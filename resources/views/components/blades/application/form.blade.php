@php

    $windowTitle = match ($type) {
        'student' => 'Подача заявки (Студент)',
        'individual' => 'Подача заявки (Физ. лицо)',
        'entity' => 'Подача заявки (Юр. лицо)',
        default => 'Ошибка'
    };

    $presentationTitle = match ($type) {
        'student','individual'  => 'Презентация (?)',
        'entity' => 'Презентации (?)',
        default => 'Ошибка'
    };

    $presentationUploadButtonTitle = match ($type) {
        'student','individual'  => 'Прикрепить файл',
        'entity' => 'Прикрепить файлы',
        default => 'Ошибка'
    };

    $color = match ($type) {
        'student','individual'  => 'blue',
        'entity' => 'green',
        default => 'Ошибка'
    };

    $colorCapitalized = ucfirst(strtolower($color));
    $colorUppercase = strtoupper($color);

    $typeCapitalized = ucfirst(strtolower($type));
    $typeUppercase = strtoupper($type);

@endphp

<div class="S-FORM-wrapper S-FORM-wrapper_{{ $color }} S-WINDOW-wrapper">
    <div class="S-FORM-carcass S-WINDOW-carcass">
        <div class="S-FORM-heading">
            <h3 class="TYPO-PRESET-CORE_H3">{!! $windowTitle !!}</h3>
        </div>
        <form class="S-FORM-content" action="{{ route('application_submit_' . $type) }}" method="POST">
            @csrf
            <input
                type="hidden"
                id="application_type"
                name="application_type"
                value="{{ $type }}"
            >
            <div class="S-CONTENT-wrapper">
                <div class="S-CONTENT-carcass">
                    <div class="S-CONTENT-name_solo S-CONTENT-name" style="display: {{ $type === 'entity' ? 'none' : 'unset' }}">
                        <div class="S-NAME_SOLO-wrapper">
                            <div class="S-NAME_SOLO-carcass">
                                <div class="S-NAME_SOLO-name_title S-CONTENT-title">
                                    <label class="TYPO-PRESET-CORE_P_BOLD">ФИО</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_SOLO-name_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                                        placeholder='Меня зовут ...'
                                        type="text"
                                        id="person_name"
                                        name="person_name"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-name_entity S-CONTENT-name" style="display: {{ $type === 'entity' ? 'unset' : 'none' }}">
                        <div class="S-NAME_ENTITY-wrapper">
                            <div class="S-NAME_ENTITY-carcass">
                                <div class="S-NAME_ENTITY-name_title S-CONTENT-title">
                                    <label class="TYPO-PRESET-CORE_P_BOLD">Название орг.</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-name_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                                        placeholder='"ООО" ...'
                                        type="text"
                                        id="organization_name"
                                        name="organization_name"
                                    >
                                </div>
                                <div class="S-NAME_ENTITY-tin_title S-CONTENT-title">
                                    <label class="TYPO-PRESET-CORE_P_BOLD">ИНН</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-tin_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                                        placeholder="1234 ..."
                                        type="text"
                                        id="organization_tin"
                                        name="organization_tin"
                                    >
                                </div>
                                <div class="S-NAME_ENTITY-representative_title S-CONTENT-title">
                                    <label class="TYPO-PRESET-CORE_P_BOLD">Представитель</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-representative_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                                        placeholder="Иванов Иван ..."
                                        type="text"
                                        id="organization_representative"
                                        name="organization_representative"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-email_title S-CONTENT-title">
                        <label class="TYPO-PRESET-CORE_P_BOLD">Почта</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-email_input S-CONTENT-input">
                        <input
                            class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                            placeholder="Свяжитесь {{ $type === 'entity' ? 'с нами' : 'со мной' }} по адресу ..."
                            type="email"
                            id="email"
                            name="email"
                        >
                    </div>
                    <div class="S-CONTENT-phone_title S-CONTENT-title">
                        <label class="TYPO-PRESET-CORE_P_BOLD">Телефон</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-phone_input S-CONTENT-input">
                        <input
                            class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-PRESET-CORE_P"
                            placeholder="+7 981 ..."
                            type="tel"
                            id="phone"
                            name="phone"
                        >
                    </div>
                    <div class="S-CONTENT-tracks">
                        <div class="S-CONTENT_TRACKS-wrapper">
                            <div class="S-CONTENT_TRACKS-carcass_student S-CONTENT_TRACKS-carcass" style="display: {{ $type === 'student' ? 'grid' : 'none' }}">
                                <div class="S-CONTENT_TRACKS-student_track S-CONTENT_TRACKS-track">
                                    <x-blades.application.select_track.string
                                        type="student"
                                        color="{{ $color }}"
                                    />
                                </div>
                            </div>
                            <div class="S-CONTENT_TRACKS-carcass_individual S-CONTENT_TRACKS-carcass" style="display: {{ $type === 'individual' ? 'grid' : 'none' }}">
                                <div class="S-CONTENT_TRACKS-individual_track S-CONTENT_TRACKS-track">
                                    <x-blades.application.select_track.string
                                        type="individual"
                                        color="{{ $color }}"
                                    />
                                </div>
                            </div>
                            <div class="S-CONTENT_TRACKS-carcass_entity S-CONTENT_TRACKS-carcass" style="display: {{ $type === 'entity' ? 'grid' : 'none' }}">
                                <div
                                    class="S-CONTENT_TRACKS-entity_tracks S-CONTENT_TRACKS-entity_track S-CONTENT_TRACKS-track">
                                    <x-blades.application.select_track.string
                                        type="entity"
                                        color="{{ $color }}"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-description_title S-CONTENT-title">
                        <label class="TYPO-PRESET-CORE_P_BOLD">Описание</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-description_input S-CONTENT-input">
                        <textarea
                            class="IN-CONTENT-text IN-CONTENT-text_{{ $color }} TYPO-PRESET-CORE_P"
                            placeholder="{{ $type === 'entity' ? 'Наш' : 'Мой' }} проект это ..."
                            type="text"
                            id="description"
                            name="description"
                        ></textarea>
                    </div>
                    <div class="S-CONTENT-presentation_title S-CONTENT-title">
                        <label class="T-CONTENT-underline TYPO-PRESET-CORE_P_BOLD"
                               id="LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_{{ $typeUppercase }}">{{ $presentationTitle }}</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div
                        class="S-CONTENT-presentation_input S-CONTENT-presentation_input_{{ $color }}_default DEV-DISABLE_SELECTION">
                        <label class="S-PRESENTATION_INPUT-wrapper" id="uploadLabel{{ $colorCapitalized }}">
                            <div class="S-PRESENTATION_INPUT-carcass">
                                <div class="S-PRESENTATION_INPUT-upload S-PRESENTATION_INPUT-upload_{{ $color }}">
                                    <input type="file" id="uploadInput{{ $colorCapitalized }}" hidden/>
                                    <div class="S-PRESENTATION_INPUT-icons">
                                        <x-svg.icons.upload
                                            class="I-PRESENTATION_INPUT-file_before_{{ $color }} I-PRESENTATION_INPUT-file"
                                        />
                                        <x-svg.icons.file
                                            class="I-PRESENTATION_INPUT-file_after_{{ $color }} I-PRESENTATION_INPUT-file"
                                        />
                                    </div>
                                    <span class="T-PRESENTATION_INPUT-filename TYPO-PRESET-CORE_P"
                                          id="uploadText{{ $colorCapitalized }}">{{ $presentationUploadButtonTitle }}</span>
                                </div>
                            </div>
                        </label>
                        <div class="S-PRESENTATION_INPUT-delete S-PRESENTATION_INPUT-delete_{{ $color }}_default">
                            <button class="B-PRESENTATION_INPUT-delete" id="uploadDelete{{ $colorCapitalized }}"
                                    type="button">
                                <x-svg.icons.trash
                                    class="I-PRESENTATION_INPUT-delete"
                                />
                            </button>
                        </div>
                    </div>
                    <div class="S-CONTENT-confirmation">
                        <div class="S-CONFIRMATION-wrapper">
                            <div class="S-CONFIRMATION-carcass">
                                <div class="S-CONFIRMATION-checkbox">
                                    <div class="S-CHECKBOX-wrapper">
                                        <div class="S-CHECKBOX-carcass">
                                            <input
                                                class="IN-CHECKBOX-input"
                                                type="checkbox"
                                                id="confirmation"
                                                name="confirmation"
                                            />
                                            <div class="S-CHECKBOX-box">
                                                <x-svg.icons.check
                                                    class="I-CHECKBOX-icon"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="S-CONFIRMATION-text">
                                    <p class="T-CONFIRMATION-text TYPO-PRESET-CORE_P">Я даю согласие на обработку своих
                                        персональных данных (имя, отчество, фамилия, почта)<br>
                                        в соответствии с требованиями Федерального закона №152-ФЗ от 27.07.2006.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-submit DEV-DISABLE_SELECTION">
                        <button class="B-CONTENT-submit B-CONTENT-submit_{{ $color }}" type="submit" id="submit_button">
                            <p class="T-CONTENT-submit_{{ $color }} TYPO-PRESET-CORE_P_BOLD">Подать заявку</p>
                        </button>
                    </div>
                    <div class="S-CONTENT-presentation_hint"
                         id="LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_{{ $typeUppercase }}">
                        <div class="S-HINT-wrapper"
                             id="LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_WRAPPER_{{ $typeUppercase }}">
                            <div class="S-HINT-carcass S-HINT-carcass_{{ $color }}">
                                <div class="S-HINT-hitbox"></div>
                                <div class="S-HINT-content">
                                    <div class="S-HINT_CONTENT-wrapper">
                                        <div class="S-HINT_CONTENT-carcass">
                                            <x-blades.application.presentation.hint
                                                number="1"
                                                color="{{ $color }}"
                                                icon="speech"
                                                icon_height="12vh"
                                                text="Расскажите о себе<br>
                                                или вашей команде"
                                            />
                                            <x-blades.application.presentation.hint
                                                number="2"
                                                color="{{ $color }}"
                                                icon="idea"
                                                icon_height="9.8vh"
                                                text="Опишите вашу идею<br>
                                                и видение"
                                            />
                                            <x-blades.application.presentation.hint
                                                number="3"
                                                color="{{ $color }}"
                                                icon="goals"
                                                icon_height="11.6vh"
                                                text="Расскажите о целях<br>
                                                вашего проекта"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
