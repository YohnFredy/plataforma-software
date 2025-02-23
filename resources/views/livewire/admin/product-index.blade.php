<div>
    <h1 class=" font-bold mb-2 text-palette-200">Productos</h1>
    <div class="p-4 rounded-lg bg-white  border border-palette-200/25  shadow-lg shadow-palette-800   ">

        <div class="flex items-center justify-between mb-6">
            <x-dynamic-button> <a href="{{ route('admin.products.create') }}">Crear producto</a></x-dynamic-button>
            {{-- Buscar productos --}}
            <x-search wire:model="search" wire:keydown.enter="searchEnter" placeholder="buscar producto" />
        </div>

        {{-- Tabla de prpductos  --}}
        <div class=" overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-palette-300  ">
                <thead
                    class="text-xs text-white uppercase
                bg-gradient-to-r from-palette-200 via-palette-150 to-palette-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Imágenes</th>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Descripción</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <div wire:key="{{ $product->id }}">
                            <tr class="bg-white border-b border-palette-300 hover:bg-palette-10 ">

                                <th scope="row" class="px-6 py-4 whitespace-nowrap">

                                    @if ($product->latestImage)
                                        <img class=" h-10 mx-auto" src="{{ Storage::url($product->latestImage->path) }}"
                                            alt="{{ $product->name }}">
                                    @endif
                                </th>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4">{{ $product->price }}</td>

                                <td class="py-4 text-lg text-center">

                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="font-medium text-palette-200 hover:text-palette-150 mr-2"><i
                                            class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" wire:click="delete({{ $product->id }})"
                                        wire:confirm="Esta seguuro de eliminar el producto {{ $product->name }} ?"
                                        class="font-medium text-palette-400 hover:text-opacity-75 "><i
                                            class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="my-2">{{ $products->links() }}</div>
    </div>
</div>
