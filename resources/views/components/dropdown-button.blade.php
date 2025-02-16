<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center py-2 border border-transparent bg-white dark:bg-neutral-800 text-palette-200 dark:text-neutral-300 hover:text-palette-300 dark:hover:text-neutral-100 text-sm leading-4 font-medium rounded-md  focus:outline-none focus:bg-white dark:focus:bg-neutral-800 focus:text-palette-300 dark:focus:text-neutral-200 active:bg-white transition ease-in-out duration-15  cursor-pointer',
    ]) }}>

    {{ $slot }}

    <svg class="ms-2 -me-0.5 h-4 w-4 text-palette-400 hover:text-palette-500 dark:text-neutral-100 dark:hover:text-neutral-50 peer"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
    </svg>
</button>
