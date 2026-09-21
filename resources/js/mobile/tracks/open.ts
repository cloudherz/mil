function initLandingMobileTracksOpen() {
    const cards = document.querySelectorAll<HTMLElement>('[id^="LANDING-MOBILE-TRACKS-CARD_"]:not([id$="-CONTENT-TEXT"])');

    cards.forEach((card) => {
        card.addEventListener('click', () => {
            const text = document.getElementById(`${card.id}-CONTENT-TEXT`);
            if (!text) return;

            text.classList.toggle('S-CONTENT-text_closed');
            text.classList.toggle('S-CONTENT-text_opened');
        });
    });
}

initLandingMobileTracksOpen();
