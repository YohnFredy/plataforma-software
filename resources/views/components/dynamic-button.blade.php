@props(['color' => 'blue'])

@php
    // Definimos las clases de diseño base para el botón
    $baseClasses =
        'text-center px-3 py-2  rounded-md font-semibold text-xs uppercase tracking-widest   disabled:opacity-70 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-neutral-600 dark:hover:bg-neutral-700 dark:text-neutral-100 dark:hover:text-white  dark:focus:ring-neutral-800 dark:focus:ring-offset-neutral-500';

    // Definimos las clases de color y efecto hover basadas en el color proporcionado
    $colorClasses = match ($color) {
        'blue' => 'bg-palette-200 hover:bg-palette-150 text-neutral-100 hover:text-white  focus:ring-palette-300',
        'white' => 'bg-neutral-200 hover:bg-white text-palette-300 hover:text-palette-200  focus:ring-neutral-200 focus:ring-offset-palette-300'
    };
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "$baseClasses $colorClasses"]) }}>
    {{ $slot }}
</button>
