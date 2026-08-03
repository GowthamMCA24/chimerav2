<?php
/**
 * Template part for displaying the Our Process section
 *
 * @package Chimera
 */
?>

<?php
$process_content = get_field('home_process_content') ?: [];
$process_badge = $process_content['badge_text'] ?? '';
$process_heading = $process_content['heading'] ?? '';
$process_highlight = $process_content['highlight_text'] ?? '';
$process_desc = $process_content['description'] ?? '';
$process_cards = $process_content['process_cards'] ?? get_field('process_cards') ?? [];
$process_image = $process_content['process_image'] ?? get_field('process_image') ?? '';
?>

<section class="w-full bg-orange-fade pb-[50px] relative border-b border-lightGray/60">


    <div class="container mx-auto relative z-10">
        
        <!-- Section Header -->
        <div class="text-center flex flex-col items-center mb-10 md:mb-[60px]">
            <!-- Pill Badge -->
            <?php if ($process_badge): ?>
            <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange tracking-wider mb-5">
                <?php echo esc_html($process_badge); ?>
            </div>
            <?php endif; ?>

            <!-- Heading -->
            <h2 class="text-dark text-center leading-[110%] mb-5">
                <?php echo esc_html($process_heading); ?> <span class="text-orange"><?php echo esc_html($process_highlight); ?></span>
            </h2>

            <!-- Description -->
            <p class="font-sans text-gray font-normal text-center mx-auto text-sm md:text-base leading-relaxed max-w-[730px]">
                <?php echo wp_kses_post($process_desc); ?>
            </p>
        </div>

        <!-- ================= DESKTOP STAGGERED LAYOUT ================= -->
        <div class="relative w-full h-[740px] hidden lg:block mx-auto">
            
            <?php 
            if ( ! empty( $process_cards ) && is_array( $process_cards ) ) : 
                $desktop_positions = [
                    'left-0 top-[140px]',
                    'left-[calc((100%-40px)/3+20px)] top-0',
                    'right-0 top-[140px]'
                ];
                foreach ( $process_cards as $index => $card ) :
                    $number = $card['number'] ?? '';
                    $title = $card['title'] ?? '';
                    $description = $card['description'] ?? '';
                    $tags = $card['tags'] ?? [];
                    
                    $position_class = $desktop_positions[$index] ?? 'relative'; // Fallback if more than 3 cards
            ?>
            <!-- Card <?php echo $index + 1; ?>: <?php echo esc_html($title); ?> -->
            <div class="absolute <?php echo esc_attr($position_class); ?> w-[calc((100%-40px)/3)] bg-white border border-bordergray rounded-[10px] p-[30px] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-start group z-10">
                <!-- Title & Number -->
                <div class="flex items-center gap-3.5 mb-5">
                    <div class="w-12 h-12 rounded-full bg-orange-gradient flex items-center justify-center text-white font-jost font-semibold text-[22px] flex-shrink-0">
                        <?php echo esc_html($number); ?>
                    </div>
                    <h3 class="font-jost font-semibold text-lg text-dark leading-none"><?php echo esc_html($title); ?></h3>
                </div>
                <!-- Description -->
                <p class="font-sans font-normal text-sm text-gray leading-relaxed mb-5">
                    <?php echo wp_kses_post($description); ?>
                </p>
                <!-- Tags -->
                <?php if ( ! empty( $tags ) && is_array( $tags ) ) : ?>
                <div class="flex flex-wrap gap-[10px] mt-auto">
                    <?php foreach ( $tags as $tag_item ) : 
                        $tag_text = $tag_item['tag'] ?? '';
                        if ( $tag_text ) :
                    ?>
                    <span class="px-2.5 py-[6px] bg-[#FF4A031A] rounded-[8px] text-xs font-semibold text-orange"><?php echo esc_html($tag_text); ?></span>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
                <?php endif; ?>
            </div>
            <?php 
                endforeach;
            endif; 
            ?>

            <!-- Custom 3D Glowing Pedestal Image (Center Bottom) -->
            <?php if ( $process_image ) : ?>
            <div class="absolute inset-0 flex items-end justify-center z-0 pointer-events-none select-none">
                <?php 
                    if ( is_array( $process_image ) ) {
                        $image_url = $process_image['url'];
                        $image_alt = $process_image['alt'] ?: 'Our Process Pedestal';
                    } else if ( is_numeric( $process_image ) ) {
                        $image_url = wp_get_attachment_image_url( $process_image, 'full' );
                        $image_alt = get_post_meta( $process_image, '_wp_attachment_image_alt', true ) ?: 'Our Process Pedestal';
                    } else {
                        $image_url = $process_image;
                        $image_alt = 'Our Process Pedestal';
                    }
                    
                    if ( $image_url ) :
                ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="max-w-[580px] w-full object-contain mb-0">
                <?php endif; ?>
            </div>
            <?php else : ?>
            <div class="absolute inset-0 flex items-end justify-center z-0 pointer-events-none select-none">
                <img src="/wp-content/uploads/2026/06/chimera-our-process.png" alt="Our Process Pedestal" class="max-w-[580px] w-full object-contain mb-0">
            </div>
            <?php endif; ?>

        </div>

        <!-- ================= MOBILE STACK LAYOUT ================= -->
        <div class="flex lg:hidden flex-col gap-2.5 sm:gap-5 items-center w-full">
            
            <?php 
            if ( ! empty( $process_cards ) && is_array( $process_cards ) ) : 
                foreach ( $process_cards as $index => $card ) :
                    $number = $card['number'] ?? '';
                    $title = $card['title'] ?? '';
                    $description = $card['description'] ?? '';
                    $tags = $card['tags'] ?? [];
            ?>
            <!-- Card <?php echo $index + 1; ?>: <?php echo esc_html($title); ?> -->
            <div class="w-full max-w-md bg-white border border-bordergray rounded-[10px] p-[30px] shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3.5 mb-2.5 sm:mb-5">
                    <div class="w-12 h-12 rounded-full bg-orange-gradient flex items-center justify-center text-white font-jost font-semibold text-[22px] flex-shrink-0">
                        <?php echo esc_html($number); ?>
                    </div>
                    <h3 class="font-jost font-semibold text-lg text-dark leading-none"><?php echo esc_html($title); ?></h3>
                </div>
                <p class="font-sans font-normal text-sm text-gray leading-relaxed mb-5">
                    <?php echo wp_kses_post($description); ?>
                </p>
                <?php if ( ! empty( $tags ) && is_array( $tags ) ) : ?>
                <div class="flex flex-wrap gap-[10px]">
                    <?php foreach ( $tags as $tag_item ) : 
                        $tag_text = $tag_item['tag'] ?? '';
                        if ( $tag_text ) :
                    ?>
                    <span class="px-2.5 py-[6px] bg-[#FF4A031A] rounded-[8px] text-xs font-semibold text-orange"><?php echo esc_html($tag_text); ?></span>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
                <?php endif; ?>
            </div>
            <?php 
                endforeach;
            endif; 
            ?>
            
        </div>

    </div>
</section>
