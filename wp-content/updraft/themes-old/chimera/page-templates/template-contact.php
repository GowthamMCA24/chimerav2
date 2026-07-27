<?php
/**
 * Template Name: Contact Page
 * 
 * Content is driven by Secure Custom Fields (SCF/ACF) and Contact Form 7.
 *
 * @package Chimera
 */

get_header();
$Herosection = get_field('herosection');
$badge = $Herosection['badge'];
$heading = $Herosection['heading'];
$description = $Herosection['description'];
$benefits = $Herosection['benefits'] ?? [];
$contact_form_shortcode = $Herosection['contact_form_shortcode'] ?? [];

?>

<main id="primary" class="site-main bg-[#f9f7f6] min-h-screen overflow-hidden -mt-[80px] pt-[80px]">

    <section class="relative pb-[50px] pt-[50px]">
        <div class="container">
            <div class="flex flex-col lg:flex-row gap-[62px] items-center">

                <!-- Left Content -->
                <div class="w-full lg:w-1/2 flex flex-col gap-[40px]">

                    <div class="flex flex-col gap-[8px]">
                        <div class="w-max">
                            <h3
                                class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-orangeBorder rounded-[8px] text-xs font-semibold uppercase text-orange tracking-wider mb-5">
                                <?php echo esc_html($badge); ?>
                            </h3>
                        </div>
                        <h1
                            class="text-dark max-w-xl text-[36px] lg:text-[40px] font-jost font-semibold leading-[1.2] tracking-[-0.12px]">
                            <?php echo wp_kses_post($heading); ?>
                        </h1>
                    </div>

                    <div class="flex flex-col gap-[17px]">
                        <p class="text-gray text-[18px] font-sans font-normal leading-[1.5]">
                            <?php echo esc_html($description); ?>
                        </p>


                        <ul class="flex flex-col gap-[14px]">
                            <?php foreach ($benefits as $benefit): ?>
                                <li class="flex items-start gap-[4px]">
                                    <div class="w-[32px] h-[30px] flex-shrink-0 flex items-center justify-center">
                                        <img src="<?php echo esc_url($benefit['icon']['url']); ?>" alt="">
                                    </div>
                                    <p class="text-gray font-normal text-[18px] font-sans leading-[1.5]">
                                        <?php echo wp_kses_post($benefit['text']); ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Trusted Logos Reusable Section -->
                    <div class="w-full">
                        <?php get_template_part('template-parts/components/logo-marquee', null, [
                            'bg_color' => 'bg-transparent',
                            'gradient_from' => 'from-[#f9f7f6]',
                            'heading_align' => 'text-left'
                        ]); ?>
                        
                    </div>
                </div>

                <!-- Right Form Container -->
                <div class="w-full lg:w-1/2 relative mt-10 lg:mt-0">
                    <!-- Orange outer card matching Figma -->
                    <div class="relative w-full rounded-[24px] overflow-hidden min-h-[600px] bg-orange-gradient lg:min-h-[820px] flex flex-col justify-center px-[24px] py-[24px] bg-[linear-gradient(0deg,rgba(255,255,255,0.2),rgba(255,255,255,0.2)),linear-gradient(180deg,rgba(255,74,3,0.1)_66.83%,rgba(255,255,255,0)_100%)]"
                        >

                        <!-- White Form Card -->
                        <div class="relative z-10 bg-white rounded-[12px] w-full contact-form-wrapper"
                            style="padding: 40px; border: 1px solid #f2ecff;">
                            <?php
                            if ($contact_form_shortcode) {
                                echo do_shortcode($contact_form_shortcode);
                            } else {
                                echo '<p style="color:#666;font-family:sans-serif;">Please add the Contact Form 7 shortcode via the page editor fields.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Global Presence Section (Reused from Home) -->
    <?php get_template_part( 'template-parts/home/presence' ); ?>

</main>

<style>
    /* ── Contact Form 7 — Figma-accurate styles ── */
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500&display=swap');

    /* The CF7 form itself */
    .contact-form-wrapper .wpcf7 {
        width: 100%;
    }
    .contact-form-wrapper .wpcf7-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Label rows — stacked above input */
    .contact-form-wrapper label {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 16px;
        color: #6f7482;
        line-height: 1.5;
        margin: 0;
    }

    /* control-wrap fills full width */
    .contact-form-wrapper .wpcf7-form-control-wrap {
        display: block;
        width: 100%;
    }

    /* Inputs, Select & Textarea */
    .contact-form-wrapper input[type="text"],
    .contact-form-wrapper input[type="email"],
    .contact-form-wrapper input[type="tel"],
    .contact-form-wrapper select,
    .contact-form-wrapper textarea {
        display: block;
        width: 100%;
        background-color: #f8fafc;
        border: 1.5px solid #f8fafc;
        border-radius: 4px;
        padding: 12px;
        color: #3b4256;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        letter-spacing: 0.01em;
        transition: border-color 0.2s ease;
        outline: none;
    }

    .contact-form-wrapper input[type="text"]::placeholder,
    .contact-form-wrapper input[type="email"]::placeholder,
    .contact-form-wrapper input[type="tel"]::placeholder,
    .contact-form-wrapper textarea::placeholder {
        color: #b8bcca;
        font-weight: 400;
    }

    .contact-form-wrapper input[type="text"]:focus,
    .contact-form-wrapper input[type="email"]:focus,
    .contact-form-wrapper input[type="tel"]:focus,
    .contact-form-wrapper select:focus,
    .contact-form-wrapper textarea:focus {
        border-color: #ff4a03;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(255, 74, 3, 0.08);
    }

    /* Select styling (custom arrow) */
    .contact-form-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236f7482%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 10px auto;
        padding-right: 32px !important;
        padding-left: 12px !important;
        text-align: left;
        cursor: pointer;
    }

    /* Phone field layout */
    .contact-form-wrapper .phone-field {
        display: flex;
        flex-direction: row;
        gap: 12px;
        width: 100%;
        align-items: flex-start;
    }
    .contact-form-wrapper .phone-field > *:nth-child(1) {
        flex: 0 0 80px; /* Width for country code */
        max-width: 130px;
        margin-bottom: 0;
    }

    .contact-form-wrapper .phone-field > *:nth-child(2) {
        flex: 1 1 auto;
        margin-bottom: 0;
    }


    /* Textarea height — controlled via rows="" in CF7 shortcode */
    .contact-form-wrapper textarea {
        min-height: unset;
        height: auto;
        resize: vertical;
    }

    /* Acceptance (checkbox) row */
    .contact-form-wrapper .wpcf7-acceptance {
        margin: 4px 0;
    }
    .contact-form-wrapper .wpcf7-acceptance label {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 10px;
        margin: 0;
    }
    .contact-form-wrapper .wpcf7-acceptance input[type="checkbox"] {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        margin-top: 2px;
        accent-color: #ff4a03;
        cursor: pointer;
        border-radius: 4px;
    }
    .contact-form-wrapper .wpcf7-acceptance .wpcf7-list-item-label {
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #b8bcca;
        line-height: 1.5;
    }
    /* Orange link inside acceptance text */
    .contact-form-wrapper .wpcf7-acceptance .wpcf7-list-item-label a {
        color: #ff4a03;
        text-decoration: none;
    }
    .contact-form-wrapper .wpcf7-acceptance .wpcf7-list-item-label a:hover {
        text-decoration: underline;
    }

    /* Submit button — full width, orange, 48px */
    .contact-form-wrapper input[type="submit"],
    .contact-form-wrapper .wpcf7-submit {
        display: block;
        width: 100%;
        height: 48px;
        background-color: #ff4a03;
        color: #ffffff;
        font-family: 'IBM Plex Sans', sans-serif;
        font-weight: 500;
        font-size: 18px;
        text-align: center;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s ease;
        margin-top: 4px;
        letter-spacing: 0.01em;
    }
    .contact-form-wrapper input[type="submit"]:hover,
    .contact-form-wrapper .wpcf7-submit:hover {
        background-color: #e03f00;
    }

    /* Validation error messages */
    .contact-form-wrapper .wpcf7-not-valid-tip {
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 13px;
        color: #e03f00;
        margin-top: 4px;
        display: block;
    }
    .contact-form-wrapper .wpcf7-not-valid {
        border-color: #e03f00 !important;
    }
    .contact-form-wrapper .wpcf7-response-output {
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 14px;
        border-radius: 6px;
        padding: 10px 14px;
        margin-top: 8px;
        border: none;
    }
    .contact-form-wrapper .wpcf7-mail-sent-ok {
        background-color: #f0fff4;
        color: #276749;
    }
    .contact-form-wrapper .wpcf7-mail-sent-ng,
    .contact-form-wrapper .wpcf7-aborted,
    .contact-form-wrapper .wpcf7-validation-errors {
        background-color: #fff5f5;
        color: #c53030;
    }

    /* ── Intl Tel Input Overrides ── */
    .iti {
        width: 100%;
        display: block;
    }
    .contact-form-wrapper .iti input[type="tel"] {
        width: 100%;
        margin-bottom: 0;
    }
    .iti__country-list {
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 14px;
        border: 1px solid #f2ecff;
        border-radius: 6px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        color: #3b4256;
    }
    .iti__selected-flag {
        background-color: transparent !important;
    }
</style>

<!-- Intl Tel Input JS/CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var phoneInput = document.querySelector('.wpcf7-tel');
    if (phoneInput) {
        var iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            initialCountry: "in",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Update the input to send the full E.164 phone number on form submit
        var form = phoneInput.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                var fullNumber = iti.getNumber();
                if (fullNumber) {
                    phoneInput.value = fullNumber;
                }
            });
        }
    }
});
</script>

<?php
get_footer();
