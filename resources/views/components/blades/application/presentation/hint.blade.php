@php
    $titleIcon = Blade::render("<x-svg.icons.application.hint.{$icon} class=\"I-PANEL-icon I-PANEL-icon_{$color}\" style=\"height: {$iconHeight}\" />");
@endphp

<div class="S-HINT_CONTENT-panel S-HINT_CONTENT-panel_{{ $number }}">
    <div class="S-PANEL-wrapper">
        <div class="S-PANEL-carcass">
            <div class="S-PANEL-icon">
                {!! $titleIcon !!}
            </div>
            <div class="S-PANEL-text">
                <p class="TYPO-PRESET-CORE_P">{!! $text !!}</p>
            </div>
            <div class="S-PANEL-number S-PANEL-number_{{ $color }}">
                <p class="TYPO-PRESET-CORE_P">{{ $number }}</p>
            </div>
        </div>
    </div>
</div>
