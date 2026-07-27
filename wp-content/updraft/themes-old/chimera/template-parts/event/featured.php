<?php
/**
 * Template part for displaying the featured event
 *
 * @package Chimera
 */

$post_type = $args['post_type'] ?? 'event';

// Get the featured event — latest upcoming first, then fallback to latest
$featured_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$featured_query = new WP_Query( $featured_args );
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
                $cat_name = 'Featured';
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $cat ) {
                        if ( strtolower( $cat->name ) === 'upcoming' || strtolower( $cat->slug ) === 'upcoming' ) {
                            $is_upcoming = true;
                            $cat_name = 'Upcoming';
                            break;
                        } elseif ( strtolower( $cat->name ) === 'completed' || strtolower( $cat->slug ) === 'completed' ) {
                            $cat_name = 'Completed';
                            break;
                        }
                    }
                }
                
                $event_date  = get_field( 'event_date' ) ?: 'Date TBA';
                $event_venue = get_field( 'event_venue' ) ?: 'Venue TBA';
                $registration_url = get_field( 'event_registration_link' ) ?: get_permalink();
            ?>
            
            <div class="border border-orange border-solid flex flex-col lg:flex-row gap-10 items-stretch overflow-hidden p-[20px] sm:p-[30px] relative rounded-[10px]" style="background-image: linear-gradient(90deg, rgba(255, 74, 3, 0.1) 0%, rgba(255, 74, 3, 0.1) 100%), linear-gradient(90deg, rgb(255, 255, 255) 0%, rgb(255, 255, 255) 100%)">
                
                <!-- Left: Image -->
                <div class="flex flex-col items-center self-center justify-center overflow-hidden relative rounded-[20px] w-full lg:w-1/2 shrink-0">
                    <a href="<?php the_permalink(); ?>" class="block size-full group">
                        <img src="<?php echo esc_url( $featured_image ); ?>" 
                             alt="<?php the_title_attribute(); ?>" 
                             class="w-full h-auto group-hover:scale-105 transition-transform duration-500">
                    </a> 
                </div>
                
                <!-- Right: Content -->
                <div class="flex flex-col gap-[30px] items-start relative w-full lg:w-1/2">
                    
                    <!-- Status Badge -->
                    <div class="flex items-center">
                        <div class="bg-white border border-orange/20 border-solid flex gap-2 h-8 items-center justify-center px-3 py-0 relative rounded-lg">
                            <span class="font-jost font-semibold text-orange text-xs text-center uppercase tracking-wider">
                                <?php echo esc_html( $cat_name ); ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Title & Excerpt -->
                    <div class="flex flex-col gap-2.5 items-start relative w-full">
                        <a href="<?php the_permalink(); ?>" class="group block">
                            <h2 class="font-jost font-semibold text-dark text-2xl md:text-[32px] leading-[1.2] md:leading-[1.1] tracking-[-0.12px] group-hover:text-orange transition-colors duration-300">
                                <?php the_title(); ?>
                            </h2>
                        </a>
                        <p class="font-sans font-normal leading-[1.5] text-gray text-sm md:text-base w-full max-w-[550px]">
                            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                        </p>
                    </div>
                    
                    <!-- Date & Venue -->
                    <div class="flex flex-col xl:flex-row gap-5 items-start xl:items-center relative w-full">
                        <!-- Date -->
                        <div class="flex flex-[1_0_0] gap-2.5 items-center relative">
                            <div class="bg-white border border-orange border-solid flex items-center justify-center h-10 w-10 overflow-hidden relative rounded-full shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M6.66797 1.66669V5.00002" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.332 1.66669V5.00002" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.8333 3.33331H4.16667C3.24619 3.33331 2.5 4.07951 2.5 4.99998V16.6666C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6666V4.99998C17.5 4.07951 16.7538 3.33331 15.8333 3.33331Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.5 8.33331H17.5" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66797 11.6667H6.67672" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 11.6667H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.332 11.6667H13.3408" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66797 15H6.67672" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 15H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.332 15H13.3408" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex flex-[1_0_0] flex-col items-start leading-[1.5] relative text-sm">
                                <p class="font-sans font-normal text-sm text-gray w-full">Date</p>
                                <p class="font-sans text-sm font-semibold text-dark w-full"><?php echo esc_html( $event_date ); ?></p>
                            </div>
                        </div>
                        
                        <!-- Venue -->
                        <div class="flex flex-[1_0_0] gap-2.5 items-center relative">
                            <div class="bg-white border border-orange border-solid flex items-center justify-center h-10 w-10 overflow-hidden relative rounded-full shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10.0007 10.8333C11.3814 10.8333 12.5007 9.71405 12.5007 8.33334C12.5007 6.95263 11.3814 5.83334 10.0007 5.83334C8.61994 5.83334 7.50065 6.95263 7.50065 8.33334C7.50065 9.71405 8.61994 10.8333 10.0007 10.8333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6673 8.33333C16.6673 14.1667 10.0007 19.1667 10.0007 19.1667C10.0007 19.1667 3.33398 14.1667 3.33398 8.33333C3.33398 6.56522 4.03636 4.86953 5.2866 3.61929C6.53685 2.36904 8.23254 1.66666 10.0007 1.66666C11.7688 1.66666 13.4645 2.36904 14.7147 3.61929C15.965 4.86953 16.6673 6.56522 16.6673 8.33333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex flex-[1_0_0] flex-col items-start leading-[1.5] relative text-sm">
                                <p class="font-sans font-normal text-sm text-gray w-full">Venue</p>
                                <p class="font-sans text-sm font-semibold text-dark w-full"><?php echo esc_html( $event_venue ); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <div class="flex items-start w-full relative mt-auto pt-4 md:pt-[10px]">
                        <?php if ( $is_upcoming ) : ?>
                        <a href="<?php echo esc_url( $registration_url ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                            <span class="font-sans font-semibold text-[16px] leading-none whitespace-nowrap">Register Now</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M0.75 4.75H13.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <?php else : ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="bg-dark hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                            <span class="font-sans font-semibold text-[16px] leading-none whitespace-nowrap">Know More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M0.75 4.75H13.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
            
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>
