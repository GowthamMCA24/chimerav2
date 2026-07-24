<?php
/**
 * Template part for displaying the Engineering Framework section
 *
 * @package Chimera
 */

$framework = get_field('services_framework');
if (!$framework) return;

$badge_text = $framework['badge_text'] ?? 'Engineering Framework';
$title_line1 = $framework['title_line1'] ?? 'Intelligent Test<br>Delivery Model (ITDM)';
$title_line2 = $framework['title_line2'] ?? 'Built for Speed, Visibility,<br>and Confidence';
$description = $framework['description'] ?? 'A six-phase delivery framework that embeds continuous testing, AI-powered automation, and quality intelligence throughout the software delivery lifecycle.';
$phases = $framework['phases'] ?? [];

// Helper function to render the card content so we don't duplicate HTML
if (!function_exists('render_framework_card')) {
    function render_framework_card($phase, $index) {
        $number = $phase['number'] ?? ($index + 1);
        $step_text = $phase['step_text'] ?? ('STEP ' . ($index + 1));
        $phase_icon = $phase['phase_icon'] ?? null;
        $title = $phase['title'] ?? 'PLAN';
        $items = $phase['items'] ?? [];
        ?>
        <div class="bg-white border border-[#e8e8e8] flex flex-col gap-[30px] p-[29px] rounded-[16px] w-full min-w-[240px] max-w-[320px] shadow-sm hover:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.05)] transition-shadow relative z-20">
            <!-- Card Header -->
            <div class="flex gap-[16px] items-center">
                <!-- Icon Box -->
                <div class="border-[1.5px] border-[rgba(255,74,3,0.2)] rounded-[16px] w-[48px] h-[48px] flex items-center justify-center bg-gradient-to-br from-[#fff5f2] to-[#ffe8e0] flex-shrink-0 relative overflow-hidden">
                    <?php if ($phase_icon): ?>
                        <img src="<?php echo esc_url(is_array($phase_icon) ? $phase_icon['url'] : $phase_icon); ?>" alt="" class="w-[22px] h-[22px] object-contain">
                    <?php else: ?>
                        <span class="font-jost font-bold text-orange text-lg leading-none"><?php echo esc_html($number); ?></span>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col gap-[8px]">
                    <p class="font-jost font-bold text-[11px] text-[rgba(255,74,3,0.6)] leading-[16.5px] tracking-[1.1px] uppercase m-0"><?php echo esc_html($step_text); ?></p>
                    <p class="font-jost font-semibold text-[#1b1b1b] text-[18px] leading-[1.2] uppercase m-0"><?php echo esc_html($title); ?></p>
                </div>
            </div>
            
            <!-- Items List -->
            <?php if (!empty($items)): ?>
            <div class="flex flex-col gap-[15px] items-start w-full">
                <?php foreach ($items as $item): 
                    $item_icon = $item['icon'] ?? null;
                ?>
                <div class="bg-[#fafafa] border border-[#ebebeb] flex gap-[8px] items-start px-[13px] py-[7px] rounded-[16px] w-full">
                    <div class="w-[14px] h-[14px] flex-shrink-0 text-orange mt-[2px]">
                        <?php if ($item_icon): ?>
                            <img src="<?php echo esc_url(is_array($item_icon) ? $item_icon['url'] : $item_icon); ?>" alt="" class="w-full h-full object-contain">
                        <?php else: ?>
                            <svg viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"><path d="M1 5L5 9L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </div>
                    <p class="font-sans font-medium text-[#444] text-[13px] leading-[18px] whitespace-normal break-words m-0"><?php echo esc_html($item['text'] ?? $item['title']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
?>

<section class="bg-white w-full py-[60px] md:py-[100px] relative overflow-visible">
    <div class="container">
        
        <!-- Main Layout: Stacked on <xl, Side-by-side on xl+ -->
        <div class="flex flex-col xl:flex-row gap-[40px] xl:gap-[32px] items-start relative w-full">
            
            <!-- Left Side: Header Content -->
            <div class="w-full xl:w-[380px] 2xl:w-[462px] flex flex-col gap-[20px] xl:sticky xl:top-[120px] flex-shrink-0 z-20 items-center text-center xl:items-start xl:text-left mx-auto xl:mx-0">
                <?php if ($badge_text): ?>
                <div class="inline-flex items-center justify-center h-[32px] px-[13px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[10px] w-fit">
                    <span class="font-jost font-semibold text-orange text-[11px] leading-[16.5px] uppercase tracking-[1.1px]"><?php echo esc_html($badge_text); ?></span>
                </div>
                <?php endif; ?>
                
                <h2 class="font-jost font-semibold text-[32px] md:text-[34px] leading-[1.15] tracking-[-1px] text-[#1b1b1b] m-0">
                    <?php echo str_replace(['<br>', '<br/>', '<br />'], '<br class="hidden xl:block">', wp_kses_post($title_line1)); ?>
                    <span class="text-orange block"><?php echo str_replace(['<br>', '<br/>', '<br />'], '<br class="hidden xl:block">', wp_kses_post($title_line2)); ?></span>
                </h2>
                
                <?php if ($description): ?>
                <p class="font-sans font-normal text-gray text-[16px] leading-[26px]">
                    <?php echo esc_html($description); ?>
                </p>
                <?php endif; ?>
            </div>

            <!-- Right Side: Timeline Mindmap -->
            <div class="w-full xl:flex-1 relative flex justify-center pb-[40px]">
                
                <!-- Mobile Layout (Single Column) -->
                <div class="md:hidden flex flex-col gap-[40px] relative w-full mt-[20px]">
                    <!-- Mobile Center Line -->
                    <div class="absolute left-[24px] top-0 bottom-0 w-px bg-orange opacity-30 z-0"></div>
                    
                    <?php if (!empty($phases)): ?>
                        <?php foreach ($phases as $index => $phase): 
                            $is_first = $index === 0;
                            $is_last = $index === count($phases) - 1;
                        ?>
                        <div class="flex flex-col relative w-full pl-[50px]">
                            
                            <?php if ($is_first): ?>
                            <!-- Top Mask to hide line above first dot -->
                            <div class="absolute top-0 left-[24px] -translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                            <?php endif; ?>
                            
                            <?php if ($is_last): ?>
                            <!-- Bottom Mask to hide line below last dot -->
                            <div class="absolute bottom-0 left-[24px] -translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                            <?php endif; ?>

                            <!-- Mobile Connector Hexagon -->
                            <div class="absolute left-[24px] top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center w-[27px] h-[31px] z-10 drop-shadow-[0_4px_16px_rgba(255,74,3,0.3)]">
                                <div class="relative w-[15px] h-[17px] bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03]" style="clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);"></div>
                            </div>
                            
                            <!-- Mobile Connector Line -->
                            <div class="absolute left-[24px] top-1/2 -translate-y-1/2 w-[26px] h-px bg-orange opacity-30 z-0"></div>

                            <?php render_framework_card($phase, $index); ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Desktop Layout (Two Overlapping Columns) -->
                <div class="hidden md:grid grid-cols-2 w-full max-w-[850px] relative mt-[20px] md:mt-0">
                    
                    <!-- Center Timeline Line (Desktop only) -->
                    <div class="absolute left-1/2 top-0 bottom-0 w-px bg-orange opacity-30 -translate-x-1/2 z-0"></div>
                    
                    <!-- Left Column (Odd Steps) -->
                    <div class="flex flex-col gap-[26px] w-full z-10">
                        <?php if (!empty($phases)): ?>
                            <?php foreach ($phases as $index => $phase): 
                                if ($index % 2 !== 0) continue; // Skip even indexes (Right column)
                                $is_first = $index === 0;
                                $is_last = $index === count($phases) - 1;
                            ?>
                            <div class="w-full flex justify-end pr-[40px] lg:pr-[60px] 2xl:pr-[105px] relative">
                                
                                <?php if ($is_first): ?>
                                <!-- Top Mask to hide line above first dot -->
                                <div class="absolute top-0 right-0 translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                                <?php endif; ?>
                                
                                <?php if ($is_last): ?>
                                <!-- Bottom Mask to hide line below last dot -->
                                <div class="absolute bottom-0 right-0 translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                                <?php endif; ?>

                                <!-- Connector line to center -->
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 w-[40px] lg:w-[60px] 2xl:w-[105px] h-px bg-orange z-0"></div>
                                <!-- Center Hexagon -->
                                <div class="absolute top-1/2 right-0 translate-x-1/2 -translate-y-1/2 flex items-center justify-center w-[27px] h-[31px] z-10 drop-shadow-[0_4px_16px_rgba(255,74,3,0.3)]">
                                    <div class="relative w-[15px] h-[17px] bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03]" style="clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);"></div>
                                </div>
                                
                                <?php render_framework_card($phase, $index); ?>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Right Column (Even Steps) -->
                    <div class="flex flex-col gap-[26px] w-full z-10 mt-[142px]">
                        <?php if (!empty($phases)): ?>
                            <?php foreach ($phases as $index => $phase): 
                                if ($index % 2 === 0) continue; // Skip odd indexes (Left column)
                                $is_first = $index === 0;
                                $is_last = $index === count($phases) - 1;
                            ?>
                            <div class="w-full flex justify-start pl-[40px] lg:pl-[60px] 2xl:pl-[105px] relative">
                                
                                <?php if ($is_first): ?>
                                <!-- Top Mask (if first item is somehow on the right) -->
                                <div class="absolute top-0 left-0 -translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                                <?php endif; ?>
                                
                                <?php if ($is_last): ?>
                                <!-- Bottom Mask to hide line below last dot -->
                                <div class="absolute bottom-0 left-0 -translate-x-1/2 w-[10px] h-1/2 bg-white z-[5]"></div>
                                <?php endif; ?>

                                <!-- Connector line to center -->
                                <div class="absolute top-1/2 -translate-y-1/2 left-0 w-[40px] lg:w-[60px] 2xl:w-[105px] h-px bg-orange z-0"></div>
                                <!-- Center Hexagon -->
                                <div class="absolute top-1/2 left-0 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center w-[27px] h-[31px] z-10 drop-shadow-[0_4px_16px_rgba(255,74,3,0.3)]">
                                    <div class="relative w-[15px] h-[17px] bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03]" style="clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);"></div>
                                </div>
                                
                                <?php render_framework_card($phase, $index); ?>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</section>
