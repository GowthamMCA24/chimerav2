<?php
/**
 * Template part for displaying the Businesses We Support section
 *
 * @package Chimera
 */

$support_section = get_field('support_section') ?? [];
$badge_text = $support_section['badge_text'] ?? '';
$heading_black = $support_section['heading_black'] ?? '';
$heading_orange = $support_section['heading_orange'] ?? '';
$description = $support_section['description'] ?? '';
$large_cards = $support_section['large_cards'] ?? [];
$small_cards = $support_section['small_cards'] ?? [];
?>

<section class="w-full bg-white py-[50px] relative overflow-hidden">
    <div class="container mx-auto">
        
        <!-- Section Header -->
        <div class="text-center flex flex-col items-center mb-10 md:mb-[60px]">
            <!-- Pill Badge -->
            <?php if ( $badge_text ) : ?>
                <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange tracking-wider mb-5">
                    <?php echo esc_html( $badge_text ); ?>
                </div>
            <?php endif; ?>

            <!-- Heading -->
            <?php if ( $heading_black || $heading_orange ) : ?>
                <h2 class="text-dark mb">
                    <?php 
                        if ( $heading_black ) {
                            echo esc_html( $heading_black );
                        }
                    ?>
                    <br class="block lg:hidden">
                    <?php 
                        if ( $heading_orange ) {
                            echo '<span class="inline-block mt-2.5 md:mt-0 text-orange">' . esc_html( $heading_orange ) . '</span>';
                        }
                    ?>
                </h2>
            <?php endif; ?>

            <!-- Description -->
            <?php if ( $description ) : ?>
                <p class="text-gray text-center text-sm md:text-base font-normal mt-5 max-w-[600px] leading-relaxed">
                    <?php echo wp_kses_post( $description ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Large Cards Grid (2 Columns) -->
        <?php if ( $large_cards && is_array( $large_cards ) ) : ?>
            <div class="w-full overflow-hidden md:overflow-visible mb-5 lg:mb-10">
                <div id="support-slider" class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] md:grid md:overflow-x-visible md:snap-none md:grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10">
                
                <?php 
                    foreach ( $large_cards as $large_card ) : 
                        $card_image = $large_card['card_image'] ?? '';
                        $card_image_alt = $large_card['card_image_alt'] ?? '';
                        $card_title = $large_card['card_title'] ?? '';
                        $card_description = $large_card['card_description'] ?? '';
                ?>
                    <!-- Large Card -->
                    <div class="support-card bg-white border border-bordergray rounded-[10px] overflow-hidden flex flex-col shrink-0 w-full sm:w-[60vw] md:w-auto snap-center self-stretch">
                        <!-- Illustration Area -->
                        <div class="bg-[radial-gradient(79.17%_79.17%_at_50%_50%,#FFFFFF_0%,#EEEDEE_100%)] h-full md:h-[320px] w-full flex items-center justify-center relative overflow-hidden">
                            <?php 
                                if ( $card_image ) {
                                    // If ACF returns array (image object)
                                    if ( is_array( $card_image ) ) {
                                        $image_url = $card_image['url'];
                                        $alt_text = ! empty( $card_image_alt ) ? $card_image_alt : $card_image['alt'];
                                    } else {
                                        // If ACF returns image ID
                                        $image_src = wp_get_attachment_image_src( $card_image, 'full' );
                                        $image_url = $image_src[0] ?? '';
                                        $alt_text = ! empty( $card_image_alt ) ? $card_image_alt : get_post_meta( $card_image, '_wp_attachment_image_alt', true );
                                    }
                                    
                                    if ( ! empty( $image_url ) ) {
                                        echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $alt_text ) . '" class="w-full h-full object-contain mix-blend-multiply">';
                                    }
                                }
                            ?>
                        </div>
                        <!-- Content Area -->
                        <div class="p-8 md:p-10 flex flex-col justify-start">
                            <?php if ( $card_title ) : ?>
                                <h3 class="font-jost font-semibold text-lg sm:text-[22px] text-dark mb-3 leading-none"><?php echo esc_html( $card_title ); ?></h3>
                            <?php endif; ?>
                            <?php if ( $card_description ) : ?>
                                <p class="font-sans font-normal text-sm text-gray leading-relaxed">
                                    <?php echo wp_kses_post( $card_description ); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                ?>

                </div> <!-- End Slider Container -->

                <!-- Mobile Slider Navigation -->
                <div class="flex items-center justify-center gap-4 mt-5 md:hidden">
                    <button id="support-slider-prev" aria-label="Previous" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center text-gray hover:text-orange hover:border-orange transition-all duration-300 bg-white cursor-pointer">
                        <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                    <button id="support-slider-next" aria-label="Next" class="w-12 h-12 rounded-full bg-orange border border-orange flex items-center justify-center text-white transition-all duration-300 cursor-pointer">
                        <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>                
                    </button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const slider = document.getElementById('support-slider');
                    const prevBtn = document.getElementById('support-slider-prev');
                    const nextBtn = document.getElementById('support-slider-next');

                    if (slider && prevBtn && nextBtn) {
                        prevBtn.addEventListener('click', () => {
                            const cardWidth = slider.querySelector('.support-card').offsetWidth + 20; // 20px is gap-5
                            slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                        });
                        nextBtn.addEventListener('click', () => {
                            const cardWidth = slider.querySelector('.support-card').offsetWidth + 20;
                            slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                        });
                    }
                });
                </script>
            </div>
        <?php endif; ?>

        <!-- Small Cards Grid (4 Columns) -->
        <?php if ( $small_cards && is_array( $small_cards ) ) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[14px]">
                
                <?php 
                    foreach ( $small_cards as $small_card ) : 
                        $icon = $small_card['card_icon'] ?? '';
                        $icon_alt = $small_card['card_icon_alt'] ?? '';
                        $title = $small_card['card_title'] ?? '';
                        $desc = $small_card['card_description'] ?? '';
                ?>
                    <!-- Small Card -->
                    <div class="bg-white border border-bordergray rounded-[8px] p-[30px] flex flex-col justify-start group">
                        <!-- Icon wrapper -->
                        <div class="size-[60px] rounded-full bg-white shadow-[0px_0px_10px_0px_#FF4A0340] flex items-center justify-center text-orange mb-[10px] flex-shrink-0">
                            <?php 
                                if ( $icon ) {
                                    // If ACF returns array (image object)
                                    if ( is_array( $icon ) ) {
                                        $icon_url = $icon['url'];
                                        $icon_text = ! empty( $icon_alt ) ? $icon_alt : $icon['alt'];
                                    } else {
                                        // If ACF returns image ID
                                        $icon_src = wp_get_attachment_image_src( $icon, 'full' );
                                        $icon_url = $icon_src[0] ?? '';
                                        $icon_text = ! empty( $icon_alt ) ? $icon_alt : get_post_meta( $icon, '_wp_attachment_image_alt', true );
                                    }
                                    
                                    if ( ! empty( $icon_url ) ) {
                                        echo '<img src="' . esc_url( $icon_url ) . '" alt="' . esc_attr( $icon_text ) . '" class="w-8 h-8">';
                                    }
                                }
                            ?>
                        </div>
                        <?php if ( $title ) : ?>
                            <h4 class="font-jost font-semibold text-[16px] text-dark mb-[10px] leading-none"><?php echo esc_html( $title ); ?></h4>
                        <?php endif; ?>
                        <?php if ( $desc ) : ?>
                            <p class="font-sans font-normal text-sm text-gray leading-relaxed">
                                <?php echo wp_kses_post( $desc ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php 
                    endforeach; 
                ?>

            </div>
        <?php endif; ?>

    </div>
</section>
