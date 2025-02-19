<x-app-layout>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class=" flex items-center bg-white  rounded-lg py-8 px-12 shadow-md shadow-palette-300  mb-6">
            <div class=" relative">
                <div class="{{$order->status >=2 && $order->status <6  ? "bg-palette-200": "bg-palette-30"  }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class=" fas fa-check text-white"></i>
                </div>

                <div class=" absolute -left-1.5  mt-0.5">
                    Recibido
                </div>
            </div>
            <div class="{{$order->status >=2 && $order->status <6  ? "bg-palette-200": "bg-palette-30"  }} h-1 flex-1 mx-2">
            </div>

            <div class=" relative">
                <div class="{{$order->status >=4 && $order->status <6  ? "bg-palette-200": "bg-palette-30"  }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class=" fas fa-truck text-white"></i>
                </div>
                <div class=" absolute -left-1.5  mt-0.5">
                    Enviado
                </div>
            </div>
            <div class="{{$order->status >=4 && $order->status <6  ? "bg-palette-200": "bg-palette-30"  }} h-1 flex-1 mx-2">
            </div>

            <div class=" relative">
                <div class="{{$order->status >=5 && $order->status < 6  ? "bg-palette-200": "bg-palette-30"  }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class=" fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5  mt-0.5">
                    Entregado
                </div>
            </div>
            
        </div>


        <!-- Order Number -->
        <div class="bg-white  rounded-lg p-6 shadow-md shadow-palette-300  mb-6">
            <p class="text-lg font-semibold text-palette-400  uppercase">Referencia: <span
                    class="text-palette-200">{{ $order->public_order_number }}</span></p>
        </div>

        <!-- Shipping and Contact Details -->
        <div class="bg-white  rounded-lg p-6 shadow-md shadow-palette-300  mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Shipping Details -->
                <div>
                    <p class="text-lg font-semibold   uppercase mb-4">Detalles de Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="">Recogida en tienda:</p>
                        <p class="">Calle 15 #42, Cali, Valle del Cauca</p>
                    @else
                        <p class="">Envío a la dirección:</p>
                        {{-- <p class="">{{ $order->address }} - {{ $order->additional_address }}</p>
                        <p class="">{{ $order->country->name }} - {{ $order->department->name }} -
                            @if ($order->city)
                                {{ $order->city->name }}
                            @else
                                {{ $order->addCity }}
                            @endif
                        </p> --}}
                    @endif
                </div>

                <!-- Contact Details -->
                <div>
                    <p class="text-lg font-semibold text-palette-200  uppercase mb-4">Contacto</p>
                    <p class="">Recibe: {{ $order->contact }}</p>
                    <p class="">Teléfono: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white  rounded-lg p-6 shadow-md shadow-palette-300  mb-6">
            <p class="text-lg font-semibold text-palette-200  uppercase mb-4">Resumen de Pedido</p>
            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">

                    <thead class="text-xs bg-palette-200  text-white uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3">Producto</th>
                            <th scope="col" class="px-6 py-3">Cant</th>
                            <th scope="col" class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr
                                class="border-b border-palette-300  hover:bg-neutral-100 ">
                                <th scope="row"
                                    class="flex items-center px-6 py-4 text-palette-200 whitespace-nowrap ">

                                    @if ($item->product->latestImage)
                                        <img src="{{ asset('storage/' . $item->product->latestImage->path) }}"
                                            alt="{{ $item->product->name }}" class="w-10 h-10 rounded-md">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="{{ $item->product->name }}"
                                            class="w-10 h-10 rounded-md">
                                    @endif

                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $item->name }}</div>
                                    </div>
                                </th>


                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">
                                    ${{ number_format($item->price * $item->quantity, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-white  rounded-lg p-6 shadow-md shadow-palette-300 ">
            <div class=" flex-1 md:flex items-center justify-between">
                <img src="https://www.agenciatravelfest.com/wp-content/uploads/2022/10/logos-medios-de-pago.jpg"
                    class=" h-28 object-cover rounded-md" alt="Logo">
                <div class="text-right">
                    <p class="">Subtotal: ${{ number_format($order->total - $order->shipping_cost, 0) }}</p>
                    <p class="">Costo de Envío: ${{ number_format($order->shipping_cost, 0) }} </p> 
                    <p class="text-lg font-semibold">Total: ${{ number_format($order->total, 0) }}</p>
                    <div class=" mt-2">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Incluir el archivo JavaScript separado -->
    <script src="{{ asset('js/boldCheckout.js') }}"></script>

</x-app-layout>
