<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCrud extends Component
{
    use WithFileUploads;

    public ?Product $product;

    public $name = '', $description = '', $price = '', $commission_income = null, $pts = '', $maximum_discount, $specifications = '', $information = '', $is_physical = '', $stock = null, $allow_backorder = '', $category_id = '', $brand_id = null, $is_active = '';

    public $newImages = [],  $images = [];
    public $isEditMode = false, $suggestedPts;
    public $category, $selectedLevels = [],  $categoryLevels = [], $hasChildCategories = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'commission_income' => 'nullable|numeric|min:0|max:999999.99',
            'pts' => 'nullable|numeric|min:0|max:999999.99',
            'maximum_discount' => 'nullable|integer|min:0|max:100',
            'specifications' => 'nullable|string',
            'information' => 'nullable|string',
            'is_physical' => 'required|boolean',
            'stock' => 'nullable|required_if:is_physical,true|integer|min:0',
            'allow_backorder' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_active' => 'required|boolean',
            'newImages.*' => 'nullable|image|max:2048',
            'hasChildCategories' => 'required|boolean|accepted',
        ];
    }

    public function mount(Product $product)
    {
        $this->product = $product ?? new Product();

        // Cargar las categorías de nivel raíz (sin padre)
        $this->categoryLevels[0] = Category::whereNull('parent_id')->get();

        if ($this->product->exists) {
            $this->loadProductData();
            $this->loadCategoryData();
            $this->isEditMode = true;
        } else {
            $this->maximum_discount = 0;
        }
    }

    public function loadProductData()
    {
        $this->fill($this->product->toArray());
        $this->images = $this->product->images->pluck('path')->toArray();
    }

    public function loadCategoryData()
    {

        $this->category = Category::find($this->product->category_id);
        // Copiar los atributos de la categoría al componente
        $this->fill($this->category->toArray());

        // Cargar la cadena de categorías padres desde category principal
        $parentChain = collect();
        $currentCategory = $this->category;

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

        // Si la categoría tiene un padre, asignar su ID
        if ($this->category->parent_id) {
            $this->selectedLevels[$level] = $this->category->parent_id;
            $this->category_id = $this->category->parent_id;
        }

        $this->hasChildCategories = true;
    }

    public function updatedSelectedLevels($value, $key)
    {
        // Limpiar todos los niveles posteriores al modificado
        $this->clearLevelsFrom($key + 1);

        // Actualizar el parent_id al nivel seleccionado actual
        $this->category_id = $value;

        // Cargar las subcategorías del nivel seleccionado
        $subcategories = Category::where('parent_id', $value)->get();

        if ($subcategories->isNotEmpty()) {
            $this->categoryLevels[$key + 1] = $subcategories;
            $this->hasChildCategories = false;
        } else {
            // Si no hay subcategorías, limpiar los niveles siguientes
            unset($this->categoryLevels[$key + 1]);
            $this->hasChildCategories = true;
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
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $product = Product::create($validatedData);
        $this->saveImages($product);

        session()->flash('success', 'Producto creado exitosamente.');
        return redirect()->route('admin.products.index');
    }


    public function update()
    {
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $this->product->update($validatedData);
        $this->saveImages($this->product);

        session()->flash('success', 'Producto actualizado exitosamente.');
        return redirect()->route('admin.products.index');
    }

    public function removeImage($path)
    {
        if (!in_array($path, $this->images)) return;

        $this->images = array_filter($this->images, fn($image) => $image !== $path);
        Storage::delete('public/' . $path);
        $this->product->images()->where('path', $path)->delete();
    }

    protected function saveImages($product)
    {
        foreach ($this->newImages as $image) {
            $path = $image->storeAs(
                'products',
                Str::slug($this->name) . '-' . uniqid() . '.' . $image->getClientOriginalExtension(),
                'public'
            );
            $product->images()->create(['path' => $path]);
        }
    }

    public function updatedPrice($value)
    {
        if (is_numeric($value)) {
            $this->suggestedPts = number_format($value * 0.20, 2, '.', '');
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.product-crud', [
            'brands' => Brand::orderBy('name')->get()

        ]);
    }
}
