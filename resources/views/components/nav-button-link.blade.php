@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-white dark:bg-neutral-800 px-4 py-3 mr-2 text-sm font-medium leading-5 text-palette-300 dark:text-neutral-200 transition duration-150 ease-in-out z-50'

            :'py-3 hover:bg-white dark:hover:bg-neutral-800 text-neutral-100 dark:text-neutral-400 hover:text-palette-200 dark:hover:text-neutral-200 px-4 mr-2 text-sm font-medium leading-5 transition duration-150 ease-in-out z-50' ;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


{{-- bg-palette-200 dark:bg-palette-60  px-4 py-2  mr-2 text-white  text-sm --}}