function initApplicationOpen() {
    document.addEventListener('DOMContentLoaded', function() {
        const app = document.getElementById('APP');

        // Пары «кнопки-триггеры → свой попап»
        const pairs = [
            {
                popupId: 'LANDING-APPLICATION-POPUP',
                windowSelectId: 'LANDING-APPLICATION-WINDOW-SELECT',
                windowIds: [
                    'LANDING-APPLICATION-WINDOW-STUDENT',
                    'LANDING-APPLICATION-WINDOW-INDIVIDUAL',
                    'LANDING-APPLICATION-WINDOW-ENTITY',
                ],
                triggerIds: [
                    'LANDING-HEADER-ACTION_BUTTON',
                    'LANDING-FOOTER-ACTION_BUTTON',
                ],
            },
            {
                popupId: 'LANDING-MOBILE-APPLICATION-POPUP',
                windowSelectId: 'LANDING-MOBILE-APPLICATION-WINDOW-SELECT',
                windowIds: [
                    'LANDING-MOBILE-APPLICATION-WINDOW-STUDENT',
                    'LANDING-MOBILE-APPLICATION-WINDOW-INDIVIDUAL',
                    'LANDING-MOBILE-APPLICATION-WINDOW-ENTITY',
                ],
                triggerIds: [
                    'LANDING-MOBILE-HEADER-ACTION_BUTTON',
                    'LANDING-MOBILE-FOOTER-ACTION_BUTTON',
                ],
            },
        ];

        pairs.forEach(({ popupId, windowSelectId, windowIds, triggerIds }) => {
            const popup = document.getElementById(popupId);
            if (!popup) return;

            function closePopup(): void {
                popup!.style.display = 'none';
                if (app) app.style.overflow = '';

                const selectEl = document.getElementById(windowSelectId);
                if (selectEl) selectEl.style.display = 'none';

                windowIds.forEach((id) => {
                    const el = document.getElementById(id);
                    if (el) el.style.display = 'none';
                });
            }

            function handlePopupClick(e: MouseEvent): void {
                const target = e.target as HTMLElement;
                let current: HTMLElement | null = target;
                let isInside = false;

                while (current) {
                    if (current.classList && current.classList.contains('S-APPLICATION-window')) {
                        isInside = true;
                        break;
                    }
                    current = current.parentNode as HTMLElement | null;
                }

                if (!isInside) {
                    closePopup();
                    popup!.removeEventListener('click', handlePopupClick);
                }
            }

            function openPopup(): void {
                popup!.style.display = 'unset';
                if (app) app.style.overflow = 'hidden';

                const selectEl = document.getElementById(windowSelectId);
                if (selectEl) selectEl.style.display = 'unset';
            }

            function handleOpenClick(e: MouseEvent): void {
                e.preventDefault();
                openPopup();
                popup!.addEventListener('click', handlePopupClick);
            }

            triggerIds.forEach((id) => {
                const btn = document.getElementById(id);
                if (btn) btn.addEventListener('click', handleOpenClick);
            });
        });
    });
}

initApplicationOpen();
