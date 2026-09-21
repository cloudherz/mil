function initLandingNewsFeed() {

// ============================================
// NEWS CAROUSEL SCRIPT (универсальный для desktop/mobile)
// ============================================

    /**
     * Инициализирует карусель новостей для конкретного экземпляра фида.
     * @param config - объект с ID элементов конкретного фида
     */
    function createNewsFeed(config: {
        wrapperId: string;
        carcassId: string;
        prevBtnId: string;
        nextBtnId: string;
    }) {
        // === GET ELEMENTS ===
        const wrapperEl = document.getElementById(config.wrapperId);
        const carcassEl = document.getElementById(config.carcassId);
        const prevBtnEl = document.getElementById(config.prevBtnId);
        const nextBtnEl = document.getElementById(config.nextBtnId);

        // Если хотя бы один элемент не найден или имеет неверный тип — выходим
        // (например, соответствующая версия не отрендерилась)
        if (
            !(wrapperEl instanceof HTMLElement) ||
            !(carcassEl instanceof HTMLElement) ||
            !(prevBtnEl instanceof HTMLButtonElement) ||
            !(nextBtnEl instanceof HTMLButtonElement)
        ) {
            return;
        }

        // Явные типизированные константы — TS сохранит их типы внутри всех замыканий
        const wrapper: HTMLElement = wrapperEl;
        const carcass: HTMLElement = carcassEl;
        const prevBtn: HTMLButtonElement = prevBtnEl;
        const nextBtn: HTMLButtonElement = nextBtnEl;

        // articles ищем внутри конкретного wrapper, а не по всему документу
        const articles = wrapper.querySelectorAll<HTMLElement>('.S-ARTICLES-article');

        if (articles.length === 0) {
            return;
        }

        // === CALCULATE ARTICLE WIDTH (including gap) ===
        let articleWidth = 0;
        let gap = 0;
        const totalArticles = articles.length;
        let currentIndex = 0;

        // Сколько карточек видно одновременно (десктоп = 3, мобилка = 1)
        // Определяем по факту: если ширина карточки примерно равна ширине враппера — значит видна 1
        let visibleCount = 3;

        function detectVisibleCount() {
            if (articles.length === 0) return 3;
            const firstArticle = articles[0];
            const articleW = firstArticle.offsetWidth;
            const wrapperW = wrapper.clientWidth;
            // сколько таких карточек с учётом gap влезает в видимую область
            const gapVal = gap || 0;
            const count = Math.round((wrapperW + gapVal) / (articleW + gapVal));
            return Math.max(1, count);
        }

        function calculateDimensions() {
            if (articles.length === 0) return;

            const firstArticle = articles[0];
            const width = firstArticle.offsetWidth;

            const carcassStyle = window.getComputedStyle(carcass);
            gap = parseFloat(carcassStyle.gap) || parseFloat(carcassStyle.columnGap) || 0;

            articleWidth = width + gap;

            // Пересчитываем сколько карточек видно
            visibleCount = detectVisibleCount();
        }

        // === UPDATE BUTTON STATES ===
        function updateButtons() {
            if (currentIndex === 0) {
                prevBtn.disabled = true;
                prevBtn.style.opacity = '0.5';
                prevBtn.style.cursor = 'not-allowed';
            } else {
                prevBtn.disabled = false;
                prevBtn.style.opacity = '1';
                prevBtn.style.cursor = 'pointer';
            }

            const maxIndex = Math.max(0, totalArticles - visibleCount);
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
        function scrollToArticle(index: number, smooth = true) {
            const maxIndex = Math.max(0, totalArticles - visibleCount);
            if (index < 0) index = 0;
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
            const maxIndex = Math.max(0, totalArticles - visibleCount);
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

        wrapper.addEventListener('mousedown', function(e: MouseEvent) {
            isDragging = true;
            hasMoved = false;
            startX = e.pageX - wrapper.offsetLeft;
            scrollLeft = wrapper.scrollLeft;
            wrapper.style.cursor = 'grabbing';
            wrapper.style.userSelect = 'none';
        });

        document.addEventListener('mousemove', function(e: MouseEvent) {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - wrapper.offsetLeft;
            const walk = (x - startX) * 1.5;
            wrapper.scrollLeft = scrollLeft - walk;
            if (Math.abs(walk) > 3) hasMoved = true;
        });

        document.addEventListener('mouseup', function() {
            if (isDragging) {
                isDragging = false;
                wrapper.style.cursor = 'grab';
                wrapper.style.userSelect = '';

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
            const maxIndex = Math.max(0, totalArticles - visibleCount);
            const snapIndex = Math.min(nearestIndex, maxIndex);
            scrollToArticle(snapIndex, true);
        }

        // === TOUCH SUPPORT ===
        let touchStartX = 0;
        let touchScrollLeft = 0;
        let isTouching = false;

        wrapper.addEventListener('touchstart', function(e: TouchEvent) {
            isTouching = true;
            touchStartX = e.touches[0].pageX - wrapper.offsetLeft;
            touchScrollLeft = wrapper.scrollLeft;
        }, { passive: true });

        wrapper.addEventListener('touchmove', function(e: TouchEvent) {
            if (!isTouching) return;
            const x = e.touches[0].pageX - wrapper.offsetLeft;
            const walk = (x - touchStartX) * 1.5;
            wrapper.scrollLeft = touchScrollLeft - walk;
        }, { passive: true });

        wrapper.addEventListener('touchend', function() {
            if (isTouching) {
                isTouching = false;
                snapToNearestArticle();
            }
        });

        // === RE-CALCULATE ON RESIZE ===
        let resizeTimeout: number | undefined;
        window.addEventListener('resize', function() {
            if (resizeTimeout) clearTimeout(resizeTimeout);
            resizeTimeout = window.setTimeout(function() {
                calculateDimensions();
                scrollToArticle(currentIndex, false);
            }, 250);
        });

        // === INITIAL SETUP ===
        function init() {
            calculateDimensions();
            wrapper.scrollLeft = 0;
            currentIndex = 0;
            updateButtons();
            wrapper.style.cursor = 'grab';
        }

        setTimeout(init, 50);

        // === ATTACH EVENT LISTENERS ===
        prevBtn.addEventListener('click', goPrev);
        nextBtn.addEventListener('click', goNext);

        // === KEYBOARD SUPPORT ===
        document.addEventListener('keydown', function(e: KeyboardEvent) {
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
    }

// ============================================
// ИНИЦИАЛИЗАЦИЯ ДЛЯ ОБОИХ ФИДОВ
// ============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop фид
        createNewsFeed({
            wrapperId: 'LANDING-NEWS-ARTICLES-WRAPPER',
            carcassId: 'LANDING-NEWS-ARTICLES-CARCASS',
            prevBtnId: 'LANDING-NEWS-PREVIOUS_BUTTON',
            nextBtnId: 'LANDING-NEWS-PREVIOUS_NEXT',
        });

        // Mobile фид
        createNewsFeed({
            wrapperId: 'LANDING-MOBILE-NEWS-ARTICLES-WRAPPER',
            carcassId: 'LANDING-MOBILE-NEWS-ARTICLES-CARCASS',
            prevBtnId: 'LANDING-MOBILE-NEWS-PREVIOUS_BUTTON',
            nextBtnId: 'LANDING-MOBILE-NEWS-PREVIOUS_NEXT',
        });
    });

}

initLandingNewsFeed();
