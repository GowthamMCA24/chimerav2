<?php
/**
 * Template part for displaying the Blog Hero section
 *
 * Features the "Chimera Blog" heading.
 *
 * @package Chimera
 */
?>

<section class="w-full overflow-hidden py-[60px] md:py-[80px]">
    <!-- Background Images -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <?php 
        $hero_bg = $args['hero_bg'] ?? '';
        if ( ! empty( $hero_bg ) ) {
            // Check if $hero_bg is an array (ACF Image object) or string (URL)
            $bg_url = is_array( $hero_bg ) ? $hero_bg['url'] : $hero_bg;
        ?>
            <img src="<?php echo esc_url( $bg_url ); ?>" alt="blog hero image" class="w-full h-full object-cover">
        <?php } else { ?>
            <img src="/wp-content/uploads/2026/06/chimera-home-hero-overlay.png" alt="" class="w-full h-full object-cover">
        <?php } ?>
    </div>

    <div class="container relative z-10">
        
        <?php
        $post_type = $args['post_type'] ?? 'post';
        
        // Use provided args or fallback to old ACF options
        if ( isset( $args['hero_title'] ) ) {
            $hero_title = $args['hero_title'];
            $hero_desc = $args['hero_desc'] ?? '';
        } elseif ( $post_type === 'whitepaper' ) {
            $hero_title = get_field('whitepaper_hero_title', 'option') ?: 'Chimera <span class="text-orange">Whitepaper</span>';
            $hero_desc  = get_field('whitepaper_hero_description', 'option') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor';
        } elseif ( $post_type === 'webinar' ) {
            $hero_title = get_field('webinar_hero_title', 'option') ?: 'Chimera <span class="text-orange">Webinars</span>';
            $hero_desc  = get_field('webinar_hero_description', 'option') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor';
        } else {
            $hero_title = get_field('blog_hero_title', 'option') ?: 'Chimera <span class="text-orange">Blog</span>';
            $hero_desc  = get_field('blog_hero_description', 'option') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor';
        }
        ?>
        <!-- Page Heading -->
        <div class="text-center">
            <h1 class="text-dark">
                <?php echo wp_kses_post( $hero_title ); ?>
            </h1>
            <?php if ( ! empty( $hero_desc ) ) : ?>
                <p class="font-sans text-gray font-normal text-center mt-4 md:mt-5 mx-auto text-sm md:text-base leading-relaxed max-w-2xl">
                    <?php echo wp_kses_post( $hero_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

    </div>
</section>
