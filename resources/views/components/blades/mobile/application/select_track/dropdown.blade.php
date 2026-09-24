<div class="S-TRACK-select S-TRACK-select_{{ $color }}" data-color="{{ $color }}">
    <span class="selected-value T-TRACK-select T-TRACK-nowrap">{{ $color === 'green' ? 'Номин. ' . $number : 'Выберите номинацию' }}</span>
    <x-svg.icons.pointer
        class="I-TRACK-select"
    />
</div>
<ul class="UL-TRACK-options UL-TRACK-options_{{ $color }} UL-TRACK-options_{{ $number }} TYPO-M-PRESET-CORE_SMALL">
    <li class="LI-TRACK-option LI-TRACK-option_{{ $color }} LI-TRACK-option_default" data-value="-">
        <span class="T-TRACK-option">(Отменить выбор)</span>
    </li>
    {{--                                 --}}
    {{--  Track 1 — Технологии и Бизнес  --}}
    {{--                                 --}}
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="1"
        text="Технологический прорыв"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="2"
        text="Масштабирование смыслов"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="3"
        text="Международная экспансия"
    />
    {{--                                    --}}
    {{--  Track 2 — Корпорации и Индустрия  --}}
    {{--                                    --}}
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="4"
        text="Архитектор трансформации"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="5"
        text="Индустриальный чемпион"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="6"
        text="Кооперация ради суверенитета"
    />
    {{--                                  --}}
    {{--  Track 3 — Регионы и Территории  --}}
    {{--                                  --}}
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="7"
        text="Строитель экосистемы"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="8"
        text="Региональный прорыв"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="9"
        text="Устойчивое развитие территории"
    />
    {{--                                --}}
    {{--  Track 4 — Общество и Будущее  --}}
    {{--                                --}}
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="10"
        text="Технологии для жизни"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="11"
        text="Визионер отрасли"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="12"
        text="Наставник поколения"
    />
    {{--                               --}}
    {{--  Track 5 — Наука и Инженерия  --}}
    {{--                               --}}
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="13"
        text="Академический предприниматель"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="14"
        text="Инженерный прорыв"
    />
    <x-blades.mobile.application.select_track.li
        color="{{ $color }}"
        number="15"
        text="Наставник инноваторов"
    />
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
