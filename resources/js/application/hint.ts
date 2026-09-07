function initApplicationHint() {
    document.addEventListener('DOMContentLoaded', () => {
        // Определяем соответствие типов и их цветов
        const typeConfigs = [
            { type: 'STUDENT', color: 'BLUE' },
            { type: 'INDIVIDUAL', color: 'BLUE' },
            { type: 'ENTITY', color: 'GREEN' }
        ];

        typeConfigs.forEach(config => {
            const { type, color } = config;

            // Используем тип для поиска элементов
            const anchor = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_${type}`);
            const content = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_${type}`);
            const wrapper = document.getElementById(`LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_WRAPPER_${type}`);

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
