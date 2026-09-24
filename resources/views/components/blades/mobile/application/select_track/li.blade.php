@php

    $liIconName = match(true) {
        $number <= 3 => 'briefcase',
        $number <= 6 => 'office',
        $number <= 9 => 'region',
        $number <= 12 => 'person',
        $number <= 15 => 'engineering',
        default => 'alert',
    };

    $liIconSize = match(true) {
        $number <= 3  => '3.65dvw',
        $number <= 6  => '3.68dvw',
        $number <= 9  => '3.775dvw',
        $number <= 12 => '3.345dvw',
        $number <= 15 => '3.8dvw',
        default       => '3.6dvw',
    };

    $icon = Blade::render("<x-svg.icons.{$liIconName} class=\"I-TRACK-option\" style=\"width: {$liIconSize}\" />");

@endphp

<li class="LI-TRACK-option LI-TRACK-option_{{ $color }} {{ match((int) $number) { 9 => 'LI-TRACK-option_industry_visionary', 11 => 'LI-TRACK-option_territory_development', default => '' } }}" data-value="{{ $number }}" data-color="{{ $color }}">
    <div class="S-OPTION-icon">
        {!! $icon !!}
    </div>
    <span class="T-TRACK-option">{{ $text }}</span>
</li>
