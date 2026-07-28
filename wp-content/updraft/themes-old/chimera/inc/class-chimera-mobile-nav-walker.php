<?php
/**
 * Chimera Mobile Nav Walker
 */

if ( ! class_exists( 'Chimera_Mobile_Nav_Walker' ) ) {

    class Chimera_Mobile_Nav_Walker extends Walker_Nav_Menu {

        private $item_count = 0;

        public function start_lvl( &$output, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                $output .= '<div class="mobile-dropdown-menu hidden pl-2 flex flex-col gap-3 text-sm font-semibold mt-2">';
            }
        }

        public function end_lvl( &$output, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                $output .= '</div>';
            }
        }

        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $has_children = in_array( 'menu-item-has-children', $classes );
            
            $is_active = false;
            // Catch active parents/ancestors, but ignore false-positives on '#' links
            if ( in_array('current-menu-ancestor', $classes) || in_array('current-menu-parent', $classes) ) {
                $is_active = true;
            } elseif ( $item->url !== '#' && $item->url !== site_url('/#') ) {
                $is_active = in_array( 'current-menu-item', $classes );
            }

            if ( $depth === 0 ) {
                $this->item_count++;
                
                $wrapper_class = ($this->item_count > 1);
                $output .= '<div class="' . esc_attr($wrapper_class) . '">';

                if ( $has_children ) {
                    $parent_active = $is_active ? 'text-orange bg-orangeLightest' : 'text-dark';
                    $output .= '<button class="mobile-dropdown-trigger w-full flex items-center justify-between text-base font-semibold tracking-wider mb-2 p-4 rounded-[8px] focus:outline-none ' . esc_attr($parent_active) . '">';
                    $output .= esc_html( $item->title );
                    $svg_color = $is_active ? 'text-orange rotate-180' : 'text-dark';
                    $output .= '<svg class="h-4 w-4 transform transition-transform duration-300 ' . esc_attr($svg_color) . '" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>';
                    $output .= '</button>';
                } else {
                    $parent_active = $is_active ? 'text-orange bg-orangeLightest' : 'text-dark';
                    $output .= '<a href="' . esc_url( $item->url ) . '" class="w-full flex items-center justify-between text-base font-semibold tracking-wider mb-2 p-4 rounded-[8px] focus:outline-none ' . esc_attr($parent_active) . '">';
                    $output .= esc_html( $item->title );
                    $output .= '</a>';
                }
            } else {
                $active_class = $is_active ? 'bg-orangeLightest' : 'hover:bg-offwhite';
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
                
                $output .= '<a href="' . esc_url( $item->url ) . '" class="flex items-start gap-4 p-4 rounded-[8px] group/sub transition-colors p-4 ' . esc_attr($active_class) . '">';
                
                if ( $icon_url ) {
                    $output .= '<img src="' . esc_url($icon_url) . '" alt="" class="w-6 h-6 object-contain self-center flex-shrink-0" />';
                }
                
                $output .= '<div>';
                $title_color = 'text-dark';
                $output .= '<div class="font-semibold font-sans text-sm mb-1 ' . esc_attr($title_color) . ' group-hover/sub:text-orange transition-colors">' . esc_html( $item->title ) . '</div>';
                if ( $description ) {
                    $output .= '<div class="text-xs text-gray font-normal leading-snug">' . esc_html( $description ) . '</div>';
                }
                $output .= '</div>';
                $output .= '</a>';
            }
        }

        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            if ( $depth === 0 ) {
                $output .= '</div>';
            }
        }

    }
}
