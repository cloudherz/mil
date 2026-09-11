function initApplicationValidation() {

    const DEBOUNCE_DELAY = 1000;

    interface FieldConfig {
        inputId: string;
        errorId: string;
    }

    interface FormConfig {
        type: string;
        submitButtonId: string;
        fields: {
            personName?: FieldConfig;
            organizationName?: FieldConfig;
            organizationTin?: FieldConfig;
            organizationRepresentative?: FieldConfig;
            email: FieldConfig;
            phone: FieldConfig;
            description: FieldConfig;
            confirmation: { inputId: string };
            trackIds: string[];
            fileId: string;
        };
    }

    const FORMS: FormConfig[] = [
        {
            type: 'student',
            submitButtonId: 'submit_button_student',
            fields: {
                personName: { inputId: 'person_name_student', errorId: 'person_name_error_student' },
                email: { inputId: 'email_student', errorId: 'email_error_student' },
                phone: { inputId: 'phone_student', errorId: 'phone_error_student' },
                description: { inputId: 'description_student', errorId: 'description_error_student' },
                confirmation: { inputId: 'confirmation_student' },
                trackIds: ['track_single'],
                fileId: 'file_student',
            },
        },
        {
            type: 'individual',
            submitButtonId: 'submit_button_individual',
            fields: {
                personName: { inputId: 'person_name_individual', errorId: 'person_name_error_individual' },
                email: { inputId: 'email_individual', errorId: 'email_error_individual' },
                phone: { inputId: 'phone_individual', errorId: 'phone_error_individual' },
                description: { inputId: 'description_individual', errorId: 'description_error_individual' },
                confirmation: { inputId: 'confirmation_individual' },
                trackIds: ['track_individual'],
                fileId: 'file_individual',
            },
        },
        {
            type: 'entity',
            submitButtonId: 'submit_button_entity',
            fields: {
                organizationName: { inputId: 'organization_name_entity', errorId: 'organization_name_error_entity' },
                organizationTin: { inputId: 'organization_tin_entity', errorId: 'organization_tin_error_entity' },
                organizationRepresentative: { inputId: 'organization_representative_entity', errorId: 'organization_representative_error_entity' },
                email: { inputId: 'email_entity', errorId: 'email_error_entity' },
                phone: { inputId: 'phone_entity', errorId: 'phone_error_entity' },
                description: { inputId: 'description_entity', errorId: 'description_error_entity' },
                confirmation: { inputId: 'confirmation_entity' },
                trackIds: ['track_1', 'track_2', 'track_3'],
                fileId: 'file_entity',
            },
        },
    ];

    const DEBUG = false;

    function debug(type: string, ...args: unknown[]): void {
        if (DEBUG) console.log(`[validation:${type}]`, ...args);
    }

    // ── Валидаторы ─────────────────────────────────────────

    function isPersonNameValid(value: string): boolean {
        if (!value) return false;
        if (value.length < 2 || value.length > 256) return false;
        // Кириллица, пробел, дефис, точка, запятая, апостроф
        if (!/^[А-Яа-яЁё\s\-.,'’]+$/.test(value)) return false;
        return true;
    }

    function isOrganizationNameValid(value: string): boolean {
        if (!value) return false;
        if (value.length < 2 || value.length > 512) return false;
        // Кириллица, латиница, цифры, пробел, дефис, точка, запятая, кавычки,
        // скобки, №, слэш, обратный слэш, & % $ @ # ! ? : ; _ * +, апострофы
        if (!/^[А-Яа-яЁёA-Za-z0-9\s\-.,"'’()«»№\/\\&%$@#!?:;_*+]+$/.test(value)) return false;
        return true;
    }

    function isOrganizationTinValid(value: string): boolean {
        if (!value) return false;
        if (value.length > 12) return false;
        if (!/^[0-9]+$/.test(value)) return false;
        return true;
    }

    function isEmailValid(value: string): boolean {
        if (!value) return false;
        if (value.length <= 4 || value.length > 256) return false;
        // Латиница, цифры, . _ % + - в локальной части;
        // латиница, цифры, . - в домене; TLD — минимум 2 буквы
        if (!/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/.test(value)) return false;
        return true;
    }

    function isPhoneValid(value: string): boolean {
        const digits = value.replace(/\D/g, '');
        if (digits.length !== 11) return false;
        if (digits[0] !== '7') return false;
        return true;
    }

    function isDescriptionValid(value: string): boolean {
        if (!value) return false;
        if (value.length < 1) return false;
        if (value.length > 10000) return false;
        return true;
    }

    function formatPhone(value: string): string {
        let digits = value.replace(/\D/g, '');
        if (digits[0] === '7' || digits[0] === '8') digits = digits.slice(1);
        digits = digits.slice(0, 10);

        let result = '+7';
        if (digits.length > 0) result += ' ' + digits.slice(0, 3);
        if (digits.length > 3) result += ' ' + digits.slice(3, 6);
        if (digits.length > 6) result += '-' + digits.slice(6, 8);
        if (digits.length > 8) result += '-' + digits.slice(8, 10);
        return result;
    }

    function setErrorVisibility(errorId: string, visible: boolean): void {
        const el = document.getElementById(errorId);
        if (!el) return;

        el.style.opacity = visible ? '1' : '0';

        const icon = el.querySelector('.S-INPUT_STRING_ERROR-icon') as HTMLElement | null;
        if (icon) {
            icon.style.pointerEvents = visible ? 'auto' : 'none';
        }
    }

    // ── setupForm ──────────────────────────────────────────

    function setupForm(config: FormConfig): void {
        const submitButton = document.getElementById(config.submitButtonId) as HTMLButtonElement | null;
        if (!submitButton) {
            console.warn(`[validation:${config.type}] Кнопка не найдена: ${config.submitButtonId}`);
            return;
        }

        submitButton.disabled = true;

        // ⬇⬇⬇ ГЛАВНОЕ: находим свою форму
        const form = submitButton.closest('form');
        if (!form) {
            console.warn(`[validation:${config.type}] Форма не найдена`);
            return;
        }
        debug(config.type, 'Форма найдена:', form.action);

        // Ищем всё ВНУТРИ своей формы — защита от дублей ID
        const scope = form;

        const inputs: { [key: string]: HTMLInputElement | HTMLTextAreaElement | null } = {};
        const errorIds: { [key: string]: string } = {};

        function loadField(key: string, cfg?: FieldConfig): void {
            if (!cfg) return;
            const el = scope.querySelector(`#${CSS.escape(cfg.inputId)}`) as HTMLInputElement | HTMLTextAreaElement | null;
            inputs[key] = el;
            errorIds[key] = cfg.errorId;
            debug(config.type, `loadField(${key}):`, el ? 'OK' : 'NOT FOUND');
        }

        loadField('personName', config.fields.personName);
        loadField('organizationName', config.fields.organizationName);
        loadField('organizationTin', config.fields.organizationTin);
        loadField('organizationRepresentative', config.fields.organizationRepresentative);
        loadField('email', config.fields.email);
        loadField('phone', config.fields.phone);
        loadField('description', config.fields.description);

        const confirmationInput = scope.querySelector(`#${CSS.escape(config.fields.confirmation.inputId)}`) as HTMLInputElement | null;
        const fileInput = scope.querySelector(`#${CSS.escape(config.fields.fileId)}`) as HTMLInputElement | null;

        const trackInputs: HTMLInputElement[] = [];
        config.fields.trackIds.forEach((id) => {
            const el = scope.querySelector(`#${CSS.escape(id)}`) as HTMLInputElement | null;
            if (el) {
                trackInputs.push(el);
                debug(config.type, `trackInput(${id}):`, `value="${el.value}"`);
            } else {
                debug(config.type, `trackInput(${id}): NOT FOUND`);
            }
        });

        Object.keys(errorIds).forEach((key) => {
            setErrorVisibility(errorIds[key], false);
        });

        // ── Проверки ──

        function isFieldValid(key: string): boolean {
            const el = inputs[key];
            if (!el) return true;
            const value = el.value;

            let result = true;
            if (key === 'personName' || key === 'organizationRepresentative') {
                result = isPersonNameValid(value);
            } else if (key === 'organizationName') {
                result = isOrganizationNameValid(value);
            } else if (key === 'organizationTin') {
                result = isOrganizationTinValid(value);
            } else if (key === 'email') {
                result = isEmailValid(value);
            } else if (key === 'phone') {
                result = isPhoneValid(value);
            } else if (key === 'description') {
                result = isDescriptionValid(value);
            }

            debug(config.type, `isFieldValid(${key})`, `value="${value}"`, '=>', result);
            return result;
        }

        function isTrackValid(): boolean {
            let valid = false;
            trackInputs.forEach((input) => {
                const v = input.value;
                debug(config.type, `isTrackValid: input#${input.id} value="${v}"`);
                if (v !== '' && v !== '-') valid = true;
            });
            debug(config.type, `isTrackValid => ${valid}`);
            return valid;
        }

        function isFilesValid(): boolean {
            if (!fileInput) {
                debug(config.type, 'isFilesValid: input not found => false');
                return false;
            }
            const count = fileInput.files ? fileInput.files.length : 0;
            debug(config.type, `isFilesValid: files.length=${count} => ${count > 0}`);
            return count > 0;
        }

        function isConfirmationValid(): boolean {
            if (!confirmationInput) {
                debug(config.type, 'isConfirmationValid: not found => false');
                return false;
            }
            debug(config.type, `isConfirmationValid: checked=${confirmationInput.checked}`);
            return confirmationInput.checked;
        }

        // ── Touched ──

        const touched: { [key: string]: boolean } = {
            personName: false,
            organizationName: false,
            organizationTin: false,
            organizationRepresentative: false,
            email: false,
            phone: false,
            description: false,
            confirmation: false,
            track: false,
            files: false,
        };

        // ── Кнопка ──

        function updateSubmitButton(): void {
            const results = {
                personName: isFieldValid('personName'),
                organizationName: isFieldValid('organizationName'),
                organizationTin: isFieldValid('organizationTin'),
                organizationRepresentative: isFieldValid('organizationRepresentative'),
                email: isFieldValid('email'),
                phone: isFieldValid('phone'),
                description: isFieldValid('description'),
                confirmation: isConfirmationValid(),
                track: isTrackValid(),
                files: isFilesValid(),
            };
            const allValid = Object.values(results).every((v) => v);
            debug(config.type, 'updateSubmitButton', results, '=> allValid =', allValid);

            submitButton!.disabled = !allValid;
            submitButton!.style.opacity = allValid ? '1' : '1';
            submitButton!.style.pointerEvents = allValid ? 'auto' : 'none';
            submitButton!.classList.toggle('B-CONTENT-submit_disabled', !allValid);
            const submitText = submitButton!.querySelector('p');
            if (submitText) {
                submitText.classList.toggle('T-CONTENT-submit_disabled', !allValid);
            }
        }

        function showError(key: string): void {
            const errorId = errorIds[key];
            if (!errorId) return;
            const valid = isFieldValid(key);
            setErrorVisibility(errorId, touched[key] && !valid);
        }

        // ── Debounce ──

        const timers: { [key: string]: ReturnType<typeof setTimeout> | null } = {};

        function debounce(key: string, fn: () => void): void {
            const existing = timers[key];
            if (existing) clearTimeout(existing);
            timers[key] = setTimeout(fn, DEBOUNCE_DELAY);
        }

        // ── Привязка полей ──

        const textFieldKeys = [
            'personName',
            'organizationName',
            'organizationTin',
            'organizationRepresentative',
            'email',
            'phone',
            'description',
        ];

        textFieldKeys.forEach((key) => {
            const el = inputs[key];
            if (!el) return;

            if (key === 'phone') {
                el.addEventListener('focus', () => {
                    if (!el.value) {
                        el.value = '+7';
                        (el as HTMLInputElement).setSelectionRange(2, 2);
                    }
                });

                el.addEventListener('input', (e) => {
                    touched[key] = true;
                    const input = e.target as HTMLInputElement;
                    const cursorPos = input.selectionStart ?? 0;
                    const oldValue = input.value;
                    const digitsBeforeCursor = oldValue.slice(0, cursorPos).replace(/\D/g, '').length;
                    const formatted = formatPhone(oldValue);
                    input.value = formatted;

                    let newCursorPos = formatted.length;
                    if (digitsBeforeCursor === 0) {
                        newCursorPos = formatted.indexOf('7') + 1;
                    } else {
                        let digitCount = 0;
                        for (let i = 0; i < formatted.length; i++) {
                            if (/[0-9]/.test(formatted[i])) {
                                digitCount++;
                                if (digitCount === digitsBeforeCursor) {
                                    newCursorPos = i + 1;
                                    break;
                                }
                            }
                        }
                    }
                    input.setSelectionRange(newCursorPos, newCursorPos);

                    debounce(key, () => {
                        showError(key);
                        updateSubmitButton();
                    });
                });

                el.addEventListener('blur', () => {
                    touched[key] = true;
                    showError(key);
                    updateSubmitButton();
                });

                return;
            }

            if (key === 'organizationTin') {
                el.addEventListener('input', () => {
                    touched[key] = true;
                    const input = el as HTMLInputElement;
                    const oldValue = input.value;
                    const cursorPos = input.selectionStart ?? 0;
                    const digitsOnly = oldValue.replace(/\D/g, '').slice(0, 12);

                    if (digitsOnly !== oldValue) {
                        const digitsBeforeCursor = oldValue.slice(0, cursorPos).replace(/\D/g, '').length;
                        input.value = digitsOnly;
                        const newPos = Math.min(digitsBeforeCursor, digitsOnly.length);
                        input.setSelectionRange(newPos, newPos);
                    }

                    debounce(key, () => {
                        showError(key);
                        updateSubmitButton();
                    });
                });

                el.addEventListener('blur', () => {
                    touched[key] = true;
                    showError(key);
                    updateSubmitButton();
                });

                return;
            }

            el.addEventListener('input', () => {
                touched[key] = true;
                debounce(key, () => {
                    showError(key);
                    updateSubmitButton();
                });
            });

            el.addEventListener('blur', () => {
                touched[key] = true;
                showError(key);
                updateSubmitButton();
            });
        });

        // ── Confirmation ──

        if (confirmationInput) {
            confirmationInput.addEventListener('change', () => {
                touched.confirmation = true;
                updateSubmitButton();
            });
            confirmationInput.addEventListener('blur', () => {
                touched.confirmation = true;
                updateSubmitButton();
            });
        }

        // ── Tracks: слушаем нативный change + custom event ──

        // Патчим сеттер value, чтобы ловить программные изменения
        trackInputs.forEach((trackInput) => {
            const descriptor = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value');
            if (descriptor && descriptor.set) {
                const originalSetter = descriptor.set;
                Object.defineProperty(trackInput, 'value', {
                    configurable: true,
                    get() { return descriptor.get ? descriptor.get.call(this) : ''; },
                    set(newValue) {
                        originalSetter.call(this, newValue);
                        touched.track = true;
                        debug(config.type, `track value set to "${newValue}"`);
                        updateSubmitButton();
                    },
                });
            }

            // На всякий случай — нативный change
            trackInput.addEventListener('change', () => {
                touched.track = true;
                updateSubmitButton();
            });
        });

        // Клики по UL-опциям (select.ts обновляет hiddenInput.value, сработает сеттер)
        const trackLists = form.querySelectorAll('.UL-TRACK-options');
        trackLists.forEach((list) => {
            list.addEventListener('click', (e) => {
                const target = e.target as HTMLElement;
                if (target.classList.contains('LI-TRACK-option')) {
                    touched.track = true;
                    setTimeout(() => updateSubmitButton(), 50);
                }
            });
        });

        // ── Files ──

        document.addEventListener('files-updated-' + config.type, () => {
            touched.files = true;
            updateSubmitButton();
        });

        if (fileInput) {
            fileInput.addEventListener('change', () => {
                touched.files = true;
                updateSubmitButton();
            });
        }

        // ── Submit ──

        form.addEventListener('submit', (e) => {
            Object.keys(touched).forEach((k) => (touched[k] = true));
            textFieldKeys.forEach((key) => showError(key));

            const allValid =
                isFieldValid('personName') &&
                isFieldValid('organizationName') &&
                isFieldValid('organizationTin') &&
                isFieldValid('organizationRepresentative') &&
                isFieldValid('email') &&
                isFieldValid('phone') &&
                isFieldValid('description') &&
                isConfirmationValid() &&
                isTrackValid() &&
                isFilesValid();

            if (!allValid) {
                e.preventDefault();
            }
        });

        // Первичная проверка на случай, если форма уже заполнена (browser autofill и т.п.)
        updateSubmitButton();
    }

    FORMS.forEach(setupForm);
}

initApplicationValidation();
