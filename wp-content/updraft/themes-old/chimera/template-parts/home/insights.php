<?php
/**
 * Template part for displaying the Resources & Insights section
 *
 * @package Chimera
 */
?>

<?php
$insights_content = get_field('home_insights_content') ?: [];
$insights_badge = $insights_content['badge_text'] ?? 'KNOWLEDGE HUB';
$insights_heading = $insights_content['heading'] ?? 'Resources & ';
$insights_highlight = $insights_content['highlight_text'] ?? 'Insights';
$insights_desc = $insights_content['description'] ?? 'Explore case studies, technical deep-dives, frameworks, and updates from across Chimera.';

$insight_cards = !empty($insights_content['insight_cards']) ? $insights_content['insight_cards'] : [
    array('post_type_selector' => 'any', 'post_offset' => 0),
    array('post_type_selector' => 'whitepaper', 'post_offset' => 0),
    array('post_type_selector' => 'post', 'post_offset' => 0),
    array('post_type_selector' => 'webinar', 'post_offset' => 0),
    array('post_type_selector' => 'casestudies', 'post_offset' => 1),
];
?>

<section class="w-full bg-[#E7E7E7] py-[50px] relative overflow-hidden">
    <div class="container text-center flex flex-col items-center mb-10 md:mb-[60px]">
        <!-- Knowledge Hub Badge -->
        <?php if ($insights_badge): ?>
        <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5 animate-fade-in">
            <?php echo esc_html($insights_badge); ?>
        </div>
        <?php endif; ?>

        <!-- Heading -->
        <h2 class="text-dark text-center leading-[48px] md:leading-tight">
            <?php echo esc_html($insights_heading); ?> <span class="text-orange"><?php echo esc_html($insights_highlight); ?></span>
        </h2>
        
        <!-- Description -->
        <p class="font-sans text-gray font-normal text-center mt-5 mx-auto text-sm md:text-base leading-relaxed">
            <?php echo wp_kses_post($insights_desc); ?>
        </p>
    </div>

    <!-- Grid Layout Container -->
    <div class="container">
        <div class="w-full overflow-hidden md:overflow-visible">
            <div id="insights-slider" class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] md:grid md:overflow-x-visible md:snap-none md:grid-cols-2 lg:grid-cols-[1.5fr,1fr,1fr] gap-6 md:gap-[20px] w-full items-stretch">
            <?php
            $card_index = 0;
            foreach ( $insight_cards as $card ) {
                $block_posts = [];
                
                if ( !empty($card['manual_post']) ) {
                    // Manual post selection overrides everything
                    $block_posts = array( $card['manual_post'] );
                } else {
                    // Latest by Post Type
                    $pt = !empty($card['post_type_selector']) ? $card['post_type_selector'] : 'any';
                    if ($pt === 'any') {
                        $pt = array('casestudies', 'whitepaper', 'post', 'webinar', 'event');
                    }
                    
                    $args = array(
                        'post_type'      => $pt,
                        'posts_per_page' => 1,
                        'post_status'    => 'publish',
                        'offset'         => !empty($card['post_offset']) ? intval($card['post_offset']) : 0,
                    );
                    
                    $block_posts = get_posts( $args );
                }
                
                // Fallback details if post is not found in that category
                $post_title = 'Resource title in one or two lines';
                $post_link = '#';
                $post_image_url = $card_index === 0 
                    ? '/chimera/wp-content/uploads/2026/06/home-resource-img-1.png'
                    : '/chimera/wp-content/uploads/2026/06/home-resource-img-2.png';
                $reading_time = 5;
                $category_name = 'DYNAMIC';
                
                if ( ! empty( $block_posts ) ) {
                    $post = $block_posts[0];
                    if (is_numeric($post)) {
                        $post = get_post($post);
                    }
                    setup_postdata( $post );
                    
                    // Always calculate the badge label based on the actual post type retrieved
                    $current_post_type = get_post_type( $post->ID );
                    if ( $current_post_type === 'casestudies' ) {
                        $category_name = 'CASE STUDY';
                    } elseif ( $current_post_type === 'whitepaper' ) {
                        $category_name = 'WHITEPAPER';
                    } elseif ( $current_post_type === 'webinar' ) {
                        $category_name = 'WEBINAR';
                    } elseif ( $current_post_type === 'event' ) {
                        $category_name = 'EVENT';
                    } else {
                        $category_name = 'BLOG';
                    }
                    
                    $post_title = get_the_title( $post->ID );
                    $post_link = get_permalink( $post->ID );
                    
                    $thumb_url = get_the_post_thumbnail_url( $post->ID, 'full' );
                    if ( $thumb_url ) {
                        $post_image_url = $thumb_url;
                    }
                    
                    // Calculate reading time (rough estimate)
                    $content = get_post_field( 'post_content', $post->ID );
                    $word_count = str_word_count( strip_tags( $content ) );
                    $reading_time = ceil( $word_count / 200 ); // 200 words per minute
                    if ( $reading_time < 1 ) $reading_time = 1;
                }
                
                if ( $card_index === 0 ) :
                    // Large Featured Card (Spans 2 rows)
                    ?>
                    <div class="insight-card relative overflow-hidden rounded-[10px] hover:!shadow-lg transition-all duration-300 md:col-span-2 lg:col-span-1 lg:row-span-2 h-[450px] md:h-[500px] lg:h-auto min-h-[480px] group hidden md:flex flex-col justify-end shrink-0 w-full sm:w-[60vw] md:w-auto snap-center self-stretch" style="background-image: url('<?php echo esc_url( $post_image_url ); ?>'); background-size: cover; background-position: center; box-shadow: 1px 1px 4px 0px #D1CDCD40, -1px 4px 4px 0px #C8C8C840;">
                        <!-- Dark Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/45 to-transparent z-10 transition-opacity duration-300 group-hover:opacity-95"></div>
                        
                        <!-- Card Content -->
                        <div class="relative z-20 p-8 md:p-[30px] flex flex-col justify-end h-full">
                            <!-- Category Badge -->
                            <span class="text-white font-jost text-xs font-bold uppercase mb-[10px] pb-[10px] w-max">
                                <?php echo esc_html( $category_name ); ?>
                            </span>
                            <!-- Title -->
                            <h3 class="text-white text-xl md:text-2xl lg:text-2xl font-semibold font-jost mb-[10px] max-w-[90%] group-hover:text-orangeLight transition-colors duration-300">
                                <?php echo esc_html( $post_title ); ?>
                            </h3>
                            <!-- Metadata -->
                            <div class="flex items-center gap-2 text-white font-sans text-sm font-normal md:text-sm mb-[10px]">
                                <span><?php echo $reading_time; ?> min read</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
                                <span><?php echo esc_html( $category_name ); ?></span>
                            </div>
                            <!-- Action Button -->
                            <a href="<?php echo esc_url( $post_link ); ?>" class="inline-flex items-center justify-center bg-gray backdrop-blur-md hover:bg-white hover:text-dark text-white rounded-[30px] px-5 py-2.5 text-sm font-semibold transition-all duration-300 gap-2 w-max shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                                Read more
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                    <?php
                else :
                    // Small Card
                    ?>
                    <div class="insight-card bg-white border border-lightGray/65 rounded-[10px] overflow-hidden flex flex-col hover:!shadow-lg hover:-translate-y-1 transition-all duration-300 group shrink-0 w-full sm:w-[60vw] md:w-auto snap-center self-stretch" style="box-shadow: 1px 1px 4px 0px #D1CDCD40, -1px 4px 4px 0px #C8C8C840;">
                        <!-- Image Container -->
                        <div class="h-[180px] md:h-[200px] w-full overflow-hidden relative">
                            <img src="<?php echo esc_url( $post_image_url ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <!-- Content Area -->
                        <div class="p-6 md:p-[30px] flex flex-col flex-grow">
                            <div>
                                <!-- Tag -->
                                <span class="text-orange font-jost text-xs font-bold tracking-wider uppercase block mb-[10px]">
                                    <?php echo esc_html( $category_name ); ?>
                                </span>
                                <!-- Title -->
                                <h4 class="text-dark font-jost text-sm font-semibold leading-snug mb-[10px] group-hover:text-orange transition-colors duration-300">
                                    <?php echo esc_html( $post_title ); ?>
                                </h4>
                            </div>
                            <!-- Link -->
                            <a href="<?php echo esc_url( $post_link ); ?>" class="inline-flex items-center text-orange hover:text-orangeLight font-sans text-sm font-semibold transition-all duration-200 gap-2 w-max mt-auto ">
                                <?php echo ( $category_name === 'WHITEPAPER' ) ? 'Download' : ( ( $category_name === 'WEBINAR' ) ? 'Watch now' : ( ( $category_name === 'EVENT' ) ? 'Register now' : 'Read more' ) ); ?>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                    <?php
                endif;
                
                $card_index++;
            }
            wp_reset_postdata();
            ?>

            </div> <!-- End Slider Container -->

            <!-- Mobile Slider Navigation -->
            <div class="flex items-center justify-center gap-4 mt-8 md:hidden">
                <button id="insights-slider-prev" aria-label="Previous" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center text-gray hover:text-orange hover:border-orange transition-all duration-300 bg-white shadow-sm cursor-pointer group">
                    <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
                <button id="insights-slider-next" aria-label="Next" class="w-12 h-12 rounded-full bg-orange border border-orange flex items-center justify-center text-white transition-all duration-300 cursor-pointer group">
                    <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.getElementById('insights-slider');
                const prevBtn = document.getElementById('insights-slider-prev');
                const nextBtn = document.getElementById('insights-slider-next');

                if (slider && prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.insight-card').offsetWidth + 24; // 24px is gap-6
                        slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                    });
                    nextBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.insight-card').offsetWidth + 24;
                        slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                    });
                }
            });
            </script>
        </div>
    </div>
</section>
