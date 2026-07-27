<?php
/**
 * Template part for displaying the About Hero section
 *
 * @package Chimera
 */

$hero_content = get_field('about_hero') ?: [];
$badge_text = $hero_content['badge_text'] ?? '';
$heading = $hero_content['heading'] ?? '';
$heading_highlight = $hero_content['heading_highlight'] ?? '';
$description = $hero_content['description'] ?? '';
$bg_image = $hero_content['bg_image'] ?? '';
?>

<section
    class="w-full bg-offwhite -mt-[80px] overflow-hidden flex flex-col items-center relative min-h-[500px] md:min-h-[700px] pt-[140px] md:pt-[130px] pb-20">

    <!-- Hero Overlay Image -->
    <?php if ($bg_image): ?>
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute inset-0 bg-white"></div>
            <?php
            $bg_url = is_array($bg_image) ? $bg_image['url'] : wp_get_attachment_image_url($bg_image, 'full');
            if ($bg_url) {
                echo '<img src="' . esc_url($bg_url) . '" alt="Background" class="absolute inset-0 w-full h-full object-contain object-bottom lg:object-cover lg:object-right-bottom mix-blend-multiply">';
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- Responsive Container -->
    <div class="container mx-auto relative z-10 flex flex-col items-start w-full">

        <!-- Content wrapper aligned left, constrained width for readability -->
        <div class="flex flex-col gap-[20px] items-start justify-center w-full lg:max-w-[80%] xl:max-w-[70%]">

            <!-- Badge -->
            <?php if ($badge_text): ?>
                <p
                    class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange tracking-wider">
                    <?php echo esc_html($badge_text); ?>
                </p>
            <?php endif; ?>

            <!-- Heading -->
            <?php if ($heading || $heading_highlight): ?>
                <div class="flex items-start relative shrink-0">
                    <h1 class="m-0 font-jost font-semibold text-dark text-[36px] md:text-[44px] tracking-[-0.12px]">
                        <span class="leading-[1.2] block sm:inline"><?php echo wp_kses_post($heading); ?></span>
                        <?php if ($heading_highlight): ?>
                            <span
                                class="leading-[1.2] text-orange block sm:inline"><?php echo wp_kses_post($heading_highlight); ?></span>
                        <?php endif; ?>
                    </h1>
                </div>
            <?php endif; ?>

            <!-- Description -->
            <?php if ($description): ?>
                <div class="font-sans font-normal text-gray text-base md:text-lg w-full mt-5">
                    <p class="font-normal leading-[1.5] m-0"><?php echo wp_kses_post($description); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>