@props(['url'])

<tr>
<td class="header">
    <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
        <table cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td style="vertical-align: middle;">
                    <img src="{{ asset('logo.png') }}" class="logo" alt="Evergreen Ascent Logo" style="max-height: 40px; vertical-align: middle;">
                </td>
                <td style="vertical-align: middle; padding-left: 12px; font-size: 19px; font-weight: bold; color: #ffffff;">
                    Evergreen Ascent
                </td>
            </tr>
        </table>
    </a>
</td>
</tr>