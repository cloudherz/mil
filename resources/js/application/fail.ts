function initApplicationFail() {
    const configs = [
        {
            overlayId: 'LANDING-MESSAGE-APPLICATION_FAIL',
            windowId: 'LANDING-MESSAGE-APPLICATION_FAIL-WINDOW',
        },
        {
            overlayId: 'LANDING-MOBILE-MESSAGE-APPLICATION_FAIL',
            windowId: 'LANDING-MOBILE-MESSAGE-APPLICATION_FAIL-WINDOW',
        },
    ];

    const app = document.getElementById('APP');

    configs.forEach(({ overlayId, windowId }) => {
        const overlay = document.getElementById(overlayId);
        if (!overlay) return;

        // Показываем только если бэк проставил флаг
        if (!overlay.hasAttribute('data-show-error')) return;

        const windowEl = document.getElementById(windowId);

        function hideOverlay(): void {
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

        overlay.style.display = 'unset';

        if (app) {
            app.style.pointerEvents = 'none';
            app.style.overflow = 'hidden';
            app.style.userSelect = 'none';
        }

        overlay.style.pointerEvents = 'auto';
        overlay.addEventListener('click', handleOverlayClick);
    });
}

initApplicationFail();
