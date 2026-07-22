<?php
/**
 * Template part for displaying the Our Story section
 *
 * @package Chimera
 */

$story_content = get_field('about_story') ?: [];
$heading = $story_content['heading'] ?? '';
$rows = $story_content['rows'] ?? [];
$cta_text = $story_content['cta_text'] ?? '';
$cta_link = $story_content['cta_link'] ?? '';
?>

<section class="w-full relative py-[50px] border-t border-orange overflow-hidden">
    
    <!-- Top Gradient Overlay -->
    <div class="absolute inset-0 pointer-events-none z-0" style="background-image: linear-gradient(rgba(255, 74, 3, 0.1) 11.884%, rgba(255, 97, 35, 0.086) 48.669%, rgba(255, 255, 255, 0) 73.601%), linear-gradient(90deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.2) 100%);"></div>

    <div class="container mx-auto relative z-10 flex flex-col items-center justify-center">
        
        <!-- Heading -->
        <?php if ( $heading ) : ?>
            <h2 class="text-dark tracking-[-0.12px] text-[44px] text-center mb-10 sm:mb-14">
                <?php echo esc_html( $heading ); ?>
            </h2>
        <?php endif; ?>

        <!-- Story Rows -->
        <?php if ( ! empty($rows) && is_array($rows) ) : ?>
            <div class="w-full flex flex-col gap-10 lg:gap-[84px]">
                <?php 
                $index = 0;
                foreach ( $rows as $row ) : 
                    $text = $row['text'] ?? '';
                    $image = $row['image'] ?? '';
                    $is_even = ($index % 2 !== 0); // 0-based, so 1 is even row (image left)
                ?>
                    <div class="flex flex-col <?php echo $is_even ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?> items-center gap-10 lg:gap-[67px] px-6 lg:px-0">
                        
                        <!-- Text -->
                        <div class="flex-1">
                            <div class="font-sans font-normal text-dark text-[20px] lg:text-[24px] leading-[1.5] text-justify">
                                <?php echo wp_kses_post( $text ); ?>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="flex-1 w-full">
                            <?php if ( $image ) : 
                                $img_url = is_array($image) ? $image['url'] : wp_get_attachment_image_url($image, 'full');
                                $img_alt = is_array($image) ? $image['alt'] : get_post_meta($image, '_wp_attachment_image_alt', true);
                            ?>
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-auto object-cover rounded-[12px] max-h-[407px] shadow-sm">
                            <?php endif; ?>
                        </div>

                    </div>
                <?php 
                $index++;
                endforeach; 
                ?>
            </div>
        <?php endif; ?>

        <!-- CTA Button -->
        <?php if ( $cta_text && $cta_link ) : ?>
            <a href="<?php echo esc_url( $cta_link ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                <?php echo esc_html( $cta_text ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
                    <path d="M8.5 1L12 4M12 4L8.5 7M12 4L0 4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        <?php endif; ?>

    </div>
</section>
