/**
 * Industry Page Interactions
 * Handles: Challenges accordion, Engagement accordion, Testimonials slider
 *
 * @package Chimera
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ================================================
       1. Challenges Accordion
       ================================================ */
    const challengeItems = document.querySelectorAll('.ind-challenge-item');

    if (challengeItems.length) {
        challengeItems.forEach(item => {
            const toggle = item.querySelector('.ind-challenge-toggle');

            toggle.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all items
                challengeItems.forEach(other => {
                    other.classList.remove('active');
                    other.classList.remove('bg-orangeLightest', 'rounded-[10px]');

                    const otherContent = other.querySelector('.ind-challenge-content');
                    const otherTitle = other.querySelector('h5');
                    const otherToggle = other.querySelector('.ind-challenge-toggle');

                    if (otherContent) {
                        otherContent.style.maxHeight = '0px';
                        otherContent.classList.add('opacity-0');
                        otherContent.classList.remove('opacity-100');
                    }
                    if (otherTitle) {
                        otherTitle.classList.remove('text-orange');
                        otherTitle.classList.add('text-dark');
                    }
                    if (otherToggle) {
                        otherToggle.setAttribute('aria-expanded', 'false');
                    }
                });

                // If it wasn't active, open it
                if (!isActive) {
                    item.classList.add('active');
                    item.classList.add('bg-orangeLightest', 'rounded-[10px]');
                    item.classList.remove('border-b', 'border-[rgba(102,102,102,0.15)]');

                    const content = item.querySelector('.ind-challenge-content');
                    const title = item.querySelector('h5');

                    if (content) {
                        content.style.maxHeight = content.scrollHeight + 50 + 'px'; // +50 for safety padding
                        content.classList.remove('opacity-0');
                        content.classList.add('opacity-100');
                    }
                    if (title) {
                        title.classList.add('text-orange');
                        title.classList.remove('text-dark');
                    }
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                    
                    // Update the main image for this item
                    const newImageUrl = item.dataset.image;
                    const mainImg = document.getElementById('ind-challenge-main-img');
                    
                    if (mainImg) {
                        if (newImageUrl && mainImg.src !== newImageUrl) {
                            mainImg.classList.add('opacity-0');
                            setTimeout(() => {
                                mainImg.src = newImageUrl;
                                mainImg.classList.remove('hidden');
                                // slight delay to ensure browser paints before fading in
                                setTimeout(() => {
                                    mainImg.classList.remove('opacity-0');
                                }, 20);
                            }, 150);
                        } else if (!newImageUrl) {
                            mainImg.classList.add('opacity-0');
                            setTimeout(() => {
                                mainImg.src = '';
                                mainImg.classList.add('hidden');
                            }, 150);
                        }
                    }
                }
            });
        });

        // Initialize first item's max-height
        const firstContent = challengeItems[0]?.querySelector('.ind-challenge-content');
        if (firstContent) {
            firstContent.style.maxHeight = firstContent.scrollHeight + 'px';
        }
    }


    /* ================================================
       3. Testimonials Slider
       ================================================ */
    const indTrack = document.getElementById('ind-testimonials-track');
    const indCards = document.querySelectorAll('.ind-testimonial-card');
    const indPrevBtn = document.getElementById('ind-testimonial-prev');
    const indNextBtn = document.getElementById('ind-testimonial-next');

    if (indTrack && indCards.length && indPrevBtn && indNextBtn) {
        let indCurrentIndex = 0;
        const indGap = 24; // gap-6

        function updateIndSlider() {
            const containerWidth = indTrack.parentElement.offsetWidth;
            const cardWidth = indCards[0].offsetWidth;

            // Center the active card
            const offset = (containerWidth / 2) - (cardWidth / 2) - (indCurrentIndex * (cardWidth + indGap));
            indTrack.style.transform = `translateX(${offset}px)`;

            // Style cards
            indCards.forEach((card, idx) => {
                const quote = card.querySelector('.ind-testimonial-quote');
                const desc = card.querySelector('.ind-testimonial-desc');
                const author = card.querySelector('.ind-testimonial-author');
                const role = card.querySelector('.ind-testimonial-role');

                if (idx === indCurrentIndex) {
                    card.style.background = '';
                    card.classList.remove('bg-[#F9F8F6]', 'opacity-40', 'border-lightGray/60');
                    card.classList.add('bg-[#DECDB9]', 'opacity-100', 'border-transparent');

                    if (quote) { quote.style.color = '#ffffff'; quote.style.opacity = '1'; }
                    if (desc) { desc.style.color = '#1B1B1B'; desc.style.opacity = '1'; }
                    if (author) author.style.color = '#1B1B1B';
                    if (role) role.style.color = '#4A4A4A';
                } else {
                    card.style.background = 'radial-gradient(56.52% 109.54% at 86.03% 96.3%, #E9D8C1 0%, #DBC5AD 100%)';
                    card.classList.remove('bg-[#DECDB9]', 'opacity-100', 'border-transparent');
                    card.classList.add('bg-[#F9F8F6]', 'opacity-40', 'border-lightGray/60');

                    if (quote) { quote.style.color = '#1B1B1B'; quote.style.opacity = '0.08'; }
                    if (desc) { desc.style.color = '#1B1B1B'; desc.style.opacity = '0.6'; }
                    if (author) author.style.color = '#1B1B1B';
                    if (role) role.style.color = '#666666';
                }
            });
        }

        // Auto-slide
        let indAutoTimer;
        const indAutoDelay = 5000;

        function startIndAutoSlide() {
            stopIndAutoSlide();
            indAutoTimer = setInterval(() => {
                indCurrentIndex = (indCurrentIndex < indCards.length - 1) ? indCurrentIndex + 1 : 0;
                updateIndSlider();
            }, indAutoDelay);
        }

        function stopIndAutoSlide() {
            if (indAutoTimer) clearInterval(indAutoTimer);
        }

        // Button events
        indPrevBtn.addEventListener('click', () => {
            indCurrentIndex = (indCurrentIndex > 0) ? indCurrentIndex - 1 : indCards.length - 1;
            updateIndSlider();
            stopIndAutoSlide();
            startIndAutoSlide();
        });

        indNextBtn.addEventListener('click', () => {
            indCurrentIndex = (indCurrentIndex < indCards.length - 1) ? indCurrentIndex + 1 : 0;
            updateIndSlider();
            stopIndAutoSlide();
            startIndAutoSlide();
        });

        // Card click
        indCards.forEach((card, idx) => {
            card.addEventListener('click', () => {
                if (indCurrentIndex !== idx) {
                    indCurrentIndex = idx;
                    updateIndSlider();
                }
                stopIndAutoSlide();
                startIndAutoSlide();
            });
        });

        // Pause on hover
        indTrack.addEventListener('mouseenter', stopIndAutoSlide);
        indTrack.addEventListener('mouseleave', startIndAutoSlide);

        // Touch swipe
        let indStartX = 0;
        let indIsDragging = false;

        indTrack.addEventListener('touchstart', (e) => {
            stopIndAutoSlide();
            indStartX = e.touches[0].clientX;
            indIsDragging = true;
        }, { passive: true });

        indTrack.addEventListener('touchend', (e) => {
            if (!indIsDragging) return;
            indIsDragging = false;
            const endX = e.changedTouches[0].clientX;
            const diff = endX - indStartX;

            if (diff > 55) {
                indCurrentIndex = (indCurrentIndex > 0) ? indCurrentIndex - 1 : indCards.length - 1;
                updateIndSlider();
            } else if (diff < -55) {
                indCurrentIndex = (indCurrentIndex < indCards.length - 1) ? indCurrentIndex + 1 : 0;
                updateIndSlider();
            }
            startIndAutoSlide();
        }, { passive: true });

        // Init
        updateIndSlider();
        startIndAutoSlide();
        window.addEventListener('resize', updateIndSlider);
    }

});
