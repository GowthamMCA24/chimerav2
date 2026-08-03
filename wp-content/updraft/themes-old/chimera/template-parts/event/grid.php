<?php
/**
 * Event Grid Template
 *
 * @package Chimera
 */

$post_type = $args['post_type'] ?? 'event';

$events_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => -1, // We load all and let JS paginate/filter
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$events_query = new WP_Query( $events_args );
?>

<section class="w-full pb-[60px] md:pb-[80px] pt-[60px] relative z-10" id="events-grid-section">
    <div class="container">
        
        <div class="flex flex-col gap-[30px] w-full items-start relative">
            <?php if ( $events_query->have_posts() ) : ?>
                <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
                    
                    <?php get_template_part( 'template-parts/event/card' ); ?>

                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center py-16 text-gray font-sans w-full">
                    <p class="text-lg font-semibold text-dark mb-2">No events found</p>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>

        <!-- Pagination Container (Handled by JS) -->
        <div id="events-pagination" class="flex justify-center items-center gap-2 mt-12 w-full"></div>
        
    </div>
</section>
