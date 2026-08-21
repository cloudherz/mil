@php
    $buttonIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-BUTTON-icon I-BUTTON-icon_{$color}\" style=\"height: {$iconHeight}\" />");

    $typeUppercase = strtoupper($type);
@endphp

<button class="B-BUTTONS-button B-BUTTONS-button_{{ $color }}" id="LANDING-APPLICATION-SELECT-{{ $typeUppercase }}_BUTTON">
    <div class="S-BUTTON-wrapper">
        <div class="S-BUTTON-carcass">
            <div class="S-BUTTON-icon">
                {!! $buttonIcon !!}
            </div>
            <div class="S-BUTTON-heading">
                <span class="T-BUTTON-heading T-BUTTON-heading_{{ $color }} TYPO-PRESET-CORE_H3">{!! $title !!}</span>
            </div>
        </div>
    </div>
</button>
