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
        $number <= 3 => '1.95vh',
        $number <= 6 => '1.98vh',
        $number <= 9 => '1.975vh',
        $number <= 12 => '1.745vh',
        $number <= 15 => '1.97vh',
        default => '1.9vh',
    };

    $icon = Blade::render("<x-svg.icons.{$liIconName} class=\"I-TRACK-option\" style=\"width: {$liIconSize}\" />");

@endphp

<li class="LI-TRACK-option LI-TRACK-option_{{ $color }} {{ match((int) $number) { 9 => 'LI-TRACK-option_industry_visionary', 11 => 'LI-TRACK-option_territory_development', default => '' } }}" data-value="{{ $number }}" data-color="{{ $color }}">
    <div class="S-OPTION-icon">
        {!! $icon !!}
    </div>
    <span class="T-TRACK-option">{{ $text }}</span>
</li>
