<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 mb-1 text-start text-sm leading-5 text-palette-300  hover:text-neutral-100 rounded-lg
                    hover:bg-gradient-to-r from-palette-200  to-palette-300 
                     transition duration-150 ease-in-out',
    ]) }}>{{ $slot }}
</a>
