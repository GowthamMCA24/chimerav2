<?php
/**
 * Template Name: Resources Page
 * 
 * The template for displaying the resources page
 *
 * @package Chimera
 */

get_header();
?>

<!-- Main Content Wrapper for Resources Page -->
<main id="primary" class="site-main overflow-hidden">
    
    <!-- Hero Section -->
    <?php 
    // Try fetching from the Options page first, then fallback to current page fields, then hardcoded text
    $hero = get_field('hero_section');
    $hero_title = $hero['title'] ?: '';
    $hero_desc  = $hero['desc'] ?: '';
    $hero_bg  = $hero['bg'] ?: '';

    get_template_part( 'template-parts/blog/hero', null, [
        'hero_title' => $hero_title,
        'hero_desc'  => $hero_desc,
        'hero_bg'    => $hero_bg,
        'hide_hero'  => $hero['hide_hero_section'] ?? false
    ] ); 
    ?>

    <!-- Featured Resources Section  -->
    <?php  get_template_part( 'template-parts/resources/featured' ); ?>

    <!-- Resources Filters Section -->
    <?php get_template_part( 'template-parts/resources/filters' ); ?>

    <!-- Resources Grid Section -->
    <?php get_template_part( 'template-parts/resources/grid' ); ?>

   
    <!-- CTA Section -->
    <?php 
    $cta = get_field('cta_section');
    $cta_args = [];
    
    if ( $cta ) {
        $btn_text = '';
        $btn_link = '';

        if ( !empty($cta['btn']) && is_array($cta['btn']) ) {
            $btn_text = $cta['btn']['text'] ?? '';
            $btn_link = $cta['btn']['link'] ?? '';
        }

        $cta_args = [
            'cta_badge'    => $cta['cta_badge'] ?? '',
            'cta_title'    => $cta['title'] ?? '',
            'cta_desc'     => $cta['desc'] ?? '',
            'cta_btn_text' => $btn_text,
            'cta_btn_link' => $btn_link
        ];
        // Remove empty keys so defaults can still kick in if a field is empty
        $cta_args = array_filter($cta_args);
    } 
    
    get_template_part( 'template-parts/home/cta', null, $cta_args ); 
    ?>

</main>

<?php
get_footer();
