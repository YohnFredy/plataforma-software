<li class="py-1" wire:key="category-{{ $category->id }}">
    @if ($category->children->isEmpty())
        {{-- Categoría sin hijos --}}
        <a href="{{ route('product', ['category' => $category->slug]) }}"
            class=" flex items-center px-2 py-0.5 hover:text-palette-300 hover:bg-neutral-100 rounded-md group">
            <span class="flex-1">{{ $category->name }}</span>
            <span class="opacity-0 group-hover:opacity-100 duration-300 text-palette-300">
                <i class="fas fa-arrow-right text-sm"></i>
            </span>
        </a>
    @else
        {{-- Categoría con hijos --}}
        <button
            class="w-full px-2 py-0.5 hover:text-palette-300 hover:bg-neutral-100 focus:bg-neutral-100 rounded-md cursor-pointer"
            x-on:click="openCategories[{{ $category->id }}] = !openCategories[{{ $category->id }}]">
            <span class="flex items-center justify-between ">
                <p class="">{{ $category->name }}</p>
                <i
                    x-bind:class="openCategories[{{ $category->id }}] ?
                        'fas fa-chevron-down text-palette-500' :
                        'fas fa-chevron-right text-palette-300'"></i>
            </span>
        </button>

        <div x-show="openCategories[{{ $category->id }}]" x-collapse class="ml-2">
            <ul class="divide-y-1 divide-palette-300">
                @foreach ($category->children as $child)
                    @include('partials.category-item', [
                        'category' => $child,
                        'level' => $level + 1,
                    ])
                @endforeach
            </ul>
        </div>
    @endif
</li>
