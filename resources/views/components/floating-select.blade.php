@props([
    'type' => 'text',
    'name' => null,
    'label' => 'name',
    'required' => false,
    'media' => 'col-span-2 md:col-span-1',
])

<div class="{{ $media }}">
    <div class="relative z-0 w-full">
        <select name="{{ $name }}"
            {{ $attributes->merge(['class' => 'block rounded-md w-full bg-transparent border-0 border-b-1 border-palette-300 dark:border-neutral-600 focus:ring-0 focus:border-palette-200 dark:focus:border-neutral-500 py-1 text-sm text-palette-200 dark:text-neutral-300 focus:text-palette-300 dark:focus:text-neutral-200 peer']) }}
            placeholder=" " {{ $required ? 'required' : '' }}>
            {{ $slot }}
        </select>
        <div
            class="absolute -z-10 w-full h-full top-0 rounded-md transition-colors duration-500 ease-in-out bg-neutral-100 dark:bg-white/5 peer-focus:bg-white dark:peer-focus:bg-white/8">
        </div>


        <label for="{{ $name }}"
            class="absolute top-1 left-1 -z-10 
                   text-xs peer-focus:text-xs peer-placeholder-shown:text-sm
                 text-palette-300  peer-placeholder-shown:text-palette-     peer-focus:text-palette-200
                 dark:text-neutral-400 dark:peer-placeholder-shown:text-neutral-3     dark:peer-focus:text-neutral-200
                   duration-300 ease-in-out 
                   transform -translate-y-5.5 -translate-x-0
                   peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-5.5 
                   peer-placeholder-shown:translate-x-2  peer-focus:-translate-x-0">{{ $label }}
        </label>
    </div>
    <div class="">
        @error($name)
            <span class="error text-xs text-palette-400 dark:text-white">{{ $message }}</span>
        @enderror
    </div>
</div>
