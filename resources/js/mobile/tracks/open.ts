function initLandingMobileTracksOpen() {
    const cards = document.querySelectorAll<HTMLElement>('[id^="LANDING-MOBILE-TRACKS-CARD_"]:not([id$="-CONTENT-TEXT"])');

    cards.forEach((card) => {
        card.addEventListener('click', () => {
            const text = document.getElementById(`${card.id}-CONTENT-TEXT`);
            if (!text) return;

            const heading = card.querySelector<HTMLElement>('.I-CONTENT-heading');
            const isOpening = text.classList.contains('S-CONTENT-text_closed');

            text.classList.toggle('S-CONTENT-text_closed');
            text.classList.toggle('S-CONTENT-text_opened');

            if (heading) {
                if (isOpening) {
                    heading.classList.add('I-CONTENT-heading_opened');
                } else {
                    heading.classList.remove('I-CONTENT-heading_opened');
                }
            }
        });
    });
}

initLandingMobileTracksOpen();
