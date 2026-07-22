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
                    echo esc_html($heading_black);
                }
                ?>
                <?php
                if ($heading_orange) {
                    echo '<span class="text-orange">' . esc_html($heading_orange) . '</span>';
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
        <?php if ($certificates && is_array($certificates)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 w-full items-stretch">

                <?php
                foreach ($certificates as $certificate):
                    $certificate_image = $certificate['certificate_image'] ?? '';
                    $certificate_alt = $certificate['certificate_alt'] ?? '';
                    $certificate_text = $certificate['certificate_text'] ?? $certificate['title'] ?? $certificate['text'] ?? '';
                    ?>
                    <!-- Certificate Card -->
                    <div class="flex flex-col group h-full w-full">

                        <div class="flex-1 flex flex-col justify-center w-full">
                            <div
                                class="flex items-center justify-center w-full shadow-[0_4px_20px_-2px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_30px_-5px_rgba(255,74,3,0.1)] hover:scale-[1.02] transition-all duration-300">
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
                                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="w-full object-contain">';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                        // Text below image
                        if ($certificate_text) {
                            echo '<p class="text-dark max-w-[330px] mx-auto font-jost font-medium text-center text-[16px] md:text-[18px] leading-[1.3] w-full mt-5">' . esc_html($certificate_text) . '</p>';
                        }
                        ?>
                    </div>
                    <?php
                endforeach;
                ?>

            </div>
        <?php endif; ?>
    </div>
</section>