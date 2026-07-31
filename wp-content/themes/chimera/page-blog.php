<?php
/**
 * Template Name: Blog
 * 
 * The template for displaying the blog listing page
 *
 * @package Chimera
 */

get_header();
?>

<!-- Main Content Wrapper for Blog Listing Page -->
<main id="blog-listing" class="site-main overflow-hidden">
    
<?php
// Setup arguments for reusable template parts
$archive_args = array(
    'post_type' => 'post',
    'taxonomy'  => 'category',
);

// Fetch dynamic Hero & CTA fields
if ( function_exists('get_field') ) {
    $page_id = get_the_ID();
    
    $hero = get_field('hero_section', $page_id);
    if ( ! empty( $hero['title'] ) ) $archive_args['hero_title'] = $hero['title'];
    if ( ! empty( $hero['desc'] ) )  $archive_args['hero_desc']  = $hero['desc'];
    if ( ! empty( $hero['bg'] ) )    $archive_args['hero_bg']    = $hero['bg'];
    if ( isset( $hero['hide_hero_section'] ) ) $archive_args['hide_hero'] = $hero['hide_hero_section'];

    $cta = get_field('cta_section', $page_id);
    if ( ! empty( $cta['title'] ) ) $archive_args['cta_title'] = $cta['title'];
    if ( ! empty( $cta['desc'] ) )  $archive_args['cta_desc']  = $cta['desc'];
    if ( ! empty( $cta['cta_badge'] ) ) $archive_args['cta_badge'] = $cta['cta_badge'];
    // Handle the CTA button fields
    if ( ! empty( $cta['btn'] ) ) {
        if ( is_array( $cta['btn'] ) ) {
            $archive_args['cta_btn_text'] = $cta['btn']['text'] ?? ( $cta['btn']['title'] ?? '' );
            $archive_args['cta_btn_link'] = $cta['btn']['link'] ?? ( $cta['btn']['url'] ?? '' );
        }
    }
}
?>


    
    <?php get_template_part( 'template-parts/blog/hero', null, $archive_args ); ?>

    <!-- Featured Post -->
    <?php get_template_part( 'template-parts/blog/featured', null, $archive_args ); ?>

    <!-- Category Filter Bar -->
    <?php get_template_part( 'template-parts/blog/filters', null, $archive_args ); ?>

    <!-- Blog Posts Grid -->
    <div id="ajax-grid-wrapper" data-post-type="<?php echo esc_attr( $archive_args['post_type'] ); ?>" data-taxonomy="<?php echo esc_attr( $archive_args['taxonomy'] ); ?>">
        <?php get_template_part( 'template-parts/blog/grid', null, $archive_args ); ?>
    </div>

    <!-- CTA Section (Reused from Home) -->
    <?php 
    $archive_args['cta_title_class'] = 'max-w-[300px] sm:max-w-3xl';
    $archive_args['cta_desc_class'] = 'max-w-[300px] sm:max-w-[828px]';
    get_template_part( 'template-parts/home/cta', null, $archive_args ); 
    ?>

</main>

<?php
get_footer();
