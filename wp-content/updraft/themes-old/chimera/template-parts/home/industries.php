<?php
/**
 * Template part for displaying the Industries We Build For section
 *
 * @package Chimera
 */

$industries_section = get_field( 'industries_section' ) ?? [];
$badge_text = $industries_section['badge_text'] ?? '';
$heading_black = $industries_section['heading_black'] ?? '';
$heading_orange = $industries_section['heading_orange'] ?? '';
$industry_cards = $industries_section['industry_cards'] ?? [];
?>

<section class="w-full bg-[#E7E7E7] py-[50px] relative overflow-hidden">
    <div class="container mx-auto">
        
        <!-- Section Header -->
        <div class="text-center flex flex-col items-center mb-10 md:mb-[60px]">
            <!-- Pill Badge -->
            <?php if ( $badge_text ) : ?>
                <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange tracking-wider mb-5 shadow-sm">
                    <?php echo esc_html( $badge_text ); ?>
                </div>
            <?php endif; ?>

            <!-- Heading -->
            <?php if ( $heading_black || $heading_orange ) : ?>
                <h2 class="text-dark max-w-2xl">
                    <?php 
                        if ( $heading_black ) {
                            echo esc_html( $heading_black );
                        }
                    ?>
                    <br class="block md:hidden"> 
                    <?php 
                        if ( $heading_orange ) {
                            echo '<span class="inline-block mt-2.5 md:mt-0 text-orange">' . esc_html( $heading_orange ) . '</span>';
                        }
                    ?>
                </h2>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <div class="w-full overflow-hidden md:overflow-visible">
            <div id="industries-slider" class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory py-2 px-1 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] md:grid md:overflow-x-visible md:snap-none md:grid-cols-2 lg:grid-cols-3 gap-3.5 items-start">
            
            <?php 
                if ( $industry_cards && is_array( $industry_cards ) ) : 
                    foreach ( $industry_cards as $card ) : 
                        $icon = $card['industry_icon'] ?? '';
                        $icon_alt = $card['industry_icon_alt'] ?? '';
                        $title = $card['industry_title'] ?? '';
                        $description = $card['industry_description'] ?? '';
                        $button_text = $card['button_text'] ?? '';
                        $button_link = $card['button_link'] ?? '';
            ?>
                <!-- Industry Card -->
                <div class="industry-card bg-white border border-transparent hover:border-orange rounded-[10px] p-8 md:p-[30px] transition-all duration-300 flex flex-col justify-start group transform shrink-0 w-full sm:w-[60vw] md:w-auto snap-center self-stretch">
                    <div>
                        <!-- Icon and Title Header -->
                        <div class="flex items-center gap-4 mb-[10px]">
                            <div class="w-14 h-14 rounded-full bg-white shadow-[0px_0px_10px_0px_#FF4A0340] flex items-center justify-center text-orange flex-shrink-0">
                                <?php 
                                    if ( $icon ) {
                                        // If ACF returns array (image object)
                                        if ( is_array( $icon ) ) {
                                            $icon_url = $icon['url'];
                                            $alt_text = ! empty( $icon_alt ) ? $icon_alt : $icon['alt'];
                                        } else {
                                            // If ACF returns image ID
                                            $icon_src = wp_get_attachment_image_src( $icon, 'full' );
                                            $icon_url = $icon_src[0];
                                            $alt_text = ! empty( $icon_alt ) ? $icon_alt : get_post_meta( $icon, '_wp_attachment_image_alt', true );
                                        }
                                        
                                        if ( ! empty( $icon_url ) ) {
                                            echo '<img src="' . esc_url( $icon_url ) . '" alt="' . esc_attr( $alt_text ) . '" class="w-8 h-8">';
                                        }
                                    }
                                ?>
                            </div>
                            <?php if ( $title ) : ?>
                                <h3 class="font-jost font-semibold text-lg text-dark leading-none"><?php echo esc_html( $title ); ?></h3>
                            <?php endif; ?>
                        </div>
                        <!-- Description -->
                        <?php if ( $description ) : ?>
                            <p class="font-sans font-normal text-sm text-gray leading-relaxed">
                                <?php echo wp_kses_post( $description ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <!-- Action Link -->
                    <div class="mt-auto pt-5">
                        <?php 
                            if ( $button_link ) {
                                $link_url = is_array( $button_link ) ? $button_link['url'] : $button_link;
                                $link_text = $button_text ? $button_text : 'Explore Industries';
                                
                                echo '<a href="' . esc_url( $link_url ) . '" class="inline-flex items-center gap-1.5 text-[15px] font-bold text-orange transition-all duration-300">';
                                    echo esc_html( $link_text );
                                    echo '<svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">';
                                        echo '<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>';
                                    echo '</svg>';
                                echo '</a>';
                            }
                        ?>
                    </div>
                </div>
            <?php 
                    endforeach; 
                endif; 
            ?>

            </div> <!-- End Slider Container -->

            <!-- Mobile Slider Navigation -->
            <div class="flex items-center justify-center gap-4 mt-8 md:hidden">
                <button id="industries-slider-prev" aria-label="Previous" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center text-gray hover:text-orange hover:border-orange transition-all duration-300 bg-white cursor-pointer group">
                    <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
                <button id="industries-slider-next" aria-label="Next" class="w-12 h-12 rounded-full bg-orange border border-orange flex items-center justify-center text-white hover:bg-[#e65c00] transition-all duration-300 cursor-pointer group">
                    <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.getElementById('industries-slider');
                const prevBtn = document.getElementById('industries-slider-prev');
                const nextBtn = document.getElementById('industries-slider-next');

                if (slider && prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.industry-card').offsetWidth + 14; // 14px is gap-3.5
                        slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                    });
                    nextBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.industry-card').offsetWidth + 14;
                        slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                    });
                }
            });
            </script>
        </div>
    </div>
</section>
