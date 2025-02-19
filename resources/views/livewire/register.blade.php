<div class="py-8 px-2">
    <div class="max-w-lg mx-auto px-4 py-4 bg-black/1   rounded-md  shadow-sm shadow-palette-300">
        <p class="text-center font-bold text-palette-400 ">
            REGISTRO FORNUVI
        </p>
        <hr class=" mt-4 mb-8  border-palette-200 ">

        <form wire:submit="save" autocomplete="off">
            <div class="grid md:grid-cols-2 md:gap-x-2 gap-y-8">
                <x-floating-input label="Nombre:" wire:model="name" name="name" />
                <x-floating-input label="Apellidos:" wire:model="last_name" name="last_name" />
                <x-floating-input label="Username:" wire:model.live.debounce.1000ms="username" name="username"
                    id="username" />
                <x-floating-input label="Número de documento:" wire:model.blur="dni" name="dni" />
                <x-floating-input label="Email:" wire:model.blur="email" type="email" name="email"
                    media="col-span-2" />
                <x-floating-radio label="Sexo:" name="sex" model="sex" :options="['male' => 'Masculino', 'female' => 'Femenino']" />

                <x-floating-input label="Fecha nacimiento:" wire:model="birthdate" type="date" name="birthdate" />
                <x-floating-input label="Teléfono:" wire:model="phone" name="phone" />

                <x-floating-select label="Pais:" wire:model.live="selectedCountry" name="country_id">
                    <option value="" hidden>Seleccione un país</option>
                    @foreach ($countries as $country)
                        <div wire:key="{{ $country->id }}">
                            <option class=" text-neutral-800" value="{{ $country['id'] }}">{{ $country['name'] }}
                            </option>
                        </div>
                    @endforeach
                </x-floating-select>
                @if ($selectedCountry)
                    <x-floating-select label="Departamento:" wire:model.live="selectedDepartment" name="department_id">
                        <option value="" hidden>Seleccione departamento</option>
                        @foreach ($departments as $department)
                            <div wire:key="{{ $department->id }}">
                                <option class=" text-neutral-800" value="{{ $department['id'] }}">
                                    {{ $department['name'] }}
                                </option>
                            </div>
                        @endforeach
                    </x-floating-select>

                    @if ($selectedDepartment)
                        @if (count($cities) > 0)
                            <x-floating-select label="Ciudad:" wire:model.live="selectedCity" name="city_id"
                                label="Ciudad">
                                <option value="" hidden>Seleccione una ciudad</option>
                                @foreach ($cities as $city)
                                    <div wire:key="{{ $city->id }}">
                                        <option class=" text-neutral-800" value="{{ $city['id'] }}">
                                            {{ $city['name'] }}
                                        </option>
                                    </div>
                                @endforeach
                            </x-floating-select>
                        @else
                            <x-floating-input label="Ciudad:" wire:model="city" type="text" name="city" />
                        @endif
                    @endif
                @endif
            </div>

            <div class="grid md:grid-cols-2 md:gap-x-2 gap-y-8 mt-7">
                <x-floating-input label="Dirección:" wire:model="address" name="address" media="col-span-2"
                    autocomplete="off" />
                <x-floating-input label="Sponsor:" wire:model="sponsor" name="sponsor" disabled />
                <x-floating-input label="Posición:" wire:model="side" name="side" disabled />

                <x-floating-input label="password:" wire:model.live.debounce.750ms="password" type="password"
                    name="password" media="col-span-2" />
                <x-floating-input label="Confirmar Password:" wire:model.live.debounce.750ms="password_confirmation"
                    type="password" name="password_confirmation" media="col-span-2" />

                <div class="col-span-2 ">
                    <div class="flex items-center">
                        <x-checkbox wire:model="terms" class="mr-2" />
                        @livewire('terms-and-privacy')
                    </div>
                    <div>
                        @error('terms')
                            <span class="error text-xs text-palette-400 ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class=" col-span-2 text-center ">
                    <x-dynamic-button type="submit" class="w-full">
                        guardar registro
                    </x-dynamic-button>
                </div>
            </div>

            <div class=" text-right mt-4">
                <x-link href="{{route('index')}}">
                    Página de inicio
                </x-link>
            </div>
        </form>
    </div>


     <x-dialog-modal wire:model="confirmingRegistration">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold">
                Confirmación de Registro
            </h2>
        </x-slot>

        <x-slot name="content">
            <p class="text-lg">
                ¡Gracias por registrarte, {{ $name }}!
            </p>
            <p class="mt-4">
                Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a todas las funcionalidades de nuestra
                plataforma.
            </p>
            <p class="mt-4">
                Aquí tienes tus detalles de registro:
            </p>
            <ul class="mt-2 list-disc list-inside">
                <li><strong>Nombre de Usuario:</strong> {{ $username }}</li>
                <li><strong>Email:</strong> {{ $email }} </li>
            </ul>
            <p class="mt-4">
                Puedes empezar a explorar y utilizar nuestras funciones. Si tienes alguna pregunta o necesitas ayuda, no
                dudes en contactarnos.
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-dynamic-button color="white" wire:click="$set('confirmingRegistration', false)">
                Cerrar
            </x-dynamic-button>

            <x-dynamic-button color="white" class="ml-4" wire:click="redirectToHome" autofocus>
                página de inicio
            </x-dynamic-button>
        </x-slot>
    </x-dialog-modal> 



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var usernameInput = document.getElementById('username');

            usernameInput.addEventListener('input', function() {
                // Permitir solo letras, números, puntos (.), guiones (-) y guiones bajos (_)
                this.value = this.value.replace(/[^a-zA-Z0-9._-]/g, '');
            });
        });
    </script>
</div>
