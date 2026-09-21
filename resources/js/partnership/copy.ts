function initLandingPartnershipCopy() {
    document.addEventListener('DOMContentLoaded', () => {
        const email = 'hello@milpremia.ru';

        // Список пар: [кнопка, carcass, значение marginBottom]
        // Обе пары существуют в DOM одновременно — просто навешиваем обработчик на каждую.
        const targets = [
            {
                button: document.getElementById('LANDING-PARTNERSHIP-COPY_BUTTON'),
                carcass: document.getElementById('LANDING-MESSAGE-EMAIL_COPIED-CARCASS'),
                marginBottom: '5vh',
            },
            {
                button: document.getElementById('LANDING-MOBILE-PARTNERSHIP-COPY_BUTTON'),
                carcass: document.getElementById('LANDING-MOBILE-MESSAGE-EMAIL_COPIED-CARCASS'),
                marginBottom: '8dvw',
            },
        ];

        for (const { button, carcass, marginBottom } of targets) {
            // Пропускаем, если элемента нет в DOM
            if (!button || !carcass) continue;

            let isCooldown = false;

            button.addEventListener('click', async () => {
                if (isCooldown) return;

                try {
                    isCooldown = true;
                    button.style.pointerEvents = 'none';

                    // Copy email to clipboard
                    await navigator.clipboard.writeText(email);

                    // Show carcass
                    carcass.style.opacity = '1';
                    carcass.style.marginBottom = marginBottom;

                    setTimeout(() => {
                        carcass.style.opacity = '0';
                        carcass.style.marginBottom = '0';
                        isCooldown = false;
                        button.style.pointerEvents = 'auto';
                    }, 3000);

                } catch (err) {
                    console.error('Failed to copy: ', err);
                    isCooldown = false;
                    button.style.pointerEvents = 'auto';
                }
            });
        }
    });
}

initLandingPartnershipCopy();
