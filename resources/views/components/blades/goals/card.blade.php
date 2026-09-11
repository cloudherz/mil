@php
    $backgroundIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-BACKGROUND-shape I-BACKGROUND-shape_{$color}\" style=\"transform: {$backgroundTransform}\" />");
    $titleIcon = Blade::render("<x-svg.icons.{$icon} class=\"I-TITLE-icon I-TITLE-icon_{$color}\" style=\"rotate: {$iconRotate}; transform: {$iconTransform}\" />");
@endphp

<div class="S-CARDS-card S-CARDS-card_{{ $number }} S-CARDS-card_{{ $color }}">
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
                        <div class="S-CONTENT-title">
                            <div class="S-TITLE-wrapper">
                                <div class="S-TITLE-carcass">
                                    <div class="S-TITLE-icon">
                                        {!! $titleIcon !!}
                                    </div>
                                    <div class="S-TITLE-heading">
                                        <h3 class="T-TITLE-heading TYPO-D-PRESET-CORE_H3">{!! $title !!}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="S-CONTENT-text_1">
                            <p class="TYPO-D-PRESET-CORE_P">{!! $text1 !!}</p>
                        </div>
                        <div class="S-CONTENT-text_2">
                            <p class="TYPO-D-PRESET-CORE_P">{!! $text2 !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
