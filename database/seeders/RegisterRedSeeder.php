<?php

namespace Database\Seeders;

use App\Models\Binary;
use App\Models\BinaryTotal;
use App\Models\Unilevel;
use App\Models\UnilevelTotal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class RegisterRedSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('id', '>', 1)->get();

        foreach ($users as $user) {
            $sponsor = rand(1, $user->id - 1);
            $side = $this->getBinaryPosition($sponsor);

            $this->processBinaryStructure($user->id, $sponsor, $side);
            $this->processUnilevelStructure($user->id, $sponsor);
        }
    }

    private function processBinaryStructure($userId, $sponsorId, $side)
    {
        $currentSponsorId = $sponsorId;
        while (true) {
            $binary = Binary::where('sponsor_id', $sponsorId)
                ->where('side', $side)
                ->first();

            if (!$binary) {
                Binary::create([
                    'user_id' => $userId,
                    'sponsor_id' => $sponsorId,
                    'side' => $side,
                ]);
                break;
            }
            $sponsorId = $binary->user_id;
            $this->incrementBinaryAffiliates($sponsorId, $side);
        }

        $this->incrementBinaryAffiliates($currentSponsorId, $side);

        while ($binary = Binary::where('user_id', $currentSponsorId)->first()) {
            $this->incrementBinaryAffiliates($binary->sponsor_id, $binary->side);
            $currentSponsorId = $binary->sponsor_id;
        }
    }

    private function incrementBinaryAffiliates($userId, $side)
    {
        $binaryTotal = BinaryTotal::where('user_id', $userId)
            ->firstOrCreate(
                ['user_id' => $userId],
                ['left_affiliates' => 0, 'right_affiliates' => 0]
            );

        $binaryTotal->increment($side === 'left' ? 'left_affiliates' : 'right_affiliates');
    }

    private function processUnilevelStructure($userId, $sponsorId)
    {
        Unilevel::create([
            'user_id' => $userId,
            'sponsor_id' => $sponsorId,
        ]);

        $this->updateUnilevelCounters($sponsorId);
    }

    private function updateUnilevelCounters($sponsorId)
    {
        $unilevelTotal = UnilevelTotal::where('user_id', $sponsorId)
            ->firstOrCreate(
                ['user_id' => $sponsorId],
                ['direct_affiliates' => 0, 'total_affiliates' => 0]
            );

        $unilevelTotal->increment('direct_affiliates');
        $unilevelTotal->increment('total_affiliates');

        while ($unilevel = Unilevel::where('user_id', $sponsorId)->first()) {
            UnilevelTotal::where('user_id', $unilevel->sponsor_id)
                ->increment('total_affiliates');
            $sponsorId = $unilevel->sponsor_id;
        }
    }

    private function getBinaryPosition($sponsorId)
    {
        $sponsorId = User::find($sponsorId);

        if ($sponsorId->binaryTotal) {
            $userCount = $sponsorId->binaryTotal;
            $left = $userCount ? $userCount->left_affiliates : 0;
            $right = $userCount ? $userCount->right_affiliates : 0;
            return $left < $right ? 'left' : 'right';
        } else {
            return 'left';
        }
    }
}
