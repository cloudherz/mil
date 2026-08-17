function initLandingHeaderScroll() {
    const header = document.getElementById("LANDING-HEADER-CARCASS");
    const button = document.getElementById("LANDING-HEADER-ACTION_BUTTON");

    const style_header_solid = "S-HEADER-carcass_solid";
    const style_button_solid = "B-BUTTON-button_solid";

    let is_solid = false;

    function updateHeader() {
        const at_the_top = window.scrollY === 0;

        if (at_the_top && is_solid) {
            header.classList.remove(style_header_solid);
            button.classList.remove(style_button_solid);
            is_solid = false;
        } else if (!at_the_top && !is_solid) {
            header.classList.add(style_header_solid);
            button.classList.add(style_button_solid);
            is_solid = true;
        }
    }

    window.addEventListener("scroll", updateHeader, { passive: true });

    updateHeader();
}

initLandingHeaderScroll();
