<?php
/**
 * Template part for displaying the Our Values section
 *
 * @package Chimera
 */

$values_content = get_field('about_values') ?: [];
$badge_text = $values_content['badge_text'] ?? '';
$heading = $values_content['heading'] ?? '';
$description = $values_content['description'] ?? '';
$items = $values_content['items'] ?? [];
?>

<section class="w-full bg-lightGray pt-[50px] relative overflow-hidden">
    <div class="container flex flex-col items-center">
        
        <div class="flex flex-col items-center gap-[20px] w-full mb-[60px]">
            
            <!-- Badge -->
            <?php if ( $badge_text ) : ?>
                <div class="inline-flex items-center justify-center bg-white border border-[rgba(255,74,3,0.2)] h-8 min-w-[32px] px-3 py-0 rounded-[8px]">
                    <span class="text-[12px] font-semibold text-orange uppercase font-jost leading-[18px]">
                        <?php echo esc_html( $badge_text ); ?>
                    </span>
                </div>
            <?php endif; ?>

            <!-- Heading -->
            <?php if ( $heading ) : ?>
                <h2 class="text-dark tracking-[-0.12px] text-[36px] md:text-[44px] leading-none text-center">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            <?php endif; ?>

            <!-- Description -->
            <?php if ( $description ) : ?>
                <p class="max-w-[454px] text-center font-sans font-normal text-gray text-[16px] leading-[1.5]">
                    <?php echo wp_kses_post( $description ); ?>
                </p>
            <?php endif; ?>

        </div>

        <!-- Values Grid -->
        <?php if ( ! empty($items) && is_array($items) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6 w-full">
                
                <?php foreach ( $items as $item ) : 
                    $icon = $item['icon'] ?? '';
                    $title = $item['title'] ?? '';
                    $desc = $item['description'] ?? '';
                    $is_wide = $item['is_wide'] ?? false;
                    
                    $col_class = $is_wide ? 'md:col-span-4' : 'md:col-span-2';
                ?>
                    <div class="<?php echo $col_class; ?> bg-white rounded-[10px] p-[30px] lg:px-[40px] shadow-[-1px_4px_4px_0px_rgba(200,200,200,0.25),1px_1px_4px_0px_rgba(209,205,205,0.25)] flex flex-col items-start">
                        
                        <div class="flex flex-col gap-[24px] items-start w-full mb-[10px]">
                            
                            <!-- Icon -->
                            <?php if ( $icon ) : 
                                $icon_url = is_array($icon) ? $icon['url'] : wp_get_attachment_image_url($icon, 'full');
                                $icon_alt = is_array($icon) ? $icon['alt'] : get_post_meta($icon, '_wp_attachment_image_alt', true);
                            ?>
                                <div class="w-[38px] h-[38px] flex items-center justify-center rounded-[8px] bg-gradient-to-b from-[#FF8B4D] to-[#FF4A03] border border-orange">
                                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" class="w-[20px] h-[20px] object-contain filter invert brightness-0">
                                </div>
                            <?php endif; ?>

                            <!-- Title -->
                            <?php if ( $title ) : ?>
                                <h3 class="font-jost font-semibold text-[18px] text-dark leading-none">
                                    <?php echo esc_html( $title ); ?>
                                </h3>
                            <?php endif; ?>

                        </div>

                        <!-- Description -->
                        <?php if ( $desc ) : ?>
                            <p class="font-sans font-normal text-[14px] text-gray leading-[1.5] m-0 p-0">
                                <?php echo wp_kses_post( $desc ); ?>
                            </p>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>
</section>
