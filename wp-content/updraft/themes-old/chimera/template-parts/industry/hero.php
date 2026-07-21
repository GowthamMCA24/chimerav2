<?php
/**
 * Template part for displaying the Industry Hero section
 *
 * @package Chimera
 */

// Get hero fields from SCF
$hero = get_field('industry_hero');
$badge_text       = $hero['badge_text'] ?? 'INDUSTRY';
$heading_line1    = $hero['heading_line1'] ?? 'AI-Led Technology Solutions,';
$heading_highlight = $hero['heading_highlight'] ?? 'Built for Your Industry';
$description      = $hero['description'] ?? '';
$cta_primary_text = $hero['cta_primary_text'] ?? 'Talk to Our Specialist';
$cta_primary_link = $hero['cta_primary_link'] ?? '#';
$cta_secondary_text = $hero['cta_secondary_text'] ?? 'Explore Our Solutions';
$cta_secondary_link = $hero['cta_secondary_link'] ?? '#';
$hero_image       = $hero['hero_image'] ?? null;
$stats            = $hero['stats'] ?? [];
$bg_shape_image   = $hero['bg_image'] ?? null;
?>

<section class="ind-hero bg-offwhite w-full pt-[60px] pb-10 overflow-hidden">
    
    <!-- Subtle geometric pattern overlay -->
    <div class="absolute right-0 top-14 sm:top-0 z-0">
      <img src="<?php echo esc_url( $bg_shape_image['url'] ); ?>" class="w-full h-full object-contain" >
    </div>

    <div class="container mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
            
            <!-- Left Content (60%) -->
            <div class="w-full lg:w-[58%] flex flex-col items-center md:items-start text-center md:text-left">
                
                <!-- Badge -->
                <div class="inline-flex font-jost items-center justify-center px-3 py-1.5 h-[32px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
                    <?php echo esc_html( $badge_text ); ?>
                </div>

                <!-- Heading -->
                <h1 class="text-center md:text-left text-[40px] md:text-[50px] xl:text-[60px] font-jost font-semibold leading-[1.2] tracking-[-0.12px] text-dark">
                    <span><?php echo esc_html( $heading_line1 ); ?></span>
                    <span class="text-orange"><?php echo esc_html( $heading_highlight ); ?></span>
                </h1>

                <!-- Description -->
                <?php if ( $description ) : ?>
                <p class="font-sans font-normal text-gray text-base leading-[1.5] mt-5 max-w-2xl text-center md:text-left">
                    <?php echo esc_html( $description ); ?>
                </p>
                <?php endif; ?>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center self-center sm:self-start w-auto gap-5 mt-10 h-auto sm:h-[52px]">
                    <?php if ( $cta_primary_text ) : ?>
                    <a href="<?php echo esc_url( $cta_primary_link ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex justify-center items-center gap-2">
                        <?php echo esc_html( $cta_primary_text ); ?>
                        <div class="w-[13px] h-[8px] flex items-center justify-center">
                            <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 5H13M13 5L9 1M13 5L9 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </a>
                    <?php endif; ?>
                    <?php if ( $cta_secondary_text ) : ?>
                    <a href="<?php echo esc_url( $cta_secondary_link ); ?>" class="bg-white hover:opacity-95 text-dark px-6 py-3 rounded-[8px] border-2 border-dark text-base font-semibold tracking-normal inline-flex justify-center items-center gap-2">
                        <?php echo esc_html( $cta_secondary_text ); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Image (42%) -->
            <div class="w-full lg:w-[42%] flex items-center self-center justify-center">
                <?php if ( $hero_image ) : ?>
                    <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ?? $badge_text ); ?>" class="w-full max-w-md lg:max-w-none h-auto object-contain">
                <?php else : ?>
                    <!-- Placeholder illustration -->
                    <div class="w-full max-w-md lg:max-w-none aspect-square bg-gradient-to-br from-orange/5 to-orange/15 rounded-[20px] flex items-center justify-center border border-orange/10">
                        <div class="text-center p-8">
                            <div class="w-20 h-20 mx-auto mb-4 bg-orange/10 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-orange" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                            </div>
                            <p class="text-orange/60 font-jost font-semibold text-sm"><?php echo esc_html( $badge_text ); ?> Illustration</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats Row -->
        <?php if ( $stats ) : ?>
        <div class="w-full grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-10 md:mt-[80px] z-20">
            <?php foreach ( $stats as $index => $stat ) : 
                $stat_icon  = $stat['icon'] ?? null;
                $stat_value = $stat['value'] ?? '';
                $stat_label = $stat['label'] ?? '';
            ?>
            <div class="bg-white border border-bordergray rounded-[8px] p-4 xl:p-6 flex items-center sm:flex-row flex-col gap-3 xl:gap-5 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.02)] hover:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.05)] transition-all duration-300">
                <?php if ( $stat_icon ) : ?>
                <div class="size-[60px] rounded-full bg-white flex items-center justify-center shadow-[0px_0px_10px_0px_#FF4A0340] flex-shrink-0">
                    <img src="<?php echo esc_url( $stat_icon['url'] ); ?>" alt="<?php echo esc_attr( $stat_label ); ?>" class="w-6 h-6 lg:w-8 lg:h-8 object-contain">
                </div>
                <?php endif; ?>
                <div class="flex flex-col text-center sm:text-left">
                    <?php 
                    preg_match('/^([^\d]*)(\d+(?:\.\d+)?)(.*)$/', trim($stat_value), $matches);
                    if ( !empty($matches[2]) ) :
                        $prefix = $matches[1];
                        $num_part = $matches[2];
                        $suffix = $matches[3];
                    ?>
                    <h3 class="text-dark text-[32px] md:text-[44px] font-jost font-semibold leading-none tracking-[-0.12px]">
                        <?php echo esc_html( $prefix ); ?><span class="stat-counter" data-target="<?php echo esc_attr( $num_part ); ?>" data-duration="3000">0</span><?php echo esc_html( $suffix ); ?>
                    </h3>
                    <?php else : ?>
                    <h3 class="text-dark text-[32px] md:text-[44px] font-jost font-semibold leading-none tracking-[-0.12px]"><?php echo esc_html( $stat_value ); ?></h3>
                    <?php endif; ?>
                    <p class="text-xs md:text-[14px] font-normal text-gray leading-tight mt-3 font-sans whitespace-nowrap tracking-tight"><?php echo esc_html( $stat_label ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if not already initialized by another script
    if (window.statCountersInitialized) return;
    window.statCountersInitialized = true;

    const counters = document.querySelectorAll('.stat-counter');
    
    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const duration = parseInt(counter.getAttribute('data-duration')) || 5000;
        const stepTime = 15; // update every 15ms
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target % 1 !== 0 ? target.toFixed(1) : target;
                clearInterval(timer);
            } else {
                counter.textContent = target % 1 !== 0 ? current.toFixed(1) : Math.floor(current);
            }
        }, stepTime);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    counters.forEach(counter => observer.observe(counter));
});
</script>
