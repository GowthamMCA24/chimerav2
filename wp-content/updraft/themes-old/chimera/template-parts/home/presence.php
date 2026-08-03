<?php
/**
 * Template part for displaying the Global Presence section
 *
 * @package Chimera
 */
$global_section = get_field( 'global_content' );
$badge_text = $global_section['badge_text'] ?? '';
$heading_black = $global_section['heading_black'] ?? '';
$heading_orange = $global_section['heading_orange'] ?? '';
$description = $global_section['description'] ?? '';
$locations = $global_section['locations'] ?? '';
$world_map_image = $global_section['world_map_image'] ?? '';
?>

<section class="w-full bg-[#E7E7E7] pt-[50px] relative overflow-hidden border-b border-lightGray/60">

    <div class="container text-center flex flex-col items-center relative z-10">
        
        <!-- Badge -->
        <?php if ( $badge_text ) : ?>
            <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
                <?php echo esc_html( $badge_text ); ?>
            </div>
        <?php endif; ?>

        <!-- Heading -->
        <?php if ( $heading_black || $heading_orange ) : ?>
            <h2 class="text-dark mb-5 leading-[48px] tracking-[-0.12px] md:leading-tight md:tracking-normal">
                <?php 
                    if ( $heading_black ) {
                        echo esc_html( $heading_black );
                    }
                ?>
                <?php 
                    if ( $heading_orange ) {
                        echo '<span class="text-orange">' . esc_html( $heading_orange ) . '</span>';
                    }
                ?>
            </h2>
        <?php endif; ?>

        <!-- Description -->
        <?php if ( $description ) : ?>
            <p class="text-gray text-center text-sm sm:text-[16px] font-normal mb-10 sm:mb-[60px]">
                <?php echo wp_kses_post( $description ); ?>
            </p>
        <?php endif; ?>

        <!-- Cards Grid -->
        <?php if ( ! empty( $locations ) && is_array( $locations ) ) : ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 w-full">
                
                <?php 
                    foreach ( $locations as $location_row ) : 
                        $location_icon = $location_row['location_icon'] ?? '';
                        $location_icon_alt = $location_row['location_icon_alt'] ?? '';
                        $country_name = $location_row['country_name'] ?? '';
                        $address = $location_row['address'] ?? '';
                ?>
                    <!-- Location Card -->
                    <div class="bg-white rounded-[10px] p-6 md:p-8 shadow-[1px_1px_4px_0px_#D1CDCD40,-1px_4px_4px_0px_#C8C8C840] hover:-translate-y-1 transition-all duration-300 text-left border border-lightGray/30">
                        
                        <!-- Card Header with Icon and Country Name -->
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-orange-gradient text-white flex items-center justify-center rounded-[10px] flex-shrink-0 shadow-[0_4px_12px_rgba(255,74,3,0.2)]">
                                <?php 
                                    if ( $location_icon ) {
                                        // If ACF returns array (image object)
                                        if ( is_array( $location_icon ) ) {
                                            $icon_url = $location_icon['url'];
                                            $icon_alt = ! empty( $location_icon_alt ) ? $location_icon_alt : $location_icon['alt'];
                                        } else {
                                            // If ACF returns image ID
                                            $icon_src = wp_get_attachment_image_src( $location_icon, 'full' );
                                            $icon_url = $icon_src[0] ?? '';
                                            $icon_alt = ! empty( $location_icon_alt ) ? $location_icon_alt : get_post_meta( $location_icon, '_wp_attachment_image_alt', true );
                                        }
                                        
                                        if ( ! empty( $icon_url ) ) {
                                            echo '<img src="' . esc_url( $icon_url ) . '" alt="' . esc_attr( $icon_alt ) . '" class="w-7 h-7 object-contain">';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="flex-1">
                                <?php if ( $country_name ) : ?>
                                    <h3 class="text-lg   font-semibold  text-dark font-jost"><?php echo esc_html( $country_name ); ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Company Name -->
                        <?php 
                            $company_name = $location_row['company_name'] ?? '';
                            if ( $company_name ) : 
                        ?>
                            <p class="text-sm font-semibold text-dark mb-3">
                                <?php echo esc_html( $company_name ); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Card Description/Address -->
<?php if ( $address ) : ?>
    <div class="mt-[10px]">
        <?php
        $address_lines = preg_split('/\r\n|\r|\n/', trim($address));

        foreach ( $address_lines as $line ) {
            if ( trim($line) === '' ) {
                continue;
            }

            echo '<p class="font-sans font-normal text-sm text-gray leading-relaxed m-0">' . esc_html($line) . '</p>';
        }
        ?>
    </div>
<?php endif; ?>
                    </div>
                <?php 
                    endforeach; 
                ?>

            </div>
        <?php endif; ?>

        <!-- World Map Background -->
        <?php if ( $world_map_image ) : ?>
            <div class="max-w-4xl h-auto pointer-events-none z-0">
                <?php 
                    if ( is_array( $world_map_image ) ) {
                        $map_url = $world_map_image['url'];
                        $map_alt = $world_map_image['alt'];
                    } else {
                        $map_src = wp_get_attachment_image_src( $world_map_image, 'full' );
                        $map_url = $map_src[0];
                        $map_alt = get_post_meta( $world_map_image, '_wp_attachment_image_alt', true );
                    }
                    
                    if ( ! empty( $map_url ) ) {
                        echo '<img src="' . esc_url( $map_url ) . '" alt="' . esc_attr( $map_alt ) . '" class="w-full h-auto object-contain">';
                    }
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
