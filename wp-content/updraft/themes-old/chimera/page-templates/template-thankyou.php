<?php
/**
 * Template Name: Thank You Template
 * 
 * The template for displaying a thank you page after form submission.
 *
 * @package Chimera
 */

get_header();
?>

<main id="thank-you-page" class="site-main -mt-20 bg-[#f9f7f6] content-stretch flex flex-col items-center relative size-full">
    
    <section class="content-stretch flex flex-col items-center pb-[60px] pt-[130px] relative shrink-0 w-full">
        <div class="container content-stretch flex items-start px-4 md:px-0 relative shrink-0 w-full max-w-[1200px] mx-auto justify-center">
            
            <div class="content-stretch flex flex-col gap-[40px] items-center justify-center relative">
                
                <?php
                // Fetch group field from ACF
                $thankyou_data = get_field('thank_you_content') ?: (get_field('thankyou_content') ?: []);
                
                // Extract fields with fallbacks
                $heading = $thankyou_data['heading'] ?? '';
                $highlight_text = $thankyou_data['highlight_text'] ?? '';
                $description = $thankyou_data['description'] ?? '';
                $social_label = $thankyou_data['social_label'] ?? '';
                $page_social_icons = $thankyou_data['social_icons'] ?? ($thankyou_data['social_icon'] ?? []);
                ?>

                <div class="content-stretch flex flex-col gap-[20px] items-start relative shrink-0 w-full text-center">
                    <div class="[word-break:break-word] flex flex-col font-jost font-semibold items-center justify-center leading-[1.1] relative shrink-0 text-[48px] md:text-[60px] tracking-[-0.12px] w-full">
                        <div class="text-[#1b1b1b]">
                            <span><?php echo wp_kses_post( $heading ); ?></span>
                        </div>
                        <?php if ( $highlight_text ) : ?>
                        <div class="text-[#ff4a03]">
                            <span><?php echo wp_kses_post( $highlight_text ); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( $description ) : ?>
                    <div class="content-stretch flex items-center justify-center relative shrink-0 w-full">
                        <p class="[word-break:break-word] font-sans font-normal leading-[1.5] relative text-[#666] text-[16px] text-center max-w-[500px]">
                            <?php echo wp_kses_post( $description ); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Social Icons from Page ACF -->
                <?php 
                if ( ! empty( $page_social_icons ) ) : 
                ?>
                <div class="content-stretch flex flex-wrap justify-center gap-[10px] items-center relative shrink-0">
                    <p class="[word-break:break-word] font-sans font-normal leading-[1.5] relative shrink-0 text-[#666] text-[16px] text-center whitespace-nowrap">
                        <?php echo esc_html( $social_label ); ?>
                    </p>
                    <div class="flex items-center gap-[10px]">
                        <?php foreach ( $page_social_icons as $social ) : 
                            $social_icon  = $social['icon'] ?? null;
                            $link_url     = $social['link'] ?? '';
                            $target_blank = ! empty( $social['target_blank'] );
                            $link_target  = $target_blank ? '_blank' : '_self';
                            
                            if ( ! empty( $social_icon ) && ! empty( $link_url ) ) : ?>
                                <a href="<?php echo esc_url( $link_url ); ?>" 
                                   target="<?php echo esc_attr( $link_target ); ?>" 
                                   aria-label="<?php echo esc_attr( is_array($social_icon) && !empty($social_icon['alt']) ? $social_icon['alt'] : 'Social Link' ); ?>"
                                   class="h-10 w-10 rounded-full bg-[#6666661A] text-gray hover:text-white flex items-center justify-center transition-colors duration-200">
                                    <img src="<?php echo esc_url( is_array($social_icon) ? $social_icon['url'] : $social_icon ); ?>" 
                                         alt="<?php echo esc_attr( is_array($social_icon) ? $social_icon['alt'] : '' ); ?>" 
                                         class="h-[18px] w-[18px]">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </section>

    <!-- Trusted By Logos -->
    <?php get_template_part('template-parts/components/logo-marquee'); ?>

</main>

<?php
get_footer();
