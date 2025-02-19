
@props(['label' => '', 'for'=> '', 'nameOption' =>'Seleccionar', 'disabled' => false])

<x-label for="{{$for}}">{{$label}}</x-label>
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full border-palette-200  bg-neutral-100  text-palette-300  focus:bg-white  focus:border-palette-300  focus:ring-neutral-100  rounded-md shadow-sm']) !!}>
    <option value="" hidden>{{$nameOption}} {{$label}}</option>
    {{$slot}}
    
</select>
<x-input-error for="{{$for}}" />
