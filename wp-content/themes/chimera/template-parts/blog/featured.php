<?php
/**
 * Template part for displaying the featured blog post
 *
 * @package Chimera
 */

// Get the featured post — use sticky posts first, fallback to latest
$post_type = $args['post_type'] ?? 'post';
$sticky_posts = get_option( 'sticky_posts' );
$featured_args = array(
    'post_type'      => $post_type,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if ( ! empty( $sticky_posts ) && $post_type === 'post' ) {
    $featured_args['post__in'] = $sticky_posts;
    $featured_args['ignore_sticky_posts'] = 1;
}

$featured_query = new WP_Query( $featured_args );
?>

<section class="w-full py-10 md:py-[60px] relative z-10">
    <div class="container">
        
        <!-- Featured Post Hero Card -->
        <?php if ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
            <?php
                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if ( ! $featured_image ) {
                    $featured_image = '/wp-content/uploads/2026/06/placeholder.jpg'; // fallback if no image
                }
                $categories     = chimera_get_post_categories();
                $reading_time   = chimera_reading_time();
                $cat_name       = ! empty( $categories ) ? $categories[0]->name : '';
                $author_id      = get_post_field( 'post_author', get_the_ID() );
                $author_name    = get_the_author_meta( 'display_name', $author_id );
                $author_desc    = get_user_meta( $author_id, 'designation', true );
                if ( empty( $author_desc ) ) {
                    $author_desc = 'Designation, Company';
                }
                $author_avatar  = get_avatar_url( $author_id );
            ?>
            <div class="flex flex-col md:flex-row gap-8 md:gap-14 items-stretch">
                
                <!-- Left: Image -->
                <div class="w-full md:w-[55%]">
                    <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden rounded-[16px] group h-full">
                        <img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover rounded-[16px] group-hover:scale-105 transition-transform duration-500">
                    </a>
                </div>
                
                <!-- Right: Content -->
                <div class="w-full md:w-[45%] flex flex-col justify-between">
                    <div>
                        <!-- Metadata -->
                        <div class="flex items-center gap-4 mb-5">
                        <?php if ( $cat_name ) : ?>
                            <span class="inline-flex items-center px-3 py-2 bg-white border border-orangeBorder rounded-[6px] text-orange font-jost text-[10px] md:text-xs font-semibold uppercase tracking-wider">
                                <?php echo esc_html( $cat_name ); ?>
                            </span>
                        <?php endif; ?>
                        <span class="text-[#666666] font-sans text-xs md:text-sm font-normal">
                            <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                        </span>
                    </div>
                    
                    <!-- Title -->
                    <a href="<?php the_permalink(); ?>" class="group block mb-5">
                        <h2 class="text-dark text-2xl md:text-[28px] lg:text-[32px] font-semibold font-jost leading-[1.2] group-hover:text-orange transition-colors duration-300">
                            <?php the_title(); ?>
                        </h2>
                    </a>
                     
                    <?php if ( has_excerpt() ) : ?>
                        <p class="font-sans text-gray font-normal text-left text-sm md:text-base font-normal font-sans leading-[1.7] mb-5">
                            <?php echo wp_kses_post( get_the_excerpt() ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <!-- Action Link -->
                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-orange hover:text-orangeLight font-sans text-sm md:text-base font-semibold transition-all duration-200 gap-2 w-max mb-5 md:mb-7">
                        <?php 
                        $pt = get_post_type();
                        if ( $pt === 'casestudies' ) {
                            echo 'Read story';
                        } elseif ( $pt === 'whitepaper' ) {
                            echo 'Download Whitepaper';
                        } else {
                            echo 'Read More';
                        }
                        ?>
                        <svg class="h-4 w-4 md:h-5 md:w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    
                    </div>
                    
                    <!-- Author Info -->
                    <?php if ( false && get_post_type() !== 'casestudies' && ( !isset($args['post_type']) || $args['post_type'] !== 'casestudies' ) ) : ?>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden border border-orange flex-shrink-0">
                            <?php if ( $author_avatar ) : ?>
                                <img src="<?php echo esc_url( $author_avatar ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" class="w-full h-full object-cover">
                            <?php else : ?>
                                <div class="w-full h-full bg-orange/10 flex items-center justify-center text-orange font-jost font-bold">
                                    <?php echo esc_html( substr( $author_name, 0, 1 ) ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[#666666] font-jost text-sm md:text-base font-semibold leading-tight"><?php echo esc_html( $author_name ); ?></span>
                            <span class="text-[#666666] font-sans text-xs md:text-sm"><?php echo esc_html( $author_desc ); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>
