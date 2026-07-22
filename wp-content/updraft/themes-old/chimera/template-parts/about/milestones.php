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

        <div class="flex flex-col gap-[80px] w-full">

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
                        <?php echo esc_html($heading); ?>    <?php if ($heading && $heading_highlight)
                                     echo "\n"; ?><br
                            class="hidden lg:block"><span
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
                
                <!-- Responsive Wrapper: Allows horizontal swiping on mobile/tablet, fully contained on desktop -->
                <div class="relative w-full mt-8 md:mt-12 mb-8 overflow-x-auto scrollbar-hide pb-4">
                    
                    <!-- min-w-[1024px] ensures that on iPad (768px) the grid is still wide enough to fit 5 items on 2 lines, allowing the user to swipe -->
                    <div class="min-w-[1024px] lg:min-w-full w-full relative">
                        
                        <!-- 
                            3-row CSS Grid to perfectly align everything! 
                            Row 1: Text titles
                            Row 2: Connecting dashed line
                            Row 3: Dots and pills 
                        -->
                        <div class="grid items-start w-full relative z-10" style="grid-template-columns: repeat(<?php echo count($items); ?>, minmax(0, 1fr));">
                            
                            <!-- ROW 1: Texts (Grows to fit tallest text) -->
                            <?php foreach ($items as $index => $item): 
                                $title = $item['title'] ?? '';
                            ?>
                                <div class="flex items-end justify-center w-full px-1 md:px-4 pb-[27px] h-full">
                                    <?php if ($title): ?>
                                        <p class="break-words max-w-[150px] font-jost font-semibold text-dark text-[14px] md:text-[18px] text-center leading-[1.2]">
                                            <?php echo esc_html($title); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                            <!-- ROW 2: Connecting Line (Spans all columns) -->
                            <div class="col-[1/-1] relative w-full h-0 z-0">
                                <?php
                                $total = count($items);
                                $start_pct = $total > 0 ? (100 / ($total * 2)) : 10;
                                ?>
                                <div class="absolute top-0 h-0 border-t-[1px] border-dashed border-orange" style="left: <?php echo $start_pct; ?>%; right: 0;"></div>
                            </div>

                            <!-- ROW 3: Dots and Pills -->
                            <?php foreach ($items as $index => $item): 
                                $year = $item['year'] ?? '';
                                $is_active = $item['is_active'] ?? false;
                            ?>
                                <div class="flex flex-col items-center relative min-w-0 z-10">
                                    
                                    <!-- Dot (Shifted up 3px to exactly center on the line) -->
                                    <div class="w-[6px] h-[6px] shrink-0 rounded-full bg-orange -mt-[3px]"></div>

                                    <!-- Year Pill -->
                                    <?php if ($is_active): ?>
                                        <div class="mt-[27px] border border-orange border-solid flex h-[52px] items-center justify-center px-[12px] rounded-[40px] shrink-0 min-w-[82px] bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03]">
                                            <span class="font-jost font-bold text-[22px] text-white leading-none whitespace-nowrap">
                                                <?php echo esc_html($year); ?>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <div class="mt-[27px] border border-orange border-solid flex h-[52px] items-center justify-center px-[12px] rounded-[40px] shrink-0 min-w-[82px] bg-transparent">
                                            <span class="font-jost font-bold text-[22px] leading-none whitespace-nowrap bg-clip-text text-transparent bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03]">
                                                <?php echo esc_html($year); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </div>
</section>