<?php
/**
 * The main template file
 *
 * @package Chimera
 */

get_header();
?>

<main class="min-h-[60vh] pt-32 pb-16 px-6 max-w-7xl mx-auto">
    <div class="max-w-4xl mx-auto">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-16'); ?>>
                    <header class="mb-6">
                        <h1 class="text-4xl md:text-5xl font-semibold mb-2"><?php the_title(); ?></h1>
                        <div class="text-sm text-brand-gray">
                            Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                        </div>
                    </header>
                    <div class="entry-content text-brand-gray leading-relaxed text-lg">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="text-center py-20">
                <h2 class="text-3xl font-semibold mb-4">No Posts Found</h2>
                <p class="text-brand-gray">Ready to build your static pages? The homepage is ready to view.</p>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
