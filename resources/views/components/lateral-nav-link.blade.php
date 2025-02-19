@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'py-2 flex items-center bg-neutral-50 text-palette-200 font-bold text-lg'
            : 'py-2 flex items-center hover:bg-palette-300 text-neutral-100 hover:text-white
            ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
