<?php
/**
 * Resources Grid Section
 *
 * @package Chimera
 */

// Query all custom post types for the resources center
$resources_query = new WP_Query([
    'post_type'      => ['post', 'whitepaper', 'casestudies', 'webinar', 'event'],
    'posts_per_page' => -1, // Query all to allow JS pagination to handle it
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
]);
?>

<section id="resources-grid-section" class="w-full pb-16 md:pb-24">

    <div class="container">

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            <?php if ( $resources_query->have_posts() ) : ?>
                <?php while ( $resources_query->have_posts() ) : $resources_query->the_post(); ?>
                    <?php 
                        $post_type = get_post_type();
                        $label = 'BLOG';
                        $link_text = 'Read More';
                        
                        if ( $post_type === 'whitepaper' ) {
                            $label = 'WHITEPAPER';
                            $link_text = 'Download Whitepaper';
                        } elseif ( $post_type === 'casestudies' ) {
                            $label = 'CASE STUDY';
                            $link_text = 'Read Story';
                        } elseif ( $post_type === 'webinar' ) {
                            $label = 'WEBINAR';
                            $link_text = 'Watch Webinar';
                        } elseif ( $post_type === 'event' ) {
                            $label = 'EVENT';
                            $link_text = 'Register Now';
                        }

                        $date = get_the_date( 'F j, Y' );
                        $title = get_the_title();
                        
                        $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $thumbnail ) {
                            // Fallback to placeholder image if no featured image is set
                            $thumbnail = '/wp-content/uploads/2026/06/placeholder.jpg';
                        }
                        
                        // Use actual permalink for each CPT instead of a dummy details page
                        $detail_url = esc_url( get_permalink() );
                    ?>
                    <article
                        class="resource-card bg-white border border-lightGray/80 rounded-[12px] overflow-hidden flex flex-col transition-all duration-300 group hover:border-orange hover:bg-[#FFF6F0]"
                        data-category="<?php echo esc_attr( $label ); ?>"
                    >

                        <!-- Image -->
                        <a href="<?php echo $detail_url; ?>" class="block">
                            <div class="h-[220px] overflow-hidden bg-lightGray/20">
                                <img
                                    src="<?php echo esc_url( $thumbnail ); ?>"
                                    alt="<?php echo esc_attr( $title ); ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                            </div>
                        </a>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">

                            <div class="flex items-center gap-4 mb-4">

                                <span class="inline-flex items-center px-3 py-1.5 bg-orange/10 text-orange border border-orange/20 rounded-[8px] text-[11px] font-semibold uppercase">
                                    <?php echo esc_html( $label ); ?>
                                </span>

                                <span class="text-[#666666] text-xs">
                                    <?php echo esc_html( $date ); ?>
                                </span>

                            </div>

                            <a href="<?php echo $detail_url; ?>" class="block mb-6 flex-1">
                                <h4 class="text-dark text-base md:text-[17px] font-semibold leading-[1.4] transition-colors duration-300 group-hover:text-orange">
                                    <?php echo esc_html( $title ); ?>
                                </h4>
                            </a>

                            <a href="<?php echo $detail_url; ?>" class="text-orange font-bold text-sm flex items-center gap-2 mt-auto">
                                <?php echo esc_html( $link_text ); ?>

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h14M12 5l7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </article>

                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="col-span-full text-center text-gray py-10">No resources found.</p>
            <?php endif; ?>

        </div>

        <!-- Pagination Wrapper (Handled by JS in filters.php) -->
        <div id="resources-pagination" class="flex justify-center items-center gap-3 mt-16">
            <!-- JS will populate this -->
        </div>

    </div>

</section>
