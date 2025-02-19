<div class="w-full text-palette-200 " x-data="{ openCategoryId: null, openSubcategoryId: null }" x-cloak>
    <p class="text-palette-400 ">Categorías</p>

    <ul class="divide-y-1 divide-palette-300  mt-2">
        @foreach ($categories as $category)
            @if ($category->children->isEmpty())
                {{-- Categorías sin subcategorías --}}
                <li class="ml-1 px-2 hover:text-palette-300 hover:bg-neutral-100  " wire:key="category-{{ $category->id }}">
                    <a href="{{ route('product', ['category' => $category->slug]) }}" class="block ">
                        {{ $category->name }}
                    </a> 
                </li>
            @else
                {{-- Categorías con subcategorías --}}
                <li class="ml-1" wire:key="category-{{ $category->id }}">
                    <button class="w-full px-2 hover:text-palette-300 hover:bg-neutral-100 focus:bg-neutral-200    cursor-pointer"
                        x-on:click="openCategoryId = (openCategoryId === {{ $category->id }} ? null : {{ $category->id }})">
                        <span class="flex items-center justify-between">
                            <p class="text-left mr-2">{{ $category->name }}</p>
                            <i :class="openCategoryId === {{ $category->id }} ?
                                    'fas fa-chevron-down text-palette-400 ' :
                                    'fas fa-chevron-right text-palette-500 '"></i>
                        </span>
                    </button>

                    {{-- Mostrar subcategorías --}}
                    <div x-show="openCategoryId === {{ $category->id }}" x-collapse>
                        <ul class="divide-y-1 divide-palette-300 ">
                            @foreach ($category->children as $subcategory)
                                @if ($subcategory->children->isEmpty())
                                    {{-- Subcategorías sin hijos --}}
                                    <li class="ml-2 hover:text-palette-300 hover:bg-neutral-100    "
                                        wire:key="subcategory-{{ $subcategory->id }}">
                                        <a href="{{ route('product', ['category' => $subcategory->slug]) }}"
                                            class="block text-left font-medium px-2">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @else
                                    {{-- Subcategorías con hijos --}}
                                    <li class="ml-3 "
                                        wire:key="subcategory-{{ $subcategory->id }}">
                                        <button
                                            class="w-full hover:text-palette-300 hover:bg-neutral-100 focus:bg-neutral-200    px-2 cursor-pointer"
                                            x-on:click="openSubcategoryId = (openSubcategoryId === {{ $subcategory->id }} ? null : {{ $subcategory->id }})">
                                            <span class="flex items-center justify-between">
                                                <p class="text-left mr-2 ">{{ $subcategory->name }}</p>
                                                <i
                                                    :class="openSubcategoryId === {{ $subcategory->id }} ?
                                                        'fas fa-chevron-down text-palette-400 ' :
                                                        'fas fa-chevron-right text-palette-500 '"></i>
                                            </span>
                                        </button>

                                        <div x-show="openSubcategoryId === {{ $subcategory->id }}" x-collapse>
                                            <ul class="divide-y-1 divide-palette-300 ">
                                                @foreach ($subcategory->children as $subsubcategory)
                                                    <li class="ml-3 hover:text-palette-300 hover:bg-neutral-100 focus:bg-neutral-200   "
                                                        wire:key="subsubcategory-{{ $subsubcategory->id }}">
                                                        <a href="{{ route('product', ['category' => $subsubcategory->slug]) }}"
                                                            class="block text-left px-2">
                                                            {{ $subsubcategory->name }} ddd
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>
