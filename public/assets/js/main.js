if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 1000,
        once: true,
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const productList = document.getElementById("productList");
    const scrollRightBtn = document.getElementById("scrollRightBtn");
    const scrollLeftBtn = document.getElementById("scrollLeftBtn");

    // 🟩 Fix: Run only if productList exists
    if (!productList) return;

    const cards = productList.querySelectorAll(".product-card-col");
    const totalCards = cards.length;

    let currentIndex = 0;
    let autoSlideInterval = null;
    let manualScrollTimeout = null;
    let autoResumeTimeout = null;

    function getCardWidth() {
        if (cards.length === 0) return 320;
        const style = window.getComputedStyle(cards[0]);
        const width = cards[0].offsetWidth;
        const marginLeft = parseFloat(style.marginLeft);
        const marginRight = parseFloat(style.marginRight);
        return width + marginLeft + marginRight;
    }

    function scrollToIndex(index) {
        const cardWidth = getCardWidth();
        const position = index * cardWidth;

        if (index >= totalCards) {
            productList.scrollLeft = 0;
            currentIndex = 0;
            return;
        }

        productList.scrollTo({
            left: position,
            behavior: 'smooth',
        });
    }

    function slideNext() {
        currentIndex++;
        if (currentIndex >= totalCards) {
            currentIndex = 0;
        }
        scrollToIndex(currentIndex);
    }

    function slidePrev() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalCards - 1;
        }
        scrollToIndex(currentIndex);
    }

    function canUseArrows() {
        return window.innerWidth >= 992;
    }

    // 🟩 Fix: Add checks before attaching listeners
    if (scrollRightBtn && scrollLeftBtn) {
        scrollRightBtn.addEventListener("click", () => {
            if (canUseArrows()) slideNext();
        });
        scrollLeftBtn.addEventListener("click", () => {
            if (canUseArrows()) slidePrev();
        });
    }

    function startAutoSlideMobile() {
        stopAutoSlideMobile();
        if (window.innerWidth < 992) {
            autoSlideInterval = setInterval(slideNext, 1500);
        }
    }

    function stopAutoSlideMobile() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }
    }

    function handleResize() {
        if (window.innerWidth < 992) {
            if (scrollRightBtn) scrollRightBtn.style.display = "none";
            if (scrollLeftBtn) scrollLeftBtn.style.display = "none";
            startAutoSlideMobile();
        } else {
            if (scrollRightBtn) scrollRightBtn.style.display = "";
            if (scrollLeftBtn) scrollLeftBtn.style.display = "";
            stopAutoSlideMobile();
        }
    }

    window.addEventListener("resize", handleResize);
    handleResize();

    // Manual scroll - pause auto slide, then resume after delay
    productList.addEventListener("scroll", () => {
        const cardWidth = getCardWidth();
        currentIndex = Math.round(productList.scrollLeft / cardWidth);

        stopAutoSlideMobile();

        if (manualScrollTimeout) clearTimeout(manualScrollTimeout);
        if (autoResumeTimeout) clearTimeout(autoResumeTimeout);

        manualScrollTimeout = setTimeout(() => {
            autoResumeTimeout = setTimeout(() => {
                if (window.innerWidth < 992) {
                    startAutoSlideMobile();
                }
            }, 10000);
        }, 10000);
    });

    productList.addEventListener("touchstart", () => {
        stopAutoSlideMobile();
        if (manualScrollTimeout) clearTimeout(manualScrollTimeout);
        if (autoResumeTimeout) clearTimeout(autoResumeTimeout);
    });

    productList.addEventListener("touchend", () => {
        productList.dispatchEvent(new Event('scroll'));
    });
});
