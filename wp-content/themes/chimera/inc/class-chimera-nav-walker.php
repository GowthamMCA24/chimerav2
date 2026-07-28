<?php
/**
 * Chimera Custom Nav Walker
 * 
 * Matches the simple layout exactly.
 * - Top-level items as buttons with chevron
 * - Dropdown panels with simple block links (plus optional ACF icons)
 * - CTA button rendering for items marked with 'is_cta_button' ACF field.
 *
 * @package Chimera
 */

if ( ! class_exists( 'Chimera_Nav_Walker' ) ) {

    class Chimera_Nav_Walker extends Walker_Nav_Menu {
        private $css_added = false;

        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element ) {
                return;
            }

            // Bubble up active state to parent if a child is active via custom logic
            if ( $depth === 0 && ! empty( $children_elements[ $element->ID ] ) ) {
                $home_url = rtrim( home_url(), '/' );
                global $wp;
                $current_path = trim( parse_url( home_url( $wp->request ), PHP_URL_PATH ) ?? '', '/' );
                
                foreach ( $children_elements[ $element->ID ] as $child ) {
                    $classes = empty( $child->classes ) ? array() : (array) $child->classes;
                    if ( in_array('current-menu-item', $classes) ) {
                        $element->classes[] = 'current-menu-parent';
                        break;
                    }

                    $child_url = rtrim( $child->url, '/' );
                    if ( $child_url !== $home_url && $child_url !== '' ) {
                        $child_path = trim( parse_url( $child->url, PHP_URL_PATH ) ?? '', '/' );
                        if ( !empty($child_path) ) {
                            // Only match exact archive path or pagination, NOT single post pages
                            if ( $current_path === $child_path || strpos($current_path, $child_path . '/page/') === 0 ) {
                                $element->classes[] = 'current-menu-parent';
                                break;
                            }
                        }
                    }
                }
            }

            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        /**
         * Start a top-level <ul> or sub-menu <div> wrapper.
         */
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                if ( ! $this->css_added ) {
                    $output .= '<style>
                        /* Only the last two menus are responsive and centered to prevent clipping */
                        .chimera-top-item:nth-last-child(2) .chimera-submenu, .chimera-top-item:last-child .chimera-submenu { left: 50% !important; right: auto !important; transform: translateX(-50%) !important; width: 300px !important; max-width: 95vw !important; }
                        @media (min-width: 768px) { .chimera-top-item:nth-last-child(2) .chimera-submenu, .chimera-top-item:last-child .chimera-submenu { width: 600px !important; } }
                        .chimera-top-item:nth-last-child(2) .chimera-submenu-grid, .chimera-top-item:last-child .chimera-submenu-grid { grid-template-columns: repeat(1, minmax(0, 1fr)) !important; }
                        @media (min-width: 768px) { .chimera-top-item:nth-last-child(2) .chimera-submenu-grid, .chimera-top-item:last-child .chimera-submenu-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; } }
                    </style>';
                    $this->css_added = true;
                }
                // Sub-menu dropdown wrapper matching header.php exact layout
                $output .= '<div class="absolute left-0 top-full w-[600px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 chimera-submenu">';
                $output .= '<div class="bg-white rounded-[10px] shadow-[0px_4px_20px_rgba(0,0,0,0.08)] p-[14px] grid grid-cols-2 gap-2 chimera-submenu-grid">';
            }
        }

        /**
         * Close the sub-menu wrapper.
         */
        public function end_lvl( &$output, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                $output .= '</div></div>';
            }
        }

        /**
         * Render each menu item.
         */
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $is_active = false;
            // Catch active parents/ancestors, but ignore false-positives on '#' links
            if ( in_array('current-menu-ancestor', $classes) || in_array('current-menu-parent', $classes) ) {
                $is_active = true;
            } elseif ( $item->url !== '#' && $item->url !== site_url('/#') ) {
                if ( in_array( 'current-menu-item', $classes ) ) {
                    $is_active = true;
                } else {
                    // Fallback URL matching for Custom Post Type archives and single posts
                    $home_url = rtrim( home_url(), '/' );
                    $item_url = rtrim( $item->url, '/' );
                    
                    // Only apply fallback if this isn't the Home page link
                    if ( $item_url !== $home_url && $item_url !== '' ) {
                        global $wp;
                        $current_path = trim( parse_url( home_url( $wp->request ), PHP_URL_PATH ) ?? '', '/' );
                        $item_path = trim( parse_url( $item->url, PHP_URL_PATH ) ?? '', '/' );
                        
                        if ( !empty($item_path) ) {
                            // Only match exact archive path or pagination, NOT single post pages
                            if ( $current_path === $item_path || strpos($current_path, $item_path . '/page/') === 0 ) {
                                $is_active = true;
                            }
                        }
                    }
                }
            }
            $has_children = in_array( 'menu-item-has-children', $classes );

            if ( $depth === 0 ) {
                // Check ACF field for CTA button
                $is_cta = function_exists('get_field') ? get_field('is_cta_button', $item->ID) : false;

                if ( $is_cta ) {
                    $output .= '<div class="hidden lg:flex items-center ml-8 chimera-top-item">';
                    $output .= '<a href="' . esc_url( $item->url ) . '" class="bg-orange hover:opacity-95 text-white px-6 py-3 rounded-[20px] text-[15px] font-semibold tracking-normal inline-flex items-center gap-2 shadow-lg transition-transform active:scale-95 focus:outline-none">';
                    $output .= esc_html( $item->title );
                    $output .= '<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';
                    $output .= '</a>';
                } else {
                    $output .= '<div class="relative group py-4 chimera-top-item">';

                    if ( $has_children ) {
                        $parent_active = $is_active ? 'text-orange bg-orangeLightest' : 'text-dark hover:text-orange';
                        $output .= '<button class="flex items-center gap-1 px-3 py-2 rounded-[8px] text-base transition-colors duration-200 focus:outline-none ' . esc_attr($parent_active) . '" aria-expanded="false">';
                        $output .= esc_html( $item->title );
                        $svg_color = $is_active ? 'text-orange group-hover:rotate-180' : 'text-dark group-hover:text-orange group-hover:rotate-180';
                        $output .= '<svg class="h-4 w-4 transform transition-all duration-300 ' . esc_attr($svg_color) . '" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>';
                        $output .= '</button>';
                    } else {
                        $parent_active = $is_active ? 'text-orange bg-orangeLightest' : 'text-dark hover:text-orange';
                        $output .= '<a href="' . esc_url( $item->url ) . '" class="flex items-center gap-1 px-3 py-2 rounded-lg transition-colors duration-200 focus:outline-none ' . esc_attr($parent_active) . '">';
                        $output .= esc_html( $item->title );
                        $output .= '</a>';
                    }
                }

            } else {
                // Sub-menu items
                $active_class = $is_active ? 'bg-[#FFF0E6]' : 'hover:bg-[#FFF0E6]';
                // ACF icon image - securely handle Array, ID, or String return types
                $icon = function_exists('get_field') ? get_field('menu_icon_image', $item->ID) : '';
                $icon_url = '';
                
                if ( is_array($icon) && isset($icon['url']) ) {
                    $icon_url = $icon['url'];
                } elseif ( is_numeric($icon) ) {
                    $icon_url = wp_get_attachment_url($icon);
                } elseif ( is_string($icon) ) {
                    $icon_url = $icon;
                }
                
                $description = !empty($item->description) ? $item->description : '';
                
                $output .= '<a href="' . esc_url( $item->url ) . '" class="flex items-center gap-4 p-5 rounded-[8px] group/sub transition-colors duration-200 ' . esc_attr($active_class) . '">';
                
                if ( $icon_url ) {
                    $output .= '<img src="' . esc_url($icon_url) . '" alt="" class="w-6 h-6 object-contain flex-shrink-0" />';
                }
                
                $output .= '<div class="flex flex-col">';
                $title_color = 'text-dark'; // Keep dark initially to match screenshot
                $output .= '<div class="font-semibold font-sans text-[15px] leading-tight mb-1 ' . esc_attr($title_color) . ' group-hover/sub:text-dark transition-colors">' . esc_html( $item->title ) . '</div>';
                if ( $description ) {
                    $output .= '<div class="text-xs text-gray font-normal leading-tight">' . esc_html( $description ) . '</div>';
                }
                $output .= '</div>';

                $output .= '</a>';
            }
        }

        /**
         * Close each menu item.
         */
        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                $output .= '</div>';
            }
        }

    }
}
