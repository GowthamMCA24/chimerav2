<?php
/**
 * Template part for displaying the Industry Engagement Models section
 * Left heading with right numbered timeline list
 *
 * @package Chimera
 */

$engagement = get_field('industry_engagement');
$badge_text        = $engagement['badge_text'] ?? 'How we Deliver';
$heading           = $engagement['heading'] ?? 'Engagement Models';
$heading_highlight = $engagement['heading_highlight'] ?? 'Built Around Your Requirements';
$description       = $engagement['description'] ?? '';
$models            = $engagement['models'] ?? [];
?>

<section class="ind-engagement w-full bg-white py-[60px] md:py-[80px] relative overflow-hidden">
    <div class="container">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-[80px]">
            
            <!-- Left Column: Header & Description -->
            <div class="w-full lg:w-[420px] lg:sticky lg:top-32 lg:self-start">
                <div class="flex flex-col gap-5 items-center md:items-start text-center md:text-left">
                    <!-- Badge -->
                    <div class="inline-flex font-jost items-center justify-center px-3 py-1.5 h-[32px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] text-xs font-semibold uppercase text-orange w-[max-content]">
                        <?php echo esc_html( $badge_text ); ?>
                    </div>

                    <!-- Heading -->
                    <h2 class="leading-[1.2] tracking-[-0.12px] text-center md:text-left">
                        <span class="text-dark"><?php echo esc_html( $heading ); ?></span>
                        <span class="text-orange"><?php echo esc_html( $heading_highlight ); ?></span>
                    </h2>

                    <?php if ( $description ) : ?>
                    <p class="font-sans font-normal text-gray text-base leading-[1.5]">
                        <?php echo esc_html( $description ); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Timeline List -->
            <div class="w-full lg:flex-1">
                <div class="flex flex-col gap-5 relative">
                    
                    <!-- Vertical timeline line is now rendered per-item -->
                    
                    <?php if ( $models ) : ?>
                        <?php foreach ( $models as $index => $model ) : 
                            $number = str_pad( $index + 1, 2, '0', STR_PAD_LEFT );
                            // The model might have its own image in the new structure, but we used a shared one before. 
                            // Let's check if there is an image per model, or use the section level image.
                            $item_img = $model['image'] ?? ($engagement['image'] ?? null);
                        ?>
                        <?php
                            $is_first = ($index === 0);
                            $is_last = ($index === count($models) - 1);
                            $total_models = count($models);

                            $line_classes = "absolute left-[29px] border-l-[2px] border-dashed border-orange -z-10 w-0 ";
                            if ( $total_models === 1 ) {
                                $line_classes .= "hidden ";
                            } elseif ( $is_first ) {
                                $line_classes .= "top-[50%] -bottom-[20px] ";
                            } elseif ( $is_last ) {
                                $line_classes .= "top-0 bottom-[50%] ";
                            } else {
                                $line_classes .= "top-0 -bottom-[20px] ";
                            }
                        ?>
                        <div class="flex flex-row gap-[15px] sm:gap-[20px] items-center relative z-10">
                            
                            <!-- Line Segment -->
                            <div class="<?php echo $line_classes; ?>"></div>
                            
                            <!-- Number Circle -->
                            <div class="size-[60px] rounded-[40px] bg-orange-gradient border border-[#ff4a03] flex items-center justify-center flex-shrink-0">
                                <span class="font-jost font-bold text-[22px] text-white leading-none">
                                    <?php echo $number; ?>
                                </span>
                            </div>

                            <!-- Content Card -->
                            <div class="flex-1 bg-[radial-gradient(79.17%_79.17%_at_50%_50%,#FFFFFF_0%,#EEEDEE_100%)] border border-bordergray rounded-[10px] p-5 lg:p-[30px] flex flex-col xl:flex-row gap-[20px] items-center transition-shadow duration-300">
                                
                                <div class="flex-1 flex flex-col gap-[10px]">
                                    <h5 class="font-jost font-semibold text-lg text-dark leading-[1.2]">
                                        <?php echo esc_html( $model['title'] ); ?>
                                    </h5>
                                    <p class="font-sans font-normal text-[#666] text-[14px] leading-[1.5]">
                                        <?php echo esc_html( $model['description'] ); ?>
                                    </p>
                                </div>

                                <?php if ( $item_img ) : ?>
                                <div class="w-full md:w-[160px] h-[132px] rounded-[6px] overflow-hidden flex-shrink-0 bg-gradient-to-br from-gray-100 to-gray-200">
                                    <img src="<?php echo esc_url( $item_img['url'] ); ?>" alt="<?php echo esc_attr( $model['title'] ); ?>" class="w-full h-full object-cover">
                                </div>
                                <?php endif; ?>

                            </div>

                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
