<div class="S-TRACK-wrapper">
    <div class="S-TRACK-carcass">
        <div class="S-TRACK-title">
            <label class="TYPO-PRESET-CORE_P_BOLD">Трек {{ $number }}</label>
            <p class="T-TRACK-asterisk T-TRACK-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD" style="display: {{ $number === '1' ? 'unset' : 'none' }}">*</p>
        </div>
        <div class="S-TRACK-select">
            <div class="S-SELECT-carcass TYPO-PRESET-CORE_P">
                <div class="S-TRACK-select S-TRACK-select_{{ $color }}" data-color="{{ $color }}">
                    <span class="selected-value">-</span>
                    <x-svg.icons.pointer
                        class="I-TRACK-select"
                    />

                </div>
                <ul class="UL-TRACK-options UL-TRACK-options_{{ $color }}">
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }} LI-TRACK-option_default" data-value="-">-</li>
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="1">Технологии и Бизнес</li>
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="2">Корпорации и Индустрия</li>
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="3">Регионы и Территории</li>
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="4">Общество и Будущее</li>
                    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="5">Корпорации и Индустрия</li>
                </ul>
                <input type="hidden" name="track_select" class="S-TRACK-hidden-input" value="-">
            </div>
        </div>
    </div>
</div>
