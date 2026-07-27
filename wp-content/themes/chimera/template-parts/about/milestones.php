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

<section class="w-full relative pb-[50px] overflow-hidden bg-offwhite">
    <div class="container">

        <div class="flex flex-col gap-[10px] w-full">

            <!-- Header Area -->
            <div class="flex flex-col items-start max-w-[450px]">

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
                        <?php echo esc_html($heading); ?>     <?php if ($heading && $heading_highlight)
                                    echo "\n"; ?><br class="hidden lg:block"><span
                            class="text-orange"><?php echo esc_html($heading_highlight); ?></span>
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
                </style>

                <div class="relative w-full">

                    <?php
                    $original_count = count($items);
                    // To maintain the alternating Top/Bottom layout, the jump distance must be an EVEN number of items.
                    $jump_count = ($original_count % 2 !== 0) ? $original_count * 2 : $original_count;
                    // Create enough copies for seamless looping
                    $slider_items = array_merge($items, $items, $items, $items);
                    ?>

                    <div id="milestones-slider" data-jump-count="<?php echo $jump_count; ?>"
                        class="overflow-x-auto w-full select-none scrollbar-hide" style="scroll-behavior: auto;">

                        <div class="flex w-max relative gap-6 px-4 md:px-8">
                            <!-- Continuous horizontal line -->
                            <div class="absolute top-0 bottom-0 left-0 right-0 z-0 pointer-events-none">
                                <div class="absolute top-1/2 left-0 right-0 h-[2px] bg-orange -translate-y-1/2"></div>
                            </div>

                            <?php foreach ($slider_items as $index => $item):
                                $title = $item['title'] ?? '';
                                $year = $item['year'] ?? '';
                                $is_active = $item['is_active'] ?? false;
                                $item_desc = $item['description'] ?? $item['text'] ?? $item['content'] ?? '';
                                $is_even = ($index % 2 === 0);
                                ?>
                                <!-- Item Column -->
                                <div class="flex-none w-[260px] sm:w-[320px] shrink-0 relative z-10">

                                    <div class="grid grid-rows-[1fr_auto_1fr] h-[600px] md:h-[550px] w-full">

                                        <!-- Top Card Area -->
                                        <div class="relative w-full flex items-end justify-center pb-[30px]">
                                            <?php if ($is_even): ?>
                                                <!-- Vertical line connecting dot to card -->
                                                <div
                                                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-[30px] bg-orange/40">
                                                </div>

                                                <!-- Card -->
                                                <div class="w-full bg-white border border-[#ebebeb] rounded-[12px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow relative z-20 group cursor-pointer">
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
                                                    
                                                    <!-- Tooltip Popup -->
                                                    <div class="absolute bottom-[calc(100%+12px)] left-1/2 -translate-x-1/2 w-[220px] bg-white border border-[#ebebeb] rounded-[8px] p-4 shadow-[0_10px_30px_rgba(0,0,0,0.15)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[60] pointer-events-none translate-y-2 group-hover:translate-y-0">
                                                        <div class="absolute -bottom-[5px] left-1/2 -translate-x-1/2 w-[10px] h-[10px] bg-white border-b border-r border-[#ebebeb] rotate-45"></div>
                                                        <h4 class="text-dark font-bold text-[14px] mb-1 leading-tight"><?php echo esc_html($title); ?></h4>
                                                        <?php if ($item_desc): ?>
                                                            <p class="text-[#666] text-[12px] leading-[1.4] m-0"><?php echo esc_html($item_desc); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Middle Line Dot -->
                                        <div class="relative flex items-center justify-center h-[2px] z-50 text-orange">
                                            <?php if ($is_active): ?>
                                                <!-- Active: Medium hexagon with outer glow & solid fill -->
                                                <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[20px] h-[20px] drop-shadow-[0_0_4px_rgba(255,74,3,0.3)] pointer-events-none" viewBox="0 0 24 24">
                                                    <polygon points="12,2 20.7,7 20.7,17 12,22 3.3,17 3.3,7" fill="currentColor" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                                                </svg>
                                            <?php else: ?>
                                                <!-- Inactive: Medium hexagon with white fill -->
                                                <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[20px] h-[20px] pointer-events-none" viewBox="0 0 24 24">
                                                    <polygon points="12,2 20.7,7 20.7,17 12,22 3.3,17 3.3,7" fill="white" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                                                </svg>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Bottom Card Area -->
                                        <div class="relative w-full flex items-start justify-center pt-[30px]">
                                            <?php if (!$is_even): ?>
                                                <!-- Vertical line connecting dot to card -->
                                                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[2px] h-[30px] bg-orange/40">
                                                </div>

                                                <!-- Card -->
                                                <div class="w-full bg-white border border-[#ebebeb] rounded-[12px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-md transition-shadow relative z-20 group cursor-pointer">
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
                                                    
                                                    <!-- Tooltip Popup -->
                                                    <div class="absolute top-[calc(100%+12px)] left-1/2 -translate-x-1/2 w-[220px] bg-white border border-[#ebebeb] rounded-[8px] p-4 shadow-[0_10px_30px_rgba(0,0,0,0.15)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[60] pointer-events-none -translate-y-2 group-hover:translate-y-0">
                                                        <div class="absolute -top-[5px] left-1/2 -translate-x-1/2 w-[10px] h-[10px] bg-white border-t border-l border-[#ebebeb] rotate-45"></div>
                                                        <h4 class="text-dark font-bold text-[14px] mb-1 leading-tight"><?php echo esc_html($title); ?></h4>
                                                        <?php if ($item_desc): ?>
                                                            <p class="text-[#666] text-[12px] leading-[1.4] m-0"><?php echo esc_html($item_desc); ?></p>
                                                        <?php endif; ?>
                                                    </div>
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
                        let autoPlayInterval;

                        const startAutoPlay = () => {
                            autoPlayInterval = setInterval(() => {
                                // Find the distance to scroll by measuring the gap between first two items
                                // item 0 is the line, so items are at index 1 and 2
                                const firstItem = innerWrapper.children[1];
                                const secondItem = innerWrapper.children[2];

                                if (!firstItem || !secondItem) return;

                                const scrollDistance = secondItem.offsetLeft - firstItem.offsetLeft;

                                // Scroll right using native smooth behavior
                                slider.scrollBy({ left: scrollDistance, behavior: 'smooth' });

                                // Seamless infinite loop logic
                                setTimeout(() => {
                                    const jumpCount = parseInt(slider.getAttribute('data-jump-count'), 10);
                                    if (!jumpCount || innerWrapper.children.length <= jumpCount) return;

                                    const targetItem = innerWrapper.children[1 + jumpCount];
                                    if (!targetItem) return;

                                    const shiftDistance = targetItem.offsetLeft - firstItem.offsetLeft;

                                    // If we have scrolled past the jump threshold, silently jump back
                                    if (slider.scrollLeft >= shiftDistance - 10) {
                                        slider.scrollLeft = slider.scrollLeft - shiftDistance;
                                    }
                                }, 800); // Wait for smooth scroll animation to finish

                            }, 2000); // 3 seconds interval
                        };

                        startAutoPlay();

                        slider.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
                        slider.addEventListener('mouseleave', () => {
                            if (!isDown) startAutoPlay();
                        });

                        slider.addEventListener('mousedown', (e) => {
                            isDown = true;
                            startX = e.pageX - slider.offsetLeft;
                            scrollLeft = slider.scrollLeft;
                            clearInterval(autoPlayInterval);
                        });

                        slider.addEventListener('mouseleave', () => {
                            isDown = false;
                        });

                        slider.addEventListener('mouseup', () => {
                            isDown = false;
                            startAutoPlay();
                        });

                        slider.addEventListener('mousemove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.pageX - slider.offsetLeft;
                            const walk = (x - startX) * 1; // 1:1 Natural drag speed
                            slider.scrollLeft = scrollLeft - walk;
                        });
                    });
                </script>
            <?php endif; ?>

        </div>
    </div>
</section>