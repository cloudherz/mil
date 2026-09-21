<div class="S-TRACK-select S-TRACK-select_{{ $color }}" data-color="{{ $color }}">
    <span class="selected-value T-TRACK-select T-TRACK-nowrap">{{ $color === 'green' ? 'Номинация ' . $number : 'Выберите номинацию' }}</span>
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
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="5">Наука и Инженерия</li>
</ul>
<input
    class="S-TRACK-hidden-input"
    type="hidden"
    id="track{{
        match($type) {
            'student' => '_single' . ($number != 1 ? '_skip_' . $number : ''),
            'individual' => '_individual' . ($number != 1 ? '_skip_' . $number : ''),
            'entity' => '_' . $number
        }
    }}"
    name="track{{
        match($type) {
            'student' => '_student' . ($number != 1 ? '_skip_' . $number : ''),
            'individual' => '_individual' . ($number != 1 ? '_skip_' . $number : ''),
            'entity' => '_' . $number
        }
    }}"
    value=""
>
