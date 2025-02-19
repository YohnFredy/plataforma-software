<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <section class=" grid grid-cols-5 gap-6">

            <a href="{{ route('orders.index') . '?status=1' }}"
                class="col-span-5 md:col-span-1 bg-palette-200  text-white rounded-lg pt-8 pb-4">
                <p class="  text-center text-2xl">
                    {{ $pendientes }}
                </p>
                <p class=" uppercase text-center">Pendiente </p>
                <p class=" text-center text-2xl mt-2">
                    <i class=" fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . '?status=2' }}"
                class="col-span-5 md:col-span-1 bg-palette-300  text-white rounded-lg pt-8 pb-4">
                <p class="  text-center text-2xl">
                    <p class="  text-center text-2xl">
                        {{ $recibido }}
                    </p>
                </p>
                <p class=" uppercase text-center">Recibido</p>
                <p class=" text-center text-2xl mt-2">
                    <i class=" fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . '?status=4' }}"
                class="col-span-5 md:col-span-1 bg-palette-400  text-white rounded-lg pt-8 pb-4">
                <p class="  text-center text-2xl">
                    {{ $enviado }}
                </p>
                <p class=" uppercase text-center">Enviados</p>
                <p class=" text-center text-2xl mt-2">
                    <i class=" fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . '?status=5' }}"
                class="col-span-5 md:col-span-1 bg-neutral-500  text-white rounded-lg pt-8 pb-4">
                <p class="  text-center text-2xl"> {{ $entregado }}</p>
                <p class=" uppercase text-center">Entregado</p>
                <p class=" text-center text-2xl mt-2">
                    <i class=" fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . '?status=6' }}"
                class="col-span-5 md:col-span-1 bg-neutral-7000  text-white rounded-lg pt-8 pb-4">
                <p class="  text-center text-2xl">{{ $anulado }}</p>
                <p class=" uppercase text-center">Anulado</p>
                <p class=" text-center text-2xl mt-2">
                    <i class=" fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        <section class=" bg-white rounded-md mt-12 py-8 px-8 shadow-lg shadow-palette-300">
            <h3 class=" mb-4">
                Pedidos Recientes
            </h3>
            <ul>
                @foreach ($orders as $order)
                    <li>
                        <a href="{{ route('orders.show', $order) }}"
                            class=" flex items-center py-2 px-2 hover:bg-palette-30 hover:rounded-md">
                            <span class=" w-12 text-center">

                                @switch($order->status)
                                    @case(1)
                                        <i class="fas fa-business-time text-palette-200"></i>
                                    @break

                                    @case(2)
                                    @case(3)
                                        <i class="fas fa-credit-card text-palette-300"></i>
                                    @break

                                    @case(4)
                                        <i class="fas fa-truck text-palette-400"></i>
                                    @break

                                    @case(5)
                                        <i class="fas fa-check-circle text-neutral-500"></i>
                                    @break

                                    @case(6)
                                        <i class="fas fa-times-circle text-neutral-7000"></i>
                                    @break
                                @endswitch
                            </span>

                            <span>
                                Referencia: {{ $order->public_order_number }}
                                <br>
                                {{ $order->created_at->format('d/m/y') }}

                            </span>

                            <div class=" ml-auto">
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                            pendiente
                                        @break

                                        @case(2)
                                        @case(3)
                                            Recibido
                                        @break

                                        @case(4)
                                            Enviado
                                        @break

                                        @case(5)
                                            Entregado
                                        @break

                                        @case(6)
                                            Anulado
                                        @break
                                    @endswitch
                                </span>
                                <br>
                                <span>
                                    ${{ $order->total }}
                                </span>
                            </div>
                            <span>
                                <i class=" fas fa-angle-right ml-6"></i>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

        </section>
    </div>
</x-app-layout>
