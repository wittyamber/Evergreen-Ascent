@props([
    'showText' => true,
    'imgClass' => 'h-10 w-auto', 
    'textClass' => 'ml-3 text-xl font-bold text-white tracking-tight' 
])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <!-- DIRECT LINK TO STATIC LOGO -->
    <img src="{{ asset('images/logo.png') }}" 
         alt="{{ config('app.name') }}" 
         class="{{ $imgClass }}">
    
    @if ($showText)
        <span class="{{ $textClass }}">
            <!-- Try Database Name, Fallback to Env, Fallback to 'Evergreen' -->
            {{ \App\Models\SystemSetting::get('site_name') ?? config('app.name', 'Evergreen Ascent') }}
        </span>
    @endif
</div>