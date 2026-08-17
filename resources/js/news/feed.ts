function initLandingNewsFeed() {

// ============================================
// NEWS CAROUSEL SCRIPT
// ============================================
document.addEventListener('DOMContentLoaded', function() {

    // === GET ELEMENTS ===
    const wrapper = document.querySelector('.S-ARTICLES-wrapper');
    const carcass = document.querySelector('.S-ARTICLES-carcass');
    const articles = document.querySelectorAll('.S-ARTICLES-article');
    const prevBtn = document.getElementById('LANDING-NEWS-PREVIOUS_BUTTON');
    const nextBtn = document.getElementById('LANDING-NEWS-PREVIOUS_NEXT');

    // === CALCULATE ARTICLE WIDTH (including gap) ===
    let articleWidth = 0;
    let gap = 0;
    let totalArticles = articles.length;
    let currentIndex = 0; // 0 = first article visible

    function calculateDimensions() {
        if (articles.length === 0) return;

        // Get the first article's full width including margin
        const firstArticle = articles[0];
        const style = window.getComputedStyle(firstArticle);
        const width = firstArticle.offsetWidth;
        const marginLeft = parseFloat(style.marginLeft) || 0;
        const marginRight = parseFloat(style.marginRight) || 0;

        // Get gap from flex container
        const carcassStyle = window.getComputedStyle(carcass);
        gap = parseFloat(carcassStyle.gap) || parseFloat(carcassStyle.columnGap) || 0;

        // Total width = article width + gap (only if not last)
        articleWidth = width + gap;
    }

    // === UPDATE BUTTON STATES ===
    function updateButtons() {
        // Disable prev if at first article
        if (currentIndex === 0) {
            prevBtn.disabled = true;
            prevBtn.style.opacity = '0.5';
            prevBtn.style.cursor = 'not-allowed';
        } else {
            prevBtn.disabled = false;
            prevBtn.style.opacity = '1';
            prevBtn.style.cursor = 'pointer';
        }

        // Disable next if at last possible position
        // We need to check if there are at least 3 more articles to show
        const maxIndex = Math.max(0, totalArticles - 3);
        if (currentIndex >= maxIndex) {
            nextBtn.disabled = true;
            nextBtn.style.opacity = '0.5';
            nextBtn.style.cursor = 'not-allowed';
        } else {
            nextBtn.disabled = false;
            nextBtn.style.opacity = '1';
            nextBtn.style.cursor = 'pointer';
        }
    }

    // === SCROLL TO SPECIFIC ARTICLE INDEX ===
    function scrollToArticle(index, smooth = true) {
        if (index < 0) index = 0;
        const maxIndex = Math.max(0, totalArticles - 3);
        if (index > maxIndex) index = maxIndex;

        currentIndex = index;
        const scrollPosition = index * articleWidth;

        wrapper.scrollTo({
            left: scrollPosition,
            behavior: smooth ? 'smooth' : 'auto'
        });

        updateButtons();
    }

    // === NEXT BUTTON ===
    function goNext() {
        const maxIndex = Math.max(0, totalArticles - 3);
        if (currentIndex < maxIndex) {
            scrollToArticle(currentIndex + 1);
        }
    }

    // === PREVIOUS BUTTON ===
    function goPrev() {
        if (currentIndex > 0) {
            scrollToArticle(currentIndex - 1);
        }
    }

    // === DRAG TO SCROLL ===
    let isDragging = false;
    let startX = 0;
    let scrollLeft = 0;
    let hasMoved = false;

    wrapper.addEventListener('mousedown', function(e) {
        isDragging = true;
        hasMoved = false;
        startX = e.pageX - wrapper.offsetLeft;
        scrollLeft = wrapper.scrollLeft;
        wrapper.style.cursor = 'grabbing';
        wrapper.style.userSelect = 'none';
    });

    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - wrapper.offsetLeft;
        const walk = (x - startX) * 1.5; // Scroll speed multiplier
        wrapper.scrollLeft = scrollLeft - walk;
        if (Math.abs(walk) > 3) hasMoved = true;
    });

    document.addEventListener('mouseup', function(e) {
        if (isDragging) {
            isDragging = false;
            wrapper.style.cursor = 'grab';
            wrapper.style.userSelect = '';

            // If we actually dragged, snap to nearest article
            if (hasMoved) {
                snapToNearestArticle();
            }
        }
    });

    // === SNAP TO NEAREST ARTICLE ===
    function snapToNearestArticle() {
        if (articleWidth === 0) return;
        const currentScroll = wrapper.scrollLeft;
        const nearestIndex = Math.round(currentScroll / articleWidth);
        const maxIndex = Math.max(0, totalArticles - 3);
        const snapIndex = Math.min(nearestIndex, maxIndex);
        scrollToArticle(snapIndex, true);
    }

    // === TOUCH SUPPORT ===
    let touchStartX = 0;
    let touchScrollLeft = 0;
    let isTouching = false;

    wrapper.addEventListener('touchstart', function(e) {
        isTouching = true;
        touchStartX = e.touches[0].pageX - wrapper.offsetLeft;
        touchScrollLeft = wrapper.scrollLeft;
    });

    wrapper.addEventListener('touchmove', function(e) {
        if (!isTouching) return;
        const x = e.touches[0].pageX - wrapper.offsetLeft;
        const walk = (x - touchStartX) * 1.5;
        wrapper.scrollLeft = touchScrollLeft - walk;
    });

    wrapper.addEventListener('touchend', function(e) {
        if (isTouching) {
            isTouching = false;
            snapToNearestArticle();
        }
    });

    // === RE-CALCULATE ON RESIZE ===
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            calculateDimensions();
            scrollToArticle(currentIndex, false);
        }, 250);
    });

    // === INITIAL SETUP ===
    function init() {
        calculateDimensions();
        // Make sure scroll starts at 0
        wrapper.scrollLeft = 0;
        currentIndex = 0;
        updateButtons();
        wrapper.style.cursor = 'grab';
    }

    // Wait a tiny bit for layout to settle
    setTimeout(init, 50);

    // === ATTACH EVENT LISTENERS ===
    prevBtn.addEventListener('click', goPrev);
    nextBtn.addEventListener('click', goNext);

    // === KEYBOARD SUPPORT (optional) ===
    document.addEventListener('keydown', function(e) {
        // Only if focus is on the carousel area
        if (wrapper.contains(document.activeElement) ||
            prevBtn.contains(document.activeElement) ||
            nextBtn.contains(document.activeElement)) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                goPrev();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                goNext();
            }
        }
    });

    // Log to confirm script loaded
    console.log('News carousel initialized!');
});

}

initLandingNewsFeed();
