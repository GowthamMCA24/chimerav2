<?php
/**
 * Template Name: Services Page
 * 
 * A reusable template for service-specific landing pages (e.g., Testing Services).
 * Content is driven by Secure Custom Fields (SCF/ACF).
 *
 * @package Chimera
 */

get_header();
?>

<!-- Main Content Wrapper for Services Page -->
<main id="primary" class="site-main">
    
    <!-- Hero Section (Reused from Industry) with Marquee before stats -->
    <?php 
    $services_hero = get_field('services_hero');
    get_template_part( 'template-parts/industry/hero', null, [
        'hero_data' => $services_hero,
        'inject_before_stats' => 'template-parts/components/logo-marquee'
    ] ); 
    ?>

    <!-- Comparison Section -->
    <?php get_template_part( 'template-parts/services/comparison' ); ?>

    <!-- Engineering Framework Section -->
    <?php get_template_part( 'template-parts/services/framework' ); ?>

    <!-- Services Offerings Section -->
    <?php get_template_part( 'template-parts/services/offerings' ); ?>

    <!-- Testimonials Section -->
    <?php 
    $services_testimonials = get_field('industry_testimonials');
    $t_args = [];
    if ( $services_testimonials ) {
        $t_args['badge'] = $services_testimonials['badge_text'] ?? null;
        
        $heading_parts = [];
        if (!empty($services_testimonials['heading_line1'])) $heading_parts[] = $services_testimonials['heading_line1'];
        if (!empty($services_testimonials['heading_highlight'])) $heading_parts[] = '<span class="text-orange">' . $services_testimonials['heading_highlight'] . '</span>';
        if (!empty($heading_parts)) $t_args['heading'] = implode(' <br class="sm:hidden">', $heading_parts);
        
        $t_args['testimonials'] = $services_testimonials['items'] ?? null;
    }
    // Fallback support for un-grouped fields
    $t_args['badge'] = $t_args['badge'] ?? get_field('testimonials_badge');
    $t_args['heading'] = $t_args['heading'] ?? get_field('testimonials_heading');
    $t_args['testimonials'] = $t_args['testimonials'] ?? get_field('testimonials');
    
    $t_args = array_filter($t_args);
    get_template_part( 'template-parts/home/testimonials', null, $t_args ); 
    ?>

    <!-- CTA Section -->
    <?php 
    $services_cta = get_field('cta_section');
    $c_args = [];
    if ( $services_cta ) {
        $c_args['cta_badge'] = $services_cta['cta_badge'] ?? null;
        $c_args['cta_title'] = $services_cta['title'] ?? null;
        $c_args['cta_desc']  = $services_cta['desc'] ?? null;
        $c_args['cta_title_class']  = $services_cta['cta_title_class'] ?? null;
        
        // Handle if 'btn' is an ACF Link Array or custom group
        $c_args['cta_btn_text'] = $services_cta['btn']['title'] ?? $services_cta['btn']['text'] ?? null;
        $c_args['cta_btn_link'] = $services_cta['btn']['url'] ?? $services_cta['btn']['link'] ?? null;
    }
    
    $c_args = array_filter($c_args);
    get_template_part( 'template-parts/home/cta', null, $c_args ); 
    ?>

</main>

<?php
get_footer();
