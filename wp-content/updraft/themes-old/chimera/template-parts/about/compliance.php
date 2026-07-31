<?php
/**
 * Template part for displaying the Compliance / standards section for About Page
 *
 * @package Chimera
 */
$compliance_section = get_field('compliance_section');
$badge_text = $compliance_section['badge_text'] ?? '';
$heading_black = $compliance_section['heading_black'] ?? '';
$heading_orange = $compliance_section['heading_orange'] ?? '';
$description = $compliance_section['description'] ?? '';
$certificates = $compliance_section['certificates'] ?? '';
?>

<section class="w-full bg-white py-[50px] relative overflow-hidden">
    <div class="container mx-auto px-6 text-center flex flex-col items-center">

        <!-- Compliance Badge -->
        <?php if ($badge_text): ?>
            <div
                class="inline-flex font-jost items-center justify-center px-3 py-2 border border-orangeBorder rounded-[8px] text-xs font-semibold tracking-wider uppercase text-orange mb-5  animate-fade-in">
                <?php echo esc_html($badge_text); ?>
            </div>
        <?php endif; ?>

        <!-- Heading -->
        <?php if ($heading_black || $heading_orange): ?>
            <h2 class="text-dark leading-tight mb-5">
                <?php
                if ($heading_black) {
                    echo wp_kses_post($heading_black);
                }
                ?>
                <?php
                if ($heading_orange) {
                    echo '<span class="text-orange">' . wp_kses_post($heading_orange) . '</span>';
                }
                ?>
            </h2>
        <?php endif; ?>

        <!-- Description -->
        <?php if ($description): ?>
            <p class="text-gray text-center text-sm sm:text-[16px] font-normal mb-[60px]">
                <?php echo wp_kses_post($description); ?>
            </p>
        <?php endif; ?>

        <!-- Cards Container -->
        <!-- Slider Container -->
        <?php if ($certificates && is_array($certificates)): ?>
            <style>
                /* Hide scrollbar for Chrome, Safari and Opera */
                #compliance-slider::-webkit-scrollbar {
                    display: none;
                }
                /* Hide scrollbar for IE, Edge and Firefox */
                #compliance-slider {
                    -ms-overflow-style: none;  /* IE and Edge */
                    scrollbar-width: none;  /* Firefox */
                    cursor: grab;
                }
                #compliance-slider:active {
                    cursor: grabbing;
                }
            </style>
            
            <div class="w-full relative overflow-hidden">
                <div id="compliance-slider" class="flex overflow-x-auto snap-x snap-mandatory gap-4 md:gap-6 w-full items-stretch pb-8 pt-4 select-none">

                    <?php
                    // Duplicate the certificates array so the slider can infinitely loop seamlessly
                    $slider_certificates = array_merge($certificates, $certificates);
                    
                    foreach ($slider_certificates as $certificate):
                        $certificate_image = $certificate['certificate_image'] ?? '';
                        $certificate_alt = $certificate['certificate_alt'] ?? '';
                        $certificate_text = $certificate['certificate_text'] ?? $certificate['title'] ?? $certificate['text'] ?? '';
                        ?>
                        <!-- Certificate Card -->
                        <div class="flex-none w-full sm:w-[calc(50%-8px)] md:w-[calc(33.333%-16px)] snap-start group h-auto flex flex-col">

                            <div class="flex-1 flex flex-col justify-center w-full">
                                <div
                                    class="flex items-center justify-center w-full h-full shadow-[0_4px_20px_-2px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_30px_-5px_rgba(255,74,3,0.1)] hover:scale-[1.02] transition-all duration-300 pointer-events-none p-4 rounded-[12px] bg-white">
                                    <?php
                                    if ($certificate_image) {
                                        // If ACF returns array (image object)
                                        if (is_array($certificate_image)) {
                                            $image_url = $certificate_image['url'];
                                            $image_alt = !empty($certificate_alt) ? $certificate_alt : $certificate_image['alt'];
                                        } else {
                                            // If ACF returns image ID
                                            $image_src = wp_get_attachment_image_src($certificate_image, 'full');
                                            $image_url = $image_src[0] ?? '';
                                            $image_alt = !empty($certificate_alt) ? $certificate_alt : get_post_meta($certificate_image, '_wp_attachment_image_alt', true);
                                        }

                                        if (!empty($image_url)) {
                                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="max-w-full max-h-[160px] object-contain">';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                            // Text below image
                            if ($certificate_text) {
                                echo '<div class="mt-auto pt-5 w-full flex-shrink-0"><p class="text-dark max-w-[330px] mx-auto font-jost font-medium text-center text-[16px] md:text-[18px] leading-[1.3] w-full pointer-events-none m-0">' . esc_html($certificate_text) . '</p></div>';
                            }
                            ?>
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('compliance-slider');
    if (!slider) return;
    
    let isDown = false;
    let startX;
    let scrollLeft;
    let autoPlayInterval;

    const startAutoPlay = () => {
        autoPlayInterval = setInterval(() => {
            if (slider.children.length === 0) return;
            
            // Scroll by one item's width
            const itemWidth = window.innerWidth >= 768 ? slider.clientWidth / 3 : (window.innerWidth >= 640 ? slider.clientWidth / 2 : slider.clientWidth);
            slider.scrollBy({ left: itemWidth, behavior: 'smooth' });

            // Seamless infinite loop logic
            setTimeout(() => {
                const originalCount = slider.children.length / 2;
                if (originalCount < 1) return;
                
                // Calculate the exact pixel distance between Set 1 and Set 2
                const shiftDistance = slider.children[originalCount].offsetLeft - slider.children[0].offsetLeft;
                
                // If we have scrolled into the duplicated Set 2, silently jump back to Set 1
                if (slider.scrollLeft >= shiftDistance - 10) {
                    slider.scrollLeft = slider.scrollLeft - shiftDistance;
                }
            }, 800); // Wait for the smooth scroll animation to finish before jumping
            
        }, 3000); // 3 seconds interval
    };

    startAutoPlay();
    
    slider.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    slider.addEventListener('mouseleave', () => {
        if(!isDown) startAutoPlay();
    });
    
    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
        clearInterval(autoPlayInterval);
    });
    
    slider.addEventListener('mouseleave', () => {
        isDown = false;
    });
    
    slider.addEventListener('mouseup', () => {
        isDown = false;
        startAutoPlay();
    });
    
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // Scroll-fast
        slider.scrollLeft = scrollLeft - walk;
    });
});
</script>