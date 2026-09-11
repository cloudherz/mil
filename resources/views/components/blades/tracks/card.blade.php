@php
    $backgroundIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-BACKGROUND-shape I-BACKGROUND-shape_{$color}\" style=\"transform: {$backgroundTransform}\" />");
    $headingIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-CONTENT-icon I-CONTENT-icon_{$color}\" style=\"height: {$iconScale}\" />");
@endphp

<div class="S-CARDS-card S-CARDS-card_{{ $number }} S-CARDS-card_{{ $color }}">
    <div class="S-CARD-wrapper">
        <div class="S-CARD-carcass">
            <div class="S-CARD-background">
                <div class="S-BACKGROUND-wrapper">
                    <div class="S-BACKGROUND-carcass">
                        {!! $backgroundIcon !!}
                    </div>
                </div>
            </div>
            <div class="S-CARD-content">
                <div class="S-CONTENT-wrapper">
                    <div class="S-CONTENT-carcass">
                        <div class="S-CONTENT-icon">
                            {!! $headingIcon !!}
                        </div>
                        <div class="S-CONTENT-heading">
                            <h3 class="T-CONTENT-heading T-CONTENT-heading_{{ $color }} TYPO-D-PRESET-CORE_H3">{!! $heading !!}</h3>
                        </div>
                        <div class="S-CONTENT-text">
                            <p class="T-CONTENT-text TYPO-D-PRESET-CORE_P">{!! $text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
