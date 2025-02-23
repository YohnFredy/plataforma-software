@props(['label' => '', 'for' => '', 'disabled' => false])

<x-label for="{{ $for }}">{{ $label }}</x-label>

<div class="w-full max-w-xs ">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'mt-1 file:bg-palette-200 file:hover:bg-palette-150 file:text-neutral-300   file:hover:text-white file:border-none file:text-sm file:px-4 file:py-2 rounded-lg file:cursor-pointer cursor-pointer bg-neutral-100  text-palette-300 text-xs pr-4 focus:outline-none',
    ]) !!} type="file" />
</div>

<x-input-error for="{{ $for }}.*" />
