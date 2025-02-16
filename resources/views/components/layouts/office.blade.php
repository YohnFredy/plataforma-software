<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/admin-template.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    @stack('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- lateral menu --}}
    <div id="sidebar" class="sidebar bg-gradient-to-r from-palette-150  to-palette-200 text-neutral-100
    dark:bg-gradient-to-r dark:from-neutral-700  dark:to-neutral-800 ">
        <div class="sidebar-header shadow-md shadow-palette-300 dark:shadow-neutral-950 h-14 flex items-center">
            <a href="{{ route('office.index') }}" class="flex items-center text-xl">
                <i class="ml-5 mr-2 fas fa-building"></i>
                <span class="text"> <span class="elephant-text">FORNUVI</span>
            </a>
        </div>
        @include('office.lateral-menu')
    </div>

    {{-- header_bar --}}
    <div id="header_bar" class="header-bar bg-white shadow-md shadow-palette-300 dark:shadow-none
    dark:bg-neutral-800  dark:border-l dark:border-neutral-900 ">
        <button id="sidebarToggleButton" class="text-xl text-palette-400 hover:text-palette-200 
        dark:text-neutral-300 dark:hover:text-neutral-50 cursor-pointer"><i
                class="fas fa-bars"></i></button>
        @include('office.header-bar')
    </div>

    <div id="main_content" class="main-content">
        <div class="inner-content bg-neutral-50 text-palette-300 dark:bg-neutral-950 dark:text-red-300 p-6">
            {{ $slot }}
        </div>

        <footer class=" text-neutral-200 py-16 bg-palette-300 dark:bg-neutral-900">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Sobre Nosotros</h3>
                        <p class="text-sm leading-relaxed">Somos una empresa dedicada a brindar soluciones innovadoras y
                            de alta calidad en el sector de la salud. Nuestra misión es mejorar la vida de las personas.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition duration-300">Inicio</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Servicios</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Proyectos</a></li>
                            <li><a href="#" class="hover:text-white transition duration-300">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Contacto</h3>
                        {{-- <p class="text-sm leading-relaxed"><strong>Dirección:</strong> Calle 15, Ciudad, País</p> --}}
                        <p class="text-sm leading-relaxed"><strong>Teléfono:</strong> +57 3145207814</p>
                        <p class="text-sm leading-relaxed"><strong>Email:</strong> contacto@fornuv1.com</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Síguenos</h3>
                        <div class="flex space-x-4 text-neutral-200">
                            <a href="#" class="  hover:text-white transition duration-300"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a href="#" class=" hover:text-white transition duration-300"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-neutral-100 mt-12 pt-8 text-center text-sm">
                    &copy; 2024 fornuvi. Todos los derechos reservados.
                </div>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleButton = document.getElementById('sidebarToggleButton');
            const mainContent = document.getElementById('main_content');
            const headerBar = document.getElementById('header_bar');

            let sidebarIsCollapsed = false;

            const toggleSidebar = () => {
                sidebarIsCollapsed = !sidebarIsCollapsed;
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('visible', sidebarIsCollapsed);
                } else {
                    sidebar.classList.toggle('collapsed', sidebarIsCollapsed);
                    mainContent.classList.toggle('collapsed', sidebarIsCollapsed);
                    headerBar.classList.toggle('collapsed', sidebarIsCollapsed);
                    handleHoverEvents(sidebarIsCollapsed);
                }
            };

            const handleHoverEvents = (shouldAdd) => {
                if (shouldAdd) {
                    sidebar.addEventListener('mouseover', expandSidebar);
                    sidebar.addEventListener('mouseout', collapseSidebar);
                } else {
                    sidebar.removeEventListener('mouseover', expandSidebar);
                    sidebar.removeEventListener('mouseout', collapseSidebar);
                }
            };

            const expandSidebar = () => {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('collapsed');
                headerBar.classList.remove('collapsed');
            };

            const collapseSidebar = () => {
                if (sidebarIsCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                    headerBar.classList.add('collapsed');
                }
            };

            const handleClickOutside = (event) => {
                if (sidebarIsCollapsed && window.innerWidth <= 768 && !sidebar.contains(event.target) && !
                    sidebarToggleButton.contains(event.target)) {
                    sidebar.classList.remove('visible');
                    sidebarIsCollapsed = false;
                }
            };

            sidebarToggleButton.addEventListener('click', toggleSidebar);
            document.addEventListener('click', handleClickOutside);
        });
    </script>

</body>

</html>
