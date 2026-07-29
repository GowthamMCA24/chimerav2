<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Sticky Navigation Header -->
<header id="site-header" class="sticky top-0 z-50 bg-transparent backdrop-blur-md transition-all duration-300">
    <div class="container mx-auto h-20 flex items-center justify-between">
        
        <!-- Logo Branding -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group focus:outline-none" aria-label="Chimera Home">
            <div class="relative flex-shrink-0">
                <?php
                $logo = get_field('logo', 'option');
                if ( $logo ) : 
                    $logo_url = $logo['url'];
                    $logo_alt = $logo['alt'];
                ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" class="w-[160px]">
                <?php else: ?>
                <img src="/wp-content/uploads/2026/06/chimera-logo.svg" alt="Chimera Logo" class="w-[160px]">
                <?php endif; ?>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-2.5 text-lg font-semibold text-dark" aria-label="Desktop Menu">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new Chimera_Nav_Walker(),
                'depth'          => 2,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <!-- Header CTA Button -->
        <div class="hidden lg:flex items-center">
            <?php 
            // Dynamic CTA Text and Link via ACF Options
            $ctaBtn = get_field('menu_cta', 'option');
            $cta_text = $ctaBtn['cta_text'];
            $cta_link = $ctaBtn['cta_link'];
            ?>
            <a href="<?php echo esc_url( $cta_link ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                <?php echo esc_html( $cta_text ); ?>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- Mobile Menu Burger Button -->
        <div class="flex lg:hidden items-center">
            <button id="mobile-menu-btn" class="w-10 h-10 flex items-center justify-center rounded-[12px] bg-orange text-white hover:bg-orange/90 transition-colors focus:outline-none" aria-label="Toggle menu" aria-expanded="false">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div id="mobile-menu" class="hidden lg:hidden bg-offwhite w-full max-h-[calc(100vh-80px)] overflow-y-auto shadow-inner py-6 px-6">
        <div class="flex flex-col gap-3">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new Chimera_Mobile_Nav_Walker(),
                'depth'          => 2,
                'fallback_cb'    => false,
            ) );
            ?>
            <div class="border-t border-lightGray pt-6 flex justify-center">
                <?php 
                // Dynamic CTA Text and Link via ACF Options (same as desktop)
                $ctaBtn = function_exists('get_field') ? get_field('menu_cta', 'option') : null;
                $cta_text = isset($ctaBtn['cta_text']) && !empty($ctaBtn['cta_text']) ? $ctaBtn['cta_text'] : 'Get in touch';
                $cta_link = isset($ctaBtn['cta_link']) && !empty($ctaBtn['cta_link']) ? $ctaBtn['cta_link'] : '#';
                ?>
                <a href="<?php echo esc_url($cta_link); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-8 py-3.5 rounded-[8px] text-[15px] font-bold w-full text-center inline-flex items-center justify-center gap-2 shadow-lg transition-transform active:scale-95">
                    <?php echo esc_html($cta_text); ?>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('site-header');
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 20) {
                header.classList.remove('bg-transparent');
                header.classList.add('bg-white/90', 'shadow-sm');
            } else {
                header.classList.remove('bg-white/90', 'shadow-sm');
                header.classList.add('bg-transparent');
            }
        };
        
        // Check immediately on load in case the user is already scrolled down
        handleScroll();
        
        // Update on scroll
        window.addEventListener('scroll', handleScroll);
    }
});
</script>
