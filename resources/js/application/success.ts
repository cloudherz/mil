function initApplicationSuccess() {
    const configs = [
        {
            overlayId: 'LANDING-MESSAGE-APPLICATION_SUCCESS',
            windowId: 'LANDING-MESSAGE-APPLICATION_SUCCESS-WINDOW',
            timerId: 'LANDING-MESSAGE-APPLICATION_SUCCESS-TIMER',
        },
        {
            overlayId: 'LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS',
            windowId: 'LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS-WINDOW',
            timerId: 'LANDING-MOBILE-MESSAGE-APPLICATION_SUCCESS-TIMER',
        },
    ];

    const app = document.getElementById('APP');

    configs.forEach(({ overlayId, windowId, timerId }) => {
        const overlay = document.getElementById(overlayId);
        if (!overlay) return;

        // Показываем только если бэк проставил флаг
        if (!overlay.hasAttribute('data-show-success')) return;

        const windowEl = document.getElementById(windowId);
        const timerEl = document.getElementById(timerId);
        if (!timerEl) return;

        const INITIAL_SECONDS = 15;
        let remaining = INITIAL_SECONDS;
        let intervalId: ReturnType<typeof setInterval> | null = null;

        function hideOverlay(): void {
            if (intervalId !== null) {
                clearInterval(intervalId);
                intervalId = null;
            }

            overlay!.style.display = 'none';
            overlay!.removeEventListener('click', handleOverlayClick);

            if (app) {
                app.style.pointerEvents = '';
                app.style.overflow = '';
                app.style.userSelect = '';
            }
        }

        function handleOverlayClick(e: MouseEvent): void {
            if (windowEl && !windowEl.contains(e.target as Node)) {
                hideOverlay();
            }
        }

        timerEl.textContent = String(remaining);

        overlay.style.display = 'unset';

        if (app) {
            app.style.pointerEvents = 'none';
            app.style.overflow = 'hidden';
            app.style.userSelect = 'none';
        }

        overlay.style.pointerEvents = 'auto';
        overlay.addEventListener('click', handleOverlayClick);

        intervalId = setInterval(() => {
            remaining -= 1;
            timerEl.textContent = String(remaining);

            if (remaining <= 0) {
                hideOverlay();
            }
        }, 1000);
    });
}

initApplicationSuccess();
