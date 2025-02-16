@props(['active'])

@php
$classes = ($active ?? false)
            ? 'py-2 flex items-center bg-neutral-50 text-palette-200 dark:bg-neutral-950 dark:text-neutral-100 font-bold text-lg'
            : 'py-2 flex items-center hover:bg-palette-300 text-neutral-100 hover:text-white
            dark:hover:bg-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-50';
@endphp

<a {{ $attributes->merge(['class' => $classes ])}}>
    {{ $slot }}
</a>

