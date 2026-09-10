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

        function updateUI() {
            const files = Array.from(input.files || []);

            if (files.length > 0) {
                // Показываем имена файлов
                const names = files.map(f => f.name).join(', ');
                text.textContent = names.length > 30 ? names.substring(0, 30) + '...' : names;
                iconBefore.style.display = 'none';
                iconAfter.style.display = 'unset';

                // Меняем классы на _uploaded
                if (parentContainer) {
                    parentContainer.classList.remove(`S-CONTENT-presentation_input_${color}_default`);
                    parentContainer.classList.add(`S-CONTENT-presentation_input_${color}_uploaded`);
                }
                if (deleteContainer) {
                    deleteContainer.classList.remove(`S-PRESENTATION_INPUT-delete_${color}_default`);
                    deleteContainer.classList.add(`S-PRESENTATION_INPUT-delete_${color}_uploaded`);
                }
            } else {
                // Возвращаем к дефолтному состоянию
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
        }

        input.addEventListener('change', (event: Event) => {
            const target = event.target as HTMLInputElement;

            if (target.files && target.files.length > 0) {
                const newFiles = Array.from(target.files);

                // Проверка расширения
                const invalidFiles = newFiles.filter(f => !f.name.toLowerCase().endsWith('.pptx'));
                if (invalidFiles.length > 0) {
                    alert('Можно загружать только .pptx файлы!');
                    target.value = '';
                    return;
                }

                // Проверка количества
                if (dataTransfer.files.length + newFiles.length > maxFiles) {
                    alert(`Максимум ${maxFiles} файл(а)!`);
                    target.value = '';
                    return;
                }

                // Добавляем файлы в DataTransfer
                newFiles.forEach(file => dataTransfer.items.add(file));

                // Присваиваем input обновлённый список файлов
                input.files = dataTransfer.files;

                updateUI();
            }
        });

        // Обработчик кнопки удаления
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
