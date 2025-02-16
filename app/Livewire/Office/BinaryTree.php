<?php

namespace App\Livewire\Office;

use App\Models\Binary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BinaryTree extends Component
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
        if (!$user->relationLoaded('binaryTotal')) {
            $user->load('binaryTotal');
        }

        $totalBinary = [
            'left' => $user->binaryTotal?->left_affiliates ?? 0,
            'right' => $user->binaryTotal?->right_affiliates ?? 0
        ];

        $branch = [
            'level' => $level,
            'id' => $user->id,
            'username' => $user->username,
            'children' => [],
            'position' => $user->binary?->side ?? 'right',
            'left' => $totalBinary['left'],
            'right' => $totalBinary['right'],
        ];

        if ($level < self::MAX_TREE_LEVEL) {
            $branch['children'] = $this->getChildrenBranches($user->id, $level);
        }

        return $branch;
    }

    private function getChildrenBranches(int $parentId, int $currentLevel): array
    {
        return Binary::where('sponsor_id', $parentId)
            ->with(['user.binaryTotal'])
            ->orderBy('side', 'asc')
            ->get()
            ->map(fn(Binary $child) => $this->buildTree($child->user, $currentLevel + 1))
            ->toArray();
    }

    public function show(User $user): void
    {
        $this->currentUser = $user;

        if ($this->primaryUserId === $this->currentUser->id) {
            return;
        }
        if ($this->currentUser->id === $this->secondaryUserId) {
            $this->currentUser = User::findOrFail($user->binary->sponsor_id);
            $this->secondaryUserId = $this->currentUser->id;
        } else {
            $this->secondaryUserId = $this->currentUser->id;
        }
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        $this->tree = $this->buildTree($this->currentUser);
        return view('livewire.office.binary-tree');
    }
}
