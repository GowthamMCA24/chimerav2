<?php
/**
 * Template part for displaying the single case study hero section
 *
 * @package Chimera
 */

$categories   = chimera_get_post_categories();
$cat_name     = ! empty( $categories ) ? $categories[0]->name : 'Tag Text';
$cat_link     = ! empty( $categories ) ? $categories[0]->link : '#';
$featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' ); 

// Static info box data for now as per user request
$hero_section = get_field('hero_section') ?? [];
$industry     = $hero_section['industry'] ?? "";
$location     = $hero_section['location'] ?? "";
$company_type = $hero_section['company_type'] ?? "";
?>

<section class="w-full bg-orange-fade py-[60px] md:py-[80px] overflow-hidden">
    <!-- Background overlay (optional, using existing overlay from theme) -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <img src="/wp-content/uploads/2026/06/chimera-home-hero-overlay.png" alt="Hero Overlay" class="w-full h-full object-cover">
    </div>

    <div class="container relative z-10 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-[60px] items-start lg:items-stretch">
            
            <!-- Left Column: Content -->
            <div class="h-full">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <!-- Breadcrumbs -->
                        <?php
                        $post_type = get_post_type();
                        $archive_url = get_post_type_archive_link( $post_type ) ?: home_url('/' . $post_type);
                        $archive_name = 'Case Study';
                        ?>
                        <div class="flex items-center justify-start gap-[5px] text-xs font-sans text-gray mb-5">
                            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-orange transition-colors">Home</a>
                            <span>/</span>
                            <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-orange transition-colors"><?php echo esc_html( $archive_name ); ?></a>
                            <span>/</span>
                            <span class="text-orange font-medium truncate max-w-[200px] md:max-w-[300px]"><?php echo esc_html( get_the_title() ); ?></span>
                        </div>

                        <!-- Category Badge -->
                        <?php if ( $cat_name ) : ?>
                            <span class="inline-flex font-jost items-center px-4 py-2 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
                                <?php echo esc_html( $cat_name ); ?>
                            </span>
                        <?php endif; ?>

                        <!-- Post Title -->
                        <h1 class="font-jost text-dark font-semibold max-w-4xl text-[24px] md:text-[32px] leading-[1.2] mb-2.5">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Post Excerpt -->
                        <?php if ( has_excerpt() ) : ?>
                            <p class="text-gray font-sans font-normal text-base leading-relaxed sm:mb-0 mb-10 max-w-xl">
                                <?php echo wp_kses_post( get_the_excerpt() ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <!-- Info Boxes -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-[14px] mt-5">
                        <!-- Industry -->
                        <div class="bg-white rounded-[8px] p-4 text-center border border-bordergray">
                            <span class="block text-dark font-sans text-sm font-semibold mb-1"><?php echo esc_html( $industry['title'] ?? 'Industry' ); ?></span>
                            <span class="block text-orange font-jost font-semibold text-lg"><?php echo esc_html( $industry['sub_text'] ?? "" ); ?></span>
                        </div>
                        <!-- Location -->
                        <div class="bg-white rounded-[12px] p-4 text-center shadow-sm border border-black/5">
                            <span class="block text-dark font-sans text-sm font-semibold mb-1"><?php echo esc_html( $location['title'] ?? 'Location' ); ?></span>
                            <span class="block text-orange font-jost font-semibold text-lg"><?php echo esc_html( $location['sub_text'] ?? "" ); ?></span>
                        </div>
                        <!-- Company Type -->
                        <div class="bg-white rounded-[12px] p-4 text-center shadow-sm border border-black/5">
                            <span class="block text-dark font-sans text-sm font-semibold mb-1"><?php echo esc_html( $company_type['title'] ?? 'Company Type' ); ?></span>
                            <span class="block text-orange font-jost font-semibold text-lg"><?php echo esc_html( $company_type['sub_text'] ?? "" ); ?></span>
                        </div>
                    </div>
                 </div>
            </div>

            <!-- Right Column: Image -->
            <?php if ( $featured_img ) : ?>
                <div class="w-full h-full">
                    <div class="rounded-[24px] overflow-hidden h-full">
                        <img src="<?php echo esc_url( $featured_img ); ?>" 
                            alt="<?php echo esc_attr( get_the_title() ); ?>" 
                            class="w-full h-full object-cover">
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
