<?php
/**
 * Template part for displaying the Services Offerings grid
 *
 * @package Chimera
 */

$offerings_data = get_field('services_offerings');
if (!$offerings_data)
    return;

$badge_text = $offerings_data['badge_text'] ?? '';
$title = $offerings_data['title'] ?? '';
$highlight_text = $offerings_data['highlight_text'] ?? '';
$description = $offerings_data['description'] ?? '';
$services = $offerings_data['services'] ?? [];
$bg_image = $offerings_data['bg_image'] ?? null;
?>

<section class="bg-[#e7e7e7] w-full py-[50px] relative">
    <div class="container">

        <?php if ($title || $description): ?>
            <div class="text-center mb-12">
                <?php if ($badge_text): ?>
                    <div
                        class="inline-flex items-center justify-center px-3 py-1.5 bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] mb-4">
                        <span
                            class="font-jost font-semibold text-orange text-xs uppercase tracking-wider"><?php echo esc_html($badge_text); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($title || $highlight_text): ?>
                    <h2 class="font-jost font-semibold text-[32px] md:text-[40px] leading-tight text-dark mb-4">
                        <?php echo wp_kses_post($title); ?>
                        <?php if ($highlight_text): ?>
                            <span class="text-orange"><?php echo wp_kses_post($highlight_text); ?></span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($description): ?>
                    <p class="font-sans font-normal text-gray text-base max-w-3xl mx-auto">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($services)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-[10px]">
                <?php foreach ($services as $service):
                    $service_title = $service['title'] ?? '';
                    $service_desc = $service['description'] ?? '';
                    $service_features = $service['features'] ?? [];
                    $service_icon = $service['icon'] ?? null;
                    $btn_text = $service['btn_text'] ?? 'Inquire Details';
                    $btn_link = $service['btn_link'] ?? '#';
                    ?>
                    <div
                        class="bg-white flex flex-col justify-between overflow-hidden p-[40px] lg:p-[60px] relative rounded-[10px] min-h-[400px] border border-transparent hover:border-orange transition-all duration-300">

                        <!-- Background Vector Image -->
                        <?php if ($bg_image): ?>
                            <div class="absolute top-1/2 -translate-y-1/2 right-0 pointer-events-none z-0">
                                <img src="<?php echo esc_url(is_array($bg_image) ? $bg_image['url'] : $bg_image); ?>" alt=""
                                    class="w-full h-full object-contain opacity-100">
                            </div>
                        <?php endif; ?>

                        <!-- Content Container -->
                        <div class="relative z-10 flex flex-col h-full">
                            <div class="flex flex-col gap-[20px] items-start w-full">
                                <div class="flex items-center gap-2 w-full">
                                    <?php if ($service_icon): ?>
                                        <div class="w-[38px] h-[38px] rounded-[10px] bg-orange-gradient flex items-center justify-center shrink-0">
                                            <img src="<?php echo esc_url(is_array($service_icon) ? $service_icon['url'] : $service_icon); ?>" alt="" class="w-[20px] h-[20px] object-contain">
                                        </div>
                                    <?php endif; ?>
                                <h3 class="font-jost font-semibold text-dark text-[24px] leading-none tracking-[-0.12px]">
                                        <?php echo esc_html($service_title); ?>
                                    </h3>
                                </div>

                                <?php if ($service_desc): ?>
                                    <div class="flex flex-col gap-4">
                                        <?php
                                        // Split by 2 or more newlines to identify distinct paragraphs
                                        $paragraphs = preg_split('/(?:\r?\n){2,}/', trim($service_desc));
                                        foreach ($paragraphs as $p) {
                                            if (trim($p) !== '') {
                                                echo '<p class="font-sans font-normal text-gray text-[16px] leading-[1.5] m-0">' . wp_kses_post(trim($p)) . '</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($service_features)): ?>
                                    <ul class="flex flex-col gap-[12px] font-sans font-medium text-dark text-[16px] leading-[1.5] mb-8 w-full">
                                        <?php foreach ($service_features as $feature): 
                                            $feature_icon = $feature['icon'] ?? ($service['list_icon'] ?? ($offerings_data['list_icon'] ?? null));
                                        ?>
                                            <li class="flex items-start gap-[12px]">
                                                <?php if ($feature_icon): ?>
                                                    <div class="w-[24px] h-[24px] flex items-center justify-center shrink-0 mt-[2px]">
                                                        <img src="<?php echo esc_url(is_array($feature_icon) ? $feature_icon['url'] : $feature_icon); ?>" alt="" class="w-full h-full object-contain">
                                                    </div>
                                                <?php else: ?>
                                                    <div class="w-[24px] h-[24px] rounded-full bg-[rgba(255,74,3,0.1)] flex items-center justify-center shrink-0 mt-[2px]">
                                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10 3L4.5 8.5L2 6" stroke="#FF4A03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="flex-1"><?php echo esc_html($feature['text'] ?? $feature['title']); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <div class="mt-auto pt-[40px]">
                                <a href="<?php echo esc_url($btn_link); ?>"
                                    class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                                    <?php echo esc_html($btn_text); ?>
                                    <svg width="13" height="8" viewBox="0 0 14 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5H13M13 5L9 1M13 5L9 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>