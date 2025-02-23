<div class="w-full bg-white rounded-lg shadow-md shadow-palette-300" x-data="{ openCategories: {} }" x-cloak>
    <div class="p-4 border-b border-neutral-400">
        <h3 class="text-lg font-medium text-palette-400">Categorías</h3>
    </div>
    <ul class=" text-palette-200 divide-y-1 divide-palette-300 py-4 px-2">
        @foreach ($categories as $category)
            @include('partials.category-item', ['category' => $category, 'level' => 0])
        @endforeach
    </ul>
</div>
