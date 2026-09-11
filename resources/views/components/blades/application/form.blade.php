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
        'student','individual'  => 'Прикрепить файл (.pptx или .pdf) (до 32мб)',
        'entity' => 'Прикрепить файлы (.pptx или .pdf) (до 32мб в сумме)',
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
            <h3 class="TYPO-D-PRESET-CORE_H3">{!! $windowTitle !!}</h3>
        </div>
        <form class="S-FORM-content" action="{{ route('application_submit_' . $type) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input
                type="hidden"
                id="application_type_{{ $type }}"
                name="application_type_{{ $type }}"
                value="{{ $type }}"
            >
            <div class="S-CONTENT-wrapper">
                <div class="S-CONTENT-carcass">
                    <div class="S-CONTENT-name_solo S-CONTENT-name" style="display: {{ $type === 'entity' ? 'none' : 'unset' }}">
                        <div class="S-NAME_SOLO-wrapper">
                            <div class="S-NAME_SOLO-carcass">
                                <div class="S-NAME_SOLO-name_title S-CONTENT-title">
                                    <label class="TYPO-D-PRESET-CORE_P_BOLD">ФИО</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_SOLO-name_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                                        placeholder='Меня зовут ...'
                                        type="text"
                                        id="person_name_{{ $type }}"
                                        name="person_name_{{ $type }}"
                                    >
                                </div>
                                <x-blades.application.errors.input_string
                                    type="{{ $type }}"
                                    color="{{ $color }}"
                                    class="S-NAME_SOLO-name_input_error"
                                    name="person_name"
                                    text="Введите ФИО<br>на кириллице"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-name_entity S-CONTENT-name" style="display: {{ $type === 'entity' ? 'unset' : 'none' }}">
                        <div class="S-NAME_ENTITY-wrapper">
                            <div class="S-NAME_ENTITY-carcass">
                                <div class="S-NAME_ENTITY-name_title S-CONTENT-title">
                                    <label class="TYPO-D-PRESET-CORE_P_BOLD">Название орг.</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-name_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                                        placeholder='"ООО" ...'
                                        type="text"
                                        id="organization_name_{{ $type }}"
                                        name="organization_name"
                                    >
                                </div>
                                <x-blades.application.errors.input_string
                                    type="{{ $type }}"
                                    color="{{ $color }}"
                                    class="S-NAME_ENTITY-name_input_error"
                                    name="organization_name"
                                    text="Введите название организации<br>на кириллице или латинице"
                                />
                                <div class="S-NAME_ENTITY-tin_title S-CONTENT-title">
                                    <label class="TYPO-D-PRESET-CORE_P_BOLD">ИНН</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-tin_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                                        placeholder="1234 ..."
                                        type="text"
                                        id="organization_tin_{{ $type }}"
                                        name="organization_tin"
                                    >
                                </div>
                                <x-blades.application.errors.input_string
                                    type="{{ $type }}"
                                    color="{{ $color }}"
                                    class="S-NAME_ENTITY-tin_input_error"
                                    name="organization_tin"
                                    text="Введите корректный<br>ИНН организации"
                                />
                                <div class="S-NAME_ENTITY-representative_title S-CONTENT-title">
                                    <label class="TYPO-D-PRESET-CORE_P_BOLD">Представитель</label>
                                    <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">
                                        *</p>
                                </div>
                                <div class="S-NAME_ENTITY-representative_input S-CONTENT-input">
                                    <input
                                        class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                                        placeholder="Иванов Иван ..."
                                        type="text"
                                        id="organization_representative_{{ $type }}"
                                        name="organization_representative"
                                    >
                                </div>
                                <x-blades.application.errors.input_string
                                    type="{{ $type }}"
                                    color="{{ $color }}"
                                    class="S-NAME_ENTITY-representative_input_error"
                                    name="organization_representative"
                                    text="Введите ФИО представителя<br>на кириллице"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-email_title S-CONTENT-title">
                        <label class="TYPO-D-PRESET-CORE_P_BOLD">Почта</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-email_input S-CONTENT-input">
                        <input
                            class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                            placeholder="Свяжитесь {{ $type === 'entity' ? 'с нами' : 'со мной' }} по адресу ..."
                            type="text"
                            inputmode="email"
                            autocomplete="email"
                            id="email_{{ $type }}"
                            name="email_{{ $type }}"
                        >
                    </div>
                    <x-blades.application.errors.input_string
                        type="{{ $type }}"
                        color="{{ $color }}"
                        class="S-CONTENT-email_input_error"
                        name="email"
                        text="Введите почту в корректном формате:<br>yourname@mail.com"
                    />
                    <div class="S-CONTENT-phone_title S-CONTENT-title">
                        <label class="TYPO-D-PRESET-CORE_P_BOLD">Телефон</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-phone_input S-CONTENT-input">
                        <input
                            class="IN-CONTENT-string IN-CONTENT-string_{{ $color }} TYPO-D-PRESET-CORE_P"
                            placeholder="+7 981 ..."
                            type="tel"
                            id="phone_{{ $type }}"
                            name="phone_{{ $type }}"
                        >
                    </div>
                    <x-blades.application.errors.input_string
                        type="{{ $type }}"
                        color="{{ $color }}"
                        class="S-CONTENT-phone_input_error"
                        name="phone"
                        text="Введите номер в корректном формате:<br>+7 999 123-45-67"
                    />
                    <div class="S-CONTENT-tracks">
                        <div class="S-CONTENT_TRACKS-wrapper">
                            @if($type === 'student')
                                <div class="S-CONTENT_TRACKS-carcass_student S-CONTENT_TRACKS-carcass" style="display: grid">
                                    <div class="S-CONTENT_TRACKS-student_track S-CONTENT_TRACKS-track">
                                        <x-blades.application.select_track.string
                                            type="student"
                                            color="{{ $color }}"
                                        />
                                    </div>
                                </div>
                            @endif

                            @if($type === 'individual')
                                <div class="S-CONTENT_TRACKS-carcass_individual S-CONTENT_TRACKS-carcass" style="display: grid">
                                    <div class="S-CONTENT_TRACKS-individual_track S-CONTENT_TRACKS-track">
                                        <x-blades.application.select_track.string
                                            type="individual"
                                            color="{{ $color }}"
                                        />
                                    </div>
                                </div>
                            @endif

                            @if($type === 'entity')
                                <div class="S-CONTENT_TRACKS-carcass_entity S-CONTENT_TRACKS-carcass" style="display: grid">
                                    <div class="S-CONTENT_TRACKS-entity_tracks S-CONTENT_TRACKS-entity_track S-CONTENT_TRACKS-track">
                                        <x-blades.application.select_track.string
                                            type="entity"
                                            color="{{ $color }}"
                                        />
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="S-CONTENT-description_title S-CONTENT-title">
                        <label class="TYPO-D-PRESET-CORE_P_BOLD">Описание</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-description_input S-CONTENT-input">
                        <textarea
                            class="IN-CONTENT-text IN-CONTENT-text_{{ $color }} TYPO-D-PRESET-CORE_P"
                            placeholder="{{ $type === 'entity' ? 'Наш' : 'Мой' }} проект это ..."
                            type="text"
                            id="description_{{ $type }}"
                            name="description_{{ $type }}"
                        ></textarea>
                    </div>
                    <x-blades.application.errors.input_string
                        type="{{ $type }}"
                        color="{{ $color }}"
                        class="S-CONTENT-description_input_error"
                        name="description"
                        text="Введите описание длинной<br>до 10 000 символов"
                    />
                    <div class="S-CONTENT-presentation_title S-CONTENT-title">
                        <label class="T-CONTENT-underline TYPO-D-PRESET-CORE_P_BOLD"
                               id="LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_{{ $typeUppercase }}">{{ $presentationTitle }}</label>
                        <p class="T-CONTENT-asterisk T-CONTENT-asterisk_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">*</p>
                    </div>
                    <div class="S-CONTENT-presentation_input S-CONTENT-presentation_input_{{ $color }}_default DEV-DISABLE_SELECTION">
                        <label class="S-PRESENTATION_INPUT-wrapper" id="uploadLabel_{{ $type }}">
                            <div class="S-PRESENTATION_INPUT-carcass">
                                <div class="S-PRESENTATION_INPUT-upload S-PRESENTATION_INPUT-upload_{{ $color }}">
                                    @php
                                        $filesName = match($type) {
                                            'student' => 'files_student',
                                            'individual' => 'files_individual',
                                            'entity' => 'files_entity',
                                            default => 'files'
                                        };
                                    @endphp

                                    <input
                                        type="file"
                                        id="file_{{ $type }}"
                                        name="{{ $filesName }}[]"
                                        @if($type === 'entity') multiple @endif
                                        accept=".pptx,.pdf"
                                        hidden
                                    />
                                    <div class="S-PRESENTATION_INPUT-icons">
                                        <x-svg.icons.upload
                                            class="I-PRESENTATION_INPUT-file_before_{{ $type }} I-PRESENTATION_INPUT-file"
                                        />
                                        <x-svg.icons.file
                                            class="I-PRESENTATION_INPUT-file_after_{{ $type }} I-PRESENTATION_INPUT-file"
                                        />
                                    </div>
                                    <span class="T-PRESENTATION_INPUT-filename TYPO-D-PRESET-CORE_P"
                                          id="uploadText_{{ $type }}">{{ $presentationUploadButtonTitle }}</span>
                                </div>
                            </div>
                        </label>
                        <div class="S-PRESENTATION_INPUT-delete S-PRESENTATION_INPUT-delete_{{ $color }}_default">
                            <button class="B-PRESENTATION_INPUT-delete" id="uploadDelete_{{ $type }}" type="button">
                                <x-svg.icons.trash class="I-PRESENTATION_INPUT-delete" />
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
                                                id="confirmation_{{ $type }}"
                                                name="confirmation_{{ $type }}"
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
                                    <p class="T-CONFIRMATION-text TYPO-D-PRESET-CORE_P">Я даю согласие на обработку своих
                                        персональных данных (имя, отчество, фамилия, почта)<br>
                                        в соответствии с требованиями Федерального закона №152-ФЗ от 27.07.2006.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="S-CONTENT-submit DEV-DISABLE_SELECTION">
                        <button class="B-CONTENT-submit B-CONTENT-submit_{{ $color }}" type="submit" id="submit_button_{{ $type }}">
                            <p class="T-CONTENT-submit T-CONTENT-submit_{{ $color }} TYPO-D-PRESET-CORE_P_BOLD">Подать заявку</p>
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
