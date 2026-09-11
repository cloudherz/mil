function initApplicationSuccess() {
    const overlay = document.getElementById('LANDING-MESSAGE-APPLICATION_SUCCESS');
    if (!overlay) return;

    // Показываем только если бэк проставил флаг
    if (!overlay.hasAttribute('data-show-success')) return;

    const windowEl = document.getElementById('LANDING-MESSAGE-APPLICATION_SUCCESS-WINDOW');
    const timerEl = document.getElementById('LANDING-MESSAGE-APPLICATION_SUCCESS-TIMER');
    if (!timerEl) return;

    const app = document.getElementById('APP');

    const INITIAL_SECONDS = 15;

    let remaining = INITIAL_SECONDS;
    let intervalId: ReturnType<typeof setInterval> | null = null;

    function hideOverlay(): void {
        if (intervalId !== null) {
            clearInterval(intervalId);
            intervalId = null;
        }

        overlay.style.display = 'none';

        if (app) {
            app.style.pointerEvents = '';
            app.style.overflow = '';
            app.style.userSelect = '';
        }

        // Снимаем слушателя клика — оверлей больше не показывается
        overlay.removeEventListener('click', handleOverlayClick);
    }

    function handleOverlayClick(e: MouseEvent): void {
        // Клик только если он был ВНЕ окна
        if (windowEl && !windowEl.contains(e.target as Node)) {
            hideOverlay();
        }
    }

    // Стартовое значение таймера
    timerEl.textContent = String(remaining);

    // Показываем окно
    overlay.style.display = 'unset';

    // Блокируем страницу под оверлеем
    if (app) {
        app.style.pointerEvents = 'none';
        app.style.overflow = 'hidden';
        app.style.userSelect = 'none';
    }

    overlay.style.pointerEvents = 'auto';

    // Клик вне окна закрывает
    overlay.addEventListener('click', handleOverlayClick);

    // Обратный отсчёт
    intervalId = setInterval(() => {
        remaining -= 1;
        timerEl.textContent = String(remaining);

        if (remaining <= 0) {
            hideOverlay();
        }
    }, 1000);
}

initApplicationSuccess();
