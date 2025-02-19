<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $readyToLoad = false;
    public $category = '';
    

    public function mount()
    {
        if (request('category')) {
            $this->category = request('category');
           
        }

        $this->search = request()->query('search');
    }


    public function searchEnter()
    {
        $this->resetPage();
    }

    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $productsQuery = Product::query();

            if (!empty($this->search)) {
                $searchTerms = explode(' ', $this->search);
                foreach ($searchTerms as $term) {
                    $productsQuery->where(function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->orWhere('description', 'like', '%' . $term . '%');
                    });
                }
            }

            if ($this->category) {
                $category = Category::where('slug', $this->category)->firstOrFail();
                $productsQuery->where('category_id', $category->id);
            }

            $products = $productsQuery->paginate(12);
        } else {
            $products = Product::where('id', '<', 1)->paginate(12);
        }

        return view('livewire.products', [
            'products' => $products
        ]);
    }
}
