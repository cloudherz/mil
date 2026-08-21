function initApplicationOpen() {

    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('LANDING-APPLICATION-POPUP');
        const headerBtn = document.getElementById('LANDING-HEADER-ACTION_BUTTON');
        const footerBtn = document.getElementById('LANDING-FOOTER-ACTION_BUTTON');
        const app = document.getElementById('APP');

        function openPopup() {
            popup.style.display = 'unset';
            app.style.overflow = 'hidden';
        }

        function closePopup() {
            popup.style.display = 'none';
            app.style.overflow = '';
            document.getElementById('LANDING-APPLICATION-WINDOW-SELECT').style.display = 'unset';
            document.getElementById('LANDING-APPLICATION-WINDOW-INDIVIDUAL').style.display = 'none';
            document.getElementById('LANDING-APPLICATION-WINDOW-ENTITY').style.display = 'none';
        }

        function handlePopupClick(e) {
            const target = e.target || e.srcElement;
            let current = target;
            let isInside = false;

            while (current) {
                if (current.classList && current.classList.contains('S-APPLICATION-window')) {
                    isInside = true;
                    break;
                }
                current = current.parentNode;
            }

            if (!isInside) {
                closePopup();
                popup.removeEventListener('click', handlePopupClick);
            }
        }

        function handleOpenClick(e) {
            e.preventDefault();
            openPopup();
            popup.addEventListener('click', handlePopupClick);
        }

        headerBtn.addEventListener('click', handleOpenClick);
        footerBtn.addEventListener('click', handleOpenClick);
    });

}

initApplicationOpen();
