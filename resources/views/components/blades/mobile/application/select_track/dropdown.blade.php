<div class="S-TRACK-select S-TRACK-select_{{ $color }}" data-color="{{ $color }}">
    <span class="selected-value T-TRACK-select T-TRACK-nowrap">{{ $color === 'green' ? 'Номин. ' . $number : 'Выберите номинацию' }}</span>
    <x-svg.icons.pointer
        class="I-TRACK-select"
    />
</div>
<ul class="UL-TRACK-options UL-TRACK-options_{{ $color }} TYPO-M-PRESET-CORE_SMALL">
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }} LI-TRACK-option_default" data-value="-">(Отменить выбор)</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="1">Технологии {!! $color === 'green' ? '<br>' : '' !!}и Бизнес</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="2">Корпорации {!! $color === 'green' ? '<br>' : '' !!}и Индустрия</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="3">Регионы {!! $color === 'green' ? '<br>' : '' !!}и Территории</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="4">Общество {!! $color === 'green' ? '<br>' : '' !!}и Будущее</li>
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }}" data-value="5">Наука {!! $color === 'green' ? '<br>' : '' !!}и Инженерия</li>
</ul>
<input
    class="S-TRACK-hidden-input"
    type="hidden"
    id="mobile-track{{
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
