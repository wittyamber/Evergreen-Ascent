@props(['url'])

<tr>
<td class="header" align="center">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center">
<a href="{{ $url }}" style="display: inline-block;">
@if (file_exists(public_path('images/logo.png')))
{{-- If a logo exists, display it --}}
<img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo" style="display: block; width: auto; max-height: 45px;" border="0">
@else
{{-- Fallback to text if no logo is found --}}
{{ $slot }}
@endif
</a>
</td>
</tr>
</table>
</td>
</tr>