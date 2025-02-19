<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
    <div class="bg-white  pt-6 pb-8 mt-6 rounded-md shadow-md shadow-palette-300  ">
        <div class=" grid grid-cols-10 gap-6 px-10 md:px-4 lg:px-10 ">
            <div class="col-span-10 md:col-span-6 lg:col-span-5">
                <a href="{{ url()->previous() }}"
                    class="flex items-center cursor-pointer hover:text-palette-200   mb-2">
                    <i class="fas fa-long-arrow-alt-left mr-2"></i>
                    <h5 class="">Home</h5>
                </a>
                <div class=" flex justify-center">
                    <div class=" max-w-96"> @livewire('product-images-carousel', ['product' => $product])</div>
                </div>
            </div>

            <div class="col-span-10 md:col-span-4 lg:col-span-5 mt-6">
                <h1 class="text-palette-400  font-bold uppercase">{{ $product->name }}</h1>
                <div class=" text-justify mt-2 md:mt-6">
                    <p>{!! $product->description !!}</p>
                </div>
                <h1 class="mt-3 md:mt-6 text-palette-200  font-bold">
                    ${{ number_format($product->price, 0) }}</h1>
                <p class="text-palette-400  font-bold">Pts: {{ $product->pts }}</p>

                <div class=" mt-6">
                    <button wire:click="decrement"
                        class="py-1 px-3 rounded-md text-neutral-200 hover:text-white bg-palette-200  hover:bg-palette-150   ">-</button>
                    <input type="text"
                        class="text-center p-0 w-14 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none "
                        type="number" wire:model.live="quantity" min="1" max="100" step="1" x-data
                        x-on:input="$el.value = Math.max(1, Math.min(100, $el.value))">
                    <button wire:click="increment"
                        class="py-1 px-3 rounded-md text-neutral-200 hover:text-white bg-palette-200  hover:bg-palette-150   ">+</button>
                </div>

                <div class="mt-8">
                    <x-dynamic-button wire:click="addToCart">agregar al carro</x-dynamic-button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white  mt-6 rounded-md shadow-md shadow-palette-300  ">
        <div class="grid grid-cols-2 gap-10 p-8">
            <div class="col-span-2 md:col-span-1 text-justify">
                <h2 class=" text-palette-200 ">Especificaciones</h2>
                <hr class="border-b-2 border-palette-300 ">
                <p class="pt-6">{!! $product->specifications !!}</p>
            </div>
            <div class="col-span-2 md:col-span-1 text-justify">
                <h2 class=" text-palette-200 ">Información adicional</h2>
                <hr class="border-b-2 border-palette-300 ">
                <p class="pt-6">{!! $product->information !!}</p>
            </div>
        </div>
    </div>


    <x-dialog-modal wire:model="modalCart">
        <x-slot name="title">
            <div class=" flex justify-between items-center">
                <div class=" flex items-center">
                    <i class=" text-palette-200  text-3xl far fa-check-circle mr-2"> </i>
                    <h3> Lo que llevas en tu Carro</h3>
                </div>
                <div>
                    <h3>X</h3>
                </div>
            </div>
            <hr class=" mt-2">
        </x-slot>

        <x-slot name="content">
            <table class="w-full text-sm text-left rtl:text-right text-palette-300  ">
                <tbody>
                    <tr class="">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-palette-200 whitespace-nowrap ">
                            <img class="w-10 h-10 rounded-md border border-neutral-600"
                                src="{{ asset('storage/' . $product->latestImage->path) }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $product->name }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            ${{ number_format($product->price, 0) }}
                        </td>

                        <td class="px-6 py-4">
                            Pts: {{ $product->pts }}
                        </td>
                        <td class="px-6 py-4">
                            Cantidad: {{ $quantity }}
                        </td>

                    </tr>

                </tbody>
            </table>

        </x-slot>

        <x-slot name="footer">

            <div class="flex items-center">
                <a class="text-neutral-300 hover:text-neutral-100 cursor-pointer underline focus:outline-none mr-4" href="{{ route('product') }}">Seguir Comprando</a>
            

                <x-link href="{{ route('product.cart') }}">
                    <x-dynamic-button color="white">Ir al carro</x-dynamic-button></x-link>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
