<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '', $searchTerms;

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function searchEnter()
    {
        $this->searchTerms = array_filter(explode(' ', $this->search));
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $categories = Category::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $categories->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%');
                });
            }
        }

        $categories = $categories->paginate(10);

        return view('livewire.admin.category-index', [
            'categories' => $categories
        ]);
    }
}
