<?php
/**
 * Template part for displaying the Mission & Vision section
 *
 * @package Chimera
 */

$mission_vision = get_field('about_mission_vision') ?: [];
$items = $mission_vision['items'] ?? [];
?>

<section class="w-full relative pb-[50px] bg-offwhite">
    <div class="container">
        
        <?php if ( ! empty($items) && is_array($items) ) : ?>
            <div class="flex flex-col md:flex-row gap-10 md:gap-[56px] w-full">
                
                <?php foreach ( $items as $item ) : 
                    $title = $item['title'] ?? '';
                    $image = $item['image'] ?? '';
                    $description = $item['description'] ?? '';
                ?>
                    <!-- Card Container -->
                    <div class="flex-1 flex flex-col bg-white rounded-[16px] border border-[#ebebeb] shadow-[0px_4px_28px_0px_rgba(0,0,0,0.06)] relative overflow-hidden px-[24px] py-[32px] lg:px-[51px] lg:py-[48px] gap-[24px] md:gap-[38px] group hover:border-[rgba(255,74,3,0.4)] transition-colors">
                        
                        <!-- Left Orange Gradient Border -->
                        <div class="absolute left-0 top-0 bottom-[50px] w-[3px] bg-gradient-to-b from-[#ff4a03] to-[rgba(255,74,3,0.08)]"></div>

                        <!-- Header: Icon & Title -->
                        <div class="flex items-center gap-[16px] relative z-10">
                            <!-- Icon -->
                            <?php if ( $image ) : 
                                $img_url = is_array($image) ? $image['url'] : wp_get_attachment_image_url($image, 'full');
                                $img_alt = is_array($image) ? $image['alt'] : get_post_meta($image, '_wp_attachment_image_alt', true);
                            ?>
                                <div class="w-[52px] h-[52px] rounded-[18px] flex items-center justify-center flex-shrink-0" style="background-image: linear-gradient(135deg, rgba(255, 139, 77, 0.12) 0%, rgba(255, 74, 3, 0.12) 100%); border: 1.3px solid rgba(255,74,3,0.18);">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-[24px] h-[24px] object-contain">
                                </div>
                            <?php endif; ?>

                            <!-- Title -->
                            <?php if ( $title ) : ?>
                                <h2 class="text-[#1b1b1b] text-left text-[32px] lg:text-[44px] tracking-[-0.12px] font-jost font-semibold leading-[1.2] m-0">
                                    <?php echo esc_html( $title ); ?>
                                </h2>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <?php if ( $description ) : ?>
                            <div class="font-sans font-normal text-dark text-[16px] md:text-[20px] leading-[1.5] relative z-10">
                                <p class="m-0 font-normal"><?php echo wp_kses_post( $description ); ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Bottom Right Watermark Icon (Optional visual flair) -->
                        <?php if ( $image ) : ?>
                            <div class="absolute -bottom-[48px] -right-[37px] opacity-[0.1] pointer-events-none w-[110px] h-[110px] z-0">
                                <img src="<?php echo esc_url($img_url); ?>" alt="" class="w-full h-full object-contain">
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>
