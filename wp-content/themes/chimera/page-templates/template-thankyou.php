<?php
/**
 * Template Name: Thank You Template
 * 
 * The template for displaying a thank you page after form submission.
 *
 * @package Chimera
 */

get_header();
?>

<main id="thank-you-page" class="site-main bg-white min-h-[60vh] flex items-center justify-center">
    
    <section class="py-[60px] md:py-[100px] w-full">
        <div class="container text-center max-w-[800px] mx-auto px-4 flex flex-col items-center">
            
            <!-- Checkmark Icon in an Orange Gradient Ring -->
            <div class="bg-[linear-gradient(135deg,#ff4a03_0%,#ffa07a_100%)] p-[2px] rounded-full inline-block mb-8">
                <div class="bg-white rounded-full w-[80px] h-[80px] flex items-center justify-center">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 6L9 17L4 12" stroke="#ff4a03" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <h1 class="font-jost font-semibold text-[36px] md:text-[56px] text-dark mb-6">Thank You!</h1>
            
            <div class="font-sans font-normal text-[16px] md:text-[18px] text-gray leading-[1.6] mb-10 max-w-[500px]">
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                } 
                
                // Fallback text if the WordPress page content is empty
                if ( empty( get_the_content() ) ) {
                    echo 'We have received your message. One of our team members will get back to you shortly.';
                }
                ?>
            </div>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                Back to Home
            </a>
            
        </div>
    </section>

</main>

<?php
get_footer();
