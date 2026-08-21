function initApplicationHint() {
    document.addEventListener('DOMContentLoaded', () => {
        // Get all anchor elements
        const blueAnchor = document.getElementById('LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_BLUE');
        const greenAnchor = document.getElementById('LANDING-APPLICATION-PRESENTATION_HINT_ANCHOR_GREEN');

        // Get all content elements
        const blueContent = document.getElementById('LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_BLUE');
        const greenContent = document.getElementById('LANDING-APPLICATION-PRESENTATION_HINT_CONTENT_GREEN');

        // Hide content initially
        if (blueContent) blueContent.style.display = 'none';
        if (greenContent) greenContent.style.display = 'none';

        // Track if mouse is over content
        let isMouseOverBlueContent = false;
        let isMouseOverGreenContent = false;

        // Blue hover events
        if (blueAnchor && blueContent) {
            blueAnchor.addEventListener('mouseenter', () => {
                blueContent.style.display = 'flex';
            });

            // Only hide if mouse is not over content
            blueAnchor.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!isMouseOverBlueContent) {
                        blueContent.style.display = 'none';
                    }
                }, 50);
            });

            // Blue content events
            blueContent.addEventListener('mouseenter', () => {
                isMouseOverBlueContent = true;
                blueContent.style.display = 'flex';
            });

            blueContent.addEventListener('mouseleave', () => {
                isMouseOverBlueContent = false;
                blueContent.style.display = 'none';
            });
        }

        // Green hover events
        if (greenAnchor && greenContent) {
            greenAnchor.addEventListener('mouseenter', () => {
                greenContent.style.display = 'flex';
            });

            // Only hide if mouse is not over content
            greenAnchor.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!isMouseOverGreenContent) {
                        greenContent.style.display = 'none';
                    }
                }, 50);
            });

            // Green content events
            greenContent.addEventListener('mouseenter', () => {
                isMouseOverGreenContent = true;
                greenContent.style.display = 'flex';
            });

            greenContent.addEventListener('mouseleave', () => {
                isMouseOverGreenContent = false;
                greenContent.style.display = 'none';
            });
        }
    });
}

initApplicationHint();
