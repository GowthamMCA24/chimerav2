<?php
/**
 * The template for displaying the footer
 *
 * @package Chimera
 */

// Get all option fields in a single call
$options        = get_fields('option');
$footer_left    = $options['footer_left'] ?? [];
$footer_columns = $options['footer_columns'] ?? [];
$logo_2         = $options['logo_2'] ?? [];
$footer_image_1 = $options['footer_image_1'] ?? null;
$footer_image_2 = $options['footer_image_2'] ?? null;
?>

<footer class="bg-white border-t border-lightGray pt-20 relative overflow-hidden">

    <!-- Footer Flex Layout -->
    <div class="container mx-auto flex flex-col md:flex-row md:flex-wrap lg:flex-nowrap justify-between gap-12 lg:gap-6 xl:gap-8 relative z-10 mb-16">

        <!-- Left Brand & Description Column -->
        <div class="w-full md:w-[40%] lg:w-[20%] flex flex-col gap-6">

            <?php if ( ! empty( $footer_left['logo'] ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group focus:outline-none" aria-label="Chimera Home">
                    <img src="<?php echo esc_url( $footer_left['logo']['url'] ); ?>" alt="<?php echo esc_attr( $footer_left['logo']['alt'] ); ?>" class="w-[160px]">
                </a>
            <?php endif; ?>

            <?php if ( ! empty( $footer_left['description'] ) ) : ?>
                <p class="text-xs leading-relaxed text-gray font-normal">
                    <?php echo esc_html( $footer_left['description'] ); ?>
                </p>
            <?php endif; ?>

            <!-- Social Icons -->
            <?php if ( ! empty( $footer_left['social_icon'] ) ) : ?>
                <div class="flex items-center gap-3">
                    <?php foreach ( $footer_left['social_icon'] as $social ) : ?>
                        <?php
                            $social_icon = $social['icon'];
                            $social_link = $social['link'];
                            $link_url    = is_array( $social_link ) ? $social_link['url'] : $social_link;
                            $link_target = is_array( $social_link ) && ! empty( $social_link['target'] ) ? $social_link['target'] : '_blank';
                            $link_title  = is_array( $social_link ) && ! empty( $social_link['title'] ) ? $social_link['title'] : '';
                        ?>
                        <?php if ( ! empty( $social_icon ) && ! empty( $link_url ) ) : ?>
                            <a href="<?php echo esc_url( $link_url ); ?>"
                               target="<?php echo esc_attr( $link_target ); ?>"
                               rel="noopener noreferrer"
                               class="h-10 w-10 rounded-full bg-[#6666661A] text-gray hover:text-white flex items-center justify-center transition-colors duration-200"
                               aria-label="<?php echo esc_attr( $link_title ? $link_title : $social_icon['alt'] ); ?>">
                                <img src="<?php echo esc_url( $social_icon['url'] ); ?>"
                                     alt="<?php echo esc_attr( $social_icon['alt'] ); ?>"
                                     class="h-[18px] w-[18px]">
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- Dynamic Footer Columns -->
        <?php if ( ! empty( $footer_columns ) ) : ?>
            <?php 
            $grouped = [];
            foreach ( $footer_columns as $column ) {
                $title = strtolower(trim($column['column_title'] ?? ''));
                if ( $title === 'legal' ) {
                    $found = false;
                    foreach ( $grouped as &$g ) {
                        if ( strtolower(trim($g['column_title'] ?? '')) === 'company' ) {
                            $g['sub_columns'][] = $column;
                            $found = true;
                            break;
                        }
                    }
                    if ( ! $found ) $grouped[] = $column;
                } else {
                    $grouped[] = $column;
                }
            }
            ?>
            <?php foreach ( $grouped as $column ) : ?>
                <div class="w-full md:w-[45%] lg:w-auto flex flex-col gap-8">
                    <div class="flex flex-col gap-4">
                        <?php if ( ! empty( $column['column_title'] ) ) : ?>
                            <h5 class="text-[16px] font-bold text-dark font-sans">
                                <?php echo esc_html( $column['column_title'] ); ?>
                            </h5>
                        <?php endif; ?>

                        <?php if ( ! empty( $column['column_links'] ) ) : ?>
                            <ul class="flex flex-col gap-3 text-[13px] text-dark font-normal">
                                <?php foreach ( $column['column_links'] as $link_item ) : ?>
                                    <?php if ( ! empty( $link_item['link_text'] ) ) : ?>
                                        <li>
                                            <?php
                                            $footer_link_url = '#';
                                            if ( ! empty( $link_item['link'] ) ) {
                                                $raw_link = $link_item['link'];
                                                if ( is_array( $raw_link ) ) {
                                                    $footer_link_url = $raw_link['url'] ?? '#';
                                                } elseif ( preg_match( '/^https?:\/\//', $raw_link ) ) {
                                                    $footer_link_url = $raw_link;
                                                } else {
                                                    $footer_link_url = home_url( '/' . ltrim( $raw_link, '/' ) );
                                                }
                                            }
                                        ?>
                                        <a href="<?php echo esc_url( $footer_link_url ); ?>" class="hover:text-orange transition-colors">
                                                <?php echo esc_html( $link_item['link_text'] ); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $column['sub_columns'] ) ) : ?>
                        <?php foreach ( $column['sub_columns'] as $sub_col ) : ?>
                            <div class="flex flex-col gap-4">
                                <?php if ( ! empty( $sub_col['column_title'] ) ) : ?>
                                    <h5 class="text-[16px] font-bold text-dark font-sans">
                                        <?php echo esc_html( $sub_col['column_title'] ); ?>
                                    </h5>
                                <?php endif; ?>

                                <?php if ( ! empty( $sub_col['column_links'] ) ) : ?>
                                    <ul class="flex flex-col gap-3 text-[13px] text-dark font-normal">
                                        <?php foreach ( $sub_col['column_links'] as $link_item ) : ?>
                                            <?php if ( ! empty( $link_item['link_text'] ) ) : ?>
                                                <li>
                                                    <?php
                                                    $footer_link_url = '#';
                                                    if ( ! empty( $link_item['link'] ) ) {
                                                        $raw_link = $link_item['link'];
                                                        if ( is_array( $raw_link ) ) {
                                                            $footer_link_url = $raw_link['url'] ?? '#';
                                                        } elseif ( preg_match( '/^https?:\/\//', $raw_link ) ) {
                                                            $footer_link_url = $raw_link;
                                                        } else {
                                                            $footer_link_url = home_url( '/' . ltrim( $raw_link, '/' ) );
                                                        }
                                                    }
                                                ?>
                                                <a href="<?php echo esc_url( $footer_link_url ); ?>" class="hover:text-orange transition-colors">
                                                        <?php echo esc_html( $link_item['link_text'] ); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Right Side Images -->
        <?php if ( ! empty( $footer_image_1 ) || ! empty( $footer_image_2 ) ) : ?>
            <div class="w-full md:w-[45%] lg:w-auto flex flex-col gap-6 lg:items-end">
                <?php if ( ! empty( $footer_image_1 ) ) : ?>
                    <img src="<?php echo esc_url( $footer_image_1['url'] ); ?>" alt="<?php echo esc_attr( $footer_image_1['alt'] ); ?>" class="max-w-[160px] object-contain">
                <?php endif; ?>
                <?php if ( ! empty( $footer_image_2 ) ) : ?>
                    <img src="<?php echo esc_url( $footer_image_2['url'] ); ?>" alt="<?php echo esc_attr( $footer_image_2['alt'] ); ?>" class="max-w-[160px] object-contain">
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Copyright Bar -->
    <div class="container text-center md:text-left relative z-10">
        <p class="text-[13px] text-gray font-normal font-sans">
            <?php 
            $current_year = date('Y');
            $home_url = esc_url( home_url( '/' ) );
            $default_copyright = '© {year} <a href="' . $home_url . '" class="hover:text-orange transition-colors">Chimera</a>. All Rights Reserved';
            $copyright = $options['footer_copyright'] ?? $default_copyright; 
            $copyright = str_replace('{year}', $current_year, $copyright);
            echo wp_kses_post( $copyright ); 
            ?>
        </p>
    </div>

    <!-- Giant Background Watermark Image -->
    <?php if ( ! empty( $logo_2 ) ) : ?>
        <div class="relative w-full overflow-hidden flex justify-center items-center pointer-events-none mt-12 px-8">
            <img src="<?php echo esc_url( $logo_2['url'] ); ?>" alt="<?php echo esc_attr( $logo_2['alt'] ); ?>">
        </div>
    <?php endif; ?>

</footer>

<?php wp_footer(); ?>
</body>
</html>
