@props([
    'showText' => true,
    'imgClass' => 'h-10 w-auto', 
    'textClass' => 'ml-3 text-xl font-bold text-gray-900' // Default fallback
])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <!-- 1. The Logo Image -->
    <img src="{{ asset('images/logo.svg') }}" 
         alt="{{ config('app.name') }}" 
         class="{{ $imgClass }}">
    
    <!-- 2. The Text (Only shows if showText is true) -->
    @if ($showText)
        <span class="{{ $textClass }}">
            {{ config('app.name', 'Evergreen Ascent') }}
        </span>
    @endif
</div>