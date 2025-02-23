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
        ">
        <div class="sidebar-header shadow-md shadow-palette-300  h-14 flex items-center">
            <a href="{{ route('office.index') }}" class="flex items-center text-xl">
                <i class="ml-5 mr-2 fas fa-building"></i>
                <span class="text"> <span class="elephant-text">FORNUVI</span>
            </a>
        </div>
        @include('admin.lateral-menu')
    </div>

    {{-- header_bar --}}
    <div id="header_bar" class="header-bar bg-white shadow-md shadow-palette-300 
        ">
        <button id="sidebarToggleButton" class="text-xl text-palette-400 hover:text-palette-200 
          cursor-pointer"><i
                class="fas fa-bars"></i></button>
        @include('admin.header-bar')
    </div>

    <div id="main_content" class="main-content">
        <div class="inner-content bg-neutral-50 text-palette-300   p-6">
            {{ $slot }}
        </div>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

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
