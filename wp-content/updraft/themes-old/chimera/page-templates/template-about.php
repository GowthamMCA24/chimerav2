<?php
/**
 * Template Name: About Page
 * 
 * A reusable template for the About page.
 * Content is driven by Secure Custom Fields (SCF/ACF).
 *
 * @package Chimera
 */

get_header();
?>

<!-- Main Content Wrapper for About Page -->
<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <?php get_template_part( 'template-parts/about/hero' ); ?>

    <!-- Our Story Section -->
    <?php get_template_part( 'template-parts/about/story' ); ?>

    <!-- Mission and Vision Section -->
    <?php get_template_part( 'template-parts/about/mission-vision' ); ?>
    
    <!-- Milestones Section -->
    <?php get_template_part( 'template-parts/about/milestones' ); ?>

    <!-- Meet the Founders Section -->
    <?php get_template_part( 'template-parts/about/founders' ); ?>

    <!-- Culture Quote Section -->
    <?php get_template_part( 'template-parts/about/culture-quote' ); ?>

    <!-- Our Values Section -->
    <?php get_template_part( 'template-parts/about/values' ); ?>

    <!-- Global Presence Section (Reused from Home) -->
    <?php get_template_part( 'template-parts/home/presence' ); ?>

    <!-- Compliance Section (Specific to About) -->
    <?php get_template_part( 'template-parts/about/compliance' ); ?>

    <!-- CTA Section (Reused from Home) -->
    <?php 
    $about_cta = get_field('about_cta_section');
    $c_args = [];
    if ( $about_cta ) {
        $c_args['cta_badge'] = $about_cta['cta_badge'] ?? null;
        $c_args['cta_title'] = $about_cta['title'] ?? null;
        $c_args['cta_desc']  = $about_cta['desc'] ?? null;
        $c_args['cta_title_class']  = $about_cta['cta_title_class'] ?? null;
        $c_args['cta_desc_class']  = $about_cta['cta_desc_class'] ?? null;
        
        $c_args['cta_btn_text'] = $about_cta['btn']['title'] ?? $about_cta['btn']['text'] ?? null;
        $c_args['cta_btn_link'] = $about_cta['btn']['url'] ?? $about_cta['btn']['link'] ?? null;

        // Optionally, support a background image for the CTA
        if ( !empty($about_cta['bg_image']) ) {
            if ( is_array($about_cta['bg_image']) ) {
                $c_args['cta_bg_image'] = $about_cta['bg_image']['url'];
            } else {
                $c_args['cta_bg_image'] = wp_get_attachment_image_url($about_cta['bg_image'], 'full');
            }
        }
    }
    
    $c_args = array_filter($c_args);
    get_template_part( 'template-parts/home/cta', null, $c_args ); 
    ?>

</main>

<?php
get_footer();
