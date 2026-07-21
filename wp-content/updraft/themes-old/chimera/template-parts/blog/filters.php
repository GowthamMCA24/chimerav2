<?php
/**
 * Template part for displaying the category filter bar
 *
 * Generates filter buttons from WordPress post categories
 *
 * @package Chimera
 */

$taxonomy = $args['taxonomy'] ?? 'category';

// Get the ID of the 'uncategorized' category to exclude it (if using default categories)
$exclude_id = '';
if ( $taxonomy === 'category' ) {
    $uncategorized = get_term_by( 'slug', 'uncategorized', $taxonomy );
    $exclude_id = $uncategorized ? $uncategorized->term_id : '';
}

// Get all categories that have posts
$categories = get_terms( array(
    'taxonomy'   => $taxonomy,
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true,
    'exclude'    => $exclude_id,
) );

// Prevent fatal error if taxonomy does not exist or is invalid
if ( is_wp_error( $categories ) ) {
    $categories = array();
}

// Determine the currently active category filter
$active_category = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : '';

// Build the base blog page URL
if ( isset( $args['post_type'] ) && $args['post_type'] !== 'post' ) {
    $blog_page_url = get_post_type_archive_link( $args['post_type'] );
} elseif ( is_home() ) {
    $blog_page_url = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $blog_page_url = get_permalink( get_the_ID() );
}
?>

<section class="w-full pb-6 md:pb-10">
    <div class="container">
        
        <!-- Filter & Search Row -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 pb-2">
            
            <!-- Filter Buttons -->
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide w-full md:w-auto" id="blog-category-filters">
                <!-- "All" Button -->
                <a href="<?php echo esc_url( $blog_page_url ); ?>" 
                   class="category-filter-btn flex-shrink-0 px-[12px] py-[10px] uppercase rounded-[14px] text-xs font-semibold font-sans transition-all duration-200 border-2 <?php echo empty( $active_category ) ? 'bg-orange text-white border-orange hover:text-white' : 'bg-white text-dark border-dark hover:border-orange hover:text-orange'; ?>"
                   data-category="">
                    All
                </a>

                <?php foreach ( $categories as $cat ) : ?>
                    <a href="<?php echo esc_url( add_query_arg( 'category', $cat->slug, $blog_page_url ) ); ?>"
                       class="category-filter-btn flex-shrink-0 px-[12px] py-[10px] uppercase rounded-[14px] text-xs font-semibold font-sans transition-all duration-200 border-2 <?php echo ( $active_category === $cat->slug ) ? 'bg-orange text-white border-orange hover:text-white' : 'bg-white text-dark border-dark hover:border-orange hover:text-orange'; ?>"
                       data-category="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php $search_id_prefix = isset($args['post_type']) ? $args['post_type'] : 'blog'; ?>
            <!-- Search Bar -->
            <?php if ( !isset($args['post_type']) || ( $args['post_type'] !== 'casestudies' && $args['post_type'] !== 'webinar' ) ) : ?>
            <div class="w-full md:w-auto flex-shrink-0">
                <form id="<?php echo esc_attr( $search_id_prefix ); ?>-ajax-search-form" class="ajax-search-form w-full" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-dark">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                        <input id="<?php echo esc_attr( $search_id_prefix ); ?>-ajax-search-input" type="search" class="ajax-search-input w-full md:min-w-[250px] lg:min-w-[320px] pl-11 pr-[20px] py-3 rounded-[14px] border-2 border-dark text-sm font-sans bg-transparent placeholder-gray focus:outline-none focus:border-orange transition-colors duration-200" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                    </div>
                </form>
            </div>
            <?php endif; ?>

        </div>
        
    </div>
</section>
