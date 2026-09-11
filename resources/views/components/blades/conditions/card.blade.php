@php
    $backgroundIcon = Blade::render("<x-svg.backgrounds.conditions.{$backgroundShape} class=\"I-BACKGROUND-shape I-BACKGROUND-shape_{$color}\" style=\"transform: {$backgroundTransform}\" />");
    $headingIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-HEADING-icon I-HEADING-icon_{$color}\" style=\"height: {$iconScale}\" />");
@endphp

<div class="S-CARDS-card S-CARDS-card_{{ $color }} S-CARDS-{{ $type }}">
    <div class="S-CARD-wrapper S-CARD-wrapper_{{ $color }}">
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
                        <div class="S-CONTENT-heading">
                            <div class="S-HEADING-wrapper">
                                <div class="S-HEADING-carcass">
                                    <div class="S-HEADING-icon">
                                        {!! $headingIcon !!}
                                    </div>
                                    <div class="S-HEADING-text">
                                        <h3 class="T-HEADING-text T-HEADING-text_{{ $color }} TYPO-D-PRESET-CORE_H3">{{ $heading }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="S-CONTENT-description">
                            <p class="TYPO-D-PRESET-CORE_P">{!! $description !!}</p>
                        </div>
                        <div class="S-CONTENT-price">
                            <p class="T-CONTENT-price T-CONTENT-price_{{ $color }} TYPO-D-PRESET-CORE_H3_LIGHT">{{ $price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
