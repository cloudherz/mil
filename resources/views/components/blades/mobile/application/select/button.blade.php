@php
    $buttonIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-BUTTON-icon I-BUTTON-icon_{$color}\" style=\"height: {$iconHeight}\" />");

    $typeUppercase = strtoupper($type);
@endphp

<button class="B-BUTTONS-button B-BUTTONS-button_{{ $color }}" id="LANDING-MOBILE-APPLICATION-SELECT-{{ $typeUppercase }}_BUTTON">
    <div class="S-BUTTON-wrapper">
        <div class="S-BUTTON-carcass">
            <div class="S-BUTTON-icon">
                {!! $buttonIcon !!}
            </div>
            <div class="S-BUTTON-heading">
                <p class="T-BUTTON-heading T-BUTTON-heading_{{ $color }} TYPO-M-PRESET-CORE_H3">{!! $title !!}</p>
            </div>
            <div class="S-BUTTON-text">
                <p class="T-BUTTON-text T-BUTTON-text_{{ $color }} TYPO-M-PRESET-CORE_P">{!! $text !!}</p>
            </div>
            <div class="S-BUTTON-price">
                <p class="T-BUTTON-price T-BUTTON-price_{{ $color }} TYPO-M-PRESET-CORE_P_BOLD">{!! $price !!}</p>
            </div>
        </div>
    </div>
</button>
