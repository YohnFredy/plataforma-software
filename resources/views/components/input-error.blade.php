@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-palette-400 ']) }}>{{ $message }}</p>
@enderror
