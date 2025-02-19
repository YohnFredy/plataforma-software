@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-white  px-4 py-3 mr-2 text-sm font-medium leading-5 text-palette-300  transition duration-150 ease-in-out z-50'

            :'py-3 hover:bg-white  text-neutral-100  hover:text-palette-200  px-4 mr-2 text-sm font-medium leading-5 transition duration-150 ease-in-out z-50' ;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
