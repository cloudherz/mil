function initApplicationFile() {

    function setupFileUpload(
        inputId: string,
        labelId: string,
        textId: string,
        deleteButtonId: string,
        color: string, // Added color parameter to dynamically manage classes
        iconBeforeSelector: string,
        iconAfterSelector: string
    ) {
        const input = document.getElementById(inputId) as HTMLInputElement;
        const label = document.getElementById(labelId) as HTMLLabelElement;
        const text = document.getElementById(textId) as HTMLSpanElement;
        const deleteButton = document.getElementById(deleteButtonId) as HTMLButtonElement;
        const iconBefore = document.querySelector(iconBeforeSelector) as SVGElement;
        const iconAfter = document.querySelector(iconAfterSelector) as SVGElement;

        // Find the parent containers relative to the input element
        const parentContainer = input.closest('.S-CONTENT-presentation_input') as HTMLDivElement;
        const deleteContainer = deleteButton?.closest('.S-PRESENTATION_INPUT-delete') as HTMLDivElement;

        // Shared function to reset the state back to default
        function resetUploadState() {
            input.value = '';
            text.textContent = 'Прикрепить файл';
            iconBefore.style.display = 'unset';
            iconAfter.style.display = 'none';

            // Switch classes to _default
            if (parentContainer) {
                parentContainer.classList.remove(`S-CONTENT-presentation_input_${color}_uploaded`);
                parentContainer.classList.add(`S-CONTENT-presentation_input_${color}_default`);
            }
            if (deleteContainer) {
                deleteContainer.classList.remove(`S-PRESENTATION_INPUT-delete_${color}_uploaded`);
                deleteContainer.classList.add(`S-PRESENTATION_INPUT-delete_${color}_default`);
            }
        }

        input.addEventListener('change', (event: Event) => {
            const target = event.target as HTMLInputElement;

            if (target.files && target.files.length > 0) {
                text.textContent = target.files[0].name;
                iconBefore.style.display = 'none';
                iconAfter.style.display = 'unset';

                // Switch classes to _uploaded
                if (parentContainer) {
                    parentContainer.classList.remove(`S-CONTENT-presentation_input_${color}_default`);
                    parentContainer.classList.add(`S-CONTENT-presentation_input_${color}_uploaded`);
                }
                if (deleteContainer) {
                    deleteContainer.classList.remove(`S-PRESENTATION_INPUT-delete_${color}_default`);
                    deleteContainer.classList.add(`S-PRESENTATION_INPUT-delete_${color}_uploaded`);
                }
            } else {
                resetUploadState();
            }
        });

        if (deleteButton) {
            deleteButton.addEventListener('click', (event: MouseEvent) => {
                event.preventDefault();
                resetUploadState();
            });
        }
    }

    // Usage updated with lowercase color strings matching your class naming convention
    setupFileUpload(
        'uploadInputBlue',
        'uploadLabelBlue',
        'uploadTextBlue',
        'uploadDeleteBlue',
        'blue',
        '.I-PRESENTATION_INPUT-file_before_blue',
        '.I-PRESENTATION_INPUT-file_after_blue'
    );

    setupFileUpload(
        'uploadInputGreen',
        'uploadLabelGreen',
        'uploadTextGreen',
        'uploadDeleteGreen',
        'green',
        '.I-PRESENTATION_INPUT-file_before_green',
        '.I-PRESENTATION_INPUT-file_after_green'
    );
}

initApplicationFile();
