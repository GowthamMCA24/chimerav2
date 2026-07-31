<?php
/**
 * Chimera Theme Functions and Definitions
 *
 * @package Chimera
 * @author Epic
 */

// Include Custom Nav Walkers
require_once get_template_directory() . '/inc/class-chimera-nav-walker.php';
require_once get_template_directory() . '/inc/class-chimera-mobile-nav-walker.php';

if ( ! function_exists( 'chimera_setup' ) ) {
    function chimera_setup() {
        // Add support for automated title tags
        add_theme_support( 'title-tag' );

        // Add support for HTML5 elements
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

        // Add support for post thumbnails
        add_theme_support( 'post-thumbnails' );

        // Register custom image sizes for blog
        add_image_size( 'chimera-blog-card', 400, 280, true );
        add_image_size( 'chimera-blog-hero', 1200, 600, true );

        // Register Primary Navigation Menu
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'chimera' ),
            'footer'  => esc_html__( 'Footer Menu', 'chimera' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'chimera_setup' );

/**
 * Enqueue scripts and styles.
 */
function chimera_scripts() {
    // Enqueue Google Fonts: DM Sans & Jost
    wp_enqueue_style( 'chimera-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Jost:ital,wght@0,100..900;1,100..900&display=swap', array(), null );

    // Enqueue compiled Tailwind CSS stylesheet with dynamic versioning to break browser cache
    $css_file = get_template_directory() . '/assets/css/output.css';
    $css_version = file_exists($css_file) ? filemtime($css_file) : '1.0.0';
    wp_enqueue_style( 'chimera-styles', get_template_directory_uri() . '/assets/css/output.css', array(), $css_version );

    // Enqueue navigation interaction scripts
    wp_enqueue_script( 'chimera-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );

    // Enqueue blog scripts on blog listing and single post pages
    if ( is_page_template( 'page-blog.php' ) || is_singular( 'post' ) || is_singular( 'whitepaper' ) || is_singular( 'casestudies' ) || is_singular( 'webinar' ) ) {
        $blog_js_file = get_template_directory() . '/assets/js/blog.js';
        $blog_js_version = file_exists($blog_js_file) ? filemtime($blog_js_file) : '1.0.0';
        wp_enqueue_script( 'chimera-blog', get_template_directory_uri() . '/assets/js/blog.js', array(), $blog_js_version, true );
    }

    // Enqueue AJAX script on blog and whitepapers archive pages
    if ( is_page_template( 'page-blog.php' ) || is_post_type_archive( 'whitepaper' ) || is_post_type_archive( 'casestudies' ) || is_post_type_archive( 'webinar' ) ) {
        wp_enqueue_script( 'chimera-blog-ajax', get_template_directory_uri() . '/assets/js/blog-ajax.js', array(), '1.0.0', true );
        wp_localize_script( 'chimera-blog-ajax', 'chimeraAjax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ) );
    }

    // Enqueue industry page scripts
    if ( is_page_template( 'page-templates/template-industry.php' ) ) {
        $industry_js_file = get_template_directory() . '/assets/js/industry.js';
        $industry_js_version = file_exists($industry_js_file) ? filemtime($industry_js_file) : '1.0.0';
        wp_enqueue_script( 'chimera-industry', get_template_directory_uri() . '/assets/js/industry.js', array(), $industry_js_version, true );
    }

    // Enqueue about page scripts
    if ( is_page_template( 'page-templates/template-about.php' ) ) {
        $about_js_file = get_template_directory() . '/assets/js/about.js';
        $about_js_version = file_exists($about_js_file) ? filemtime($about_js_file) : '1.0.0';
        wp_enqueue_script( 'chimera-about', get_template_directory_uri() . '/assets/js/about.js', array(), $about_js_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'chimera_scripts' );

/**
 * Calculate estimated reading time for a post.
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return int Estimated reading time in minutes.
 */
function chimera_reading_time( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = max( 1, ceil( $word_count / 250 ) );
    return $reading_time;
}

/**
 * Get formatted category list for a post.
 * Supports standard posts and custom post types (like whitepapers).
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return array Array of category objects with name, slug, and link.
 */
function chimera_get_post_categories( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $post_type = get_post_type( $post_id );
    if ( $post_type === 'whitepaper' ) {
        $taxonomy = 'whitepaper_category';
    } elseif ( $post_type === 'casestudies' ) {
        $taxonomy = 'casestudies_category';
    } elseif ( $post_type === 'webinar' ) {
        $taxonomy = 'webinar_category';
    } elseif ( $post_type === 'event' ) {
        $taxonomy = 'event_category';
    } else {
        $taxonomy = 'category';
    }
    $categories = get_the_terms( $post_id, $taxonomy );
    $result = array();
    
    if ( $categories && ! is_wp_error( $categories ) ) {
        foreach ( $categories as $cat ) {
            $result[] = (object) array(
                'name' => $cat->name,
                'slug' => $cat->slug,
                'link' => get_term_link( $cat->term_id, $taxonomy ),
            );
        }
    }
    return $result;
}

/**
 * AJAX handler for archive (blog/whitepapers) category filtering and live search.
 */
function chimera_filter_archive_ajax_handler() {
    $args = array();
    if ( isset( $_POST['post_type'] ) ) {
        $args['post_type'] = sanitize_text_field( $_POST['post_type'] );
    }
    if ( isset( $_POST['taxonomy'] ) ) {
        $args['taxonomy'] = sanitize_text_field( $_POST['taxonomy'] );
    }
    get_template_part( 'template-parts/blog/grid', null, $args );
    wp_die();
}
add_action( 'wp_ajax_filter_archive', 'chimera_filter_archive_ajax_handler' );
add_action( 'wp_ajax_nopriv_filter_archive', 'chimera_filter_archive_ajax_handler' );

/**
 * Auto-create Resource Detail page on theme init if it doesn't exist
 */
function chimera_create_resource_detail_page() {
    $slug = 'resource-detail';
    $page = get_page_by_path( $slug );
    
    if ( ! $page ) {
        $page_id = wp_insert_post( array(
            'post_title'    => 'Resource Detail',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => $slug,
        ) );
        
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-templates/template-resource-detail.php' );
        }
    }
}
add_action( 'init', 'chimera_create_resource_detail_page' );

/**
 * Helper: Determine webinar status based on webinar_date ACF field.
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return string 'upcoming' or 'past'
 */
function chimera_get_webinar_status( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $webinar_date = get_field( 'webinar_date', $post_id );
    if ( ! empty( $webinar_date ) ) {
        $event_time = strtotime( $webinar_date );
        if ( $event_time && $event_time > current_time( 'timestamp' ) ) {
            return 'upcoming';
        }
    }
    return 'past';
}

/**
 * Shortcode for Speaker Card
 * Usage: [chimera_speaker name="Sydney Sloan" title="CMO" role="Featuring" photo="url"]
 */
function chimera_speaker_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'name'  => 'Speaker Name',
        'title' => 'Speaker Title',
        'role'  => '',
        'photo' => '',
    ), $atts, 'chimera_speaker' );

    $name  = esc_html( $atts['name'] );
    $title = esc_html( $atts['title'] );
    $role  = esc_html( $atts['role'] );
    $photo = esc_url( $atts['photo'] );

    $initial = esc_html( substr( $name, 0, 1 ) );

    $photo_html = '';
    if ( $photo ) {
        $photo_html = '<img src="' . $photo . '" alt="' . esc_attr( $name ) . '" class="absolute inset-0 w-full h-full object-cover !m-0">';
    } else {
        $photo_html = '<div class="w-full h-full flex items-center justify-center text-orange font-jost font-bold text-3xl bg-orange/5 !m-0">' . $initial . '</div>';
    }

    $role_html = '';
    if ( $role ) {
        $role_html = '<div class="bg-white border border-[rgba(255,74,3,0.2)] flex h-[32px] items-center justify-center px-[12px] rounded-[8px] flex-shrink-0 mt-1 !mb-0">
                          <span class="font-jost font-semibold text-orange text-xs text-center uppercase tracking-wider leading-none !m-0">' . $role . '</span>
                      </div>';
    }

    $output = '
    <div class="border border-orange bg-[rgba(255,74,3,0.1)] flex flex-col sm:flex-row gap-6 sm:gap-[40px] items-start overflow-hidden p-[20px] relative rounded-[10px] w-full not-prose">
        <div class="flex flex-col items-center overflow-hidden relative rounded-[10px] flex-shrink-0 w-[100px] h-[100px] md:w-[120px] md:h-[120px] bg-gradient-to-br from-white to-[#EEEDED] !m-0">
            ' . $photo_html . '
        </div>
        
        <div class="flex flex-col flex-[1_0_0] gap-[10px] items-start relative min-w-0 !m-0">
            <span class="font-jost font-semibold text-dark text-[24px] tracking-[-0.12px] leading-none !mt-0 !mb-0">
                ' . $name . '
            </span>
            <span class="font-sans font-normal text-gray text-sm leading-[1.5] !mt-0 !mb-0">
                ' . $title . '
            </span>
            ' . $role_html . '
        </div>
    </div>
    ';

    return $output;
}
add_shortcode( 'chimera_speaker', 'chimera_speaker_shortcode' );

/**
 * Shortcode for Chimera CTA
 * Usage: [chimera_cta title="Ready to transform your business?" button_text="Contact Us" button_link="/contact"]Your description text here[/chimera_cta]
 */
function chimera_cta_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'title'       => 'Call to Action',
        'desc'        => '',
        'button_text' => 'Click Here',
        'button_link' => '#',
        'variant'     => 'dark',
    ), $atts, 'chimera_cta' );

    $title       = esc_html( $atts['title'] );
    $button_text = esc_html( $atts['button_text'] );
    $button_link = esc_url( $atts['button_link'] );
    $wrapper_class = ($atts['variant'] === 'light') ? 'chimera-cta-light' : 'chimera-cta';
    
    // Use 'desc' attribute if provided, otherwise fallback to inner content
    $description = !empty($atts['desc']) ? wp_kses_post( $atts['desc'] ) : '';
    if ( empty($description) && $content ) {
        // Strip empty P tags that WP might add inside the content
        $description = wp_kses_post( trim( preg_replace( '#^<\/p>|<p>$#', '', $content ) ) );
    }

    $output = '
    <div class="' . $wrapper_class . ' wp-block-group not-prose">
        <div class="wp-block-group__inner-container">
            <span class="cta-title block">' . $title . '</span>
            <p>' . $description . '</p>
            <div class="wp-block-buttons">
                <div class="wp-block-button">
                    <a class="wp-block-button__link" href="' . $button_link . '">' . $button_text . '</a>
                </div>
            </div>
        </div>
    </div>
    ';

    return $output;
}
add_shortcode( 'chimera_cta', 'chimera_cta_shortcode' );

// Add /blog/ before post URLs
function custom_post_permalink($permalink, $post) {
    if ($post->post_type === 'post') {
        return home_url('/blog/' . $post->post_name . '/');
    }
    return $permalink;
}
add_filter('post_link', 'custom_post_permalink', 10, 2);

// Rewrite /blog/post-name/ to the actual post
function custom_blog_rewrite_rule() {
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?post_type=post&name=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_blog_rewrite_rule');

/**
 * Handle Whitepaper Download Form Submission
 */
function chimera_handle_whitepaper_submit() {
    ob_start(); // Buffer any output to prevent JSON corruption
    
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['work_email'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $whitepaper_title = sanitize_text_field($_POST['whitepaper_title'] ?? '');
    $whitepaper_file = esc_url_raw($_POST['whitepaper_file'] ?? '');

    if ( empty($name) || empty($_POST['work_email']) ) {
        ob_end_clean();
        wp_send_json_error('Please fill all required fields.');
    }

    if ( empty($email) ) {
        ob_end_clean();
        wp_send_json_error('Please enter a valid email address.');
    }

    // 1. Email to Admin (Lead Info)
    $admin_email = 'gowthambiznzfame@gmail.com';
    $admin_subject = "New Whitepaper Request: $whitepaper_title";
    $admin_message = "A new user has requested a whitepaper download.\n\n";
    $admin_message .= "Name: $name\n";
    $admin_message .= "Email: $email\n";
    $admin_message .= "Company: $company\n";
    $admin_message .= "Whitepaper: $whitepaper_title\n";
    
    @wp_mail($admin_email, $admin_subject, $admin_message);

    // 2. Email to User (Download Link)
    if ( !empty($whitepaper_file) ) {
        $user_subject = "Your Download: $whitepaper_title";
        $user_message = "Hi $name,\n\n";
        $user_message .= "Thank you for your interest! You can download your whitepaper using the link below:\n\n";
        $user_message .= $whitepaper_file . "\n\n";
        $user_message .= "Best regards,\nThe Team";

        @wp_mail($email, $user_subject, $user_message);
    }

    ob_end_clean();
    wp_send_json_success(array('url' => $whitepaper_file));
}
add_action('wp_ajax_submit_whitepaper', 'chimera_handle_whitepaper_submit');
add_action('wp_ajax_nopriv_submit_whitepaper', 'chimera_handle_whitepaper_submit');

/**
 * Import Industry Page SCF Field Group into the database (one-time).
 * This creates the field group in the DB so it appears in SCF → Field Groups
 * and is fully editable from the WP Admin UI.
 * Runs only once — sets an option flag after first import.
 */
function chimera_import_industry_fields() {
    if ( ! function_exists('acf_import_field_group') ) {
        return;
    }

    // Only run once
    if ( get_option('chimera_industry_fields_imported') ) {
        return;
    }

    acf_import_field_group(array(
        'key' => 'group_industry_page',
        'title' => 'Industry Page',
        'fields' => array(

            // ========================================
            // HERO SECTION
            // ========================================
            array(
                'key' => 'field_industry_hero',
                'label' => 'Hero Section',
                'name' => 'industry_hero',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_hero_badge',
                        'label' => 'Badge Text',
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'HEALTHTECH',
                        'instructions' => 'Short uppercase tag displayed above the heading (e.g. HEALTHTECH, FINTECH)',
                    ),
                    array(
                        'key' => 'field_ind_hero_heading1',
                        'label' => 'Heading Line 1',
                        'name' => 'heading_line1',
                        'type' => 'text',
                        'default_value' => 'AI-Led Healthcare Technology Solutions,',
                    ),
                    array(
                        'key' => 'field_ind_hero_highlight',
                        'label' => 'Heading Highlight (Orange Italic)',
                        'name' => 'heading_highlight',
                        'type' => 'text',
                        'default_value' => 'Built Around Care Delivery',
                    ),
                    array(
                        'key' => 'field_ind_hero_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_ind_hero_cta1_text',
                        'label' => 'Primary CTA Text',
                        'name' => 'cta_primary_text',
                        'type' => 'text',
                        'default_value' => 'Talk to Our Specialist',
                    ),
                    array(
                        'key' => 'field_ind_hero_cta1_link',
                        'label' => 'Primary CTA Link',
                        'name' => 'cta_primary_link',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_ind_hero_cta2_text',
                        'label' => 'Secondary CTA Text',
                        'name' => 'cta_secondary_text',
                        'type' => 'text',
                        'default_value' => 'Explore Our Solutions',
                    ),
                    array(
                        'key' => 'field_ind_hero_cta2_link',
                        'label' => 'Secondary CTA Link',
                        'name' => 'cta_secondary_link',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_ind_hero_image',
                        'label' => 'Hero Image',
                        'name' => 'hero_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_ind_hero_stats',
                        'label' => 'Stats',
                        'name' => 'stats',
                        'type' => 'repeater',
                        'max' => 4,
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_hero_stat_icon',
                                'label' => 'Icon',
                                'name' => 'icon',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'thumbnail',
                            ),
                            array(
                                'key' => 'field_ind_hero_stat_value',
                                'label' => 'Value',
                                'name' => 'value',
                                'type' => 'text',
                                'instructions' => 'e.g. ISO, 25+, 250+',
                            ),
                            array(
                                'key' => 'field_ind_hero_stat_label',
                                'label' => 'Label',
                                'name' => 'label',
                                'type' => 'text',
                                'instructions' => 'e.g. ISO 27001 Certified',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_ind_hero_logos',
                        'label' => 'Trusted By Logos',
                        'name' => 'trusted_logos',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_hero_logo_img',
                                'label' => 'Logo',
                                'name' => 'logo',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'thumbnail',
                            ),
                            array(
                                'key' => 'field_ind_hero_logo_name',
                                'label' => 'Company Name',
                                'name' => 'name',
                                'type' => 'text',
                            ),
                        ),
                    ),
                ),
            ),

            // ========================================
            // CHALLENGES SECTION
            // ========================================
            array(
                'key' => 'field_industry_challenges',
                'label' => 'Challenges Section',
                'name' => 'industry_challenges',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_ch_badge',
                        'label' => 'Badge Text',
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'HEALTHTECH CHALLENGES',
                    ),
                    array(
                        'key' => 'field_ind_ch_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'text',
                        'default_value' => 'Transformation Towards',
                    ),
                    array(
                        'key' => 'field_ind_ch_highlight',
                        'label' => 'Heading Highlight (Orange)',
                        'name' => 'heading_highlight',
                        'type' => 'text',
                        'default_value' => 'Digital Healthcare Operations',
                    ),
                    array(
                        'key' => 'field_ind_ch_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_ind_ch_image',
                        'label' => 'Section Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_ind_ch_items',
                        'label' => 'Challenge Items',
                        'name' => 'items',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_ch_item_title',
                                'label' => 'Title',
                                'name' => 'title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_ind_ch_item_desc',
                                'label' => 'Description',
                                'name' => 'description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                        ),
                    ),
                ),
            ),

            // ========================================
            // SOLUTIONS SECTION
            // ========================================
            array(
                'key' => 'field_industry_solutions',
                'label' => 'Solutions Section',
                'name' => 'industry_solutions',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_sol_badge',
                        'label' => 'Badge Text',
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'OUR HEALTHTECH SOLUTIONS',
                    ),
                    array(
                        'key' => 'field_ind_sol_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'text',
                        'default_value' => 'Healthcare Technology Solutions',
                    ),
                    array(
                        'key' => 'field_ind_sol_highlight',
                        'label' => 'Heading Highlight (Orange)',
                        'name' => 'heading_highlight',
                        'type' => 'text',
                        'default_value' => 'for Connected Care Ecosystems',
                    ),
                    array(
                        'key' => 'field_ind_sol_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_ind_sol_cards',
                        'label' => 'Solution Cards',
                        'name' => 'cards',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_sol_card_title',
                                'label' => 'Title',
                                'name' => 'title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_ind_sol_card_desc',
                                'label' => 'Description',
                                'name' => 'description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_ind_sol_card_image',
                                'label' => 'Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                            ),
                            array(
                                'key' => 'field_ind_sol_card_link_text',
                                'label' => 'Link Text',
                                'name' => 'link_text',
                                'type' => 'text',
                                'default_value' => 'Explore Details',
                            ),
                            array(
                                'key' => 'field_ind_sol_card_link_url',
                                'label' => 'Link URL',
                                'name' => 'link_url',
                                'type' => 'url',
                            ),
                        ),
                    ),
                ),
            ),

            // ========================================
            // ENGAGEMENT MODELS SECTION
            // ========================================
            array(
                'key' => 'field_industry_engagement',
                'label' => 'Engagement Models Section',
                'name' => 'industry_engagement',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_eng_badge',
                        'label' => 'Badge Text',
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'HOW WE DELIVER',
                    ),
                    array(
                        'key' => 'field_ind_eng_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'text',
                        'default_value' => 'Engagement Models',
                    ),
                    array(
                        'key' => 'field_ind_eng_highlight',
                        'label' => 'Heading Highlight (Orange)',
                        'name' => 'heading_highlight',
                        'type' => 'text',
                        'default_value' => 'Built Around Your Requirements',
                    ),
                    array(
                        'key' => 'field_ind_eng_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_ind_eng_image',
                        'label' => 'Section Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_ind_eng_models',
                        'label' => 'Engagement Models',
                        'name' => 'models',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_eng_model_title',
                                'label' => 'Title',
                                'name' => 'title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_ind_eng_model_desc',
                                'label' => 'Description',
                                'name' => 'description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                        ),
                    ),
                ),
            ),

            // ========================================
            // TESTIMONIALS SECTION
            // ========================================
            array(
                'key' => 'field_industry_testimonials',
                'label' => 'Testimonials Section',
                'name' => 'industry_testimonials',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_test_badge',
                        'label' => 'Badge Text',
                        'name' => 'badge_text',
                        'type' => 'text',
                        'default_value' => 'REAL OUTCOMES. LONG-TERM PARTNERSHIPS.',
                    ),
                    array(
                        'key' => 'field_ind_test_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'text',
                        'default_value' => 'Trusted by',
                    ),
                    array(
                        'key' => 'field_ind_test_highlight',
                        'label' => 'Heading Highlight (Orange)',
                        'name' => 'heading_highlight',
                        'type' => 'text',
                        'default_value' => 'Organizations Across the Healthcare Ecosystem',
                    ),
                    array(
                        'key' => 'field_ind_test_items',
                        'label' => 'Testimonials',
                        'name' => 'items',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ind_test_quote',
                                'label' => 'Quote',
                                'name' => 'quote',
                                'type' => 'textarea',
                                'rows' => 4,
                            ),
                            array(
                                'key' => 'field_ind_test_author',
                                'label' => 'Author Name',
                                'name' => 'author_name',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_ind_test_role',
                                'label' => 'Author Role / Company',
                                'name' => 'author_role',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_ind_test_photo',
                                'label' => 'Author Photo',
                                'name' => 'author_photo',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'thumbnail',
                            ),
                        ),
                    ),
                ),
            ),

            // ========================================
            // CTA SECTION
            // ========================================
            array(
                'key' => 'field_industry_cta',
                'label' => 'CTA Section',
                'name' => 'industry_cta',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_ind_cta_heading',
                        'label' => 'Heading',
                        'name' => 'heading',
                        'type' => 'textarea',
                        'rows' => 2,
                        'default_value' => "Bring Greater Speed, Visibility,\nand Control to Your Healthcare Operations",
                    ),
                    array(
                        'key' => 'field_ind_cta_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_ind_cta_btn_text',
                        'label' => 'Button Text',
                        'name' => 'button_text',
                        'type' => 'text',
                        'default_value' => 'Schedule a Call',
                    ),
                    array(
                        'key' => 'field_ind_cta_btn_link',
                        'label' => 'Button Link',
                        'name' => 'button_link',
                        'type' => 'url',
                    ),
                ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/template-industry.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    // Mark as imported so it doesn't run again
    update_option('chimera_industry_fields_imported', true);
}
add_action('acf/init', 'chimera_import_industry_fields');

/**
 * Auto-create HealthTech Industry page on theme init if it doesn't exist
 */
function chimera_create_healthtech_industry_page() {
    $slug = 'healthtech';
    $page = get_page_by_path( $slug );
    
    if ( ! $page ) {
        $page_id = wp_insert_post( array(
            'post_title'    => 'HealthTech',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => $slug,
        ) );
        
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-templates/template-industry.php' );
        }
    }
}
add_action( 'init', 'chimera_create_healthtech_industry_page' );
