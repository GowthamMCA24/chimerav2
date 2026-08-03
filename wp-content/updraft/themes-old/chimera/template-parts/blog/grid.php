<?php
/**
 * Template part for displaying the blog posts grid with pagination
 *
 * @package Chimera
 */

// Pagination
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
if ( isset( $_POST['paged'] ) ) {
    $paged = absint( $_POST['paged'] );
}

// Category filter
$active_category = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : '';
if ( isset( $_POST['category'] ) ) {
    $active_category = sanitize_text_field( $_POST['category'] );
}

// Search
$active_search = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
if ( isset( $_POST['s'] ) ) {
    $active_search = sanitize_text_field( $_POST['s'] );
}

$post_type = $args['post_type'] ?? 'post';
$taxonomy  = $args['taxonomy'] ?? 'category';

// Build query args
$grid_args = array(
    'post_type'      => $post_type,
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Exclude the featured/sticky post from the grid
$sticky_posts = get_option( 'sticky_posts' );
if ( ! empty( $sticky_posts ) && $post_type === 'post' ) {
    $grid_args['post__not_in'] = $sticky_posts;
    $grid_args['ignore_sticky_posts'] = 1;
}

// Apply category filter
if ( ! empty( $active_category ) ) {
    $grid_args['tax_query'] = array(
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $active_category,
        ),
    );
}

// Apply search filter
if ( ! empty( $active_search ) ) {
    $grid_args['s'] = $active_search;
}

$grid_query = new WP_Query( $grid_args );
?>

<section class="w-full pb-[60px] md:pb-[80px]">
    <div class="container">
        
        <?php if ( $grid_query->have_posts() ) : ?>
        
            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="blog-posts-grid">
                <?php while ( $grid_query->have_posts() ) : $grid_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/blog/card' ); ?>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <?php if ( $grid_query->max_num_pages > 1 ) : ?>
                <div class="flex items-center justify-center gap-2 mt-12 md:mt-16" id="blog-pagination">
                    <?php
                    // Previous Button
                    if ( $paged > 1 ) {
                        $prev_link = get_pagenum_link( $paged - 1 );
                        if ( ! empty( $active_category ) ) {
                            $prev_link = add_query_arg( 'category', $active_category, $prev_link );
                        }
                        $prev_class = "ajax-pagination-link hover:text-orange hover:border-orange";
                    } else {
                        $prev_link  = '#';
                        $prev_class = "cursor-not-allowed pointer-events-none";
                    }
                    ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>" 
                       <?php if ( $paged > 1 ) echo 'data-page="' . esc_attr( $paged - 1 ) . '"'; ?>
                       class="py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark transition-all duration-300 <?php echo esc_attr( $prev_class ); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 5L5 12L12 19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    <?php
                    // Page Numbers
                    $total_pages = $grid_query->max_num_pages;
                    $range = 2; // Show 2 pages around current
                    
                    for ( $i = 1; $i <= $total_pages; $i++ ) :
                        if ( $i == 1 || $i == $total_pages || ( $i >= $paged - $range && $i <= $paged + $range ) ) :
                            $page_link = get_pagenum_link( $i );
                            if ( ! empty( $active_category ) ) {
                                $page_link = add_query_arg( 'category', $active_category, $page_link );
                            }
                    ?>
                            <a href="<?php echo esc_url( $page_link ); ?>" 
                               data-page="<?php echo esc_attr( $i ); ?>"
                               class="ajax-pagination-link flex items-center justify-center text-sm font-semibold font-sans transition-all duration-300 <?php echo ( $i === $paged ) ? 'py-[16px] px-5 rounded-[16px] bg-orange text-white' : 'py-[16px] px-5 rounded-[16px] border-2 border-dark text-dark hover:border-orange hover:text-orange'; ?>">
                                <?php echo esc_html( $i ); ?>
                            </a>
                    <?php
                        elseif ( $i == $paged - $range - 1 || $i == $paged + $range + 1 ) :
                    ?>
                            <span class="py-[16px] px-5 flex items-center justify-center text-gray text-sm">...</span>
                    <?php
                        endif;
                    endfor;
                    ?>

                    <?php
                    // Next Button
                    if ( $paged < $total_pages ) {
                        $next_link = get_pagenum_link( $paged + 1 );
                        if ( ! empty( $active_category ) ) {
                            $next_link = add_query_arg( 'category', $active_category, $next_link );
                        }
                        $next_class = "ajax-pagination-link hover:text-orange hover:border-orange";
                    } else {
                        $next_link  = '#';
                        $next_class = "cursor-not-allowed pointer-events-none";
                    }
                    ?>
                    <a href="<?php echo esc_url( $next_link ); ?>" 
                       <?php if ( $paged < $total_pages ) echo 'data-page="' . esc_attr( $paged + 1 ) . '"'; ?>
                       class="py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark transition-all duration-300 <?php echo esc_attr( $next_class ); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 5L19 12L12 19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <!-- No Posts Found -->
            <div class="text-center py-20">
                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-lightGray flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray/40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold mb-3 font-jost">No Posts Found</h3>
                <p class="text-gray font-sans font-normal text-sm max-w-md mx-auto">
                    <?php if ( ! empty( $active_category ) ) : ?>
                        No posts found in this category. Try selecting a different category or browse all posts.
                    <?php else : ?>
                        No blog posts have been published yet. Check back soon for updates!
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>
