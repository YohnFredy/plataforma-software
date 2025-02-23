<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryCrud extends Component
{
    #[Validate('required|string|min:3|max:100')]
    public $name = "";

    #[Validate('string|max:255')]
    public $description = '';

    #[Validate('required|boolean')]
    public $is_active = '';

    public $category;
    public $isEditMode = false;
    public $parent_id = null;

    // Array para almacenar los niveles seleccionados
    public $selectedLevels = [];
    // Array para almacenar las categorías disponibles en cada nivel
    public $categoryLevels = [];

    public function mount(Category $category)
    {
        $this->category = $category;
        
        // Inicializar el primer nivel con categorías raíz
        $this->categoryLevels[0] = Category::whereNull('parent_id')->get();

        if ($this->category->exists) {
            $this->loadCategoryData();
            $this->isEditMode = true;
        }
    }

    public function loadCategoryData()
    {
        $this->fill($this->category->toArray());
        
        // Cargar la cadena de categorías padres
        $parentChain = collect();
        $currentCategory = $this->category->parent;
        
        while ($currentCategory) {
            $parentChain->prepend($currentCategory);
            $currentCategory = $currentCategory->parent;
        }

        // Configurar los niveles seleccionados y cargar sus subcategorías
        $level = 0;
        foreach ($parentChain as $parent) {
            $this->selectedLevels[$level] = $parent->id;
            $this->categoryLevels[$level + 1] = Category::where('parent_id', $parent->id)->get();
            $level++;
        }

        if ($this->category->parent_id) {
            $this->selectedLevels[$level] = $this->category->parent_id;
            $this->parent_id = $this->category->parent_id;
        }
    }

    public function updatedSelectedLevels($value, $key)
    {
        // Si el valor es vacío, limpiar este nivel y todos los siguientes
        if (empty($value)) {
            $this->clearLevelsFrom($key);
            $this->parent_id = $key > 0 ? $this->selectedLevels[$key - 1] : null;
            return;
        }

        // Limpiar todos los niveles posteriores al modificado
        $this->clearLevelsFrom($key + 1);

        // Actualizar el parent_id al nivel seleccionado actual
        $this->parent_id = $value;

        // Cargar las subcategorías del nivel seleccionado
        $subcategories = Category::where('parent_id', $value)->get();
        
        if ($subcategories->isNotEmpty()) {
            $this->categoryLevels[$key + 1] = $subcategories;
        } else {
            // Si no hay subcategorías, limpiar los niveles siguientes
            unset($this->categoryLevels[$key + 1]);
        }
    }

    protected function clearLevelsFrom($startLevel)
    {
        foreach ($this->selectedLevels as $level => $selectedId) {
            if ($level >= $startLevel) {
                unset($this->selectedLevels[$level]);
                unset($this->categoryLevels[$level + 1]);
            }
        }
    }

    public function save()
    {
        $this->validate();
        $this->category = Category::create($this->all());
        return redirect()->route('admin.categories.index');
    }

    public function update()
    {
        $this->validate();
        $this->category->update($this->all());
        return redirect()->route('admin.categories.index');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.category-crud');
    }
}