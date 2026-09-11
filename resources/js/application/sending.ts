function initApplicationSending() {
    const overlay = document.getElementById('LANDING-MESSAGE-APPLICATION_SENDING');
    if (!overlay) {
        console.warn('[sending] Оверлей не найден');
        return;
    }

    const app = document.getElementById('APP');
    const popup = document.getElementById('LANDING-APPLICATION-POPUP');

    const configs = [
        { buttonId: 'submit_button_student',    color: 'blue' },
        { buttonId: 'submit_button_individual', color: 'blue' },
        { buttonId: 'submit_button_entity',     color: 'green' },
    ] as const;

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
        // 1. Перекрашиваем оверлей
        recolorOverlay(color);

        // 2. Скрываем попап визуально
        if (popup) popup.style.opacity = '0';

        // 3. Показываем оверлей
        overlay.style.display = 'unset';

        // 4. Блокируем страницу — на следующем тике,
        //    чтобы нативный submit успел уйти
        setTimeout(lockPage, 0);
    }

    configs.forEach(({ buttonId, color }) => {
        const button = document.getElementById(buttonId) as HTMLButtonElement | null;
        if (!button) return;

        button.addEventListener('click', () => {
            if (button.disabled) return;
            showOverlay(color);
        });
    });
}

initApplicationSending();
