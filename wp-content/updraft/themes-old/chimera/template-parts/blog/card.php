<?php
/**
 * Template part for displaying the blog post card
 *
 * Reusable card component used in both the grid and related posts sections
 *
 * @package Chimera
 */

$card_image     = get_the_post_thumbnail_url( get_the_ID(), 'chimera-blog-card' );
$categories     = chimera_get_post_categories();
$reading_time   = chimera_reading_time();
$cat_name       = ! empty( $categories ) ? $categories[0]->name : '';
$post_type      = get_post_type();

// Webinar-specific logic
$is_webinar     = ( $post_type === 'webinar' );
$is_upcoming    = false;
if ( $is_webinar && ! empty( $categories ) ) {
    foreach ( $categories as $cat ) {
        if ( strtolower( $cat->name ) === 'upcoming' || strtolower( $cat->slug ) === 'upcoming' ) {
            $is_upcoming = true;
            break;
        }
    }
}

// Dynamic card classes
if ( $is_webinar && $is_upcoming ) {
    $card_border_class = 'border-orange bg-[rgba(255,74,3,0.05)]';
} else {
    $card_border_class = 'border-lightGray';
}

// Dynamic CTA text
if ( $is_webinar ) {
    $cta_text = $is_upcoming ? 'Watch Webinar' : 'Watch Webinar';
} elseif ( $post_type === 'casestudies' ) {
    $cta_text = 'Read Story';
}
elseif ( $post_type === 'whitepaper' ) {
    $cta_text = 'Download Whitepaper';
} else {
    $cta_text = 'Read More';
}
?>

<article class="bg-white border <?php echo esc_attr( $card_border_class ); ?> rounded-[8px] overflow-hidden flex flex-col transition-all duration-300 group hover:border-orange hover:bg-[#FFF6F0]">
    <a href="<?php the_permalink(); ?>" class="block">
        <!-- Image Container -->
        <div class="w-full overflow-hidden relative bg-lightGray">
            <?php if ( $card_image ) : ?>
                <img src="<?php echo esc_url( $card_image ); ?>" 
                     alt="<?php echo esc_attr( get_the_title() ); ?>" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     loading="lazy">
            <?php else : ?>
                <!-- Fallback placeholder -->
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-lightGray to-bordergray">
                    <svg class="w-12 h-12 text-gray/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm12.75-11.25h.008v.008h-.008V6.75z"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>
    </a>

    <!-- Content Area -->
    <div class="p-6 flex flex-col flex-1">
        
        <!-- Tag and Date Row -->
        <div class="flex items-center gap-4 mb-4">
            <?php if ( $is_webinar && $cat_name ) : ?>
                <span class="inline-flex items-center gap-2 px-3 py-2 bg-orange/10 text-orange border border-orange/20 rounded-[8px] text-[11px] md:text-xs font-semibold font-jost uppercase tracking-wider">
                    <?php echo esc_html( $cat_name ); ?>
                </span>
            <?php elseif ( $cat_name ) : ?>
                <span class="inline-flex items-center gap-2 px-3 py-2 bg-orange/10 text-orange border border-orange/20 rounded-[8px] text-[11px] md:text-xs font-semibold uppercase tracking-wider">
                    <?php echo esc_html( $cat_name ); ?>
                </span>
            <?php endif; ?>
            <span class="text-[#666666] text-[10px] md:text-xs font-sans font-medium">
                <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
            </span>
        </div>

        <!-- Title -->
        <a href="<?php the_permalink(); ?>" class="block mb-4 md:mb-8 flex-1">
            <h4 class="text-dark font-jost text-base md:text-[17px] font-medium leading-[1.4] transition-colors duration-300">
                <?php the_title(); ?>
            </h4>
        </a>

        <!-- CTA Link -->
        <a href="<?php the_permalink(); ?>" class="text-orange font-bold text-sm font-sans flex items-center gap-2 group-hover:text-dark transition-colors duration-300 mt-auto">
            <?php echo esc_html( $cta_text ); ?>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</article>
