<?php
/**
 * Template part for displaying the featured blog post
 *
 * @package Chimera
 */

// Get the featured post — use sticky posts first, fallback to latest
$post_type = $args['post_type'] ?? 'post';
$sticky_posts = get_option('sticky_posts');
$featured_args = array(
    'post_type' => $post_type,
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
);

if (!empty($sticky_posts) && $post_type === 'post') {
    $featured_args['post__in'] = $sticky_posts;
    $featured_args['ignore_sticky_posts'] = 1;
}

$featured_query = new WP_Query($featured_args);
?>

<section class="w-full py-10 md:py-[50px] relative z-10">
    <div class="container">

        <!-- Featured Post Hero Card -->
        <?php if ($featured_query->have_posts()):
            $featured_query->the_post(); ?>
            <?php
            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$featured_image) {
                $featured_image = '/wp-content/uploads/2026/06/placeholder.jpg'; // fallback if no image
            }
            $categories = chimera_get_post_categories();
            $reading_time = chimera_reading_time();
            $cat_name = !empty($categories) ? $categories[0]->name : '';
            $author_id = get_post_field('post_author', get_the_ID());
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_desc = get_user_meta($author_id, 'designation', true);
            if (empty($author_desc)) {
                $author_desc = 'Designation, Company';
            }
            $author_avatar = get_avatar_url($author_id);
            ?>
            <div class="border border-orange border-solid flex flex-col lg:flex-row gap-10 lg:gap-[60px] items-stretch overflow-hidden p-[20px] sm:p-[30px] relative rounded-[10px]"
                style="background-image: linear-gradient(90deg, rgba(255, 74, 3, 0.1) 0%, rgba(255, 74, 3, 0.1) 100%), linear-gradient(90deg, rgb(255, 255, 255) 0%, rgb(255, 255, 255) 100%)">

                <!-- Left: Image -->
                <div class="w-full lg:w-1/2 self-center rounded-[20px] overflow-hidden aspect-video flex-shrink-0">
                    <a href="<?php the_permalink(); ?>" class="block relative group w-full h-full">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                </div>

                <!-- Right: Content -->
                <div class="w-full lg:w-1/2 flex flex-col gap-5">
                    <div class="flex-1 flex flex-col gap-[20px]">
                        <div>
                            <div class="flex items-center">
                                <?php if ($cat_name): ?>
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 bg-white border border-orange/20 rounded-[8px] text-orange font-jost text-xs font-semibold uppercase tracking-wider">
                                        <?php echo esc_html($cat_name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex flex-col gap-[10px] max-w-[556px]">
                            <!-- Title -->
                            <a href="<?php the_permalink(); ?>" class="group block">
                                <h2
                                    class="text-dark text-[24px] md:text-[26px] font-jost font-semibold leading-[1.2] tracking-[-0.12px] group-hover:text-orange transition-colors duration-300">
                                    <?php the_title(); ?>
                                </h2>
                            </a>

                            <?php if (has_excerpt()): ?>
                                <p class="text-gray font-normal font-sans text-sm leading-[1.5]">
                                    <?php echo wp_kses_post(get_the_excerpt()); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col xl:flex-row gap-5">
                            <!-- Date -->
                            <div class="flex items-center gap-[10px]">
                                <div
                                    class="w-10 h-10 rounded-full bg-white border border-orange shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <path d="M6.66602 1.66699V5.00033" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.334 1.66699V5.00033" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M15.8333 3.33301H4.16667C3.24619 3.33301 2.5 4.0792 2.5 4.99967V16.6663C2.5 17.5868 3.24619 18.333 4.16667 18.333H15.8333C16.7538 18.333 17.5 17.5868 17.5 16.6663V4.99967C17.5 4.0792 16.7538 3.33301 15.8333 3.33301Z"
                                            stroke="#FF4A03" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2.5 8.33301H17.5" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.66602 11.667H6.67477" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 11.667H10.0088" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.334 11.667H13.3427" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.66602 15H6.67477" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 15H10.0088" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.334 15H13.3427" stroke="#FF4A03" stroke-width="1.66667"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="flex flex-col items-start leading-[1.5]">
                                    <p class="font-sans font-normal text-sm text-gray w-full">Date</p>
                                    <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1">
                                        <?php echo esc_html(get_the_date('F j, Y')); ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Author Info -->
                            <?php if (false && get_post_type() !== 'casestudies' && (!isset($args['post_type']) || $args['post_type'] !== 'casestudies')): ?>
                                <div class="flex items-center gap-[10px]">
                                    <div
                                        class="w-10 h-10 rounded-full border border-orange shadow-[0px_0px_10px_0px_rgba(255,74,3,0.25)] flex items-center justify-center flex-shrink-0 overflow-hidden">
                                        <?php if ($author_avatar): ?>
                                            <img src="<?php echo esc_url($author_avatar); ?>"
                                                alt="<?php echo esc_attr($author_name); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full bg-orange/10 flex items-center justify-center text-orange font-jost font-bold">
                                                <?php echo esc_html(substr($author_name, 0, 1)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex flex-col items-start leading-[1.5]">
                                        <p class="font-sans font-normal text-sm text-gray w-full">
                                            <?php echo esc_html($author_desc); ?>
                                        </p>
                                        <p class="font-sans font-semibold text-sm text-dark w-full line-clamp-1">
                                            <?php echo esc_html($author_name); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <!-- Action Link -->
                        <a href="<?php the_permalink(); ?>"
                            class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                            <?php
                            $pt = get_post_type();
                            if ($pt === 'casestudies') {
                                echo 'Read story';
                            } elseif ($pt === 'whitepaper') {
                                echo 'Download Whitepaper';
                            } else {
                                echo 'Read More';
                            }
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        <?php endif;
        wp_reset_postdata(); ?>

    </div>
</section>