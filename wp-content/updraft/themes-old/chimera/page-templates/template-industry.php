<?php
/**
 * Template Name: Industry Page
 * 
 * A reusable template for industry-specific landing pages.
 * Content is driven by Secure Custom Fields (SCF/ACF).
 *
 * @package Chimera
 */
$show_expertise = get_field('expertise_content') ?: [];

get_header();
?>

<!-- Main Content Wrapper for Industry Page -->
<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <?php get_template_part( 'template-parts/industry/hero' ); ?>

    <!-- Trusted By Logos -->
    <?php get_template_part('template-parts/components/logo-marquee'); ?>

    <!-- Industry Challenges Section -->
    <?php get_template_part( 'template-parts/industry/challenges' ); ?>
    
    <!-- Solutions Section -->
    <?php get_template_part( 'template-parts/industry/solutions' ); ?>
    
    <!-- Expertise Section (Conditional) -->
    <?php if ( $show_expertise['show_expertise_section'] ?? "" ) : ?>
        <?php get_template_part( 'template-parts/industry/expertise' ); ?>
    <?php endif; ?>
    
    <!-- Engagement Models Section -->
    <?php get_template_part( 'template-parts/industry/engagement' ); ?>

    <!-- Testimonials Section -->
    <?php 
    $industry_testimonials = get_field('industry_testimonials');
    $t_args = [];
    if ( $industry_testimonials ) {
        $t_args['badge'] = $industry_testimonials['badge_text'] ?? null;
        
        $heading_parts = [];
        if (!empty($industry_testimonials['heading_line1'])) $heading_parts[] = $industry_testimonials['heading_line1'];
        if (!empty($industry_testimonials['heading_highlight'])) $heading_parts[] = '<span class="text-orange">' . $industry_testimonials['heading_highlight'] . '</span>';
        if (!empty($heading_parts)) $t_args['heading'] = implode(' <br class="sm:hidden">', $heading_parts);
        
        $t_args['testimonials'] = $industry_testimonials['items'] ?? null;
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
    $industry_cta = get_field('cta_section');
    $c_args = [];
    if ( $industry_cta ) {
        $c_args['cta_badge'] = $industry_cta['cta_badge'] ?? null;
        $c_args['cta_title'] = $industry_cta['title'] ?? null;
        $c_args['cta_desc']  = $industry_cta['desc'] ?? null;
        $c_args['cta_title_class']  = $industry_cta['cta_title_class'] ?? null;
        
        // Handle if 'btn' is an ACF Link Array or custom group
        $c_args['cta_btn_text'] = $industry_cta['btn']['title'] ?? $industry_cta['btn']['text'] ?? null;
        $c_args['cta_btn_link'] = $industry_cta['btn']['url'] ?? $industry_cta['btn']['link'] ?? null;
    }
    
    $c_args = array_filter($c_args);
    get_template_part( 'template-parts/home/cta', null, $c_args ); 
    ?>

</main>

<?php
get_footer();
