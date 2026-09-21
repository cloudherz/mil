function initLandingMobileHeaderOpen() {
    const openBtn = document.getElementById('LANDING-MOBILE-HEADER-OPEN');
    const closeBtn = document.getElementById('LANDING-MOBILE-HEADER-CLOSE');
    const overlay = document.getElementById('LANDING-MOBILE-HEADER-OVERLAY');
    const wrapper = document.getElementById('LANDING-MOBILE-HEADER-OVERLAY_WRAPPER');

    if (!openBtn || !closeBtn || !overlay || !wrapper) return;

    const openMenu = () => {
        openBtn.style.display = 'none';
        overlay.style.opacity = '1';
        overlay.style.pointerEvents = 'auto';
    };

    const closeMenu = () => {
        openBtn.style.display = 'flex';
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
    };

    openBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        openMenu();
    });

    closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMenu();
    });

    // клики внутри wrapper не должны доходить до document и закрывать меню
    wrapper.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // клик по любой ссылке внутри wrapper закрывает меню
    wrapper.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    // любой клик вне wrapper (в т.ч. вне overlay) закрывает меню
    document.addEventListener('click', (e) => {
        if (overlay.style.opacity !== '1') return;
        if (!wrapper.contains(e.target as Node)) {
            closeMenu();
        }
    });
}

initLandingMobileHeaderOpen();
