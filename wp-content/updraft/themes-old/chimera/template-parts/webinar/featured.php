<?php
/**
 * Template part for displaying the featured webinar
 *
 * Two-column layout: Left image + Right content with status badge,
 * title, date/time with clock icon, and Register Now CTA.
 *
 * @package Chimera
 */

$post_type = $args['post_type'] ?? 'webinar';

// Get the featured webinar — latest upcoming first, then fallback to latest
$featured_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'meta_key'       => 'webinar_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'webinar_date',
            'value'   => date( 'Y-m-d H:i:s' ),
            'compare' => '>=',
            'type'    => 'DATETIME',
        ),
    ),
);

$featured_query = new WP_Query( $featured_args );

// If no upcoming webinar, get the latest one
if ( ! $featured_query->have_posts() ) {
    $featured_args = array(
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $featured_query = new WP_Query( $featured_args );
}

?>

<section class="w-full pb-10 md:pb-[60px] pt-10 relative z-10">
    <div class="container">
        
        <?php if ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
            <?php
                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if ( ! $featured_image ) {
                    $featured_image = '/wp-content/uploads/2026/06/placeholder.jpg';
                }
                
                $categories   = chimera_get_post_categories();
                $is_upcoming  = false;
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $cat ) {
                        if ( strtolower( $cat->name ) === 'upcoming' || strtolower( $cat->slug ) === 'upcoming' ) {
                            $is_upcoming = true;
                            break;
                        }
                    }
                }
                
                $webinar_date     = get_field( 'webinar_date' );
                $registration_url = get_field( 'registration_url' ) ?: get_permalink();
            ?>
            
            <!-- Featured Webinar Hero Card -->
            <div class="flex flex-col md:flex-row gap-8 md:gap-14 items-stretch">
                
                <!-- Left: Image -->
                <div class="w-full md:w-[55%]">
                    <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden rounded-[20px] group h-full bg-white">
                        <img src="<?php echo esc_url( $featured_image ); ?>" 
                             alt="<?php the_title_attribute(); ?>" 
                             class="w-full h-[250px] md:h-full object-cover rounded-[20px] group-hover:scale-105 transition-transform duration-500">
                    </a>
                </div>
                
                <!-- Right: Content -->
                <div class="w-full md:w-[45%] flex flex-col gap-10">
                    <div class="flex-1 flex flex-col gap-[30px]">
                        <!-- Status Badge -->
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1.5 bg-white border border-orange/20 rounded-[8px] text-orange font-jost text-xs font-semibold uppercase tracking-wider">
                                <?php echo $is_upcoming ? 'Upcoming' : 'Past'; ?>
                            </span>
                        </div>
                        
                        <!-- Title -->
                        <a href="<?php the_permalink(); ?>" class="group block">
                            <h2 class="text-dark text-2xl md:text-[28px] lg:text-[32px] font-semibold font-jost leading-[1.1] tracking-[-0.12px] group-hover:text-orange transition-colors duration-300">
                                <?php the_title(); ?>
                            </h2>
                        </a>
                        
                        <!-- Date/Time Row -->
                        <div class="flex items-center gap-[10px]">
                            <!-- Clock Icon -->
                            <div class="w-10 h-10 rounded-full bg-white border border-orange shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.332 11.6667V13.5L14.6654 14.3333" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.332 1.66666V4.99999" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.5 6.25001V5.00001C17.5 4.55798 17.3244 4.13406 17.0118 3.8215C16.6993 3.50894 16.2754 3.33334 15.8333 3.33334H4.16667C3.72464 3.33334 3.30072 3.50894 2.98816 3.8215C2.67559 4.13406 2.5 4.55798 2.5 5.00001V16.6667C2.5 17.1087 2.67559 17.5326 2.98816 17.8452C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H7.08333" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.5 8.33334H6.66667" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66797 1.66666V4.99999" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.332 18.3333C16.0935 18.3333 18.332 16.0948 18.332 13.3333C18.332 10.5719 16.0935 8.33334 13.332 8.33334C10.5706 8.33334 8.33203 10.5719 8.33203 13.3333C8.33203 16.0948 10.5706 18.3333 13.332 18.3333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p class="text-gray font-sans text-sm font-semibold leading-[1.5]">
                                <?php echo esc_html(  $webinar_date ); ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Register Now / Watch Now CTA Button -->
                    <div>
                        <a href="<?php echo esc_url( $is_upcoming ? $registration_url : get_permalink() ); ?>" 
                        class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                            <?php echo $is_upcoming ? 'Register Now' : 'Watch Now'; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>
