function initApplicationHint() {
    document.addEventListener('DOMContentLoaded', () => {
        const prefixes = [
            'LANDING-APPLICATION-PRESENTATION_HINT',
            'LANDING-MOBILE-APPLICATION-PRESENTATION_HINT',
        ];

        const types = ['STUDENT', 'INDIVIDUAL', 'ENTITY'];

        prefixes.forEach((prefix) => {
            types.forEach((type) => {
                const anchor = document.getElementById(`${prefix}_ANCHOR_${type}`);
                const content = document.getElementById(`${prefix}_CONTENT_${type}`);
                const wrapper = document.getElementById(`${prefix}_CONTENT_WRAPPER_${type}`);

                if (!anchor || !content) return;

                content.style.display = 'none';

                let isMouseOver = false;

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

                content.addEventListener('mouseenter', () => {
                    isMouseOver = true;
                    content.style.display = 'flex';
                });

                content.addEventListener('mouseleave', () => {
                    isMouseOver = false;
                    content.style.display = 'none';
                });

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
    });
}

initApplicationHint();
