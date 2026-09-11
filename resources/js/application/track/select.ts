function initApplicationTrackSelect() {
    document.querySelectorAll('.S-SELECT-carcass').forEach(carcass => {
        const select = carcass.querySelector('.S-TRACK-select');
        const optionsList = carcass.querySelector('.UL-TRACK-options');
        const selectedValue = select?.querySelector('.selected-value');
        const hiddenInput = carcass.querySelector('.S-TRACK-hidden-input') as HTMLInputElement | null;

        if (!select || !optionsList || !hiddenInput) return;

        if (selectedValue) {
            selectedValue.classList.add('T-TRACK-select');
        }

        // Toggle dropdown on click
        select.addEventListener('click', function(e) {
            e.stopPropagation();

            document.querySelectorAll('.S-TRACK-select .UL-TRACK-options.open').forEach(list => {
                if (list !== optionsList) {
                    list.classList.remove('open');
                    const otherCarcass = list.closest('.S-SELECT-carcass');
                    if (otherCarcass) {
                        const selectBtn = otherCarcass.querySelector('.S-TRACK-select');
                        if (selectBtn) selectBtn.classList.remove('open');
                    }
                }
            });

            optionsList.classList.toggle('open');
            select.classList.toggle('open');
        });

        optionsList.querySelectorAll('li').forEach(option => {
            option.addEventListener('click', function(e) {
                e.stopPropagation();
                const value = (this as HTMLElement).dataset.value ?? '';
                const text = this.textContent ?? '';

                // Обновляем отображаемый текст
                if (selectedValue) {
                    if (value === '-') {
                        selectedValue.textContent = 'Выберите трек';
                        selectedValue.classList.add('T-TRACK-select');
                    } else {
                        selectedValue.textContent = text;
                        selectedValue.classList.remove('T-TRACK-select');
                    }
                }

                // Update hidden input for form submission
                if (value === '-') {
                    hiddenInput.value = '';
                } else {
                    hiddenInput.value = value;
                }

                // ⬇⬇⬇ ВАЖНО: продублируем нативное событие change,
                // чтобы validation.ts точно его поймал
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                // ⬆⬆⬆

                optionsList.querySelectorAll('li').forEach(li => li.classList.remove('selected'));
                this.classList.add('selected');

                optionsList.classList.remove('open');
                select.classList.remove('open');

                // ⬇⬇⬇ Дispatch custom event на carcass (wrapper больше нет)
                const event = new CustomEvent('custom-change', {
                    detail: { value, text }
                });
                carcass.dispatchEvent(event);
                // ⬆⬆⬆

                // console.log('[track-select] Selected:', value, 'from', hiddenInput.id);
            });
        });
    });

    document.addEventListener('click', function() {
        document.querySelectorAll('.S-TRACK-select .UL-TRACK-options.open').forEach(list => {
            list.classList.remove('open');
            const carcass = list.closest('.S-SELECT-carcass');
            if (carcass) {
                const selectBtn = carcass.querySelector('.S-TRACK-select');
                if (selectBtn) selectBtn.classList.remove('open');
            }
        });
    });
}

initApplicationTrackSelect();
