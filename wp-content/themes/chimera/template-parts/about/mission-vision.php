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
                    <div class="flex-1 flex flex-col gap-6 md:gap-[28px]">
                        
                        <!-- Title -->
                        <?php if ( $title ) : ?>
                            <h2 class="text-dark text-left text-[36px] md:text-[44px] tracking-[-0.12px] font-jost font-semibold leading-[1.2]">
                                <?php echo esc_html( $title ); ?>
                            </h2>
                        <?php endif; ?>

                        <!-- Image -->
                        <?php if ( $image ) : 
                            $img_url = is_array($image) ? $image['url'] : wp_get_attachment_image_url($image, 'full');
                            $img_alt = is_array($image) ? $image['alt'] : get_post_meta($image, '_wp_attachment_image_alt', true);
                        ?>
                            <div class="w-full relative rounded-[12px] overflow-hidden">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>

                        <!-- Description -->
                        <?php if ( $description ) : ?>
                            <div class="font-sans font-normal text-dark text-[18px] md:text-[24px] leading-[1.5] text-justify">
                                <?php echo wp_kses_post( $description ); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>
