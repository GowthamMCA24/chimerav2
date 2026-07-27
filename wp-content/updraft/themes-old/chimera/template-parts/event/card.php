<?php
/**
 * Template part for displaying an event card in the grid
 *
 * @package Chimera
 */

$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
if ( ! $featured_image ) {
    $featured_image = '/wp-content/uploads/2026/06/placeholder.jpg';
}

$categories   = chimera_get_post_categories();
$is_upcoming  = false;
$cat_name = ''; // Default
if ( ! empty( $categories ) ) {
    foreach ( $categories as $cat ) {
        if ( strtolower( $cat->name ) === 'upcoming' || strtolower( $cat->slug ) === 'upcoming' ) {
            $is_upcoming = true;
            $cat_name = 'Upcoming';
            break;
        } elseif ( strtolower( $cat->name ) === 'completed' || strtolower( $cat->slug ) === 'completed' ) {
            $cat_name = 'Completed';
            break;
        } else {
            $cat_name = $cat->name;
        }
    }
}

$event_date  = get_field( 'event_date' ) ?: 'Date TBA';
$event_venue = get_field( 'event_venue' ) ?: 'Venue TBA';
$registration_url = get_field( 'event_registration_link' ) ?: get_permalink();
?>

<!-- Individual Event Card -->
<div class="event-card bg-white border border-orange border-solid flex flex-col lg:flex-row gap-5 lg:gap-[40px] items-stretch overflow-hidden p-5 relative rounded-[10px] w-full" data-category="<?php echo esc_attr( $cat_name ); ?>">
    
    <!-- Image -->
    <div class="bg-white flex flex-col h-[200px] sm:h-[250px] lg:h-[220px] items-center justify-center overflow-hidden relative rounded-[20px] w-full lg:w-[350px] shrink-0">
        <a href="<?php the_permalink(); ?>" class="block size-full group">
            <img src="<?php echo esc_url( $featured_image ); ?>" 
                 alt="<?php the_title_attribute(); ?>" 
                 class="absolute inset-0 size-full group-hover:scale-105 transition-transform duration-500">
        </a>
    </div>
    
    <!-- Right Side: Row -->
    <div class="flex lg:flex-1 flex-col xl:flex-row items-stretch xl:items-end self-stretch gap-5 lg:gap-8 w-full">
        
        <!-- Left Column of Right Side: Content -->
        <div class="flex xl:flex-1 flex-col gap-[20px] items-start relative w-full pt-2 lg:pt-0">
            
            <!-- Status Badge -->
            <div class="flex items-center">
                <div class="bg-white border border-orange/20 border-solid flex gap-[8px] h-[32px] items-center justify-center px-[12px] py-0 relative rounded-[8px]">
                    <span class="font-jost font-semibold text-orange text-[12px] text-center uppercase tracking-wider leading-[18px]">
                        <?php echo esc_html( $cat_name ); ?>
                    </span>
                </div>
            </div>
            
            <!-- Title & Excerpt -->
            <div class="flex flex-col gap-[10px] items-start relative w-full">
                <a href="<?php the_permalink(); ?>" class="group block w-full">
                    <h3 class="font-jost font-semibold text-dark text-xl md:text-2xl lg:text-[20px] leading-[1.2] tracking-[-0.12px] group-hover:text-orange transition-colors duration-300 line-clamp-2">
                        <?php the_title(); ?>
                    </h3>
                </a>
                <p class="font-sans font-normal leading-[1.5] text-gray text-sm md:text-base lg:text-sm w-full line-clamp-2">
                    <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                </p>
            </div>
            
            <!-- Date & Venue -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-[20px] items-start mt-auto sm:items-center relative w-full">
                
                <!-- Date -->
                <div class="flex flex-[1_0_0] gap-[10px] items-center relative w-full sm:w-auto">
                    <div class="bg-white border border-orange border-solid flex items-center justify-center h-[40px] w-[40px] min-h-[32px] min-w-[32px] overflow-hidden relative rounded-[50px] shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M6.66797 1.66663V4.99996" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.332 1.66663V4.99996" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.8333 3.33337H4.16667C3.24619 3.33337 2.5 4.07957 2.5 5.00004V16.6667C2.5 17.5872 3.24619 18.3334 4.16667 18.3334H15.8333C16.7538 18.3334 17.5 17.5872 17.5 16.6667V5.00004C17.5 4.07957 16.7538 3.33337 15.8333 3.33337Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2.5 8.33337H17.5" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.66797 11.6666H6.67672" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 11.6666H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.332 11.6666H13.3408" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.66797 15H6.67672" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 15H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.332 15H13.3408" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col items-start leading-[1.5] relative">
                        <p class="font-sans font-normal text-xs sm:text-sm text-gray w-full">Date</p>
                        <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1"><?php echo esc_html( $event_date ); ?></p>
                    </div>
                </div>
                
                <!-- Venue -->
                <div class="flex flex-[1_0_0] gap-[10px] items-center relative w-full sm:w-auto">
                    <div class="bg-white border border-orange border-solid flex items-center justify-center h-[40px] w-[40px] min-h-[32px] min-w-[32px] overflow-hidden relative rounded-[50px] shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10.0007 10.8333C11.3814 10.8333 12.5007 9.71405 12.5007 8.33334C12.5007 6.95263 11.3814 5.83334 10.0007 5.83334C8.61994 5.83334 7.50065 6.95263 7.50065 8.33334C7.50065 9.71405 8.61994 10.8333 10.0007 10.8333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.6673 8.33333C16.6673 14.1667 10.0007 19.1667 10.0007 19.1667C10.0007 19.1667 3.33398 14.1667 3.33398 8.33333C3.33398 6.56522 4.03636 4.86953 5.2866 3.61929C6.53685 2.36904 8.23254 1.66666 10.0007 1.66666C11.7688 1.66666 13.4645 2.36904 14.7147 3.61929C15.965 4.86953 16.6673 6.56522 16.6673 8.33333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col items-start leading-[1.5] relative">
                        <p class="font-sans font-normal text-xs sm:text-sm text-gray w-full">Venue</p>
                        <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1"><?php echo esc_html( $event_venue ); ?></p>
                    </div>
                </div>

            </div>

        </div>

        <!-- Right Column of Right Side: Action Button -->
        <div class="flex items-start shrink-0 w-full xl:w-auto mt-2 xl:mt-0">
            <?php if ( $is_upcoming ) : ?>
            <a href="<?php echo esc_url( $registration_url ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                <span class="font-sans font-semibold text-[16px] text-white leading-none whitespace-nowrap">Register Now</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 15 10" fill="none">
                    <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <?php else : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="bg-dark hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                <span class="font-sans font-semibold text-[16px] text-white leading-none whitespace-nowrap">Know More</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 15 10" fill="none">
                    <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <?php endif; ?>
        </div>

    </div>

</div>
