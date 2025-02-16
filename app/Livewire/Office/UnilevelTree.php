<?php

namespace App\Livewire\Office;

use App\Models\Unilevel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UnilevelTree extends Component
{
    public array $tree;
    public User $currentUser;
    public int $secondaryUserId;
    public int $primaryUserId;

    private const MAX_TREE_LEVEL = 3;

    public function mount(): void
    {
        $this->resetTree();
    }

    public function resetTree(): void
    {
        $this->currentUser = Auth::user();
        $this->primaryUserId = $this->currentUser->id;
        $this->secondaryUserId = $this->currentUser->id;
    }

    private function buildTree(User $user, int $level = 0): array
    {
        if (!$user->relationLoaded('unilevelTotal')) {
            $user->load('unilevelTotal');
        }
        
        $branch = [
            'level' => $level,
            'id' => $user->id,
            'username' => $user->username,
            'children' => [],
            'direct_affiliates' => $user->unilevelTotal?->direct_affiliates ?? 0,
            'total_affiliates' => $user->unilevelTotal?->total_affiliates ?? 0,
        ];

        if ($level < self::MAX_TREE_LEVEL) {
            $branch['children'] = $this->getChildrenBranches($user->id, $level);
        }

        return $branch;
    }

    private function getChildrenBranches(int $parentId, int $currentLevel): array
    {
        return Unilevel::where('sponsor_id', $parentId)
            ->with(['user.unilevelTotal'])
            ->get()
            ->map(fn(Unilevel $child) => $this->buildTree($child->user, $currentLevel + 1))
            ->toArray();
    }

    public function show(User $user): void
    {
        $this->currentUser = $user;

        if ($this->primaryUserId === $this->currentUser->id) {
            return;
        }
      
        if ($this->currentUser->id === $this->secondaryUserId) {
            $this->currentUser = User::findOrFail($user->unilevel->sponsor_id);
            $this->secondaryUserId = $this->currentUser->id;
        } else {
            $this->secondaryUserId = $this->currentUser->id;
        }
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        $this->tree = $this->buildTree($this->currentUser);
        return view('livewire.office.unilevel-tree');
    }
}
