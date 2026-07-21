<?php
/**
 * Template Name: Legal Template
 * 
 * The template for displaying legal pages like Privacy Policy, Terms & Conditions, etc.
 *
 * @package Chimera
 */

get_header();

$archive_args = [];
$hero = get_field('hero_section');
if ( ! empty( $hero['title'] ) ) $archive_args['hero_title'] = $hero['title'];
if ( ! empty( $hero['desc'] ) )  $archive_args['hero_desc']  = $hero['desc'];
if ( ! empty( $hero['bg'] ) )    $archive_args['hero_bg']    = $hero['bg'];

?>

<main id="legal-page" class="site-main bg-white">
    
    <!-- Hero Section -->
    <?php get_template_part( 'template-parts/blog/hero', null, $archive_args ); ?>

    <!-- Legal Content Area -->
    <section class="py-10 md:py-[60px]">
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    
                    // Tailwind arbitrary child selectors for styling WordPress Gutenberg output
                    $typography_classes = implode(' ', [
                        '[&>p]:font-sans [&>p]:font-normal [&>p]:text-[15px] md:[&>p]:text-[18px] [&>p]:text-dark [&>p]:leading-[1.8] [&>p]:mb-6 [&>p]:font-normal',
                        '[&>h1]:font-jost [&>h1]:font-semibold [&>h1]:text-[32px] md:[&>h1]:text-[40px] [&>h1]:text-dark [&>h1]:mt-12 [&>h1]:mb-6',
                        '[&>h2]:font-jost [&>h2]:font-semibold [&>h2]:text-[24px] md:[&>h2]:text-[32px] [&>h2]:text-dark [&>h2]:mt-10 [&>h2]:mb-4',
                        '[&>h3]:font-jost [&>h3]:font-semibold [&>h3]:text-[20px] md:[&>h3]:text-[26px] [&>h3]:text-dark [&>h3]:mt-8 [&>h3]:mb-3',
                        '[&>ul]:list-disc [&>ul]:pl-6 [&>ul]:mb-6',
                        '[&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:mb-6',
                        '[&_li]:font-sans [&_li]:text-[15px] md:[&_li]:text-[18px] [&_li]:leading-[1.7] [&_li]:text-dark [&_li]:mb-2',
                        '[&_a]:text-orange [&_a]:underline hover:[&_a]:text-orangeLight',
                        '[&>blockquote]:border-l-4 [&>blockquote]:border-orange [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-gray [&>blockquote]:my-6',
                        '[&>strong]:font-semibold [&>b]:font-semibold',
                        '[&_table]:w-full [&_table]:mb-6 [&_th]:border [&_th]:border-lightGray [&_th]:p-3 [&_th]:bg-lightGray/30 [&_th]:text-left',
                        '[&_td]:border [&_td]:border-lightGray [&_td]:p-3'
                    ]);
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="legal-content <?php echo esc_attr( $typography_classes ); ?>">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </section>

</main>

<?php
get_footer();
