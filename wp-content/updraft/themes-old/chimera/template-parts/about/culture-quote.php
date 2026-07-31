<?php
/**
 * Template part for displaying the Culture Quote section
 *
 * @package Chimera
 */

$culture_content = get_field('about_culture_quote') ?: [];
$quote_text = $culture_content['quote_text'] ?? '';
$bg_image = $culture_content['bg_image'] ?? '';
$quote_icon_1 = $culture_content['quote_icon_1'] ?? ($culture_content['quote_icon'] ?? '');
$quote_icon_2 = $culture_content['quote_icon_2'] ?? '';
?>

<section class="w-full relative py-[120px] lg:py-[150px] bg-orange overflow-hidden about-culture-section">
    
    <!-- Background Image / Texture -->
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute inset-0 mix-blend-overlay">
            <?php if ( $bg_image ) : 
                $bg_url = is_array($bg_image) ? $bg_image['url'] : wp_get_attachment_image_url($bg_image, 'full');
                if ( $bg_url ) {
                    echo '<img src="' . esc_url($bg_url) . '" alt="" class="w-full h-full object-cover">';
                }
            endif; ?>
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10 flex flex-col items-center justify-center">
        
        <div class="relative max-w-[1342px] w-full text-center">
            
            <!-- Quote Text -->
            <?php if ( $quote_text ) : ?>
                <h2 class="font-jost max-w-7xl font-semibold text-[28px] md:text-[36px] lg:text-[42px] text-white tracking-[-0.12px] leading-[1.2] lg:leading-tight mx-auto">
                    <?php echo wp_kses_post( $quote_text ); ?>
                </h2>
            <?php endif; ?>

            <!-- Decorative Quotes (Top Left) -->
            <div class="absolute -top-[40px] md:-top-[60px] lg:-top-[86px] left-0 w-[30px] md:w-[40px] lg:w-[50px] h-auto text-white">
                <?php if ( $quote_icon_1 ) : 
                    $icon1_url = is_array($quote_icon_1) ? $quote_icon_1['url'] : wp_get_attachment_image_url($quote_icon_1, 'full');
                    $icon1_alt = is_array($quote_icon_1) ? $quote_icon_1['alt'] : get_post_meta($quote_icon_1, '_wp_attachment_image_alt', true);
                ?>
                    <img src="<?php echo esc_url($icon1_url); ?>" alt="<?php echo esc_attr($icon1_alt); ?>" class="w-full h-auto">
                <?php endif; ?>
            </div>

            <!-- Decorative Quotes (Bottom Right) -->
            <div class="absolute -bottom-[40px] md:-bottom-[60px] lg:-bottom-[80px] right-0 w-[30px] md:w-[40px] lg:w-[50px] h-auto text-white">
                <?php if ( $quote_icon_2 ) : 
                    $icon2_url = is_array($quote_icon_2) ? $quote_icon_2['url'] : wp_get_attachment_image_url($quote_icon_2, 'full');
                    $icon2_alt = is_array($quote_icon_2) ? $quote_icon_2['alt'] : get_post_meta($quote_icon_2, '_wp_attachment_image_alt', true);
                ?>
                    <img src="<?php echo esc_url($icon2_url); ?>" alt="<?php echo esc_attr($icon2_alt); ?>" class="w-full h-auto">
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>
