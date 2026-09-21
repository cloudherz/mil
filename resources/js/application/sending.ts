function initApplicationSending() {
    const app = document.getElementById('APP');

    // Каждая группа: 3 кнопки + свой оверлей + свой попап
    const groups = [
        {
            color: 'blue' as const,
            overlayId: 'LANDING-MESSAGE-APPLICATION_SENDING',
            popupId: 'LANDING-APPLICATION-POPUP',
            buttons: [
                { id: 'submit_button_student',    color: 'blue' as const },
                { id: 'submit_button_individual', color: 'blue' as const },
                { id: 'submit_button_entity',     color: 'green' as const },
            ],
        },
        {
            color: 'blue' as const,
            overlayId: 'LANDING-MOBILE-MESSAGE-APPLICATION_SENDING',
            popupId: 'LANDING-MOBILE-APPLICATION-POPUP',
            buttons: [
                { id: 'mobile-submit_button_student',    color: 'blue' as const },
                { id: 'mobile-submit_button_individual', color: 'blue' as const },
                { id: 'mobile-submit_button_entity',     color: 'green' as const },
            ],
        },
    ];

    groups.forEach(({ overlayId, popupId, buttons }) => {
        const overlay = document.getElementById(overlayId);
        if (!overlay) {
            console.warn('[sending] Оверлей не найден:', overlayId);
            return;
        }

        const popup = document.getElementById(popupId);

        function recolorOverlay(color: 'blue' | 'green'): void {
            const elements = [
                { selector: '.S-WINDOW-wrapper',     prefix: 'S-WINDOW-wrapper' },
                { selector: '.T-WINDOW-heading',     prefix: 'T-WINDOW-heading' },
                { selector: '.I-WINDOW-loading',     prefix: 'I-WINDOW-loading' },
                { selector: '.T-WINDOW-description', prefix: 'T-WINDOW-description' },
            ];

            elements.forEach(({ selector, prefix }) => {
                const el = overlay.querySelector(selector) as HTMLElement | null;
                if (!el) return;
                el.classList.remove(`${prefix}_blue`, `${prefix}_green`);
                el.classList.add(`${prefix}_${color}`);
            });
        }

        function lockPage(): void {
            if (!app) return;
            app.style.pointerEvents = 'none';
            app.style.overflow = 'hidden';
            app.style.userSelect = 'none';
        }

        function showOverlay(color: 'blue' | 'green'): void {
            recolorOverlay(color);
            if (popup) popup.style.opacity = '0';
            overlay.style.display = 'unset';
            setTimeout(lockPage, 0);
        }

        buttons.forEach(({ id, color }) => {
            const button = document.getElementById(id) as HTMLButtonElement | null;
            if (!button) return;

            button.addEventListener('click', () => {
                if (button.disabled) return;
                showOverlay(color);
            });
        });
    });
}

initApplicationSending();
