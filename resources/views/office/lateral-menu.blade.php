<div class="lateral-menu mt-6">

    <ul class="divide-y divide-neutral-50  mt-6">

        <li>
            <x-lateral-nav-link href="{{ route('office.index') }}" :active="request()->routeIs('office.index')">
                <i class=" ml-5 mr-2 fas fa-building"></i>
                <span class="text">Inicio</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="">
                <i class="ml-5 mr-2 fas fa-store"></i>
                <span class="text">Tienda</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="{{ route('office.binary-tree') }}" :active="request()->routeIs('office.binary-tree')" >
               {{--  <i class="ml-5 mr-2 fas fas fa-network-wired"></i> --}}
                <i class="ml-5 mr-2 fas fa-project-diagram"></i>
                <span class="text">Binario</span>
            </x-lateral-nav-link>
        </li>

        <li>
            <x-lateral-nav-link href="{{ route('office.unilevel-tree') }}" :active="request()->routeIs('office.unilevel-tree')">
                <i class="ml-5 mr-2 fas fa-sitemap"></i>
                <span class="text">unilevel</span>
            </x-lateral-nav-link>
        </li>

        <!-- Agrega más elementos aquí -->
    </ul>
</div>

