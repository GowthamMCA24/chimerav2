<?php
/**
 * Template part for displaying the client logo carousel section
 *
 * @package Chimera
 */

$trusted_logo_content = get_field('trusted_logo_content');
$trusted_logos = !empty($trusted_logo_content['trusted_logos']) ? $trusted_logo_content['trusted_logos'] : null;
$trusted_logos_heading = !empty($trusted_logo_content['trusted_logos_heading']) ? $trusted_logo_content['trusted_logos_heading'] : 'Trusted by Companies Driving <br class="block md:hidden"> AI-Led Digital Transformation';

$bg_color = $args['bg_color'] ?? 'bg-offwhite';
$gradient_from = $args['gradient_from'] ?? 'from-[#FEFEFE]';
$heading_align = $args['heading_align'] ?? 'text-center';
?>

<!-- Client Logo Marquee Section -->
<section class="w-full <?php echo esc_attr($bg_color); ?> py-5 sm:py-12 overflow-hidden relative">
    <div class="w-full container <?php echo esc_attr($heading_align); ?>">
        <h2 class="text-dark text-base font-semibold tracking-wide leading-[1.4] mb-3">
            <?php echo wp_kses_post( $trusted_logos_heading ); ?>
        </h2>
        
        <!-- Marquee Outer Wrapper -->
        <div class="relative w-full overflow-hidden flex ">
            <!-- Left and Right Gradient Faders -->
            <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r <?php echo esc_attr($gradient_from); ?> to-transparent pointer-events-none z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l <?php echo esc_attr($gradient_from); ?> to-transparent pointer-events-none z-10"></div>
            
            <!-- Scrolling Track -->
            <div class="flex whitespace-nowrap py-4">
                
                <?php
                $logos = [
                    ['name' => 'Mapal', 'src_gray' => 'mapal-grey-log.png', 'src_color' => 'mapal-logo.png'],
                    ['name' => 'Printo', 'src_gray' => 'Printo-grey-logo.png', 'src_color' => 'Printo-logo.png'],
                    ['name' => 'Redcloud', 'src_gray' => 'redcloud-grey-logo.png', 'src_color' => 'redcloud-logo.png'],
                    ['name' => 'Quality Wholesale', 'src_gray' => 'quality-wholesale-grey-logo.png', 'src_color' => 'quality-wholesale-logo.png'],
                    ['name' => 'Genpact', 'src_gray' => 'genpact-grey-logo.png', 'src_color' => 'genpact-logo.png'],
                    ['name' => 'Hightowers', 'src_gray' => 'hightowers-grey-logo.png', 'src_color' => 'hightowers-logo.png'],
                    ['name' => 'Federal Bank', 'src_gray' => 'fedaral-bank-grey-logo.png', 'src_color' => 'fedaral-bank-logo.png'],
                    ['name' => 'Acelo Solutions', 'src_gray' => 'acelo-solutions-grey-logo.png', 'src_color' => 'acelo-solutions-logo.png'],
                    ['name' => 'Yadtel', 'src_gray' => 'yadtel-grey-logo.png', 'src_color' => 'yadtel-logo.png'],
                    ['name' => 'HP', 'src_gray' => 'hp-grey-logo.png', 'src_color' => 'hp-logo.png'],
                    ['name' => 'Abhi Loans', 'src_gray' => 'abhi-loans-grey-logo.png', 'src_color' => 'abhi-loans-logo.png'],
                    ['name' => 'Orange Business Serve', 'src_gray' => 'orange-business-serve-grey-logo.png', 'src_color' => 'orange-business-serve-logo.png'],
                    ['name' => 'Knap Finance', 'src_gray' => 'knap-finanace-grey-logo.png', 'src_color' => 'knap-finanace-logo.png'],
                    ['name' => 'Sericin', 'src_gray' => 'sericin-grey-logo.png', 'src_color' => 'sericin-logo.png'],
                    ['name' => 'Maxworth Consulting', 'src_gray' => 'maxworth-consulting-grey-logo.png', 'src_color' => 'maxworth-consulting-logo.png'],
                    ['name' => 'Matchmove', 'src_gray' => 'matchmove-grey-logo.png', 'src_color' => 'matchmove-logo.png'],
                    ['name' => 'InsureZone', 'src_gray' => 'insurezone-grey-logo.png', 'src_color' => 'insurezone-logo.png'],
                    ['name' => 'Covergo', 'src_gray' => 'covergo-grey-logo.png', 'src_color' => 'covergo-logo.png'],
                    ['name' => 'Phoenix', 'src_gray' => 'phoenix-grey-logo.png', 'src_color' => 'phoenix-logo.png'],
                    ['name' => 'Ignatica', 'src_gray' => 'ignatica-grey-logo.png', 'src_color' => 'ignatica-logo.png'],
                    ['name' => 'Edlio', 'src_gray' => 'edlio-grey-logo.png', 'src_color' => 'edlio-logo.png'],
                    ['name' => 'Buddyins', 'src_gray' => 'buddyins-grey-logo.png', 'src_color' => 'buddyins-logo.png'],
                    ['name' => 'Mu Sigma', 'src_gray' => 'mu-sigma-grey-logo.png', 'src_color' => 'mu-sigma-logo.png'],
                    ['name' => 'Cisco', 'src_gray' => 'cisco-grey-logo.png', 'src_color' => 'cisco-logo.png'],
                    ['name' => 'Ashurst', 'src_gray' => 'ashurst-grey-logo.png', 'src_color' => 'ashurst-logo.png'],
                    ['name' => 'Adera', 'src_gray' => 'adera-grey-logo.png', 'src_color' => 'adera-logo.png'],
                    ['name' => 'Sapheneia', 'src_gray' => 'sapheneia-grey-logo.png', 'src_color' => 'sapheneia-logo.png'],
                    ['name' => 'Neurasix', 'src_gray' => 'neurasix-grey-logo.png', 'src_color' => 'neurasix-logo.png'],
                    ['name' => 'Lendeast', 'src_gray' => 'lendeast-grey-logo.png', 'src_color' => 'lendeast-logo.png'],
                ];

                for ($i = 0; $i < 4; $i++) : 
                ?>
                 <!-- Group <?php echo $i + 1; ?> -->
                 <div class="flex items-center flex-shrink-0 animate-marquee" style="animation-duration: 80s;">
                     <?php 
                     $logos_list = $trusted_logos ? $trusted_logos : $logos;
                     foreach ($logos_list as $logo) : 
                         if ( $trusted_logos ) {
                             // ACF structure
                             $logo_gray = $logo['logo_gray'] ?? ($logo['logo'] ?? null);
                             $logo_color = $logo['logo_color'] ?? ($logo['logo'] ?? null);
                             
                             // If no separate gray/color, fallback to the single 'logo'
                             $logo_gray = $logo_gray ?: $logo_color;
                             $logo_color = $logo_color ?: $logo_gray;
                             
                             $src_gray = $logo_gray ? esc_url($logo_gray['url']) : '';
                             $src_color = $logo_color ? esc_url($logo_color['url']) : '';
                             $logo_name = $logo['name'] ?? '';
                         } else {
                             // Fallback static structure
                             $src_gray = esc_url( home_url('/wp-content/uploads/2026/06/' . $logo['src_gray']) );
                             $src_color = esc_url( home_url('/wp-content/uploads/2026/06/' . $logo['src_color']) );
                             $logo_name = $logo['name'];
                         }
                     ?>
                        <div class="relative group h-14 sm:h-16 flex items-center justify-center cursor-pointer px-4 sm:px-6 flex-shrink-0" style="width: calc(100vw / 9);">
                            <!-- Gray Logo (Default) -->
                            <img src="<?php echo $src_gray; ?>" 
                                 alt="<?php echo esc_attr( $logo_name ); ?>" 
                                 class="block w-auto h-auto max-w-[100px] sm:max-w-[120px] md:max-w-[130px] lg:max-w-[150px] xl:max-w-[170px] max-h-[38px] sm:max-h-[46px] object-contain transition-opacity duration-300 group-hover:opacity-0 <?php echo ($trusted_logos && empty($logo['logo_gray']) && !empty($logo['logo'])) ? 'grayscale opacity-60' : ''; ?>">
                            
                            <!-- Color Logo (Hover) -->
                            <img src="<?php echo $src_color; ?>" 
                                 alt="<?php echo esc_attr( $logo_name ); ?> Full Color" 
                                 class="absolute inset-0 m-auto w-auto h-auto max-w-[100px] sm:max-w-[120px] md:max-w-[130px] lg:max-w-[150px] xl:max-w-[170px] max-h-[38px] sm:max-h-[46px] object-contain opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endfor; ?>

            </div>
        </div>
    </div>
</section>