function initApplicationFile() {

    function setupFileUpload(
        inputId: string,
        labelId: string,
        textId: string,
        deleteButtonId: string,
        color: string,
        iconBeforeSelector: string,
        iconAfterSelector: string
    ) {
        const input = document.getElementById(inputId) as HTMLInputElement;
        const label = document.getElementById(labelId) as HTMLLabelElement;
        const text = document.getElementById(textId) as HTMLSpanElement;
        const deleteButton = document.getElementById(deleteButtonId) as HTMLButtonElement;
        const iconBefore = document.querySelector(iconBeforeSelector) as SVGElement;
        const iconAfter = document.querySelector(iconAfterSelector) as SVGElement;

        // Проверяем, что элементы найдены
        if (!input || !label || !text || !deleteButton || !iconBefore || !iconAfter) {
            console.error('Elements not found for:', inputId);
            return;
        }

        const parentContainer = input.closest('.S-CONTENT-presentation_input') as HTMLDivElement;
        const deleteContainer = deleteButton?.closest('.S-PRESENTATION_INPUT-delete') as HTMLDivElement;

        // DataTransfer для накопления файлов
        const dataTransfer = new DataTransfer();

        const maxFiles = color === 'green' ? 3 : 1;
        const defaultText = maxFiles === 1 ? 'Прикрепить файл' : 'Прикрепить файлы';

        /*
        |--------------------------------------------------------------------------
        | Определяем тип заявки из inputId (file_student -> student)
        |--------------------------------------------------------------------------
        */

        const applicationType = inputId.replace('file_', ''); // 'student' | 'individual' | 'entity'

        /*
        |--------------------------------------------------------------------------
        | Диспатчим кастомное событие для валидации
        |--------------------------------------------------------------------------
        */

        function notifyValidation() {
            document.dispatchEvent(
                new CustomEvent(`files-updated-${applicationType}`)
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Обновление UI
        |--------------------------------------------------------------------------
        */

        function updateUI() {
            const files = Array.from(input.files || []);

            if (files.length > 0) {
                const names = files.map(f => f.name).join(', ');
                text.textContent = names.length > 30 ? names.substring(0, 30) + '...' : names;
                iconBefore.style.display = 'none';
                iconAfter.style.display = 'unset';

                if (parentContainer) {
                    parentContainer.classList.remove(`S-CONTENT-presentation_input_${color}_default`);
                    parentContainer.classList.add(`S-CONTENT-presentation_input_${color}_uploaded`);
                }
                if (deleteContainer) {
                    deleteContainer.classList.remove(`S-PRESENTATION_INPUT-delete_${color}_default`);
                    deleteContainer.classList.add(`S-PRESENTATION_INPUT-delete_${color}_uploaded`);
                }
            } else {
                text.textContent = defaultText;
                iconBefore.style.display = 'unset';
                iconAfter.style.display = 'none';

                if (parentContainer) {
                    parentContainer.classList.remove(`S-CONTENT-presentation_input_${color}_uploaded`);
                    parentContainer.classList.add(`S-CONTENT-presentation_input_${color}_default`);
                }
                if (deleteContainer) {
                    deleteContainer.classList.remove(`S-PRESENTATION_INPUT-delete_${color}_uploaded`);
                    deleteContainer.classList.add(`S-PRESENTATION_INPUT-delete_${color}_default`);
                }
            }

            // ── Уведомляем валидацию ──
            notifyValidation();
        }

        /*
        |--------------------------------------------------------------------------
        | Обработчик выбора файлов
        |--------------------------------------------------------------------------
        */

        input.addEventListener('change', (event: Event) => {
            const target = event.target as HTMLInputElement;

            if (target.files && target.files.length > 0) {
                const newFiles = Array.from(target.files);

                const allowedExtensions = ['.pptx', '.pdf'];
                const invalidFiles = newFiles.filter(
                    f => !allowedExtensions.some(ext => f.name.toLowerCase().endsWith(ext))
                );
                if (invalidFiles.length > 0) {
                    alert('Можно загружать только .pptx и .pdf файлы');
                    target.value = '';
                    input.files = dataTransfer.files;
                    return;
                }

                // Проверка количества
                if (dataTransfer.files.length + newFiles.length > maxFiles) {
                    alert(`Максимально можно прикрепить ${maxFiles} файл(а)`);
                    target.value = '';
                    input.files = dataTransfer.files;
                    return;
                }

                // Проверка суммарного размера (32 MB на все файлы)
                const MAX_TOTAL_SIZE = 32 * 1024 * 1024; // 32 MB в байтах
                const existingSize = Array.from(dataTransfer.files).reduce((sum, f) => sum + f.size, 0);
                const newSize = newFiles.reduce((sum, f) => sum + f.size, 0);
                if (existingSize + newSize > MAX_TOTAL_SIZE) {
                    const currentMb = (existingSize / 1024 / 1024).toFixed(1);
                    const newMb = (newSize / 1024 / 1024).toFixed(1);
                    alert(
                        `Суммарный размер всех файлов не должен превышать 32 MB.\n` +
                        `Уже загружено: ${currentMb} MB\n` +
                        `Новый файл: ${newMb} MB\n` +
                        `Итого: ${(Math.floor((existingSize + newSize) / 1024 / 1024 * 10) / 10).toFixed(1)} MB`
                    );
                    target.value = '';
                    input.files = dataTransfer.files;
                    return;
                }

                // Добавляем файлы в DataTransfer
                newFiles.forEach(file => dataTransfer.items.add(file));

                // Присваиваем input обновлённый список файлов
                input.files = dataTransfer.files;

                updateUI();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Обработчик кнопки удаления
        |--------------------------------------------------------------------------
        */

        if (deleteButton) {
            deleteButton.addEventListener('click', (event: MouseEvent) => {
                event.preventDefault();

                // Очищаем все файлы
                dataTransfer.items.clear();
                input.files = dataTransfer.files;
                input.value = '';

                updateUI();
            });
        }
    }

    // Студент - 1 файл
    setupFileUpload(
        'file_student',
        'uploadLabel_student',
        'uploadText_student',
        'uploadDelete_student',
        'blue',
        '.I-PRESENTATION_INPUT-file_before_student',
        '.I-PRESENTATION_INPUT-file_after_student'
    );

    // Физ. лицо - 1 файл
    setupFileUpload(
        'file_individual',
        'uploadLabel_individual',
        'uploadText_individual',
        'uploadDelete_individual',
        'blue',
        '.I-PRESENTATION_INPUT-file_before_individual',
        '.I-PRESENTATION_INPUT-file_after_individual'
    );

    // Организация - 3 файла
    setupFileUpload(
        'file_entity',
        'uploadLabel_entity',
        'uploadText_entity',
        'uploadDelete_entity',
        'green',
        '.I-PRESENTATION_INPUT-file_before_entity',
        '.I-PRESENTATION_INPUT-file_after_entity'
    );
}

initApplicationFile();
