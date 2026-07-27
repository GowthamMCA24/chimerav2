<?php
/**
 * Template part for displaying the single webinar hero section
 *
 * Two-column layout with gradient background:
 * Left: Status badge, title, description, date/time, Register Now CTA
 * Right: Featured image
 *
 * @package Chimera
 */

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
$featured_img     = get_the_post_thumbnail_url( get_the_ID(), 'large' );


?>

<section class="w-full bg-gradient-to-b from-transparent to-orange/10 py-[60px] md:py-[80px] overflow-hidden">
    <!-- Background Overlay -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <img src="/wp-content/uploads/2026/06/chimera-home-hero-overlay.png" alt="" class="w-full h-full object-cover">
    </div>
    
    <div class="container relative z-10">
        <div class="flex flex-col md:flex-row gap-10 md:gap-[60px] items-start">
            
            <!-- Left: Content -->
            <div class="w-full md:w-1/2 flex flex-col gap-5">
                <div class="flex-1 flex flex-col gap-[30px]">
                    <div>
                        <!-- Breadcrumbs -->
                        <?php
                        $post_type = get_post_type();
                        $archive_url = get_post_type_archive_link( $post_type ) ?: home_url('/' . $post_type);
                        $archive_name = 'Webinar';
                        ?>
                        <div class="flex items-center justify-start gap-[5px] text-xs font-sans text-gray mb-5">
                            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-orange transition-colors">Home</a>
                            <span>/</span>
                            <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-orange transition-colors"><?php echo esc_html( $archive_name ); ?></a>
                            <span>/</span>
                            <span class="text-orange font-medium truncate max-w-[200px] md:max-w-[300px]"><?php echo esc_html( get_the_title() ); ?></span>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1.5 bg-white border border-orange/20 rounded-[8px] text-orange font-jost text-xs font-semibold uppercase tracking-wider">
                                <?php echo $is_upcoming ? 'Upcoming' : 'Past'; ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Title & Description -->
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
                            <?php echo esc_html( $webinar_date ); ?>
                        </p>
                    </div>
                </div>
                
                <!-- Register Now / Watch Now CTA Button -->
                <div>
                    <a href="<?php echo esc_url( $is_upcoming ? $registration_url : get_permalink() ); ?>" 
                    class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2 mt-2">
                        <?php echo $is_upcoming ? 'Register Now' : 'Watch Now'; ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                            <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Right: Featured Image -->
            <div class="w-full md:w-1/2 self-center rounded-[20px] h-auto overflow-hidden flex-shrink-0">
                <?php if ( $featured_img ) : ?>
                    <img src="<?php echo esc_url( $featured_img ); ?>" 
                         alt="<?php echo esc_attr( get_the_title() ); ?>" 
                         class="w-full h-full">
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
