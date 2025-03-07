@props([
    'name' => 'name',
    'label' => 'name',
    'options' => [],
    'model' => null,
    'media' => 'col-span-2 md:col-span-1',
])

<div class="{{ $media }}">
    <div class="relative z-0 w-full">
        <div
            class="rounded-md w-full py-1 text-sm 
            border-0 border-b-1 
            border-palette-300 hover:border-palette-200 
             
            transition-colors duration-500 ease-in-out 
            bg-neutral-100 hover:bg-white 
             peer">

            <div class="flex items-center pl-3 space-x-3">
                @foreach ($options as $value => $optionLabel)
                    <div class="space-x-2 flex items-center">
                        <input
                            class="w-3.5 h-3.5 rounded-full 
                            border-1  border-neutral-700 
                             bg-white 
                            k  checked:bg-palette-200 
                             outline-palette-300
                            transition duration-900"
                            wire:model.live="{{ $model }}" type="radio" name="{{ $name }}"
                            id="{{ $value }}" value="{{ $value }}">
                        <label class=" text-palette-200"
                            for="{{ $value }}">{{ $optionLabel }}</label>
                    </div>
                @endforeach
            </div>

        </div>
        <label for="{{ $name }}"
            class="absolute -top-4 left-1 text-xs 
            transition-colors duration-500 ease-in-out
           text-palette-300 peer-hover:text-palette-200 
            ">
            {{ $label }}
        </label>
    </div>
    <div class=" ">
        @error($name)
            <span class="error text-xs text-palette-400 ">{{ $message }}</span>
        @enderror
    </div>
</div>
