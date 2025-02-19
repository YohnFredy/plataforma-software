@props([
    'type' => 'text',
    'name' => null,
    'label' => 'name',
    'required' => false,
    'media' => 'col-span-2 md:col-span-1',
])

<div class="{{ $media }}">
    <div class="relative z-0 w-full">
        <input type="{{ $type }}" name="{{ $name }}"
            {{ $attributes->merge(['class' => 'block rounded-md w-full bg-transparent border-0 border-b-1 border-palette-300  focus:ring-0 focus:border-palette-200  py-1 text-sm text-palette-200  focus:text-palette-300  peer']) }}
            placeholder=" " {{ $required ? 'required' : '' }} />
        <div
            class="absolute -z-10 w-full h-full top-0 rounded-md transition-colors duration-500 ease-in-out bg-neutral-100  peer-focus:bg-white ">
        </div>

        <label for="{{ $name }}"
            class="absolute top-1 left-1 -z-10 
                   text-xs peer-focus:text-xs peer-placeholder-shown:text-sm
                 text-palette-300  peer-placeholder-shown:text-palette-     peer-focus:text-palette-200
                       
                   duration-300 ease-in-out 
                   transform -translate-y-5.5 -translate-x-0
                   peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-5.5 
                   peer-placeholder-shown:translate-x-2  peer-focus:-translate-x-0">{{ $label }}
        </label>
    </div>
    <div class="">
        @error($name)
            <span class="error text-xs text-palette-400 ">{{ $message }}</span>
        @enderror
    </div>
</div>
