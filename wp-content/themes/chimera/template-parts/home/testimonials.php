<?php
/**
 * Template part for displaying the Testimonials section with smooth sliding interaction
 *
 * @package Chimera
 */

$testimonials = $args['testimonials'] ?? [
    [
        'quote' => 'Their unconventional way of thinking has helped Orange solve several practical issues in the most efficient ways.',
        'author' => 'Tom Clarke,',
        'role' => 'Head of Connectivity Management Solutions, Orange Business Service',
    ],
    [
        'quote' => 'Both the leadership team and the engineering team exhibited a proactive mindset and willingness to deliver the desired outcome. This was a huge factor in getting the MVP to the finish line. This leadership style helped us gain trust with Chimera relatively fast. The engineering team was also hard-working and had the required technical competencies. They were very agile and able to improvise when needed.',
        'author' => '',
        'role' => 'CPO, LendEast',
    ],
    [
        'quote' => 'The professional relationship with Chimera has been beyond our expectations. I would like to  congratulate you on your levels of customer service, as your support team are always quick to respond, and expertise.',
        'author' => 'Reinaldo. A. Carvalho,',
        'role' => 'CTO , Phoenix Kiosk',
    ]
];

$badge = $args['badge'] ?? 'Enterprise AI. Proven Partnerships.';
$heading = $args['heading'] ?? 'Trusted Long <br class="sm:hidden"><span class="text-orange">After the First Project</span>';
?>

<section class="w-full bg-white py-[50px] relative overflow-hidden">
    <div class="container text-center flex flex-col items-center mb-10 md:mb-[60px]">
        <?php if ( $badge ) : ?>
        <!-- Real Outcomes Badge -->
        <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
            <?php echo wp_kses_post( $badge ); ?>
        </div>
        <?php endif; ?>

        <?php if ( $heading ) : ?>
        <!-- Heading -->
        <h2 class="text-dark text-center leading-[1.2] md:leading-tight">
            <?php echo wp_kses_post( $heading ); ?>
        </h2>
        <?php endif; ?>
    </div>

    <!-- Testimonials Slider Container -->
    <div class="w-full overflow-hidden relative">
        <div id="testimonials-track" class="flex transition-transform duration-500 ease-out gap-6 items-stretch w-max mx-auto" style="transform: translateX(0px);">
            
            <?php foreach ($testimonials as $index => $testimonial) : ?>
            <!-- Testimonial Card -->
            <div class="testimonial-card relative flex-shrink-0 w-[calc(100vw-40px)] lg:w-[800px] rounded-[10px] p-6 md:p-12 transition duration-500 flex flex-col justify-between border border-lightGray/60 cursor-pointer" data-index="<?php echo $index; ?>">
                <div class="relative z-10">
                    <!-- Quote Mark Icon -->
                    <span class="testimonial-quote font-serif text-[100px] leading-none absolute -top-4 -left-2 transition duration-500 select-none">“</span>
                    <!-- Testimonial Text -->
                    <p class="testimonial-desc font-jost text-sm md:text-[22px] leading-[1.6] font-medium text-dark transition duration-500 mt-10 max-w-full relative z-20">
                        <?php echo $testimonial['quote']; ?>
                    </p>
                </div>
                <!-- Author Info -->
                <div class="relative z-10 mt-[60px] max-w-full">
                    <h4 class="testimonial-author font-sans text-base sm:text-lg font-semibold text-dark transition-colors duration-500"><?php echo $testimonial['author']; ?></h4>
                    <p class="testimonial-role font-sans w-full text-xs text-gray font-normal transition-colors duration-500 mt-0 sm:mt-[10px]"><?php echo $testimonial['role']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex items-center justify-center gap-4 mt-10 md:mt-[60px]">
        <!-- Prev Button -->
        <button id="testimonial-prev" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center bg-white text-gray hover:bg-lightGray/10 active:scale-95 transition-all shadow-[0_2px_8px_rgba(0,0,0,0.03)] cursor-pointer outline-none focus:outline-none focus:ring-0 [-webkit-tap-highlight-color:transparent]" aria-label="Previous testimonial">
            <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </button>
        <!-- Next Button -->
        <button id="testimonial-next" class="w-12 h-12 rounded-full bg-orange flex items-center justify-center text-white hover:opacity-90 active:scale-95 transition-all shadow-[0_4px_12px_rgba(255,74,3,0.2)] cursor-pointer outline-none focus:outline-none focus:ring-0 [-webkit-tap-highlight-color:transparent]" aria-label="Next testimonial">
            <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('testimonials-track');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.getElementById('testimonial-prev');
    const nextBtn = document.getElementById('testimonial-next');
    
    let currentIndex = 1; // Default center
    const gap = 24; // gap-6 is 24px

    function updateSlider() {
        const containerWidth = track.parentElement.offsetWidth;
        const cardWidth = cards[0].offsetWidth;
        
        // Compute offset to perfectly center the active card
        const offset = (containerWidth / 2) - (cardWidth / 2) - (currentIndex * (cardWidth + gap));
        track.style.transform = `translateX(${offset}px)`;

        // Update cards styling
        cards.forEach((card, idx) => {
            const quote = card.querySelector('.testimonial-quote');
            const desc = card.querySelector('.testimonial-desc');
            const author = card.querySelector('.testimonial-author');
            const role = card.querySelector('.testimonial-role');

            if (idx === currentIndex) {
                // Active Card State (Warm Sand/Beige color)
                card.style.background = '';
                card.classList.remove('bg-[#F9F8F6]', 'opacity-40', 'border-lightGray/60');
                card.classList.add('bg-[#DECDB9]', 'opacity-100', 'border-transparent');
                
                quote.style.color = '#ffffff';
                quote.style.opacity = '1';
                desc.style.color = '#1B1B1B';
                desc.style.opacity = '1';
                author.style.color = '#1B1B1B';
                role.style.color = '#4A4A4A';
            } else {
                // Inactive Card State (Faded off-white)
                card.style.background = 'radial-gradient(56.52% 109.54% at 86.03% 96.3%, #E9D8C1 0%, #DBC5AD 100%)';
                card.classList.remove('bg-[#DECDB9]', 'opacity-100', 'border-transparent');
                card.classList.add('bg-[#F9F8F6]', 'opacity-40', 'border-lightGray/60');
                
                quote.style.color = '#1B1B1B';
                quote.style.opacity = '0.08';
                desc.style.color = '#1B1B1B';
                desc.style.opacity = '0.6';
                author.style.color = '#1B1B1B';
                role.style.color = '#666666';
            }
        });

        // Update Navigation Button States (Always enabled for infinite loop)
        prevBtn.style.opacity = '1';
        prevBtn.style.pointerEvents = 'auto';
        nextBtn.style.opacity = '1';
        nextBtn.style.pointerEvents = 'auto';
    }

    // Auto slide functionality
    let autoSlideTimer;
    const autoSlideDelay = 3000; // 5 seconds

    function startAutoSlide() {
        stopAutoSlide(); // Ensure no multiple timers
        autoSlideTimer = setInterval(() => {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0; // Loop back to the first slide
            }
            updateSlider();
        }, autoSlideDelay);
    }

    function stopAutoSlide() {
        if (autoSlideTimer) {
            clearInterval(autoSlideTimer);
        }
    }

    // Attach button actions
    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = cards.length - 1; // Loop to last
        }
        updateSlider();
        stopAutoSlide();
        startAutoSlide();
    });

    nextBtn.addEventListener('click', () => {
        if (currentIndex < cards.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop to first
        }
        updateSlider();
        stopAutoSlide();
        startAutoSlide();
    });

    // Make cards clickable to slide to them
    cards.forEach((card, idx) => {
        card.addEventListener('click', () => {
            if (currentIndex !== idx) {
                currentIndex = idx;
                updateSlider();
            }
            stopAutoSlide();
            startAutoSlide();
        });
    });

    // Pause on hover
    track.addEventListener('mouseenter', stopAutoSlide);
    track.addEventListener('mouseleave', startAutoSlide);
    prevBtn.addEventListener('mouseenter', stopAutoSlide);
    prevBtn.addEventListener('mouseleave', startAutoSlide);
    nextBtn.addEventListener('mouseenter', stopAutoSlide);
    nextBtn.addEventListener('mouseleave', startAutoSlide);

    // Touch support (swiping)
    let startX = 0;
    let isDragging = false;

    track.addEventListener('touchstart', (e) => {
        stopAutoSlide();
        startX = e.touches[0].clientX;
        isDragging = true;
    }, { passive: true });

    track.addEventListener('touchend', (e) => {
        if (!isDragging) return;
        isDragging = false;
        const endX = e.changedTouches[0].clientX;
        const diff = endX - startX;

        if (diff > 55) {
            // Swipe right -> prev card
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = cards.length - 1;
            }
            updateSlider();
        } else if (diff < -55) {
            // Swipe left -> next card
            if (currentIndex < cards.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateSlider();
        }
        startAutoSlide();
    }, { passive: true });

    // Initial positioning
    updateSlider();
    
    // Start auto slide initially
    startAutoSlide();
    
    // Recalculate positions on window resize
    window.addEventListener('resize', updateSlider);
});
</script>
