<?php
/**
 * Template part for displaying the CTA section
 *
 * @package Chimera
 */
?>

<section class="bg-orange-gradient relative overflow-hidden">
    <div class="relative z-10">
        
        <!-- Gradient Callout Card -->
        <div class="container text-white py-[50px] flex flex-col items-center text-center relative overflow-hidden">
            
            <?php
            $cta_badge = $args['cta_badge'] ?? "";
            $cta_title = $args['cta_title'] ?? "Let's build what's next.";
            $cta_desc  = $args['cta_desc'] ?? "Whether you are modernizing legacy systems, building AI-native products, or scaling global operations, our team is ready to architect the solution.";
            $cta_btn_text = $args['cta_btn_text'] ?? "Build with us";
            $cta_btn_link = $args['cta_btn_link'] ?? "#";
            $cta_title_class = $args['cta_title_class'] ?? "max-w-[200px] sm:max-w-3xl";
            $cta_desc_class  = $args['cta_desc_class'] ?? "";
            ?>

            <!-- START YOUR TRANSFORMATION Badge -->
             <?php if ( $cta_badge ) : ?>
            <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 border border-white rounded-full text-xs font-semibold tracking-wider uppercase text-white mb-5 ">
                <?php echo esc_html( $cta_badge ); ?>
            </div>
            <?php endif; ?>

            <!-- Heading -->
            <h2 class="text-white mb-5 leading-[1.2] <?php echo esc_attr( $cta_title_class ); ?>">
                <?php echo wp_kses_post( $cta_title ); ?>
            </h2>

            <!-- Description -->
            <p class="text-white text-sm sm:text-[16px] md:text-md font-normal leading-[1.6] mb-10 sm:mb-14 font-sans  <?php echo esc_attr( $cta_desc_class ); ?>">
                <?php echo wp_kses_post( $cta_desc ); ?>
            </p>

            <!-- CTA Button -->
            <div class="w-full flex justify-center">
                <a href="<?php echo esc_url( $cta_btn_link ); ?>" class="bg-white hover:opacity-95 text-dark px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                    <?php echo esc_html( $cta_btn_text ); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                        <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M0.75 4.75H13.75" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>

    </div>
</section>
