<?php
/**
 * Template part for displaying the Comparison section
 *
 * @package Chimera
 */

$comparison = get_field('services_comparison');

// Check if section exists and the toggle is set to true (Yes)
if (empty($comparison) || empty($comparison['show_section'])) {
    return;
}

$badge_text = $comparison['badge_text'] ?? 'The Strategy';
$title_line1 = $comparison['title_line1'] ?? 'Transform Isolated AI Agents';
$title_line2 = $comparison['title_line2'] ?? 'into Operational Ecosystems';
$description = $comparison['description'] ?? 'As operations grow, process dependencies, manual interventions, and disconnected systems create friction across the enterprise. We develop AI-led agentic workflows designed for coordinated execution at scale.';
$left_column_title = $comparison['left_column_title'] ?? 'Current State';
$right_column_title = $comparison['right_column_title'] ?? 'With Chimera';
$rows = $comparison['rows'] ?? [];

// Helper function to render image correctly whether it's an ID, Array, or URL from ACF
if (!function_exists('render_acf_image_url')) {
    function render_acf_image_url($image, $default_url = '') {
        if (!$image) return $default_url;
        if (is_array($image)) return $image['url'];
        if (is_numeric($image)) return wp_get_attachment_image_url($image, 'full');
        return $image;
    }
}
?>

<section class="bg-white w-full py-[50px] relative overflow-hidden" id="comparison-section">
    <div class="container mx-auto px-4 lg:px-8 max-w-[1200px]">
        <!-- Header Section -->
        <div class="flex flex-col items-center gap-[20px] text-center w-full mb-[60px] md:mb-[80px]">
            <?php if ($badge_text): ?>
            <div class="bg-white border border-[rgba(255,74,3,0.2)] flex items-center justify-center h-[32px] px-[12px] rounded-[8px]">
                <span class="font-jost font-semibold text-orange text-[12px] uppercase leading-[18px] tracking-[1.1px] m-0"><?php echo esc_html($badge_text); ?></span>
            </div>
            <?php endif; ?>

            <h2 class="font-jost font-semibold text-[32px] md:text-[44px] leading-[1.1] tracking-[-0.12px] m-0">
                <span class="text-[#1b1b1b] block"><?php echo wp_kses_post($title_line1); ?></span>
                <span class="text-orange block"><?php echo wp_kses_post($title_line2); ?></span>
            </h2>

            <?php if ($description): ?>
            <p class="font-sans font-normal text-[#666] text-[16px] leading-[1.5] max-w-[900px] m-0">
                <?php echo wp_kses_post($description); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Comparison Grid -->
        <div class="flex flex-col items-center w-full relative">
            <div class="flex flex-col gap-[12px] w-full max-w-[896px]">
                
                <!-- Table Headers (Responsive) -->
                <div class="grid grid-cols-[1fr_24px_1fr] md:grid-cols-[1fr_72px_1fr] gap-[8px] md:gap-[20px] px-[8px] md:px-[24px] pb-[8px] w-full">
                    <div class="flex items-center justify-center w-full">
                        <span class="font-jost font-semibold text-[#aaa] text-[9px] md:text-[11px] leading-[1.5] tracking-[1px] md:tracking-[1.65px] uppercase text-center"><?php echo esc_html($left_column_title); ?></span>
                    </div>
                    <div></div>
                    <div class="flex items-center justify-center w-full">
                        <span class="font-jost font-semibold text-orange text-[9px] md:text-[11px] leading-[1.5] tracking-[1px] md:tracking-[1.65px] uppercase text-center"><?php echo esc_html($right_column_title); ?></span>
                    </div>
                </div>

                <!-- Rows -->
                <div class="flex flex-col gap-[12px] md:gap-[20px] w-full comparison-rows-container">
                    <?php if (!empty($rows)): ?>
                        <?php foreach ($rows as $index => $row): ?>
                        
                        <div class="comparison-row flex flex-row gap-[8px] md:gap-[20px] items-stretch md:items-center w-full group">

                            <!-- Left Card (Current State) -->
                            <div class="comp-left bg-white border border-[#ebebeb] flex flex-col md:flex-row items-center px-[12px] py-[16px] md:px-[25px] md:py-[21px] rounded-[12px] md:rounded-[16px] w-[calc(50%-16px)] md:flex-1 shadow-sm opacity-0 translate-x-[-30px] transition-all duration-300 ease-out text-center md:text-left gap-[8px] md:gap-[16px]">
                                <div class="bg-[#fdf2f2] rounded-[10px] md:rounded-[14px] w-[32px] h-[32px] md:w-[40px] md:h-[40px] flex items-center justify-center flex-shrink-0">
                                    <?php if (!empty($row['current_state_icon'])): ?>
                                        <img src="<?php echo esc_url(render_acf_image_url($row['current_state_icon'])); ?>" class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] object-contain" alt="">
                                    <?php else: ?>
                                        <div class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] bg-[#fca5a5] rounded-full"></div>
                                    <?php endif; ?>
                                </div>
                                <p class="font-jost font-semibold text-[#1b1b1b] text-[12px] md:text-[14px] leading-[1.3] md:leading-[17.5px] m-0"><?php echo esc_html($row['current_state_text'] ?? ''); ?></p>
                            </div>

                            <!-- Center Arrow -->
                            <div class="comp-arrow bg-[#fff5f0] border border-[rgba(255,74,3,0.2)] flex items-center justify-center rounded-full w-[24px] h-[24px] md:w-[72px] md:h-[32px] flex-shrink-0 opacity-0 scale-50 transition-all duration-200 ease-out self-center">
                                <?php if (!empty($row['center_icon'])): ?>
                                    <img src="<?php echo esc_url(render_acf_image_url($row['center_icon'])); ?>" class="w-[12px] h-[6px] md:w-[28px] md:h-[10px] object-contain" alt="">
                                <?php else: ?>
                                    <svg class="w-[10px] h-[10px] md:w-[14px] md:h-[14px]" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5H9M9 5L5 1M9 5L5 9" stroke="#FF4A03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                <?php endif; ?>
                            </div>

                            <!-- Right Card (With Chimera) -->
                            <div class="comp-right bg-[#fff5f0] border border-[#ebebeb] flex flex-col md:flex-row items-center px-[12px] py-[16px] md:px-[25px] md:py-[21px] rounded-[12px] md:rounded-[16px] w-[calc(50%-16px)] md:flex-1 shadow-sm opacity-0 translate-x-[30px] transition-all duration-300 ease-out hover:shadow-[0_10px_30px_-5px_rgba(255,74,3,0.1)] text-center md:text-left gap-[8px] md:gap-[16px]">
                                <div class="bg-[#fff5f0] rounded-[10px] md:rounded-[14px] w-[32px] h-[32px] md:w-[40px] md:h-[40px] flex items-center justify-center flex-shrink-0 border border-orange transition-colors group-hover:text-orange">
                                    <?php if (!empty($row['with_chimera_icon'])): ?>
                                        <img src="<?php echo esc_url(render_acf_image_url($row['with_chimera_icon'])); ?>" class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] object-contain transition-all" alt="">
                                    <?php else: ?>
                                        <div class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] bg-orange rounded-full group-hover:bg-white transition-all"></div>
                                    <?php endif; ?>
                                </div>
                                <p class="font-jost font-semibold text-[#1b1b1b] text-[12px] md:text-[14px] leading-[1.3] md:leading-[17.5px] m-0"><?php echo esc_html($row['with_chimera_text'] ?? ''); ?></p>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Waterfall Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const section = document.getElementById('comparison-section');
    if (!section) return;

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px', // Trigger slightly after it enters the viewport
        threshold: 0.1
    };

    let animationTimeouts = [];

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const rows = section.querySelectorAll('.comparison-row');
            
            if (entry.isIntersecting) {
                // Section is in view! Trigger the whole animation sequence for all rows.
                rows.forEach((row, index) => {
                    const leftCard = row.querySelector('.comp-left');
                    const arrow = row.querySelector('.comp-arrow');
                    const rightCard = row.querySelector('.comp-right');
                    
                    // Base delay ensures rows play exactly one by one (600ms per row)
                    const baseDelay = index * 600;
                    
                    // Step 1: Left card animates in
                    animationTimeouts.push(setTimeout(() => {
                        if (leftCard) {
                            leftCard.classList.remove('opacity-0', 'translate-x-[-30px]');
                            leftCard.classList.add('opacity-100', 'translate-x-0');
                        }
                    }, baseDelay));
                    
                    // Step 2: Arrow animates in 150ms later
                    animationTimeouts.push(setTimeout(() => {
                        if (arrow) {
                            arrow.classList.remove('opacity-0', 'scale-50');
                            arrow.classList.add('opacity-100', 'scale-100');
                        }
                    }, baseDelay + 150));
                    
                    // Step 3: Right card animates in 150ms after arrow
                    animationTimeouts.push(setTimeout(() => {
                        if (rightCard) {
                            rightCard.classList.remove('opacity-0', 'translate-x-[30px]');
                            rightCard.classList.add('opacity-100', 'translate-x-0');
                        }
                    }, baseDelay + 300));
                });
            } else {
                // Section left viewport! Reset animations so it can replay when they scroll back.
                
                // Clear any pending timeouts so it doesn't keep animating while offscreen
                animationTimeouts.forEach(t => clearTimeout(t));
                animationTimeouts = [];
                
                // Instantly reset classes to hidden state
                rows.forEach(row => {
                    const leftCard = row.querySelector('.comp-left');
                    const arrow = row.querySelector('.comp-arrow');
                    const rightCard = row.querySelector('.comp-right');
                    
                    if (leftCard) {
                        leftCard.classList.add('opacity-0', 'translate-x-[-30px]');
                        leftCard.classList.remove('opacity-100', 'translate-x-0');
                    }
                    if (arrow) {
                        arrow.classList.add('opacity-0', 'scale-50');
                        arrow.classList.remove('opacity-100', 'scale-100');
                    }
                    if (rightCard) {
                        rightCard.classList.add('opacity-0', 'translate-x-[30px]');
                        rightCard.classList.remove('opacity-100', 'translate-x-0');
                    }
                });
            }
        });
    }, observerOptions);

    // Ensure we don't have stray inline transition delays blocking JS
    const rows = document.querySelectorAll('.comparison-row');
    rows.forEach(row => {
        const leftCard = row.querySelector('.comp-left');
        const arrow = row.querySelector('.comp-arrow');
        const rightCard = row.querySelector('.comp-right');
        if (leftCard) leftCard.style.transitionDelay = '0ms';
        if (arrow) arrow.style.transitionDelay = '0ms';
        if (rightCard) rightCard.style.transitionDelay = '0ms';
    });

    sectionObserver.observe(section);
});
</script>
