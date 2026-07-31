<?php
/**
 * Template part for displaying the hero section
 *
 * @package Chimera
 */

$hero_content = get_field('home_hero_content') ?: [];
$hero_bg_image = $hero_content['hero_bg_image'] ?: 'chimera-home-hero-overlay.png';
$hero_badge = !empty($hero_content['badge_text']) ? $hero_content['badge_text'] : 'AI Led Technology Service Company';
$hero_badge_image = $hero_content['badge_gif']['url'] ?? [];
$hero_heading = !empty($hero_content['heading']) ? $hero_content['heading'] : "<span class=\"block\">Built for scale</span>\n            <span class=\"text-orange block\">Designed for what's next</span>";
$hero_highlight = !empty($hero_content['highlight_text']) ? $hero_content['highlight_text'] : 'Built for scale';
$hero_desc = !empty($hero_content['description']) ? $hero_content['description'] : 'We help you build, modernize, test, and scale digital products through AI systems, product engineering, QA, cloud, and data analytics solutions backed by specialized digital engineering services.';
$hero_btn_text = !empty($hero_content['button_text']) ? $hero_content['button_text'] : 'Build with us';
$hero_btn_link = !empty($hero_content['button_link']) ? $hero_content['button_link'] : '#';
$hero_stats = !empty($hero_content['stats']) ? $hero_content['stats'] : [
    [
        'icon' => home_url('/wp-content/uploads/2026/06/idea-i.svg'),
        'number' => '25',
        'duration' => '3000',
        'text' => 'Years of Innovation'
    ],
    [
        'icon' => home_url('/wp-content/uploads/2026/06/member-i.svg'),
        'number' => '250',
        'duration' => '5000',
        'text' => 'Strong Tech Team'
    ],
    [
        'icon' => home_url('/wp-content/uploads/2026/06/insights-i.svg'),
        'number' => '720',
        'duration' => '5000',
        'text' => 'Impactful Solutions'
    ],
    [
        'icon' => home_url('/wp-content/uploads/2026/06/globe-i.svg'),
        'number' => '180',
        'duration' => '5000',
        'text' => 'Global Client Served'
    ]
];
?>

<section class="w-full bg-offwhite pt-[60px] sm:pt-[80px] pb-10 md:py-30 overflow-hidden flex items-center justify-center">
    
    <!-- Hero Overlay Image -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <img src="<?php echo $hero_bg_image['url']; ?>" alt="Hero Overlay" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto relative z-10 flex flex-col items-center text-center">
        
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 md:gap-4 bg-white border border-lightGray h-10 sm:h-12 rounded-full shadow-[0px_0px_10px_0px_#FF4A0340] mb-8">
            <div class="w-12 sm:w-14 h-12 sm:h-14 -ml-3 rounded-full bg-white border border-lightGray flex items-center justify-center shadow-[0px_0px_10px_0px_#FF4A0340] flex-shrink-0">
                <img src="<?php echo esc_url( $hero_badge_image ); ?>" alt="Icon" class="w-10 h-10 object-contain">
            </div>
            <span class="text-xs  md:text-[16px] font-semibold text-orange uppercase font-jost pr-2 md:pr-6">
                <?php echo wp_kses_post( $hero_badge ); ?>
            </span>
        </div>

        <!-- Heading -->
        <h2 class="tracking-[-0.12px] align-middle text-[50px] md:text-[84px] max-w-7xl">
            <span class="block"><?php echo wp_kses_post( $hero_heading ); ?></span>
            <span class="text-orange block"><?php echo wp_kses_post( $hero_highlight ); ?></span>
        </h2>

        <!-- Description -->
        <p class="max-w-4xl mt-5 font-normal">
            <?php echo wp_kses_post( $hero_desc ); ?>
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-10 mt-5 w-full max-w-xs sm:max-w-none">
            <a href="<?php echo esc_url( $hero_btn_link ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                <?php echo esc_html( $hero_btn_text ); ?>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <!-- <a href="#" class="w-full sm:w-auto bg-white hover:bg-offwhite text-dark border border-2 border-dark px-8 py-4 rounded-[20px] text-[16px] font-semibold shadow-sm transition-transform active:scale-95 flex items-center justify-center">
                Explore Solutions
            </a> -->
        </div>

        <!-- Stats Grid Section -->
        <div class="w-full grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-10 md:mt-16 z-20">
            <?php foreach ( $hero_stats as $stat ) : 
                $icon_url = is_array($stat['icon']) ? $stat['icon']['url'] : $stat['icon'];
                $duration = !empty($stat['duration']) ? $stat['duration'] : '5000';
            ?>
            <div class="bg-white border border-bordergray rounded-[8px] p-4 xl:p-6 flex items-center sm:flex-row flex-col gap-3 xl:gap-5 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.02)] hover:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.05)] transition-all duration-300">
                <div class="size-[60px]  rounded-full bg-white flex items-center justify-center shadow-[0px_0px_10px_0px_#FF4A0340] flex-shrink-0">
                    <img src="<?php echo esc_url( $icon_url ); ?>" alt="Stat Icon">
                </div>
                <div class="flex flex-col text-center sm:text-left">
                    <h3 class="text-dark"><span class="stat-counter" data-target="<?php echo esc_attr($stat['number']); ?>" data-duration="<?php echo esc_attr($duration); ?>">0</span></h3>
                    <p class=" text-xs  md:text-[14px] font-normal text-gray leading-tight mt-3 font-sans whitespace-nowrap tracking-tight"><?php echo esc_html($stat['text']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.stat-counter');
    
    const animateCounter = (counter) => {
        const targetAttr = counter.getAttribute('data-target');
        // Use parseFloat/parseInt to safely handle strings like "25+" or "25k"
        const target = parseFloat(targetAttr) || parseInt(targetAttr) || 0;
        
        // Extract any suffix string (e.g. "+", "k") by removing numbers and dots/commas
        const suffix = targetAttr.replace(/[0-9., ]/g, '');

        const duration = parseInt(counter.getAttribute('data-duration')) || 5000;
        const stepTime = 15; // update every 15ms
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target + suffix;
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current) + suffix;
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
