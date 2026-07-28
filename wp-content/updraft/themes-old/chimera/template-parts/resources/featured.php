<!-- Part 2: Featured Resource Card (Matching Blog Featured Style) -->
<section class="w-full pb-10 md:pb-[60px] container relative z-10">
    <?php
    // Query the latest updated post from all resource post types
    $featured_query = new WP_Query([
        'post_type'      => ['post', 'whitepaper', 'casestudies', 'webinar', 'event'],
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'orderby'        => 'modified',
        'order'          => 'DESC'
    ]);

    if ( $featured_query->have_posts() ) :
        $featured_query->the_post();

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
        $featured_detail_url = esc_url( get_permalink() );
        
        $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        if ( ! $thumbnail ) {
            $thumbnail = '/wp-content/uploads/2026/06/box.png'; // Fallback
        }

        $author_id = get_the_author_meta( 'ID' );
        $author_name = get_the_author();
        $author_avatar = get_avatar_url( $author_id );
        if ( ! $author_avatar ) {
            $author_avatar = '/wp-content/uploads/2026/06/icon.png';
        }
        
        $designation = get_field('designation', 'user_' . $author_id);
        if ( ! $designation ) {
            $designation = 'Author'; // Fallback
        }
    ?>
        <div class="flex flex-col md:flex-row gap-8 md:gap-[60px] items-stretch">
            
            <!-- Left: Image -->
            <div class="w-full md:w-[55%]">
                <a href="<?php echo $featured_detail_url; ?>" class="block relative overflow-hidden rounded-[20px] group h-full">
                    <img 
                        src="<?php echo esc_url( $thumbnail ); ?>" 
                        alt="<?php echo esc_attr( $title ); ?>" 
                        class="w-full h-full object-cover rounded-[16px] group-hover:scale-105 transition-transform duration-500"
                    >
                </a>
            </div>
            
            <!-- Right: Content -->
            <div class="w-full md:w-[45%] flex flex-col justify-between">
                <div>
                    <!-- Metadata -->
                    <div class="flex items-center gap-4 mb-5">
                        <span class="inline-flex items-center px-3 py-2 bg-white border border-[#FF6B35]/40 rounded-[6px] text-[#FF6B35] font-jost text-[10px] md:text-xs font-semibold uppercase tracking-wider">
                            <?php echo esc_html( $label ); ?>
                        </span>
                        <span class="text-[#666666] font-sans text-xs md:text-sm font-normal">
                            <?php echo esc_html( $date ); ?>
                        </span>
                    </div>
                    
                    <!-- Title -->
                    <a href="<?php echo $featured_detail_url; ?>" class="group block mb-5">
                        <h2 class="text-dark max-w-md text-2xl md:text-[28px] lg:text-[32px] font-semibold font-jost leading-[1.2] group-hover:text-orange transition-colors duration-300">
                            <?php echo esc_html( $title ); ?>
                        </h2>
                    </a>
                    
                    <!-- Action Link -->
                    <a href="<?php echo $featured_detail_url; ?>" class="inline-flex items-center text-orange hover:text-orangeLight font-sans text-sm md:text-base font-semibold transition-all duration-200 gap-2 w-max mb-5 md:mb-7">
                        <?php echo esc_html( $link_text ); ?>
                        <svg class="h-4 w-4 md:h-5 md:w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                
                <!-- Author Info -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden border border-orange flex-shrink-0">
                        <img 
                            src="<?php echo esc_url( $author_avatar ); ?>" 
                            alt="<?php echo esc_attr( $author_name ); ?>" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[#666666] font-jost text-sm md:text-base font-semibold leading-tight"><?php echo esc_html( $author_name ); ?></span>
                        <span class="text-[#666666] font-sans text-xs md:text-sm"><?php echo esc_html( $designation ); ?></span>
                    </div>
                </div>
            </div>
            
        </div>
    <?php 
        wp_reset_postdata();
    endif; 
    ?>
</section>