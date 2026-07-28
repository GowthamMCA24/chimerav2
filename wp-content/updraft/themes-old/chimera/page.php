<?php
/**
 * The template for displaying all single pages
 *
 * @package Chimera
 */

get_header();
?>

<main>
    <div>
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
