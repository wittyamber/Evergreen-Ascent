@props([
    'showText' => true,
    'imgClass' => 'h-10 w-auto', 
    'textClass' => 'ml-3 text-xl font-bold text-white tracking-tight' 
])

@php
    // Fetch the logo path from the database (Admin Settings)
    $logoPath = \App\Models\SystemSetting::get('site_logo');
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    
    <!-- 1. The Logo Image (Dynamic) -->
    @if($logoPath)
        <!-- If Admin uploaded a logo, show it from Storage -->
        <img src="{{ asset('storage/' . $logoPath) }}" 
             alt="{{ config('app.name') }}" 
             class="{{ $imgClass }}">
    @else
        <!-- Fallback: Default SVG Icon (The Evergreen Leaf) -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="{{ $imgClass }} text-emerald-400">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
        </svg>
    @endif
    
    <!-- 2. The Text (Dynamic) -->
    @if ($showText)
        <span class="{{ $textClass }}">
            <!-- Uses the Name set in Admin Panel, or defaults to .env name -->
            {{ \App\Models\SystemSetting::get('site_name', config('app.name', 'Evergreen Ascent')) }}
        </span>
    @endif
</div>