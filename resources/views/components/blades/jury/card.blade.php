@php
    $portraitImage = Blade::render("<img class=\"I-CARD-portrait\" src=\"{{ asset('{$portrait}') }}\" alt=\"{$name}\"/>");
@endphp

<div class="S-CARDS-card S-CARDS-card_{{ $number }} S-CARDS-card_{{ $color }}">
    <div class="S-CARD-wrapper S-CARD-wrapper_{{ $color }}">
        <div class="S-CARD-carcass">
            <div class="S-CARD-portrait">
                {!! $portraitImage !!}
            </div>
            <div class="S-CARD-name">
                <h3 class="T-CARD-name T-CARD-name_{{ $color }} TYPO-PRESET-CORE_H3">{!! $name !!}
            </div>
            <div class="S-CARD-title">
                <p class="TYPO-PRESET-CORE_P">{!! $title !!}</p>
            </div>
        </div>
    </div>
</div>
