<?php
/**
 * Template part for displaying related posts
 *
 * Shows posts from the same category, excluding the current post
 *
 * @package Chimera
 */

$post_type = get_post_type();
if ( $post_type === 'whitepaper' ) {
    $taxonomy = 'whitepaper_category';
} elseif ( $post_type === 'casestudies' ) {
    $taxonomy = 'casestudies_category';
} elseif ( $post_type === 'webinar' ) {
    $taxonomy = 'webinar_category';
} else {
    $taxonomy = 'category';
}
$categories = get_the_terms( get_the_ID(), $taxonomy );
$current_post_id = get_the_ID();

if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
    $category_ids = wp_list_pluck( $categories, 'term_id' );

    $related_args = array(
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'post__not_in'   => array( $current_post_id ),
        'tax_query'      => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $category_ids,
            ),
        ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $related_query = new WP_Query( $related_args );

    if ( $related_query->have_posts() ) :
?>

<section class="w-full bg-white pb-[100px] md:pb-[80px]">
    <div class="container">
        
        <!-- Section Header -->
       <div class="mb-10">
    <h2 class="text-dark font-jost text-[28px] md:text-[32px] font-semibold leading-tight">
        <?php 
            if ( $post_type === 'whitepaper' ) {
                echo 'Related Whitepapers';
            } elseif ( $post_type === 'casestudies' ) {
                echo 'Related Case Studies';
            } elseif ( $post_type === 'webinar' ) {
                echo 'Related Webinars';
            } else {
                echo 'Related Blogs';
            }
        ?>
    </h2>
</div>


        <!-- Related Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-[30px]">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <?php get_template_part( 'template-parts/blog/card' ); ?>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php
    endif;
    wp_reset_postdata();
}
?>
