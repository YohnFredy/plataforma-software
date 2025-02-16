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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

        @stack('css')


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('js')

        <!-- Styles -->
        @livewireStyles

        <style>
            #loader-wrapper {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, #f3f4f6, #e5e7eb);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.3s ease-out;
            }
    
            #loader {
                width: 80px;
                height: 80px;
                border: 5px solid #f3f4f6;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
    
            .loader-hidden {
                opacity: 0;
                pointer-events: none;
            }
    
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
    
                100% {
                    transform: rotate(360deg);
                }
            }
    
            .loader-logo {
                position: absolute;
                width: 60px;
                height: 60px;
                object-fit: contain;
            }
    
            .loader-text {
                position: absolute;
                bottom: 20%;
                font-size: 1.2rem;
                color: #4b5563;
                font-weight: 500;
            }
        </style>
        
    </head>
    <body class="font-sans antialiased">

        <div id="loader-wrapper">
            <div id="loader"></div>
            <img src="{{ asset('storage\images\fornuvi-logo.png') }}" alt="Logo" class="loader-logo">
            <p class="loader-text">Cargando...</p>
        </div>

        <div class="min-h-screen bg-palette-100 dark:bg-neutral-900">

            @include('navigation')
            {{-- @livewire('navigation') --}}
    
            <!-- Page Content -->
            <main class=" text-palette-300 dark:text-neutral-300">
                {{ $slot }}
            </main>
    
            @include('footer')
    
        </div>
    

        @stack('modals')

        @livewireScripts

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loaderWrapper = document.getElementById('loader-wrapper');
    
                // Ocultar el loader después de un breve retraso
                setTimeout(function() {
                    loaderWrapper.classList.add('loader-hidden');
                    loaderWrapper.addEventListener('transitionend', function() {
                        if (loaderWrapper.parentNode) {
                            loaderWrapper.parentNode.removeChild(loaderWrapper);
                        }
                    });
                }, 0); // Ajusta este valor según sea necesario
            });
        </script>
    </body>
</html>
