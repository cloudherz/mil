@php
    $background = Blade::render("<x-svg.backgrounds.rair_{$number} class=\"I-BACKGROUND-shape I-BACKGROUND-shape_{$number}\" />");
@endphp

<div class="S-MAIN-rair" id="rair_{{ $number }}">
    <div class="S-RAIR-wrapper">
        <div class="S-RAIR-carcass">
            <div class="S-RAIR-background DEV-DISABLE_SELECTION">
                <div class="S-BACKGROUND-wrapper">
                    <div class="S-BACKGROUND-carcass S-BACKGROUND-carcass_{{ $number }}">
                        {!! $background !!}
                    </div>
                </div>
            </div>
            <div class="S-RAIR-content">
                <div class="S-CONTENT-wrapper">
                    <div class="S-CONTENT-carcass">
                        <div class="S-CONTENT-title">
                            <h2 class="TYPO-D-PRESET-CORE_H2">{!! $heading !!}</h2>
                        </div>
                        <div class="S-CONTENT-text">
                            <p class="TYPO-D-PRESET-CORE_P">{!! $text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
