function initApplicationTrackSelect() {
    document.querySelectorAll('.S-TRACK-select .S-SELECT-carcass').forEach(wrapper => {
        const select = wrapper.querySelector('.S-TRACK-select');
        const optionsList = wrapper.querySelector('.UL-TRACK-options');
        const selectedValue = select.querySelector('.selected-value');
        const hiddenInput = wrapper.querySelector('.S-TRACK-hidden-input');

        // Toggle dropdown on click
        select.addEventListener('click', function(e) {
            e.stopPropagation();

            document.querySelectorAll('.S-TRACK-select .UL-TRACK-options.open').forEach(list => {
                if (list !== optionsList) {
                    list.classList.remove('open');
                    const carcass = list.closest('.S-SELECT-carcass');
                    if (carcass) {
                        const selectBtn = carcass.querySelector('.S-TRACK-select');
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
                const value = this.dataset.value;
                const text = this.textContent;

                // Update selected value display
                selectedValue.textContent = text;

                // Update hidden input for form submission
                if (hiddenInput) {
                    hiddenInput.value = value;
                }

                optionsList.querySelectorAll('li').forEach(li => li.classList.remove('selected'));
                this.classList.add('selected');

                optionsList.classList.remove('open');
                select.classList.remove('open');

                const event = new CustomEvent('custom-change', {
                    detail: { value: value, text: text }
                });
                wrapper.dispatchEvent(event);

                console.log('Selected:', value);
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









