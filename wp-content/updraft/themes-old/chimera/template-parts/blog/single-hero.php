<?php
/**
 * Template part for displaying the single post hero section
 *
 * Includes centered category badge, title, excerpt, and full-width featured image
 *
 * @package Chimera
 */

$categories   = chimera_get_post_categories();
$cat_name     = ! empty( $categories ) ? $categories[0]->name : '';
$cat_link     = ! empty( $categories ) ? $categories[0]->link : '';
$featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' ); // Using full or a large custom size
?>

<section class="w-full bg-orange-fade pt-[60px] pb-0">
    <div class="container text-center px-4">
        
        <div class="absolute inset-0 pointer-events-none z-0">
            <img src="/wp-content/uploads/2026/06/chimera-home-hero-overlay.png" alt="Hero Overlay" class="w-full h-full object-cover">
        </div>
        <div class="z-10 relative">
            <!-- Breadcrumbs -->
            <?php
            $post_type = get_post_type();
            if ( $post_type === 'post' ) {
                $page_for_posts = get_option( 'page_for_posts' );
                $archive_url = $page_for_posts ? get_permalink( $page_for_posts ) : home_url('/blog');
                $archive_name = 'Blog';
            } else {
                $archive_url = get_post_type_archive_link( $post_type ) ?: home_url('/' . $post_type);
                $archive_name = ucwords(str_replace('-', ' ', $post_type));
                if ($post_type === 'whitepaper') $archive_name = 'Whitepapers';
            }
            ?>
            <div class="flex items-center justify-center gap-[5px] text-xs font-sans text-gray mb-5">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-orange transition-colors">Home</a>
                <span>/</span>
                <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-orange transition-colors"><?php echo esc_html( $archive_name ); ?></a>
                <span>/</span>
                <span class="text-orange font-medium truncate max-w-[200px] md:max-w-[300px]"><?php echo esc_html( get_the_title() ); ?></span>
            </div>

            <!-- Category Badge -->
            <?php if ( $cat_name ) : ?>
                <span class="inline-flex font-jost items-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
                    <?php echo esc_html( $cat_name ); ?>
                </span>
            <?php endif; ?>

            <!-- Post Title -->
            <h1 class="tracking-normal text-[34px] md:text-[44px] max-w-4xl self-center justify-self-center mb-6">
                <?php the_title(); ?>
            </h1>

            <!-- Post Excerpt (Subtitle) -->
            <?php if ( has_excerpt() ) : ?>
                <p class="text-gray font-sans font-normal text-base md:text-lg leading-relaxed mx-auto max-w-5xl">
                    <?php echo wp_kses_post( get_the_excerpt() ); ?>
                </p>
            <?php endif; ?>

            <!-- white paper button -->
             <?php
             $custom_post_type = get_post_type();
             if ( $custom_post_type === 'whitepaper' ) : 
                 $download_type = get_field('download_type') ?: '';
                 $whitepaper_file = get_field('whitepaper_file');
                 
                 $btn_tag = 'button';
                 $btn_attrs = 'id="whitepaper-download-btn" onclick="document.getElementById(\'whitepaper-popup\').classList.remove(\'hidden\');"';
                 
                 if ( $download_type === 'direct' && $whitepaper_file ) {
                     $btn_tag = 'a';
                     $btn_attrs = 'href="' . esc_url($whitepaper_file) . '" download target="_blank"';
                 }
             ?>
                 <div class="w-full flex justify-center gap-5 my-5">
                     <!-- Download Button -->
                     <<?php echo $btn_tag; ?> <?php echo $btn_attrs; ?> class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                        Download Now
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                            <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     </<?php echo $btn_tag; ?>>
                 </div>
             <?php endif; ?>

            <!-- Full-Width Featured Image -->
            <?php if ( $featured_img ) : ?>
                <div class="-mb-[80px] mt-[60px]">
                    <div class="rounded-[20px] overflow-hidden">
                        <img src="<?php echo esc_url( $featured_img ); ?>" 
                            alt="<?php echo esc_attr( get_the_title() ); ?>" 
                            class="w-full h-auto max-h-[500px] object-cover">
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

</section>
