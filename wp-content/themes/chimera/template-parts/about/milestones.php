<?php
/**
 * Template part for displaying the Milestones section
 *
 * @package Chimera
 */

$milestones_content = get_field('about_milestones') ?: [];
$badge_text = $milestones_content['badge_text'] ?? '';
$heading = $milestones_content['heading'] ?? '';
$heading_highlight = $milestones_content['heading_highlight'] ?? '';
$description = $milestones_content['description'] ?? '';
$items = $milestones_content['items'] ?? [];
?>

<section class="w-full relative overflow-hidden bg-offwhite">
    <div class="container">

        <div class="flex flex-col gap-[10px] w-full">

            <!-- Header Area -->
            <div class="flex flex-col items-center mx-auto text-center max-w-3xl">

                <?php if ($badge_text): ?>
                    <div
                        class="inline-flex items-center justify-center bg-white border border-[rgba(255,74,3,0.2)] h-8 min-w-[32px] px-3 py-0 rounded-[8px] mb-5">
                        <span class="text-[12px] font-semibold text-orange uppercase font-jost leading-[18px]">
                            <?php echo esc_html($badge_text); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($heading || $heading_highlight): ?>
                    <h2
                        class="text-dark tracking-[-0.12px] text-[36px] md:text-[44px] mb-4 font-jost font-semibold leading-[1.1]">
                        <?php echo esc_html($heading); ?>
                        <span class="text-orange"><?php echo esc_html($heading_highlight); ?></span>
                    </h2>
                <?php endif; ?>

                <?php if ($description): ?>
                    <div class="font-sans font-normal text-gray text-[16px] leading-[1.5]">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Timeline Area -->
            <?php if (!empty($items) && is_array($items)): ?>

                <style>
                    /* Hide scrollbar for Chrome, Safari and Opera */
                    #milestones-slider::-webkit-scrollbar {
                        display: none;
                    }

                    /* Hide scrollbar for IE, Edge and Firefox */
                    #milestones-slider {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                        cursor: grab;
                    }

                    #milestones-slider:active {
                        cursor: grabbing;
                    }

                    .milestone-item.active-milestone .milestone-dot {
                        filter: drop-shadow(0 0 4px rgba(255,74,3,0.3));
                    }
                    .milestone-item.active-milestone .milestone-polygon {
                        fill: currentColor;
                    }
                    .milestone-item:not(.active-milestone) .milestone-polygon {
                        fill: white;
                    }
                </style>

                <div class="relative w-full">
                    <!-- Fixed continuous timeline line -->
                    <div class="absolute top-1/2 left-4 right-4 md:left-8 md:right-8 h-[2px] bg-orange -translate-y-1/2 z-0 pointer-events-none"></div>

                    <?php
                    $original_count = count($items);
                    // To maintain the alternating Top/Bottom layout, the jump distance must be an EVEN number of items.
                    $jump_count = ($original_count % 2 !== 0) ? $original_count * 2 : $original_count;
                    // Create enough copies for seamless looping
                    $slider_items = array_merge($items, $items, $items, $items);
                    ?>

                    <div id="milestones-slider" data-jump-count="<?php echo $jump_count; ?>"
                        class="overflow-x-auto w-full select-none scrollbar-hide relative z-10" style="scroll-behavior: auto;">

                        <div class="flex w-max relative gap-2 px-4 md:px-8">

                            <?php foreach ($slider_items as $index => $item):
                                $title = $item['title'] ?? '';
                                $year = $item['year'] ?? '';
                                $item_desc = $item['description'] ?? $item['text'] ?? $item['content'] ?? '';
                                $is_even = ($index % 2 === 0);
                                ?>
                                <!-- Item Column -->
                                <div class="flex-none w-[260px] sm:w-[260px] md:w-[220px] lg:w-[200px] xl:w-[220px] shrink-0 relative z-10 milestone-item">

                                    <div class="grid grid-rows-[1fr_auto_1fr] h-full min-h-[300px] w-full py-4">

                                        <!-- Top Card Area -->
                                        <div class="relative w-full flex items-end justify-center pb-[30px]">
                                            <?php if ($is_even): ?>
                                                <!-- Vertical line connecting dot to card -->
                                                <div
                                                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-[30px] bg-orange/40">
                                                </div>

                                                <!-- Card -->
                                                <div class="w-full bg-white border border-[#ebebeb] rounded-[12px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-md transition-all duration-300 relative z-20 milestone-card">
                                                    <div class="flex items-center gap-2 mb-2 pointer-events-none">
                                                        <span
                                                            class="text-orange font-bold text-[22px] leading-none"><?php echo esc_html($year); ?></span>
                                                    </div>
                                                    <h4
                                                        class="text-dark font-bold text-[16px] mb-2 leading-tight pointer-events-none">
                                                        <?php echo esc_html($title); ?></h4>
                                                    <?php if ($item_desc): ?>
                                                        <p class="text-[#666] text-[13px] leading-[1.4] m-0 pointer-events-none">
                                                            <?php echo esc_html($item_desc); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Middle Line Dot -->
                                        <div class="relative flex items-center justify-center h-[2px] z-50 text-orange">
                                            <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[20px] h-[20px] pointer-events-none transition-all duration-300 milestone-dot" viewBox="0 0 24 24">
                                                <polygon points="12,2 20.7,7 20.7,17 12,22 3.3,17 3.3,7" class="transition-all duration-300 milestone-polygon" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                                            </svg>
                                        </div>

                                        <!-- Bottom Card Area -->
                                        <div class="relative w-full flex items-start justify-center pt-[30px]">
                                            <?php if (!$is_even): ?>
                                                <!-- Vertical line connecting dot to card -->
                                                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[2px] h-[30px] bg-orange/40">
                                                </div>

                                                <!-- Card -->
                                                <div class="w-full bg-white border border-[#ebebeb] rounded-[12px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-md transition-all duration-300 relative z-20 milestone-card">
                                                    <div class="flex items-center gap-2 mb-2 pointer-events-none">
                                                        <span
                                                            class="text-orange font-bold text-[22px] leading-none"><?php echo esc_html($year); ?></span>
                                                    </div>
                                                    <h4
                                                        class="text-dark font-bold text-[16px] mb-2 leading-tight pointer-events-none">
                                                        <?php echo esc_html($title); ?></h4>
                                                    <?php if ($item_desc): ?>
                                                        <p class="text-[#666] text-[13px] leading-[1.4] m-0 pointer-events-none">
                                                            <?php echo esc_html($item_desc); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <!-- Auto-play & Drag JS -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const slider = document.getElementById('milestones-slider');
                        if (!slider) return;

                        const innerWrapper = slider.querySelector('.flex.w-max');
                        if (!innerWrapper) return;

                        let isDown = false;
                        let startX;
                        let scrollLeft;
                        let animationId;
                        let autoPlaySpeed = 1; // Pixels per frame (adjust for marquee speed)
                        let isHovered = false;

                        const firstItem = innerWrapper.children[0];
                        
                        const updateActiveState = () => {
                            const sliderRect = slider.getBoundingClientRect();
                            
                            // Determine padding (px-4 or md:px-8)
                            const padding = window.innerWidth >= 768 ? 32 : 16;
                            
                            const items = innerWrapper.querySelectorAll('.milestone-item');
                            const cardWidth = items.length > 0 ? items[0].getBoundingClientRect().width : 260;
                            
                            // Evaluate active state at the center of where the first card naturally sits on the left
                            const evaluationPoint = sliderRect.left + padding + (cardWidth / 2);
                            
                            let closestItem = null;
                            let minDistance = Infinity;
                            
                            items.forEach(item => {
                                const itemRect = item.getBoundingClientRect();
                                // Skip if completely out of viewport
                                if (itemRect.right < sliderRect.left || itemRect.left > sliderRect.right) {
                                    item.classList.remove('active-milestone');
                                    return;
                                }
                                
                                const itemCenter = itemRect.left + itemRect.width / 2;
                                const distance = Math.abs(evaluationPoint - itemCenter);
                                
                                if (distance < minDistance) {
                                    minDistance = distance;
                                    closestItem = item;
                                }
                                item.classList.remove('active-milestone');
                            });
                            
                            if (closestItem) {
                                closestItem.classList.add('active-milestone');
                            }
                        };

                        const loopScroll = () => {
                            if (!isDown && !isHovered) {
                                slider.scrollLeft += autoPlaySpeed;
                            }
                            
                            // Seamless wrap logic
                            const jumpCount = parseInt(slider.getAttribute('data-jump-count'), 10);
                            const targetItem = innerWrapper.children[jumpCount];
                            
                            if (firstItem && targetItem) {
                                const shiftDistance = targetItem.offsetLeft - firstItem.offsetLeft;
                                if (slider.scrollLeft >= shiftDistance) {
                                    slider.scrollLeft -= shiftDistance;
                                } else if (slider.scrollLeft <= 0 && isDown) {
                                    // Reverse wrap if manual scrolling backwards
                                    slider.scrollLeft += shiftDistance;
                                }
                            }
                            
                            updateActiveState();
                            animationId = requestAnimationFrame(loopScroll);
                        };

                        // Start continuous loop
                        animationId = requestAnimationFrame(loopScroll);

                        // Drag events
                        slider.addEventListener('mouseenter', () => {
                            isHovered = true;
                        });
                        
                        slider.addEventListener('mouseleave', () => {
                            isHovered = false;
                            isDown = false;
                        });

                        slider.addEventListener('mousedown', (e) => {
                            isDown = true;
                            startX = e.pageX - slider.offsetLeft;
                            scrollLeft = slider.scrollLeft;
                        });

                        slider.addEventListener('mouseup', () => {
                            isDown = false;
                        });

                        slider.addEventListener('mousemove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.pageX - slider.offsetLeft;
                            const walk = (x - startX) * 1.5; // Drag speed multiplier
                            
                            let targetScroll = scrollLeft - walk;
                            
                            // Handle loop jumping during drag smoothly
                            const jumpCount = parseInt(slider.getAttribute('data-jump-count'), 10);
                            const targetItem = innerWrapper.children[jumpCount];
                            if (firstItem && targetItem) {
                                const shiftDistance = targetItem.offsetLeft - firstItem.offsetLeft;
                                if (targetScroll >= shiftDistance) {
                                    targetScroll -= shiftDistance;
                                    scrollLeft -= shiftDistance; // prevent drag glitching
                                } else if (targetScroll <= 0) {
                                    targetScroll += shiftDistance;
                                    scrollLeft += shiftDistance; // prevent drag glitching
                                }
                            }
                            
                            slider.scrollLeft = targetScroll;
                        });
                        
                        // Initial state
                        updateActiveState();
                    });
                </script>
            <?php endif; ?>

        </div>
    </div>
</section>