function initLandingPartnershipCopy() {

    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('LANDING-PARTNERSHIP-COPY_BUTTON');
        const carcass = document.getElementById('LANDING-MESSAGE-EMAIL_COPIED-CARCASS');
        const email = 'hello@milpremia.ru';

        let isCooldown = false;

        button.addEventListener('click', async () => {
            if (isCooldown) return;

            try {
                isCooldown = true;
                button.style.pointerEvents = 'none';

                // Copy email to clipboard
                await navigator.clipboard.writeText(email);

                // Set carcass opacity to 1
                carcass.style.opacity = '1';
                carcass.style.marginBottom = '5vh';

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
    });

}

initLandingPartnershipCopy();
