<?php
/**
 * The template for displaying single whitepaper posts
 *
 * @package Chimera
 */

get_header();
?>

<!-- Main Content Wrapper for Single Whitepaper Post -->
<main id="blog-single" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>
    
        <!-- Single Post Hero Section -->
        <?php get_template_part( 'template-parts/blog/single-hero' ); ?>

        <!-- Single Post Content -->
        <?php get_template_part( 'template-parts/blog/single-content' ); ?>

        <!-- Related Posts Section -->
        <?php get_template_part( 'template-parts/blog/related-posts' ); ?>

    <?php endwhile; ?>

    <!-- CTA Section -->
    <?php 
        $industry_cta = get_field('cta_section');
        $c_args = [];
        if ( $industry_cta ) {
            $c_args['cta_badge'] = $industry_cta['cta_badge'] ?? null;
            $c_args['cta_title'] = $industry_cta['title'] ?? null;
            $c_args['cta_desc']  = $industry_cta['desc'] ?? null;
            $c_args['cta_title_class']  = $industry_cta['cta_title_class'] ?? null;
            $c_args['cta_desc_class']  = $industry_cta['cta_desc_class'] ?? null;
            
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
