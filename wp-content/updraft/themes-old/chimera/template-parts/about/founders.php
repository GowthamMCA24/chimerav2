<?php
/**
 * Template part for displaying the Meet the Founders section
 *
 * @package Chimera
 */

$founders_content = get_field('about_founders') ?: [];
$heading = $founders_content['heading'] ?? '';
$founders = $founders_content['founders'] ?? [];
?>

<section class="w-full relative pt-[50px] overflow-hidden">

    <!-- Bottom Gradient Background -->
    <div
        class="absolute bottom-0 left-0 right-0 h-[580px] z-0 pointer-events-none bg-gradient-to-b from-[rgba(255,255,255,0)] to-[rgba(255,74,3,0.1)]">
    </div>

    <div class="container relative z-10  pb-[50px] flex flex-col items-center">

        <!-- Heading -->
        <?php if ($heading): ?>
            <h2
                class="text-orange text-[36px] md:text-[44px] tracking-[-0.12px] font-jost font-semibold leading-none text-center mb-12">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <!-- Founders Grid -->
        <?php if (!empty($founders) && is_array($founders)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 w-full">

                <?php foreach ($founders as $founder):
                    $photo = $founder['photo'] ?? '';
                    $name = $founder['name'] ?? '';
                    $role = $founder['role'] ?? '';
                    $bio = $founder['bio'] ?? '';
                    ?>
                    <div
                        class="bg-white border border-[#d9d9d9] rounded-[10px] gap-8 px-[20px] pt-[20px] flex flex-col xl:flex-row items-start overflow-hidden relative">

                        <!-- Photo: 40% Width -->
                        <!-- aspect-[239/241] ensures the exact Figma proportions are maintained at 100% and 110% zoom, so the image never crops differently! -->
                        <div class="w-full xl:w-[40%] relative shrink-0 rounded-[10px] overflow-hidden">
                            <?php if ($photo):
                                $img_url = is_array($photo) ? $photo['url'] : wp_get_attachment_image_url($photo, 'full');
                                $img_alt = is_array($photo) ? $photo['alt'] : get_post_meta($photo, '_wp_attachment_image_alt', true);
                                ?>
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>"
                                    class="object-cover object-top pointer-events-none">
                            <?php endif; ?>
                        </div>

                        <!-- Content: 60% Width -->
                        <div class="w-full xl:w-[60%] flex flex-col gap-4 items-start mt-6 xl:mt-0">

                            <div class="flex flex-col items-start w-full">
                                <?php if ($name): ?>
                                    <h3 class="font-jost font-medium text-[22px] text-black leading-[1.2] mb-1 p-0">
                                        <?php echo esc_html($name); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if ($role): ?>
                                    <p class="font-sans font-normal text-[14px] text-gray leading-none mb-1 p-0">
                                        <?php echo esc_html($role); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <?php if ($bio): ?>
                                <div class="font-sans font-normal text-[14px] text-gray leading-[1.5] m-0 pb-[20px]">
                                    <?php echo wp_kses_post($bio); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>