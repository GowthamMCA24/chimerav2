<?php
/**
 * Template part for displaying the single webinar content
 *
 * Two-column layout:
 * Left: "About this webinar" content + "About Speakers" section
 * Right: Registration form sidebar
 *
 * @package Chimera
 */

$is_upcoming      = has_term( 'upcoming', 'category' );
$registration_url = get_field( 'registration_url' ) ?: '';

// Speakers data from ACF repeater field
$section_title = get_field('section_heading') ?: '';
$speakers = array();
if ( function_exists( 'get_field' ) && have_rows( 'about_speakers' ) ) {
    while ( have_rows( 'about_speakers' ) ) {
        the_row();
        $speakers[] = array(
            'name'  => get_sub_field( 'name' ),
            'title' => get_sub_field( 'title' ),
            'role'  => get_sub_field( 'role' ),  // e.g., 'Featuring', 'Hosts'
            'photo' => get_sub_field( 'photo' ),
        );
    }
}

// Form fields configuration
$form_heading = get_field( 'form_heading' ) ?: 'Some good heading here';
$form_description = get_field( 'form_description' ) ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';
$form_consent_text = get_field( 'form_consent_text' ) ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
?>

<section class="w-full bg-white py-[60px] md:py-[80px]">
    <div class="container">
        <div class="flex flex-col lg:flex-row gap-10 md:gap-[30px] xl:gap-[60px] items-start">
            
            <!-- Left Column: Content & Speakers -->
            <div class="w-full lg:flex-1 flex flex-col gap-[60px]">
                
                <!-- About this webinar -->
                <div class="flex flex-col gap-5">
                    
                    <!-- Post Content -->
                    <div class="webinar-entry-content prose prose-lg max-w-none text-gray font-sans text-base md:text-lg leading-[1.5]
                                [&_h2]:text-dark [&_h2]:font-jost [&_h2]:text-[28px] md:[&_h2]:text-[32px] [&_h2]:font-semibold [&_h2]:leading-[1.2] [&_h2]:tracking-[-0.12px] [&_h2]:mb-5 [&_h2]:mt-10 [&>h2:first-child]:mt-0
                                [&_h3]:text-dark [&_h3]:font-jost [&_h3]:text-[22px] md:[&_h3]:text-[26px] [&_h3]:font-semibold [&_h3]:leading-[1.2] [&_h3]:mb-4 [&_h3]:mt-8 [&>h3:first-child]:mt-0
                                [&_p]:mb-5 [&_p]:font-normal [&_p]:text-dark last:[&_p]:mb-0
                                [&_a]:text-orange [&_a]:underline hover:[&_a]:text-orangeLight [&_a]:transition-colors
                                [&_strong]:font-semibold [&_strong]:text-dark
                                [&_ul]:list-none [&_ul]:pl-0 [&_ul]:flex [&_ul]:flex-col [&_ul]:gap-[10px] [&_ul]:mb-8
                                [&_ul_li]:flex [&_ul_li]:gap-[10px] [&_ul_li]:items-start [&_ul_li]:text-dark
                                [&_ul_li::before]:content-[''] [&_ul_li::before]:w-[6px] [&_ul_li::before]:h-[6px] [&_ul_li::before]:mt-[10px] [&_ul_li::before]:flex-shrink-0 [&_ul_li::before]:bg-orange [&_ul_li::before]:rounded-full">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- About Speakers -->
                <?php if ( ! empty( $speakers ) ) : ?>
                <div class="flex flex-col gap-5">
                    <h2 class="text-dark font-jost text-[28px] md:text-[32px] font-semibold leading-none tracking-[-0.12px]">
                        <?php echo esc_html( $section_title ); ?>
                    </h2>
                    
                    <div class="flex flex-col gap-5 w-full">
                        <?php foreach ( $speakers as $speaker ) : ?>
                            <div class="border border-orange bg-[rgba(255,74,3,0.1)] flex flex-col sm:flex-row gap-6 sm:gap-[40px] items-start overflow-hidden p-[20px] relative rounded-[10px] w-full">
                                <!-- Speaker Photo -->
                                <div class="flex flex-col items-center overflow-hidden relative rounded-[10px] flex-shrink-0 w-[100px] h-[100px] md:w-[120px] md:h-[120px] bg-gradient-to-br from-white to-[#EEEDED]">
                                    <?php 
                                    $photo_url = '';
                                    if ( ! empty( $speaker['photo'] ) ) {
                                        $photo_url = is_array( $speaker['photo'] ) ? $speaker['photo']['url'] : $speaker['photo'];
                                    }
                                    if ( $photo_url ) : ?>
                                        <img src="<?php echo esc_url( $photo_url ); ?>" 
                                             alt="<?php echo esc_attr( $speaker['name'] ); ?>" 
                                             class="absolute inset-0 w-full h-full object-cover">
                                    <?php else : ?>
                                        <div class="w-full h-full flex items-center justify-center text-orange font-jost font-bold text-3xl bg-orange/5">
                                            <?php echo esc_html( substr( $speaker['name'], 0, 1 ) ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Speaker Info -->
                                <div class="flex flex-col flex-[1_0_0] gap-[10px] items-start relative min-w-0">
                                    <h3 class="font-jost font-semibold text-dark text-[24px] tracking-[-0.12px] leading-none mb-0 mt-0">
                                        <?php echo esc_html( $speaker['name'] ); ?>
                                    </h3>
                                    <p class="font-sans font-normal text-gray text-sm leading-[1.5] mb-0 mt-0">
                                        <?php echo esc_html( $speaker['title'] ); ?>
                                    </p>
                                    <?php if ( ! empty( $speaker['role'] ) ) : ?>
                                        <div class="bg-white border border-[rgba(255,74,3,0.2)] flex h-[32px] items-center justify-center px-[12px] rounded-[8px] flex-shrink-0 mt-1">
                                            <span class="font-jost font-semibold text-orange  text-xs  text-center uppercase tracking-wider leading-none">
                                                <?php echo esc_html( $speaker['role'] ); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
            </div>
            
            <!-- Right Column: Registration Form Sidebar -->
            <div class="w-full md:w-[450px] xl:w-[550px] flex-shrink-0">
                <div class="lg:sticky top-24 bg-offwhite rounded-[20px] px-8 md:px-[60px]">
                    
                    <!-- Form Header -->
                    <div class="flex flex-col gap-[10px] items-center mb-[30px]">
                        <h3 class="text-dark font-jost text-xl md:text-2xl font-semibold leading-none tracking-[-0.12px] text-center">
                            <?php echo esc_html( $form_heading ); ?>
                        </h3>
                        <p class="text-gray font-sans font-normal text-sm leading-[1.5] text-center">
                            <?php echo esc_html( $form_description ); ?>
                        </p>
                    </div>
                    
                    <!-- Registration Form -->
                    <form id="webinar-registration-form" class="flex flex-col gap-[10px]" method="post" action="">
                        <input type="hidden" name="webinar_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                        <input type="hidden" name="webinar_title" value="<?php echo esc_attr( get_the_title() ); ?>">
                        
                        <input type="text" name="name" placeholder="Name *" required
                               class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        
                        <input type="email" name="work_email" placeholder="Work Email *" required
                               class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        
                        <input type="text" name="company" placeholder="Company"
                               class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        
                        <input type="text" name="job_title" placeholder="Job Title" 
                               class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        
                        <input type="text" name="country" placeholder="Country"
                               class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        
                        <!-- Consent Checkbox -->
                        <div class="flex items-start gap-[10px] mt-2">
                            <input type="checkbox" name="consent" id="webinar-consent" required
                                   class="mt-0.5 w-[18px] h-[18px] flex-shrink-0 rounded border-dark/50 text-orange focus:ring-orange accent-orange cursor-pointer">
                            <label for="webinar-consent" class="text-gray font-sans text-xs leading-[1.3]">
                                <?php echo esc_html( $form_consent_text ); ?>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center justify-center gap-2 mt-3">
                            Register Now
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
