@props(['iconName' => '', 'iconStyle' => 'outline', 'solid' => '', 'outline' => ''])
@php
    if (! empty($solid)) {
        $iconStyle = 'solid';
    }
@endphp
<x-dynamic-component :component="'heroicons::'.$iconStyle.'.'.$iconName" {{ $attributes->merge(['class' => 'h-6 w-6']) }}></x-dynamic-component>
