<?php
/**
 * Template part for displaying the single event hero section
 *
 * @package Chimera
 */

$categories   = chimera_get_post_categories();
$is_upcoming  = false;
$cat_name = 'Completed';
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
$event_date       = get_field( 'event_date' ) ?: 'Date TBA';
$event_venue      = get_field( 'event_venue' ) ?: 'Venue TBA';
$registration_url = get_field( 'event_registration_link' ) ?: '#register';
$featured_img     = get_the_post_thumbnail_url( get_the_ID(), 'large' );
?>

<section class="w-full bg-gradient-to-b from-transparent to-orange/10 py-[60px] md:py-[80px] overflow-hidden">
    <div class="absolute inset-0 pointer-events-none z-0">
        <img src="<?php echo get_home_url(); ?>/wp-content/uploads/2026/06/chimera-home-hero-overlay.png" alt="" class="w-full h-full object-cover">
    </div>
    
    <div class="container relative z-10">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-[60px] items-stretch">
            
            <div class="w-full lg:w-1/2 flex flex-col gap-5">
                <div class="flex-1 flex flex-col gap-[30px]">
                    <div>
                        <!-- Breadcrumbs -->
                        <?php
                        $post_type = get_post_type();
                        $archive_url = get_post_type_archive_link( $post_type ) ?: home_url('/' . $post_type);
                        $archive_name = 'Events';
                        ?>
                        <div class="flex items-center justify-start gap-[5px] text-xs font-sans text-gray mb-5">
                            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-orange transition-colors">Home</a>
                            <span>/</span>
                            <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-orange transition-colors"><?php echo esc_html( $archive_name ); ?></a>
                            <span>/</span>
                            <span class="text-orange font-medium truncate max-w-[200px] md:max-w-[300px]"><?php echo esc_html( get_the_title() ); ?></span>
                        </div>

                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1.5 bg-white border border-orange/20 rounded-[8px] text-orange font-jost text-xs font-semibold uppercase tracking-wider">
                                <?php echo esc_html( $cat_name ); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-[10px] max-w-[556px]">
                        <h1 class="text-dark text-[28px] md:text-[32px] font-jost font-semibold leading-[1.2] tracking-[-0.12px]">
                            <?php the_title(); ?>
                        </h1>
                        <?php if ( has_excerpt() ) : ?>
                            <p class="text-gray font-normal font-sans text-base leading-[1.5]">
                                <?php echo wp_kses_post( get_the_excerpt() ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex flex-col xl:flex-row gap-5">
                        <!-- Date -->
                        <div class="flex items-center gap-[10px]">
                            <div class="w-10 h-10 rounded-full bg-white border border-orange shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M6.66602 1.66699V5.00033" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.334 1.66699V5.00033" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.8333 3.33301H4.16667C3.24619 3.33301 2.5 4.0792 2.5 4.99967V16.6663C2.5 17.5868 3.24619 18.333 4.16667 18.333H15.8333C16.7538 18.333 17.5 17.5868 17.5 16.6663V4.99967C17.5 4.0792 16.7538 3.33301 15.8333 3.33301Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.5 8.33301H17.5" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66602 11.667H6.67477" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 11.667H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.334 11.667H13.3427" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66602 15H6.67477" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 15H10.0088" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.334 15H13.3427" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex flex-col items-start leading-[1.5]">
                                <p class="font-sans font-normal text-sm text-gray w-full">Date</p>
                                <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1"><?php echo esc_html( $event_date ); ?></p>
                            </div>
                        </div>
                        
                        <!-- Venue -->
                        <div class="flex items-center gap-[10px]">
                            <div class="w-10 h-10 rounded-full bg-white border border-orange shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10.0007 10.8333C11.3814 10.8333 12.5007 9.71405 12.5007 8.33334C12.5007 6.95263 11.3814 5.83334 10.0007 5.83334C8.61994 5.83334 7.50065 6.95263 7.50065 8.33334C7.50065 9.71405 8.61994 10.8333 10.0007 10.8333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6673 8.33333C16.6673 14.1667 10.0007 19.1667 10.0007 19.1667C10.0007 19.1667 3.33398 14.1667 3.33398 8.33333C3.33398 6.56522 4.03636 4.86953 5.2866 3.61929C6.53685 2.36904 8.23254 1.66666 10.0007 1.66666C11.7688 1.66666 13.4645 2.36904 14.7147 3.61929C15.965 4.86953 16.6673 6.56522 16.6673 8.33333Z" stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex flex-col items-start leading-[1.5]">
                                <p class="font-sans font-normal text-sm text-gray w-full">Venue</p>
                                <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1"><?php echo esc_html( $event_venue ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php 
                // if ( $is_upcoming ) : ?>
                <div>
                    <a href="<?php echo esc_url( $registration_url ); ?>" 
                    class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                        Register Now
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                            <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php 
            // endif; 
            ?>
            </div>
            
            <div class="w-full lg:w-1/2 self-center rounded-[20px] overflow-hidden h-auto flex-shrink-0">
                <?php if ( $featured_img ) : ?>
                    <img src="<?php echo esc_url( $featured_img ); ?>" 
                         alt="<?php echo esc_attr( get_the_title() ); ?>" 
                         class="w-full h-auto">
                <?php else : ?>
                    <div class="w-full h-full bg-gradient-to-br from-lightGray to-bordergray flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>
