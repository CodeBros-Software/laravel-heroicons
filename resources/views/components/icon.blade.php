@props(['iconName' => '', 'iconStyle' => 'outline', 'iconSize' => '24', 'solid' => '', 'outline' => ''])
@php
    if (! empty($solid)) {
        $iconStyle = 'solid';
    }
@endphp
<x-dynamic-component :component="'heroicons::'.$iconSize.'.'.$iconStyle.'.'.$iconName" {{ $attributes }}></x-dynamic-component>
