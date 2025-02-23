<div>
    <h1 class=" font-bold mb-2 text-palette-200 ">Categorias</h1>
    <div
        class="p-4 rounded-lg bg-white border border-palette-200/50 shadow-lg shadow-palette-300 ">

        <div class="flex items-center justify-between mb-6">
            <x-dynamic-button> <a href="{{ route('admin.categories.create') }}">Crear categorias</a></x-dynamic-button>
            {{-- Buscar productos --}}
            <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar producto" />
        </div>

        {{-- Tabla de prpductos  --}}
        <div class=" overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-palette-300">
                <thead class="text-xs text-white uppercase
                bg-gradient-to-r from-palette-200  via-palette-300 to-palette-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Category Padre</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <div wire:key="{{ $category->id }}">
                            <tr
                                class="bg-white border-b border-palette-300 ">


                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($category->parent_id > 0)
                                        {{ $category->parent->name }}
                                    @endif
                                </td>
                                <td class="py-4 text-lg text-center">

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="font-medium text-palette-200 hover:text-palette-150  mr-2"><i
                                            class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" wire:click="delete({{ $category->id }})"
                                        wire:confirm="Esta seguuro de eliminar el producto {{ $category->name }} ?"
                                        class="font-medium text-palette-400 hover:text-palette-400/80 cursor-pointer"><i
                                            class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="my-2">{{ $categories->links() }}</div>
    </div>
</div>

