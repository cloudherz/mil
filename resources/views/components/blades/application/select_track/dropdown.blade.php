<div class="S-TRACK-select S-TRACK-select_{{ $color }}" data-color="{{ $color }}">
    <span class="selected-value T-TRACK-select">{{ $color === 'green' ? 'Номинация ' . $number : 'Выберите номинацию' }}</span>
    <x-svg.icons.pointer
        class="I-TRACK-select"
    />
</div>
<ul class="UL-TRACK-options UL-TRACK-options_{{ $color }}">
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }} LI-TRACK-option_default" data-value="-">(Отменить выбор)</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="1">Технологии и Бизнес</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="2">Корпорации и Индустрия</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="3">Регионы и Территории</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="4">Общество и Будущее</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="5">Корпорации и Индустрия</li>
</ul>
<input type="hidden" name="track_select" class="S-TRACK-hidden-input" value="-">
