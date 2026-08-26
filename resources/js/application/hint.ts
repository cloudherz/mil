function initApplicationHint() {
    document.addEventListener('DOMContentLoaded', () => {
        const colors = ['BLUE', 'GREEN'];

        colors.forEach(color => {
            const anchor = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_${color}`);
            const content = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_${color}`);
            const wrapper = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_WRAPPER_${color}`);

            if (!anchor || !content) return;

            // Hide content initially
            content.style.display = 'none';

            // Track if mouse is over content or wrapper
            let isMouseOver = false;

            // Anchor hover events
            anchor.addEventListener('mouseenter', () => {
                content.style.display = 'flex';
            });

            anchor.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!isMouseOver) {
                        content.style.display = 'none';
                    }
                }, 50);
            });

            // Content hover events
            content.addEventListener('mouseenter', () => {
                isMouseOver = true;
                content.style.display = 'flex';
            });

            content.addEventListener('mouseleave', () => {
                isMouseOver = false;
                content.style.display = 'none';
            });

            // Wrapper hover events (new)
            if (wrapper) {
                wrapper.addEventListener('mouseenter', () => {
                    isMouseOver = true;
                    content.style.display = 'flex';
                });

                wrapper.addEventListener('mouseleave', () => {
                    isMouseOver = false;
                    content.style.display = 'none';
                });
            }
        });
    });
}

initApplicationHint();
