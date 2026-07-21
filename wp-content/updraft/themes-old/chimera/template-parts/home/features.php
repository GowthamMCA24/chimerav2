<?php
/**
 * Template part for displaying the Core Capabilities / Features section
 *
 * @package Chimera
 */

$features_content = get_field('home_features_content') ?: [];
$features_badge = !empty($features_content['badge_text']) ? $features_content['badge_text'] : 'Core IT Services and Solutions';
$features_heading = !empty($features_content['heading']) ? $features_content['heading'] : 'Enterprise AI <br class="hidden lg:block">Solutions,';
$features_highlight_text = !empty($features_content['highlight_text']) ? $features_content['highlight_text'] : 'Built<br class="hidden lg:block"> for Complex <br class="hidden lg:block">Software and IT services';
$features_desc = !empty($features_content['description']) ? $features_content['description'] : 'End-to-end engineering capabilities built around enterprise platforms, complex architectures, and large-scale software delivery.';

$features_list = !empty($features_content['list']) ? $features_content['list'] : [
    [
        'title' => 'AI & Agentic Systems',
        'description' => 'From AI copilots to intelligent workflows, build systems that automate tasks, improve decision-making, and support real-time business operations.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-AI-Agentic-Systems.png',
        'image_color' => '/wp-content/uploads/2026/06/ai-agentics.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ],
    [
        'title' => 'Software Testing',
        'description' => 'Reduce deployment risk, improve release stability, and strengthen product quality through manual and automated testing frameworks.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-Software-Testing.png',
        'image_color' => '/wp-content/uploads/2026/06/software-testing.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ],
    [
        'title' => 'AI-Powered Digital Transformation',
        'description' => 'Modernize legacy applications, streamline fragmented workflows, and improve system interoperability across complex IT environments.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-AI-Powered-Digital-Transformation.png',
        'image_color' => '/wp-content/uploads/2026/06/ai-powered-digital.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ],
    [
        'title' => 'Low-Code / No-Code Development',
        'description' => 'Eliminate repetitive manual processes and accelerate internal application development through low-code / no-code solutions.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-Low-Code-No-Code-Development.png',
        'image_color' => '/wp-content/uploads/2026/06/low-and-no-code.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ],
    [
        'title' => 'Machine Learning and Data Analytics',
        'description' => 'Develop scalable data pipelines and BI systems. Build predictive analytical models that improve visibility across business operations.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-Machine-Learning-and-Data-Analytics.png',
        'image_color' => '/wp-content/uploads/2026/06/machine-leanring.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ],
    [
        'title' => 'DevOps & Cloud',
        'description' => 'Streamline CI/CD workflows, improve infrastructure resilience and support scalable cloud operations across enterprise environments.',
        'image_gray' => '/wp-content/uploads/2026/06/home-service-DevOps-Cloud.png',
        'image_color' => '/wp-content/uploads/2026/06/devops-and-cloud.png',
        'link_text' => 'Explore Services',
        'link_url' => '#'
    ]
];
?>

<section class="w-full bg-white py-[50px] relative overflow-hidden">
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-12 gap-[40px] items-start">
        
        <!-- Left Column (Capability Text and Header) -->
        <div class="lg:col-span-4 flex flex-col justify-start">
            <!-- Badge -->
            <div class="flex flex-col sm:flex-row items-center font-jost gap-2 text-xs uppercase text-orange font-semibold tracking-wider mb-5">
                <span class="w-10 h-[5px] rounded-[10px] bg-orange inline-block"></span>
                <?php echo wp_kses_post( $features_badge ); ?>
            </div>

            <!-- Heading -->
            <h1 class="leading-[110%] text-[34px] md:text-[44px] text-center md:text-left mb-5">
                <?php echo wp_kses_post( $features_heading ); ?>
                <span class="text-orange"><?php echo wp_kses_post( $features_highlight_text ); ?></span>
            </h1>

            <!-- Description -->
            <p class="font-sans font-normal text-sm md:text-base  text-center md:text-left text-gray leading-relaxed max-w-sm">
                <?php echo wp_kses_post( $features_desc ); ?>
            </p>
        </div>

        <!-- Right Column (Cards Grid) -->
        <div class="lg:col-span-8 w-full overflow-hidden md:overflow-visible">
            <div id="features-slider" class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] md:grid md:overflow-x-visible md:snap-none md:grid-cols-2 lg:grid-cols-3 gap-5">
            
            <?php foreach ($features_list as $feature) : 
                $img_gray = is_array($feature['image_gray']) ? $feature['image_gray']['url'] : $feature['image_gray'];
                $img_color = is_array($feature['image_color']) ? $feature['image_color']['url'] : $feature['image_color'];
                $link_text = !empty($feature['link_text']) ? $feature['link_text'] : 'Explore Services';
                $link_url = !empty($feature['link_url']) ? $feature['link_url'] : '#';
            ?>
            <div class="features-card bg-white border border-bordergray rounded-[10px] overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group shrink-0 w-full sm:w-[60vw] md:w-auto snap-center !h-auto md:!h-full self-stretch">
                <!-- Illustration Area -->
                <div class="bg-[#F5F5F5] flex items-center justify-center relative overflow-hidden px-6 h-[180px] shrink-0 group-hover:h-[100px] transition-all duration-500">
                    <img src="<?php echo esc_url($img_gray); ?>" alt="<?php echo esc_attr($feature['title']); ?>" class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-500 group-hover:opacity-0">
                    <img src="<?php echo esc_url($img_color); ?>" alt="<?php echo esc_attr($feature['title']); ?>" class="w-full h-full object-contain mix-blend-multiply absolute inset-0 m-auto px-6 opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                </div>
                <!-- Content Area -->
                <div class="px-5 pt-5 flex-grow">
                    <h3 class="font-jost font-medium text-base text-dark  leading-tight group-hover:text-orange transition-colors duration-300">
                        <?php echo esc_html($feature['title']); ?>
                    </h3>
                    <p class="font-sans font-normal text-xs text-gray leading-relaxed max-h-0 opacity-0 overflow-hidden transition-all duration-300 group-hover:max-h-40 group-hover:opacity-100 group-hover:mt-2">
                        <?php echo esc_html($feature['description']); ?>
                    </p>
                </div>
                <!-- Action Link -->
                <div class="px-5 pb-5 mt-[10px] flex-shrink-0">
                    <a href="<?php echo esc_url($link_url); ?>" class="inline-flex items-center gap-1.5 text-xs font-bold text-orange hover:gap-2.5 transition-all duration-300">
                        <?php echo esc_html($link_text); ?>
                        <svg class="h-3.5 w-3.5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
            
            </div> <!-- End Slider Container -->

            <!-- Mobile Slider Navigation -->
            <div class="flex items-center justify-center gap-4 mt-10 md:hidden">
                <button id="slider-prev" aria-label="Previous" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center text-gray hover:text-orange hover:border-orange transition-all duration-300 bg-white cursor-pointer">
                    <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>               
                </button>
                <button id="slider-next" aria-label="Next" class="w-12 h-12 rounded-full bg-orange border border-orange flex items-center justify-center text-white transition-all duration-300 cursor-pointer">
                    <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>



            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slider = document.getElementById('features-slider');
                const prevBtn = document.getElementById('slider-prev');
                const nextBtn = document.getElementById('slider-next');

                if (slider && prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.features-card').offsetWidth + 20; // 20px is gap-5
                        slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                    });
                    nextBtn.addEventListener('click', () => {
                        const cardWidth = slider.querySelector('.features-card').offsetWidth + 20;
                        slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                    });
                }
            });
            </script>
        </div>
    </div>
</section>
