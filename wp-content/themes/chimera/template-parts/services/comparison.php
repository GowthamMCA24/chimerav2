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
                        
                        <div class="comparison-row flex flex-row gap-[8px] md:gap-[20px] items-stretch md:items-center w-full group" data-index="<?php echo $index; ?>">

                            <!-- Left Card (Current State) -->
                            <div class="comp-left bg-white border border-[#ebebeb] flex flex-col md:flex-row items-center px-[12px] py-[16px] md:px-[25px] md:py-[21px] rounded-[12px] md:rounded-[16px] w-[calc(50%-16px)] md:flex-1 text-center md:text-left gap-[8px] md:gap-[16px] cursor-pointer" style="opacity: 0; transform: translateX(-34px); transition: opacity 640ms cubic-bezier(0.22, 0.9, 0.28, 1), transform 700ms cubic-bezier(0.22, 0.9, 0.28, 1), filter 500ms ease;">
                                <div class="bg-[#fdf2f2] rounded-[10px] md:rounded-[14px] w-[32px] h-[32px] md:w-[40px] md:h-[40px] flex items-center justify-center flex-shrink-0">
                                    <?php if (!empty($row['current_state_icon'])): ?>
                                        <img src="<?php echo esc_url(render_acf_image_url($row['current_state_icon'])); ?>" class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] object-contain" alt="">
                                    <?php else: ?>
                                        <div class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] bg-[#fca5a5] rounded-full"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <p class="font-jost font-semibold text-[#1b1b1b] text-[12px] md:text-[14px] leading-[1.3] md:leading-[17.5px] m-0"><?php echo esc_html($row['current_state_text'] ?? ''); ?></p>
                                </div>
                            </div>

                            <!-- Center Arrow -->
                            <div class="comp-arrow-wrapper flex items-center justify-center w-[24px] md:w-[84px] flex-shrink-0" style="opacity: 0; transform: scale(0.8); transition: opacity 640ms cubic-bezier(0.22, 0.9, 0.28, 1), transform 700ms cubic-bezier(0.22, 0.9, 0.28, 1);">
                                <div class="comp-arrow relative w-[24px] h-[24px] md:w-[84px] md:h-[40px] border border-[#F7C7B2] rounded-full flex items-center justify-center overflow-hidden transition-colors duration-420 ease-out" style="background: transparent;">
                                    <?php if (!empty($row['center_icon'])): ?>
                                        <img src="<?php echo esc_url(render_acf_image_url($row['center_icon'])); ?>" class="w-[12px] h-[6px] md:w-[28px] md:h-[10px] object-contain" alt="">
                                    <?php else: ?>
                                        <svg viewBox="0 0 44 10" class="w-[18px] md:w-[44px] h-[4px] md:h-[10px] overflow-visible">
                                            <line class="comp-line" x1="1" y1="5" x2="35" y2="5" stroke="#E8501C" stroke-width="1.3" stroke-linecap="round" stroke-dasharray="36" style="stroke-dashoffset: 36; opacity: 0.7; transition: stroke-dashoffset 700ms cubic-bezier(0.22, 0.9, 0.28, 1) 260ms;"></line>
                                            <path class="comp-head" d="M30 1 L35 5 L30 9" fill="none" stroke="#E8501C" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0; transition: opacity 400ms ease 780ms;"></path>
                                        </svg>
                                    <?php endif; ?>
                                    <div class="comp-dot absolute w-[4px] h-[4px] md:w-[7px] md:h-[7px] rounded-full bg-[#E8501C]" style="opacity: 0;"></div>
                                </div>
                            </div>

                            <!-- Right Card (With Chimera) -->
                            <div class="comp-right bg-[#fff5f0] border border-[#fbe3d8] flex flex-col md:flex-row items-center px-[12px] py-[16px] md:px-[25px] md:py-[21px] rounded-[12px] md:rounded-[16px] w-[calc(50%-16px)] md:flex-1 text-center md:text-left gap-[8px] md:gap-[16px] cursor-pointer" style="opacity: 0; transform: translateX(34px); transition: opacity 640ms cubic-bezier(0.22, 0.9, 0.28, 1) 160ms, transform 700ms cubic-bezier(0.22, 0.9, 0.28, 1) 160ms, box-shadow 420ms ease, background 420ms ease;">
                                <div class="relative bg-[#fff5f0] rounded-[10px] md:rounded-[14px] w-[32px] h-[32px] md:w-[40px] md:h-[40px] flex items-center justify-center flex-shrink-0 border border-[#F3B695] text-[#E8501C]">
                                    <div class="comp-ring absolute inset-[-1px] rounded-[11px] md:rounded-[15px] border border-[#E8501C]" style="opacity: 0;"></div>
                                    <?php if (!empty($row['with_chimera_icon'])): ?>
                                        <img src="<?php echo esc_url(render_acf_image_url($row['with_chimera_icon'])); ?>" class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] object-contain relative z-10" alt="">
                                    <?php else: ?>
                                        <div class="w-[14px] h-[14px] md:w-[18px] md:h-[18px] bg-[#E8501C] rounded-full relative z-10"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <p class="font-jost font-semibold text-[#1b1b1b] text-[12px] md:text-[14px] leading-[1.3] md:leading-[17.5px] m-0"><?php echo esc_html($row['with_chimera_text'] ?? ''); ?></p>
                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inline styles for keyframes -->
<style>
@keyframes omDotFlow {
  0% { transform: translateX(-14px) scale(0.6); opacity: 0; }
  18% { opacity: 1; }
  72% { opacity: 1; }
  100% { transform: translateX(46px) scale(0.6); opacity: 0; }
}
@keyframes omRingPulse {
  0% { transform: scale(1); opacity: 0.55; }
  70% { transform: scale(1.55); opacity: 0; }
  100% { transform: scale(1.55); opacity: 0; }
}
</style>

<!-- Waterfall Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const section = document.getElementById('comparison-section');
    if (!section) return;

    const rows = Array.from(section.querySelectorAll('.comparison-row'));
    if (rows.length === 0) return;

    let revealed = -1;
    let step = 0;
    let hoverIndex = -1;
    let inView = false;
    let revealT = null;
    let cycleT = null;

    const render = () => {
        const activeIndex = hoverIndex >= 0 ? hoverIndex : Math.floor(step / 3) % rows.length;

        rows.forEach((row, i) => {
            const shown = i <= revealed;
            const isActive = shown && (i === activeIndex);
            const dim = shown && !isActive && hoverIndex >= 0;
            
            const leftCard = row.querySelector('.comp-left');
            const arrowWrap = row.querySelector('.comp-arrow-wrapper');
            const rightCard = row.querySelector('.comp-right');
            const compLine = row.querySelector('.comp-line');
            const compHead = row.querySelector('.comp-head');
            const compDot = row.querySelector('.comp-dot');
            const compRing = row.querySelector('.comp-ring');

            if (leftCard) {
                leftCard.style.opacity = shown ? (dim ? '0.42' : '1') : '0';
                leftCard.style.transform = shown ? `translateX(0) scale(${isActive ? '1.012' : '1'})` : 'translateX(-34px)';
                leftCard.style.filter = (shown && !isActive) ? 'saturate(0.85)' : 'none';
            }
            if (arrowWrap) {
                arrowWrap.style.opacity = shown ? (dim ? '0.35' : '1') : '0';
                arrowWrap.style.transform = shown ? 'scale(1)' : 'scale(0.8)';
            }
            if (rightCard) {
                rightCard.style.opacity = shown ? (dim ? '0.45' : '1') : '0';
                rightCard.style.transform = shown ? `translateX(0) scale(${isActive ? '1.016' : '1'})` : 'translateX(34px)';
                rightCard.style.boxShadow = isActive ? '0 18px 44px -22px rgba(232,80,28,0.55)' : '0 0 0 rgba(0,0,0,0)';
            }
            if (compLine) {
                compLine.style.strokeDashoffset = shown ? '0' : '36';
                compLine.style.opacity = isActive ? '1' : '0.7';
            }
            if (compHead) {
                compHead.style.opacity = shown ? (isActive ? '1' : '0.7') : '0';
            }
            if (compDot) {
                if (isActive) {
                    compDot.style.animation = 'omDotFlow 1.5s cubic-bezier(0.5,0,0.5,1) infinite';
                } else {
                    compDot.style.animation = 'none';
                    compDot.style.opacity = '0';
                }
            }
            if (compRing) {
                if (isActive) {
                    compRing.style.animation = 'omRingPulse 1.9s ease-out infinite';
                    compRing.style.opacity = '1';
                } else {
                    compRing.style.animation = 'none';
                    compRing.style.opacity = '0';
                }
            }
        });
    };

    const runReveal = () => {
        const stepReveal = (i) => {
            revealed = i;
            render();
            if (i < rows.length - 1) {
                revealT = setTimeout(() => stepReveal(i + 1), 260);
            } else {
                revealT = setTimeout(() => startCycle(), 700);
            }
        };
        stepReveal(0);
    };

    const startCycle = () => {
        clearInterval(cycleT);
        cycleT = setInterval(() => {
            if (hoverIndex >= 0) return;
            step++;
            render();
        }, 866); // 2600 / 3 roughly matches React timing
    };

    // Add event listeners for hover interactions
    rows.forEach((row, i) => {
        row.addEventListener('mouseenter', () => {
            hoverIndex = i;
            render();
        });
        row.addEventListener('mouseleave', () => {
            hoverIndex = -1;
            render();
        });
    });

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px',
        threshold: 0.1
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !inView) {
                inView = true;
                runReveal();
            } else if (!entry.isIntersecting) {
                // Reset when out of view so it can replay
                inView = false;
                revealed = -1;
                step = 0;
                hoverIndex = -1;
                clearTimeout(revealT);
                clearInterval(cycleT);
                render();
            }
        });
    }, observerOptions);

    sectionObserver.observe(section);
});
</script>
