<?php
/**
 * Template part for displaying the Industry Challenges section
 * Accordion-style expandable items with image on the right
 *
 * @package Chimera
 */

$challenges = get_field('industry_challenges');
$badge_text        = $challenges['badge_text'] ?? 'HealthTech Challenges';
$heading           = $challenges['heading'] ?? 'Transformation Towards';
$heading_highlight = $challenges['heading_highlight'] ?? 'Digital Healthcare Operations';
$description       = $challenges['description'] ?? '';
$image             = $challenges['image'] ?? null;
$items             = $challenges['items'] ?? [];
?>

<section class="ind-challenges w-full bg-white py-[60px] md:py-[80px] relative overflow-hidden">
    <div class="container">
        
        <div class="flex flex-col gap-[60px]">
            <!-- Section Header -->
            <div class="flex flex-col gap-5 items-center md:items-start text-center md:text-left">
                <!-- Badge -->
                <div class="inline-flex font-jost items-center justify-center px-3 py-1.5 h-[32px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] text-xs font-semibold uppercase text-orange w-[max-content]">
                    <?php echo esc_html( $badge_text ); ?>
                </div>

                <!-- Heading -->
                <h2 class="text-center md:text-left leading-[1.2]">
                    <?php echo wp_kses_post( $heading ); ?>
                    <span class="text-orange"><?php echo wp_kses_post( $heading_highlight ); ?></span>
                </h2>

                <?php if ( $description ) : ?>
                <p class="font-sans font-normal text-gray text-base leading-[1.5]">
                    <?php echo wp_kses_post( $description ); ?>
                </p>
                <?php endif; ?>
            </div>

            <!-- Two Column Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-[55fr_45fr] gap-[40px] lg:gap-[80px] items-start w-full">
                
                <!-- Left: Accordion Items -->
                <div class="flex flex-col">
                    <?php 
                        $first_image_url = '';
                        if ( $items ) : 
                    ?>
                        <?php foreach ( $items as $index => $item ) : 
                            $is_first = ( $index === 0 );
                            // Use item image only (no fallback to main image)
                            $item_image = $item['image'] ?? $item['img'] ?? null;
                            $item_image_url = $item_image['url'] ?? '';
                            
                            if ( $is_first ) {
                                $first_image_url = $item_image_url;
                            }
                        ?>
                        <div class="ind-challenge-item transition-all duration-300 px-[20px] md:px-[30px] py-[20px] md:py-[24px] <?php echo $is_first ? 'active bg-orangeLightest rounded-[10px]' : ''; ?>" data-index="<?php echo $index; ?>" data-image="<?php echo esc_url($item_image_url); ?>">
                            <!-- Accordion Header -->
                            <button class="ind-challenge-toggle w-full flex items-center justify-between text-left cursor-pointer group outline-none focus:outline-none focus:ring-0 [-webkit-tap-highlight-color:transparent]" aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>">
                                <h5 class="font-jost font-semibold text-lg transition-colors duration-300 <?php echo $is_first ? 'text-orange' : 'text-dark'; ?>">
                                    <?php echo esc_html( $item['title'] ); ?>
                                </h5>
                            </button>
                            <!-- Accordion Content -->
                            <div class="ind-challenge-content overflow-hidden transition-all duration-400 ease-in-out <?php echo $is_first ? 'max-h-[500px] opacity-100' : 'max-h-0 opacity-0'; ?>">
                                <div class="pt-2.5">
                                    <p class="font-sans font-normal text-gray text-sm leading-[1.5]">
                                        <?php echo esc_html( $item['description'] ); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Right: Image -->
                <div class="flex items-start justify-center h-full">
                    <div class="w-full h-[300px] lg:h-[430px] rounded-[10px] flex items-center justify-center">
                        <?php 
                            $img_src = !empty($first_image_url) ? esc_url($first_image_url) : '';
                            $visibility_classes = !empty($first_image_url) ? 'opacity-100' : 'opacity-0 hidden';
                        ?>
                        <img id="ind-challenge-main-img" src="<?php echo $img_src; ?>" alt="<?php echo esc_attr( $heading ); ?>" class="w-full h-full object-contain transition-opacity duration-300 <?php echo $visibility_classes; ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
