<?php

namespace App\Livewire;

use App\Models\Binary;
use App\Models\BinaryTotal;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Unilevel;
use App\Models\UnilevelTotal;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    public $sponsor = 'master', $side = 'right';

    #[Validate()]
    public $username, $name, $last_name, $dni, $email, $password, $password_confirmation;
    public $sex, $birthdate, $phone, $country_id, $department_id, $city_id, $address, $terms = false;
    public $countries = [], $departments = [], $cities = [];
    public $selectedCountry = '', $selectedDepartment = '', $selectedCity = '',  $city = '';

    public bool $confirmingRegistration = false;

    protected function rules()
    {
        return [
            'sponsor' => ['required', 'string', 'max:20', 'exists:users,username'],
            'side' => ['required', Rule::in(['right', 'left'])],
            'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9._-]+$/', Rule::unique('users', 'username'),],
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => ['required', 'string', 'max:255', Rule::unique('users', 'dni')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'sex' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:30',
            'country_id' => 'required|integer',
            'department_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'terms' => 'accepted',
        ];
    }

    public function mount($sponsor, $side)
    {
        $this->sponsor = $sponsor;
        $this->side = $side;
        $this->countries = Country::all();
    }

    public function updatedSelectedCountry($country_id)
    {
        $this->reset(['departments', 'selectedDepartment', 'cities', 'selectedCity', 'city']);
        $this->departments = Department::where('country_id', $country_id)->get();
        $this->country_id = $country_id;
        $this->reset('department_id', 'city_id', 'city');
    }

    public function updatedSelectedDepartment($department_id)
    {
        $this->reset(['cities', 'selectedCity', 'city']);
        $this->cities = City::where('department_id', $department_id)->get();
        $this->department_id = $department_id;
        $this->reset('city_id', 'city');
    }

    public function updatedSelectedCity($city_id)
    {
        $this->reset('city');
        $this->city_id = $city_id;
        $this->reset('city');
    }

    public function updatedCity()
    {
        $this->reset('cityId');
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {

                $user = $this->createUserWithData();
                $sponsor = User::where('username', $this->sponsor)->firstOrFail();

                $this->processBinaryStructure($user->id, $sponsor->id);
                $this->processUnilevelStructure($user->id, $sponsor->id);

                $this->confirmingRegistration = true;
            }, 5); // 5 intentos en caso de deadlock

        } catch (\Exception $e) {
            logger()->error('Error en registro MLM: ' . $e->getMessage());
            $this->addError('registration', 'No se pudo completar el registro.');
        }
    }

    private function createUserWithData()
    {

        $user = User::create([
            'username' => $this->username,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'dni' => $this->dni,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Crear datos del usuario
        UserData::create([
            'user_id' => $user->id,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'address' => $this->address,
        ]);

        return $user;
    }

    private function processBinaryStructure($userId, $sponsorId)
    {
        $currentSponsorId = $sponsorId;

        while (true) {
            $binary = Binary::where('sponsor_id', $sponsorId)
                ->where('side', $this->side)
                ->first();

            if (!$binary) {
                Binary::create([
                    'user_id' => $userId,
                    'sponsor_id' => $sponsorId,
                    'side' => $this->side,
                ]);
                break;
            }
            $sponsorId = $binary->user_id;
            $this->incrementBinaryAffiliates($sponsorId, $this->side);
        }

        $this->incrementBinaryAffiliates($currentSponsorId, $this->side);

        while ($binary = Binary::where('user_id', $currentSponsorId)->first()) {
            $this->incrementBinaryAffiliates($binary->sponsor_id, $binary->side);
            $currentSponsorId = $binary->sponsor_id;
        }
    }

    private function incrementBinaryAffiliates($userId, $side)
    {
        $binaryTotal = BinaryTotal::where('user_id', $userId)
            ->lockForUpdate()
            ->firstOrCreate(
                ['user_id' => $userId],
                ['left_affiliates' => 0, 'right_affiliates' => 0]
            );

        // Incrementar el campo correspondiente
        $binaryTotal->increment($side === 'left' ? 'left_affiliates' : 'right_affiliates');
    }

    private function processUnilevelStructure($userId, $sponsorId)
    {
        Unilevel::create([
            'user_id' => $userId,
            'sponsor_id' => $sponsorId,
        ]);

        // Actualizar contadores unilevel
        $this->updateUnilevelCounters($sponsorId);
    }

    private function updateUnilevelCounters($sponsorId)
    {
        $unilevelTotal = UnilevelTotal::where('user_id', $sponsorId)
            ->lockForUpdate()
            ->firstOrCreate(
                ['user_id' => $sponsorId],
                ['direct_affiliates' => 0, 'total_affiliates' => 0]
            );

        $unilevelTotal->increment('direct_affiliates');
        $unilevelTotal->increment('total_affiliates');

        while ($unilevel = Unilevel::where('user_id', $sponsorId)->first()) {
            UnilevelTotal::where('user_id', $unilevel->sponsor_id)
                ->lockForUpdate()
                ->increment('total_affiliates');

            $sponsorId = $unilevel->sponsor_id;
        }
    }

    public function updatedConfirmingRegistration()
    {
        $this->reset();
        $this->confirmingRegistration = false;
    }

    public function redirectToHome()
    {
        return redirect('/');
    }

    #[Layout('components.layouts.register')]
    public function render()
    {
        return view('livewire.register');
    }
}
