<nav x-data="{ sidebarOpen: false }" x-init="$watch('sidebarOpen', value => {
    if (value) {
        document.body.classList.add('overflow-hidden');
    } else {
        document.body.classList.remove('overflow-hidden');
    }
})" class=" relative bg-white dark:bg-neutral-800 ">
    <div class=" bg-palette-200 dark:bg-neutral-950 h-1">
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-1">
        <div class=" flex items-center justify-between h-14">

            <div class="shrink-0 flex items-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('storage\images\fornuvi-logo.png') }}" alt="logo" class="w-40 object-cover">
                </a>
            </div>
            <div class=" hidden sm:block mx-2 md:mx-6 grow">@livewire('search')</div>
            <div class="hidden sm:flex mr-2 md:mr-6">
                @auth
                    <x-profile-configuration />
                @else
                    <a href="{{ route('login') }}" :active="request() - > routeIs('login')">
                        <x-dropdown-button>
                            Iniciar Sesión
                        </x-dropdown-button>
                    </a>
                @endauth
            </div>
            <!-- cart -->
            <div class="flex items-center">
                <a href="" :active="request() - > routeIs('')" class="relative inline-block cursor-pointer">
                    <i
                        class="fas fa-cart-arrow-down text-3xl {{ request()->routeIs() ? 'text-palette-400 dark:text-white' : 'text-palette-200 hover:text-palette-300 dark:text-palette-30 dark:hover:text-white' }}"></i>
                    <div
                        class="top-0 left-8 absolute {{ request()->routeIs() ? 'bg-palette-200 dark:bg-white' : 'bg-palette-400 dark:bg-white' }} rounded-full p-1">
                    </div>
                </a>

                <!-- Hamburger -->
                <div class="ml-3 flex items-center sm:hidden">
                    {{-- <x-dark-button /> --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-palette-400 dark:text-neutral-400 hover:text-palette-200 dark:hover:text-neutral-100 hover:bg-palette-10 focus:outline-none  focus:text-palette-300 dark:focus:text-white cursor-pointer transition duration-150 ease-in-out">
                        <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !sidebarOpen, 'inline-flex': sidebarOpen }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="hidden sm:block bg-gradient-to-r from-palette-300 via-palette-200 to-palette-300  dark:bg-gradient-to-r dark:from-neutral-950 dark:via-neutral-900 dark:to-neutral-950 mt-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class=" flex items-center h-8">
                <x-nav-button-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                    Inicio
                </x-nav-button-link>

                <x-nav-button-link href="" :active="request()->routeIs('')">
                    Productos
                </x-nav-button-link>

                <x-nav-button-link href="{{ route('office.index') }}" :active="request()->routeIs('office.index')">
                    Oficina
                </x-nav-button-link>
            </div>
        </div>
    </div>
    <div
        class=" sm:hidden bg-gradient-to-r from-palette-300 via-palette-200 to-palette-300  dark:bg-gradient-to-r dark:from-neutral-900 dark:via-neutral-950 dark:to-neutral-900 flex items-center py-2 px-6">
        <div class="w-full rounded-lg p-0.5 dark:p-1 ">@livewire('search')</div>
    </div>


    <!-- Overlay -->
    <div x-show="sidebarOpen"x-cloak @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/80 z-40 transition-opacity" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <!-- Menú lateral -->

    <div x-show="sidebarOpen" x-cloak
        class="fixed inset-y-0 left-0 w-4/5 bg-white dark:bg-neutral-800 max-w-sm z-50 overflow-y-auto"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

        <div
            class="bg-gradient-to-r from-palette-150  to-palette-200 text-neutral-100 dark:text-neutral-300  
        dark:bg-gradient-to-r dark:from-neutral-900 dark:via-neutral-950 dark:to-neutral-900 h-16 flex items-center ">
            @if (Route::has('login'))
                @auth
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base dark:text-neutral-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-white dark:text-neutral-100">{{ Auth::user()->email }}
                            </div>
                        </div>

                    </div>
                @else
                    <div class="flex items-center px-4">
                        <!-- Authentication -->
                        <a href="{{ route('login') }}" :active="request() - > routeIs('login')"
                            class=" hover:text-white dark:hover:text-neutral-100">
                            Iniciar Sesión <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </div>
                @endauth
            @endif
        </div>


        <div class="mt-3 space-y-1">
            <!-- Account Management -->
            <x-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                Inicio
            </x-responsive-nav-link>

            <x-responsive-nav-link href="" :active="request()->routeIs('')">
                Productos
            </x-responsive-nav-link>

            <x-responsive-nav-link href="" :active="request()->routeIs('')">
                Mis ordenes
            </x-responsive-nav-link>


            <x-responsive-nav-link href="{{ route('office.index') }}" :active="request()->routeIs('office.index')">
                {{ 'Oficina' }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            @if (Route::has('login'))
                @auth
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
            @endif
        </div>


        <div class=" bg-palette-300 dark:bg-neutral-600 my-4 h-1">
        </div>

        <div class=" bg-palette-100 dark:bg-neutral-700  rounded-lg  mx-4 p-4 mb-8">
            {{--  @livewire('categories') --}}
            category
        </div>
    </div>
    <!-- Estilos personalizados -->
    <style>
        /* Para personalizar el scroll del menú */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }

        .overflow-y-auto:hover::-webkit-scrollbar-thumb {
            background-color: #888;
        }
    </style>

</nav>
