<?php
/**
 * Template part for displaying the Delivery Models section
 *
 * @package Chimera
 */

$models_content = get_field('home_models_content') ?: [];
$models_bg_image = !empty($models_content['bg_image']) ? (is_array($models_content['bg_image']) ? $models_content['bg_image']['url'] : $models_content['bg_image']) : '';
$models_feature_icon = !empty($models_content['feature_icon']) ? (is_array($models_content['feature_icon']) ? $models_content['feature_icon']['url'] : $models_content['feature_icon']) : '';
$models_badge = $models_content['badge_text'] ?? '';
$models_heading = $models_content['heading'] ?? '';
$models_highlight = $models_content['highlight_text'] ?? '';
$models_desc = $models_content['description'] ?? '';
$models_btn_text = $models_content['button_text'] ?? '';
$models_btn_link = $models_content['button_link'] ?? '';

$models_list = $models_content['list'] ?? [];
?>

<section class="w-full bg-[#FEFEFE] py-[50px] relative overflow-hidden">
    <div class="container text-center flex flex-col items-center mb-10 md:mb-[60px]">
        <!-- How We Work Badge -->
        <?php if ($models_badge): ?>
        <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5 animate-fade-in">
            <?php echo wp_kses_post($models_badge); ?>
        </div>
        <?php endif; ?>

        <!-- Heading -->
        <h2 class="text-dark text-center leading-[48px] md:leading-tight">
            <?php echo wp_kses_post($models_heading); ?>
            <span class="text-orange"><?php echo wp_kses_post($models_highlight); ?></span>
        </h2>
        
        <!-- Description -->
        <p class="font-sans text-gray font-normal text-center mt-5 mx-auto text-sm md:text-base leading-relaxed">
            <?php echo wp_kses_post($models_desc); ?>
        </p>
    </div>

    <!-- Layout Container -->
    <style>
        @media (min-width: 1024px) {
            .models-dynamic-bg {
                background-image: url('<?php echo esc_url($models_bg_image); ?>');
            }
        }
    </style>
    <div class="bg-none bg-contain bg-no-repeat models-dynamic-bg">
        <div class="container bg-transparent lg:bg-white flex flex-col lg:flex-row gap-10 lg:gap-10 p-5 sm:p-10 rounded-[20px] shadow-none lg:shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
            
            <!-- Left Side: Tab Navigation -->
            <div class="hidden md:flex w-full lg:w-[30%] flex-col flex-shrink-0">
                <!-- Scrollable Tab Row on Mobile, Vertical on Desktop -->
                <div id="models-tab-nav" class="flex flex-row lg:flex-col overflow-x-auto lg:overflow-x-visible pb-4 lg:pb-0 scrollbar-hide w-full max-w-full">
                    
                    <?php foreach ($models_list as $index => $model) : 
                        $is_active = ($index === 0);
                        
                        $icon_normal = is_array($model['tab_icon_normal']) ? $model['tab_icon_normal']['url'] : $model['tab_icon_normal'];
                        $icon_active = is_array($model['tab_icon_active']) ? $model['tab_icon_active']['url'] : $model['tab_icon_active'];
                        
                        $icon_url = $is_active ? $icon_active : $icon_normal;
                    ?>
                    <button class="model-tab-btn <?php echo $is_active ? 'active bg-orangeBorder' : 'bg-transparent'; ?> flex items-center justify-start flex-shrink-0 text-left px-5 py-4 rounded-[12px] transition-all duration-300 w-[260px] lg:w-full select-none cursor-pointer outline-none focus:outline-none focus:ring-0 [-webkit-tap-highlight-color:transparent]" 
                            data-tab="<?php echo $index; ?>" 
                            data-icon-normal="<?php echo esc_url($icon_normal); ?>" 
                            data-icon-active="<?php echo esc_url($icon_active); ?>">
                        <div class="model-tab-icon-wrapper w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-all duration-300 <?php echo $is_active ? 'bg-[#FF4A03] text-white' : 'border border-orange text-orange'; ?> flex-shrink-0">
                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($model['tab_label']); ?>" class="model-tab-icon w-5 h-5 object-contain">
                        </div>
                        <span class="model-tab-label font-jost font-semibold text-md text-dark transition-colors duration-300">
                            <?php echo esc_html($model['tab_label']); ?>
                        </span>
                    </button>
                    <?php endforeach; ?>

                </div>

                <!-- Divider (Desktop Only) -->
                <hr class="hidden lg:block border-lightGray my-10">

                <!-- Action Button (Desktop Only) -->
                <?php if ($models_btn_link && $models_btn_text): ?>
                <a href="<?php echo esc_url($models_btn_link); ?>" class="hidden lg:inline-flex w-full justify-center bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal items-center gap-2">
                    <?php echo esc_html($models_btn_text); ?>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <?php endif; ?>
            </div>

            <!-- Right Side: Tab Panels -->
            <div class="w-full overflow-hidden md:overflow-visible lg:w-[70%]">
                <div id="models-slider" class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] md:flex-col gap-5 md:overflow-x-visible md:snap-none relative w-full items-stretch">
                
                <?php foreach ($models_list as $index => $model) : 
                    $is_active = ($index === 0);
                    $panel_img = is_array($model['panel_image']) ? $model['panel_image']['url'] : $model['panel_image'];
                ?>
                <div class="model-tab-panel bg-[radial-gradient(79.17%_79.17%_at_50%_50%,#FFFFFF_0%,#EEEDEE_100%)] <?php echo $is_active ? 'flex opacity-100 scale-100' : 'hidden opacity-0 scale-95'; ?> flex-col-reverse md:flex-row justify-between gap-8 rounded-[8px] p-8 md:p-10 transition-all duration-300 transform shrink-0 w-full sm:w-[60vw] md:w-auto snap-center self-stretch" data-panel="<?php echo $index; ?>">
                    <div class="w-full md:w-[55%] flex flex-col">
                        <h3 class="text-lg font-semibold font-jost text-dark mb-[10px]">
                            <?php echo esc_html($model['tab_label']); ?>
                        </h3>
                        <p class="text-sm font-normal font-sans text-gray leading-relaxed mb-5">
                            <?php echo wp_kses_post($model['panel_desc']); ?>
                        </p>
                        
                        <?php if (!empty($model['features'])): ?>
                        <ul class="flex flex-col gap-3">
                            <?php foreach ($model['features'] as $feature) : ?>
                            <li class="flex items-start">
                                <img src="<?php echo esc_url($models_feature_icon); ?>" alt="Tick" class="w-5 h-5 flex-shrink-0 mr-3 mt-0.5">
                                <span class="text-sm font-normal text-gray"><?php echo esc_html($feature['text']); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <!-- 3D Illustration Container -->
                    <div class="w-full md:w-[45%] flex items-center justify-center">
                        <img src="<?php echo esc_url($panel_img); ?>" alt="<?php echo esc_attr($model['tab_label']); ?>" class="w-full h-auto object-contain">
                    </div>
                </div>
                <?php endforeach; ?>

                </div> <!-- End Slider Container -->

                <!-- Mobile Slider Navigation -->
                <div class="flex items-center justify-center gap-4 mt-5 md:hidden">
                    <button id="models-slider-prev" aria-label="Previous" class="w-12 h-12 rounded-full border border-gray flex items-center justify-center text-gray hover:text-orange hover:border-orange transition-all duration-300 bg-white cursor-pointer group">
                        <svg class="h-4 w-4 transform rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                    <button id="models-slider-next" aria-label="Next" class="w-12 h-12 rounded-full bg-orange border border-orange flex items-center justify-center text-white hover:bg-[#e65c00] transition-all duration-300 cursor-pointer group">
                        <svg class="h-4 w-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const slider = document.getElementById('models-slider');
                    const prevBtn = document.getElementById('models-slider-prev');
                    const nextBtn = document.getElementById('models-slider-next');

                    if (slider && prevBtn && nextBtn) {
                        prevBtn.addEventListener('click', () => {
                            const cardWidth = slider.querySelector('.model-tab-panel').offsetWidth + 20; // 20px is gap-5
                            slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                        });
                        nextBtn.addEventListener('click', () => {
                            const cardWidth = slider.querySelector('.model-tab-panel').offsetWidth + 20;
                            slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                        });
                    }
                });
                </script>
            </div>
        </div>
    </div>
</section>

<!-- Tab Switcher Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.model-tab-btn');
    const panels = document.querySelectorAll('.model-tab-panel');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            // Deactivate all tabs
            tabs.forEach(t => {
                t.classList.remove('active', 'bg-orangeBorder');
                t.classList.add('bg-transparent');
                
                // Inactive icon wrapper style
                const iconWrap = t.querySelector('.model-tab-icon-wrapper');
                if (iconWrap) {
                    iconWrap.classList.remove('bg-[#FF4A03]', 'text-white');
                    iconWrap.classList.add('border', 'border-orange', 'text-orange');
                }

                // Reset all tab icons to normal/inactive from data attributes
                const img = t.querySelector('.model-tab-icon');
                if (img) {
                    img.src = t.getAttribute('data-icon-normal');
                }
            });

            // Activate current tab button
            tab.classList.add('active', 'bg-orangeBorder');
            tab.classList.remove('bg-transparent');

            const activeIconWrap = tab.querySelector('.model-tab-icon-wrapper');
            if (activeIconWrap) {
                activeIconWrap.classList.add('bg-[#FF4A03]', 'text-white');
                activeIconWrap.classList.remove('border', 'border-orange', 'text-orange');
            }

            // Set active icon style from data attribute
            const activeImg = tab.querySelector('.model-tab-icon');
            if (activeImg) {
                activeImg.src = tab.getAttribute('data-icon-active');
            }

            // Determine which panels should be visible for this tab index
            const visiblePanelIndices = [];
            if (index === 0) {
                visiblePanelIndices.push(0);
            } else if (index === 1) {
                visiblePanelIndices.push(1);
            } else if (index === 2) {
                visiblePanelIndices.push(2);
            }

            // Hide non-applicable panels with fade transition
            panels.forEach((p, pIdx) => {
                const isVisible = visiblePanelIndices.includes(pIdx);
                if (!isVisible) {
                    p.classList.add('opacity-0', 'scale-95');
                    p.classList.remove('opacity-100', 'scale-100');
                    setTimeout(() => {
                        if (!visiblePanelIndices.includes(pIdx)) {
                            p.classList.add('hidden');
                            p.classList.remove('flex');
                        }
                    }, 150);
                }
            });

            // Show applicable panels
            setTimeout(() => {
                panels.forEach((p, pIdx) => {
                    const isVisible = visiblePanelIndices.includes(pIdx);
                    if (isVisible) {
                        p.classList.remove('hidden');
                        p.classList.add('flex');
                        // Trigger reflow to start fade
                        p.offsetHeight;
                        p.classList.remove('opacity-0', 'scale-95');
                        p.classList.add('opacity-100', 'scale-100');
                    }
                });
            }, 150);
        });
    });
});
</script>
