<?php
/**
 * Template part for displaying a reusable logo marquee
 *
 * Expected arguments:
 * $args['heading'] - Heading text (optional)
 * $args['logos']   - Array of logo arrays with 'logo' (array with 'url') and 'name'
 *
 * @package Chimera
 */
$trusted_logo_content = get_field('trusted_logo_content');
$trusted_logos = $trusted_logo_content['trusted_logos'] ?? [];
$trusted_logos_heading = $trusted_logo_content['trusted_logos_heading'] ?? '';

// Support passing styling arguments
$heading_align = $args['heading_align'] ?? 'text-center';
$gradient_from = $args['gradient_from'] ?? 'from-offwhite';

if ( empty( $trusted_logos ) ) {
    return;
}
?>
<div class="container mb-5 <?php echo esc_attr($args['bg_color'] ?? ''); ?>">
    <?php if ( $trusted_logos_heading ) : ?>
    <p class="font-jost text-base font-semibold text-dark tracking-wider mb-6 <?php echo esc_attr($heading_align); ?>">
        <?php echo esc_html( $trusted_logos_heading ); ?>
    </p>
    <?php endif; ?>
    
    <!-- Marquee Outer Wrapper -->
    <div class="relative w-full overflow-hidden flex">
        <!-- Left and Right Gradient Faders -->
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r <?php echo esc_attr($gradient_from); ?> to-transparent pointer-events-none z-10"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l <?php echo esc_attr($gradient_from); ?> to-transparent pointer-events-none z-10"></div>
        
        <!-- Scrolling Track -->
        <div class="flex whitespace-nowrap py-4">
            <?php 
            // The home page has 29 logos and takes 60s (approx 2.07s per logo)
            $duration = count($trusted_logos) * 2.07;
            for ($i = 0; $i < 4; $i++) : 
            ?>
            <div class="flex items-center flex-shrink-0 animate-marquee" style="animation-duration: <?php echo esc_attr($duration); ?>s;">
                <?php foreach ( $trusted_logos as $logo_item ) : 
                    // Support new dual logo fields or fallback to single 'logo'
                    $logo_gray = $logo_item['logo_gray'] ?? ($logo_item['logo'] ?? null);
                    $logo_color = $logo_item['logo_color'] ?? ($logo_item['logo'] ?? null);
                    $logo_name = $logo_item['name'] ?? '';

                    if ( ! $logo_gray && ! $logo_color ) continue;

                    $logo_gray = $logo_gray ?: $logo_color;
                    $logo_color = $logo_color ?: $logo_gray;
                ?>
                    <div class="relative group h-14 sm:h-16 w-[120px] sm:w-[140px] lg:w-[160px] xl:w-[180px] flex items-center justify-center cursor-pointer px-2 flex-shrink-0">
                        <!-- Gray Logo (Default) -->
                        <img src="<?php echo esc_url( $logo_gray['url'] ); ?>" 
                             alt="<?php echo esc_attr( $logo_name ); ?>" 
                             class="block w-auto h-auto max-w-[100px] sm:max-w-[120px] lg:max-w-[140px] xl:max-w-[160px] max-h-[40px] sm:max-h-[50px] object-contain transition-opacity duration-300 group-hover:opacity-0 <?php echo (!isset($logo_item['logo_gray']) && isset($logo_item['logo'])) ? 'grayscale opacity-60' : ''; ?>">
                        
                        <!-- Color Logo (Hover) -->
                        <img src="<?php echo esc_url( $logo_color['url'] ); ?>" 
                             alt="<?php echo esc_attr( $logo_name ); ?> Full Color" 
                             class="absolute inset-0 m-auto w-auto h-auto max-w-[100px] sm:max-w-[120px] lg:max-w-[140px] xl:max-w-[160px] max-h-[40px] sm:max-h-[50px] object-contain opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
