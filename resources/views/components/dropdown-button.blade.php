<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center py-2 border border-transparent bg-white  text-palette-200  hover:text-palette-300  text-sm leading-4 font-medium rounded-md  focus:outline-none focus:bg-white  focus:text-palette-300 active:bg-white transition ease-in-out duration-15  cursor-pointer',
    ]) }}>

    {{ $slot }}

    <svg class="ms-2 -me-0.5 h-4 w-4 text-palette-400 hover:text-neutral-500   peer"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
    </svg>
</button>
