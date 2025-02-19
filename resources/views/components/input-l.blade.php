
@props(['label' => '', 'for'=> '', 'disabled' => false])

<x-label for="{{$for}}">{{$label}}</x-label>

<input  {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full border-palette-200 bg-neutral-50 text-palette-200 focus:bg-white focus:border-palette-300/30 focus:ring-palette-300
   
   rounded-md shadow-sm']) !!}>

<x-input-error for="{{$for}}" />