<div class="{{ $class }} S-CONTENT-input_string_error" id="{{ $name }}_error_{{ $type }}">
    <div class="S-INPUT_STRING_ERROR-wrapper">
        <div class="S-INPUT_STRING_ERROR-carcass">
            <div class="S-INPUT_STRING_ERROR-icon S-INPUT_STRING_ERROR-icon_{{ $color }}">
                <x-svg.icons.alert
                    class="I-INPUT_STRING_ERROR-icon"
                    style=""
                />
            </div>
            <div class="S-INPUT_STRING_ERROR-message">
                <p class="T-INPUT_STRING_ERROR-text TYPO-D-PRESET-CORE_P">{!! $text !!}</p>
            </div>
        </div>
    </div>
</div>
