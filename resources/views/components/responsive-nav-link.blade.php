@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-1 border-l-8 border-palette-200  text-start text-base font-medium text-white bg-gradient-to-r from-palette-300  to-palette-150  focus:outline-none focus:text-white focus:bg-palette-300 focus:border-palette-150  
            transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-1 border-l-8 border-transparent text-start text-base font-medium text-palette-300 hover:text-palette-200  hover:bg-neutral-200  hover:border-palette-200  focus:outline-none focus:text-palette-400  focus:bg-nuetral-200  focus:border-palette-150 
            transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
