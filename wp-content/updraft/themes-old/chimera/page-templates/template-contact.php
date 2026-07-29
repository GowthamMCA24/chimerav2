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

<style>
    /* ── Contact Form 7 — Figma-accurate styles (Overriding Zoho) ── */
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500&display=swap');

    /* The CF7 form itself -> Zoho form wrapper */
    .contact-form-wrapper .crmWebToEntityForm {
        width: 100% !important;
        max-width: 100% !important;
        background-color: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .contact-form-wrapper .crmWebToEntityForm form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Remove Zoho's internal title */
    /* .contact-form-wrapper .zcwf_title {
        display: none !important;
    } */

    /* .zcwf_row */
    .contact-form-wrapper .zcwf_row {
        display: flex !important;
        flex-direction: column !important;
        gap: 4px !important;
        width: 100% !important;
        margin: 0 !important;
        float: none !important;
    }

    /* Label rows — stacked above input -> .zcwf_col_lab */
    .contact-form-wrapper .zcwf_col_lab {
        width: 100% !important;
        float: none !important;
        margin: 0 !important;
        padding: 0 !important;
        font-family: 'IBM Plex Sans', sans-serif !important;
        font-weight: 500 !important;
        font-size: 16px !important;
        color: #6f7482 !important;
        line-height: 1.5 !important;
    }
    
    .contact-form-wrapper .zcwf_col_lab label {
        font-family: inherit !important;
        font-size: inherit !important;
        color: inherit !important;
    }

    /* .zcwf_col_fld where inputs live */
    .contact-form-wrapper .zcwf_col_fld {
        width: 100% !important;
        float: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    /* Inputs, Select & Textarea */
    .contact-form-wrapper .zcwf_col_fld input[type="text"],
    .contact-form-wrapper .zcwf_col_fld input[type="password"],
    .contact-form-wrapper .zcwf_col_fld input[type="email"],
    .contact-form-wrapper .zcwf_col_fld input[type="tel"],
    .contact-form-wrapper .zcwf_col_fld select,
    .contact-form-wrapper .zcwf_col_fld textarea {
        display: block !important;
        width: 100% !important;
        background-color: #f8fafc !important;
        border: 1px solid #c0c6cc !important;
        border-radius: 4px !important;
        padding: 12px !important;
        color: #3b4256 !important;
        font-family: 'IBM Plex Sans', sans-serif !important;
        font-size: 16px !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        letter-spacing: 0.01em !important;
        transition: border-color 0.2s ease !important;
        outline: none !important;
        box-sizing: border-box !important;
        margin: 0 !important;
    }

    .contact-form-wrapper .zcwf_col_fld input::placeholder,
    .contact-form-wrapper .zcwf_col_fld textarea::placeholder {
        color: #b8bcca !important;
        font-weight: 400 !important;
    }

    .contact-form-wrapper .zcwf_col_fld input:focus,
    .contact-form-wrapper .zcwf_col_fld select:focus,
    .contact-form-wrapper .zcwf_col_fld textarea:focus {
        border-color: #ff4a03 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 3px rgba(255, 74, 3, 0.08) !important;
    }

    /* Select styling (custom arrow) */
    .contact-form-wrapper .zcwf_col_fld select {
        appearance: none !important;
        -webkit-appearance: none !important;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236f7482%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 12px center !important;
        background-size: 10px auto !important;
        padding-right: 32px !important;
        padding-left: 12px !important;
        text-align: left !important;
        cursor: pointer !important;
    }

    /* Textarea height */
    .contact-form-wrapper .zcwf_col_fld textarea {
        min-height: unset !important;
        height: 80px !important;
        resize: vertical !important;
    }

    /* Acceptance (checkbox) row -> .zcwf_privacy */
    .contact-form-wrapper .zcwf_privacy {
        margin: 4px 0 !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        align-items: flex-start !important;
        gap: 10px !important;
    }
    
    .contact-form-wrapper .zcwf_privacy > div {
        float: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .contact-form-wrapper .zcwf_privacy > div:first-child {
        flex-shrink: 0 !important;
    }

    .contact-form-wrapper .zcwf_privacy input[type="checkbox"] {
        width: 20px !important;
        height: 20px !important;
        margin-top: 2px !important;
        accent-color: #ff4a03 !important;
        cursor: pointer !important;
        border-radius: 4px !important;
    }

    .contact-form-wrapper .zcwf_privacy_txt {
        font-family: 'IBM Plex Sans', sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #b8bcca !important;
        line-height: 1.5 !important;
        padding-top: 0 !important;
        width: 100% !important;
        flex: 1 !important;
    }
    
    .contact-form-wrapper .zcwf_privacy_txt div,
    .contact-form-wrapper .zcwf_privacy_txt font,
    .contact-form-wrapper .zcwf_privacy_txt span {
        font-family: inherit !important;
        font-size: inherit !important;
        color: inherit !important;
    }
    
    /* Orange link inside acceptance text */
    .contact-form-wrapper .zcwf_privacy_txt a {
        color: #ff4a03 !important;
        text-decoration: none !important;
    }
    .contact-form-wrapper .zcwf_privacy_txt a:hover {
        text-decoration: underline !important;
    }
    
    /* Submit button — full width, orange, 48px */
    .contact-form-wrapper .formsubmit {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        height: 48px !important;
        background: #ff4a03 !important; /* override gradient */
        color: #ffffff !important;
        font-family: 'IBM Plex Sans', sans-serif !important;
        font-weight: 500 !important;
        font-size: 18px !important;
        text-align: center !important;
        border: none !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        transition: background-color 0.2s ease !important;
        margin-top: 4px !important;
        letter-spacing: 0.01em !important;
        padding: 0 !important;
    }
    .contact-form-wrapper .formsubmit:hover {
        background: #e03f00 !important;
    }
    
    /* Hide reset button if present */
    .contact-form-wrapper input[type="reset"] {
        display: none !important;
    }

    /* Validation error messages */
    .contact-form-wrapper #privacyErr1293549000027498002 {
        font-family: 'IBM Plex Sans', sans-serif !important;
        font-size: 13px !important;
        color: #e03f00 !important;
        margin-top: 4px !important;
        padding-left: 0 !important;
        display: none !important; /* Hide by default to remove empty space */
        width: 100% !important;
        margin-left: 30px !important;
    }
    
    .contact-form-wrapper #privacyErr1293549000027498002[style*="visible"] {
        display: block !important;
    }

    /* ── Intl Tel Input Overrides ── */
    .iti {
        width: 100%;
        display: block;
    }
    .contact-form-wrapper .iti input[type="tel"],
    .contact-form-wrapper .iti input[type="text"] {
        width: 100% !important;
        margin-bottom: 0 !important;
        padding-left: 76px !important;
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
    var phoneInput = document.querySelector('#Phone');
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

<main id="primary" class="site-main bg-[#f9f7f6] min-h-screen overflow-hidden -mt-[80px] pt-[80px]">

    <section class="relative pb-[50px] pt-[50px]">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[62px]">

                <!-- Left Content -->
                <div class="w-full flex flex-col gap-[40px]">

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
                <div class="w-full relative mt-10 lg:mt-0">
                    <!-- Orange outer card matching Figma -->
                    <div class="relative w-full rounded-[24px] overflow-hidden bg-orange-gradient flex flex-col justify-center px-[24px] py-[24px] bg-[linear-gradient(0deg,rgba(255,255,255,0.2),rgba(255,255,255,0.2)),linear-gradient(180deg,rgba(255,74,3,0.1)_66.83%,rgba(255,255,255,0)_100%)]"
                        >

                        <!-- White Form Card -->
                        <div class="relative z-10 bg-white rounded-[12px] w-full contact-form-wrapper p-[20px] md:px-[30px] md:pt-[30px] md:pb-[20px]"
                            style="border: 1px solid #f2ecff;">
                            <!-- Note : - You can modify the font style and form style to suit your website. - Code lines with comments Do not remove this code are required for the form to work properly, make sure that you do not remove these lines of code. - The Mandatory check script can modified as to suit your business needs. - It is important that you test the modified form before going live.-->
                            <div id='crmWebToEntityForm' class='zcwf_lblLeft crmWebToEntityForm' style='background-color: white;color: black;max-width: 600px;'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <META HTTP-EQUIV='content-type' CONTENT='text/html;charset=UTF-8'>
                                <form id='webform1293549000027498002' action='https://crm.zoho.in/crm/WebToLeadForm' name=WebToLeads1293549000027498002 method='POST' onSubmit='javascript:document.charset="UTF-8"; var isValid = checkMandatory1293549000027498002(); if(isValid) { window.zohoFormSubmitted = true; } return isValid;' accept-charset='UTF-8' target='zoho_hidden_iframe'>
                                    <input type='text' style='display:none;' name='xnQsjsdp' value='b36ece8a12db00fd62eb8a99abbf4353a69fe28c39353ce4c3b85429c71abf65'> </input>
                                    <input type='hidden' name='zc_gad' id='zc_gad' value=''> </input>
                                    <input type='text' style='display:none;' name='xmIwtLD' value='3c4a1ca4bf8c0a3f4418da236d7625223130663ce4beddaf22518879a3bd207d5e6835ed56bda4b85482d218da9e722d'> </input>
                                    <input type='text' style='display:none;' name='actionType' value='TGVhZHM='> </input>
                                    <input type='text' style='display:none;' name='returnURL' value='<?php echo esc_url( home_url( '/thank-you/' ) ); ?>'> </input>
                                    <!-- Do not remove this code. -->
                                    <style> html,body{ margin: 0px; } .formsubmit.zcwf_button{ color: white !important; background: transparent linear-gradient(0deg, #0279FF 0%, #00A3F3 100%); } #crmWebToEntityForm.zcwf_lblLeft{ width: 100%; padding: 25px; margin: 0 auto; box-sizing: border-box; } #crmWebToEntityForm.zcwf_lblLeft *{ box-sizing: border-box; } #crmWebToEntityForm{ text-align: left; } #crmWebToEntityForm *{ direction: ltr; } .zcwf_lblLeft .zcwf_title{ word-wrap: break-word; padding: 0px 6px 10px; font-weight: bold } .zcwf_lblLeft.cpT_primaryBtn:hover{ background: linear-gradient(#02acff 0,#006be4 100%)no-repeat padding-box !important; box-shadow: 0 -2px 0 0 #0159b9 inset !important; border: 0 !important; color: #fff !important; outline: 0 !important; } .zcwf_lblLeft .zcwf_col_fld input[ type = text], input[ type = password], .zcwf_lblLeft .zcwf_col_fld textarea { width: 60%; border: 1px solid #c0c6cc !important; resize: vertical; border-radius: 2px; float: left; } .zcwf_lblLeft .zcwf_col_lab{ width: 30%; word-break: break-word; padding: 0px 6px 0px; margin-right: 10px; margin-top: 5px; float: left; min-height: 1px; } .zcwf_lblLeft .zcwf_col_fld{ float: left; width: 68%; padding: 0px 6px 0px; position: relative; margin-top: 5px; } .zcwf_lblLeft .zcwf_privacy{ padding: 6px; } .zcwf_lblLeft .wfrm_fld_dpNn{ display: none; } .dIB{ display: inline-block; } .zcwf_lblLeft .zcwf_col_fld_slt{ width: 60%; border: 1px solid #ccc; background: #fff; border-radius: 4px; font-size: 12px; float: left; resize: vertical; padding: 2px 5px; } .zcwf_lblLeft .zcwf_row:after, .zcwf_lblLeft .zcwf_col_fld:after{ content: ''; display: table; clear: both; } .zcwf_lblLeft .zcwf_col_help{ float: left; margin-left: 7px; font-size: 12px; max-width: 35%; word-break: break-word; } .zcwf_lblLeft .zcwf_help_icon{ cursor: pointer; width: 16px; height: 16px; display: inline-block; background: #fff; border: 1px solid #c0c6cc; color: #c1c1c1; text-align: center; font-size: 11px; line-height: 16px; font-weight: bold; border-radius: 50%; } .zcwf_lblLeft .zcwf_row{ margin: 15px 0px; } .zcwf_lblLeft .formsubmit{ margin-right: 5px; cursor: pointer; color: #313949; font-size: 12px; } .zcwf_lblLeft .zcwf_privacy_txt{ width: 90%; color: rgb(0, 0, 0); font-size: 12px; font-family: Arial; display: inline-block; vertical-align: top; color: #313949; padding-top: 2px; margin-left: 6px; } .zcwf_lblLeft .zcwf_button{ font-size: 12px; color: #313949; border: 1px solid #c0c6cc; padding: 3px 9px; border-radius: 4px; cursor: pointer; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; } .zcwf_lblLeft .zcwf_tooltip_over{ position: relative; } .zcwf_lblLeft .zcwf_tooltip_ctn{ position: absolute; background: #dedede; padding: 3px 6px; top: 3px; border-radius: 4px; word-break: break-word; min-width: 100px; max-width: 150px; color: #313949; z-index: 100; } .zcwf_lblLeft .zcwf_ckbox{ float: left; } .zcwf_lblLeft .zcwf_file{ width: 55%; box-sizing: border-box; float: left; } .cBoth:after{ content: ''; display: block; clear: both; } @media all and (max-width: 600px){ .zcwf_lblLeft .zcwf_col_lab, .zcwf_lblLeft .zcwf_col_fld{ width: auto; float: none !important; } .zcwf_lblLeft .zcwf_col_help{ width: 40%; } } </style>
                                    <h2 class='zcwf_title text-center text-[20px] font-medium text-dark mb-4' style='max-width: 600px;'>Let's Talk About Your Next Build</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-[12px] w-full">
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='First_Name'>First Name <span style='color:red;'>*</span> </label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <input type='text' id='First_Name' aria-required='true' aria-label='First Name' name='First Name' aria-valuemax='40' maxlength='40'> </input>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='Last_Name'>Last Name <span style='color:red;'>*</span> </label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <input type='text' id='Last_Name' aria-required='true' aria-label='Last Name' name='Last Name' aria-valuemax='80' maxlength='80'> </input>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-[12px] w-full">
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='Email'>Work Email <span style='color:red;'>*</span> </label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <input type='text' ftype='email' autocomplete='false' id='Email' aria-required='true' aria-label='Email' name='Email' aria-valuemax='100' crmlabel='' maxlength='100'> </input>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='Phone'>Phone Number</label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <input type='text' id='Phone' aria-required='false' aria-label='Phone' name='Phone' aria-valuemax='30' maxlength='30'> </input>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-[12px] w-full">
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='Company'>Company</label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <input type='text' id='Company' aria-required='false' aria-label='Company' name='Company' aria-valuemax='200' maxlength='200'> </input>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                        <div class='zcwf_row'>
                                            <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                                <label for='Industry'>Industry</label>
                                            </div>
                                            <div class='zcwf_col_fld'>
                                                <select class='zcwf_col_fld_slt' role='combobox' aria-expanded='false' aria-haspopup='listbox' id='Industry' onChange='addAriaSelected1293549000027498002()' aria-required='false' aria-label='Industry' name='Industry'>
                                                    <option value='-None-'>-None-</option>
                                                    <option value='Edu Tech'>Edu Tech</option>
                                                    <option value='Fintech'>Fintech</option>
                                                    <option value='Insurtech'>Insurtech</option>
                                                    <option value='LendTech'>LendTech</option>
                                                    <option value='PropTech'>PropTech</option>
                                                    <option value='Others'>Others</option>
                                                    <option value='Retail'>Retail</option>
                                                    <option value='Enterprise'>Enterprise</option>
                                                </select>
                                                <div class='zcwf_col_help'> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='zcwf_row'>
                                        <div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'>
                                            <label for='Description'>How can we help?</label>
                                        </div>
                                        <div class='zcwf_col_fld'>
                                            <textarea style='font-family: Arial, sans-serif;' aria-multiline='true' id='Description' aria-required='false' aria-label='Description' name='Description'></textarea>
                                            <div class='zcwf_col_help'> </div>
                                        </div>
                                    </div>
                                    <div class='zcwf_row'>
                                        <div class='zcwf_privacy'>
                                            <div class='dIB vaT' align='left'>
                                                <div class='displayPurpose crm-small-font-size'>
                                                    <label class='newCustomchkbox-md dIB w100_per'>
                                                        <input autocomplete='off' id='privacyTool1293549000027498002' type='checkbox' aria-checked='false' name='' aria-errormessage='privacyErr1293549000027498002' aria-label='privacyTool' onclick='disableErr1293549000027498002()'>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='dIB zcwf_privacy_txt' style='font-size: 12px;font-family:Arial;color: black;'>
                                                <div>
                                                    <font color='#1b1b1b' face='Jost, sans-serif'>
                                                        <span style='font-size:32px'>I agree to the <a href='<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>' title='Terms and Conditions' target='_blank'>terms and conditions</a> </span>
                                                    </font>
                                                </div>
                                            </div>
                                            <div id='privacyErr1293549000027498002' aria-live='polite' style='font-size:12px;color:red;padding-left: 5px;visibility:hidden;'>Please accept this</div>
                                        </div>
                                    </div>
                                    <input type='text' type='hidden' style='display: none;' name='aG9uZXlwb3Q' value='' />
                                    <div class='zcwf_row'>

                                        <div class='zcwf_col_fld'>
                                            <input type='submit' id='formsubmit' role='button' class='formsubmit zcwf_button' value='Let’s Connect' aria-label='Let’s Connect' title='Let’s Connect'>
                                            <input type='reset' class='zcwf_button' role='button' name='reset' value='Reset' aria-label='Reset' title='Reset'>
                                        </div>
                                    </div>
                                    <script>
                                        function showInlineError(fieldObj, message) {
                                            var errorTip = fieldObj.parentNode.querySelector('.wpcf7-not-valid-tip');
                                            if (!errorTip) {
                                                errorTip = document.createElement('span');
                                                errorTip.className = 'wpcf7-not-valid-tip';
                                                fieldObj.parentNode.appendChild(errorTip);
                                            }
                                            errorTip.innerHTML = message;
                                            fieldObj.classList.add('wpcf7-not-valid');
                                            // Add focus event listener to remove error when user clicks on it
                                            fieldObj.addEventListener('input', function() {
                                                fieldObj.classList.remove('wpcf7-not-valid');
                                                if (errorTip && errorTip.parentNode) {
                                                    errorTip.parentNode.removeChild(errorTip);
                                                }
                                            }, { once: true });
                                            fieldObj.focus();
                                        }

                                        function clearInlineErrors(form) {
                                            var tips = form.querySelectorAll('.wpcf7-not-valid-tip');
                                            tips.forEach(function(tip) { tip.remove(); });
                                            var fields = form.querySelectorAll('.wpcf7-not-valid');
                                            fields.forEach(function(field) { field.classList.remove('wpcf7-not-valid'); });
                                        }

                                        function addAriaSelected1293549000027498002() {
                                            var optionElem = event.target;
                                            var previousSelectedOption = optionElem.querySelector('[aria-selected=true]');
                                            if (previousSelectedOption) { previousSelectedOption.removeAttribute('aria-selected'); }
                                            optionElem.querySelectorAll('option')[optionElem.selectedIndex].ariaSelected = 'true';
                                        }

                                        function privacyAlert1293549000027498002() {
                                            var privacyTool = document.getElementById('privacyTool1293549000027498002');
                                            var privacyErr = document.getElementById('privacyErr1293549000027498002');
                                            if (privacyTool != undefined && !privacyTool.checked) {
                                                privacyErr.style.visibility = 'visible';
                                                privacyTool.ariaInvalid = 'true';
                                                privacyTool.focus();
                                                return false;
                                            }
                                            return true;
                                        }

                                        function disableErr1293549000027498002() {
                                            var privacyTool = document.getElementById('privacyTool1293549000027498002');
                                            var privacyErr = document.getElementById('privacyErr1293549000027498002');
                                            if (privacyTool != undefined && privacyTool.checked && privacyErr != undefined) {
                                                privacyErr.style.visibility = 'hidden';
                                                privacyTool.ariaInvalid = 'false';
                                            }
                                        }

                                        function validateEmail1293549000027498002() {
                                            var form = document.forms['WebToLeads1293549000027498002'];
                                            var emailFld = form.querySelectorAll('[ftype=email]');
                                            var i;
                                            for (i = 0; i < emailFld.length; i++) {
                                                var emailVal = emailFld[i].value;
                                                if ((emailVal.replace(/^\s+|\s+$/g, '')).length != 0) {
                                                    var atpos = emailVal.indexOf('@');
                                                    var dotpos = emailVal.lastIndexOf('.');
                                                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= emailVal.length) {
                                                        showInlineError(emailFld[i], 'Please enter a valid email address.');
                                                        return false;
                                                    }
                                                }
                                            }
                                            return true;
                                        }

                                        function checkMandatory1293549000027498002(isAjax) {
                                            var form = document.forms['WebToLeads1293549000027498002'];
                                            clearInlineErrors(form);

                                            var mndFileds = new Array('First Name', 'Last Name', 'Email');
                                            var fldLangVal = new Array('First Name', 'Last Name', 'Work Email');
                                            for (i = 0; i < mndFileds.length; i++) {
                                                var fieldObj = form[mndFileds[i]];
                                                if (fieldObj) {
                                                    if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length == 0) {
                                                        if (fieldObj.type == 'file') {
                                                            showInlineError(fieldObj, 'Please select a file to upload.');
                                                            return false;
                                                        }
                                                        showInlineError(fieldObj, fldLangVal[i] + ' cannot be empty.');
                                                        return false;
                                                    } else if (fieldObj.nodeName == 'SELECT') {
                                                        if (fieldObj.options[fieldObj.selectedIndex].value == '-None-') {
                                                            showInlineError(fieldObj, fldLangVal[i] + ' cannot be none.');
                                                            return false;
                                                        }
                                                    } else if (fieldObj.type == 'checkbox') {
                                                        if (fieldObj.checked == false) {
                                                            showInlineError(fieldObj, 'Please accept ' + fldLangVal[i]);
                                                            return false;
                                                        }
                                                    }
                                                    try {
                                                        if (fieldObj.name == 'Last Name') {
                                                            name = fieldObj.value;
                                                        }
                                                    } catch (e) { }
                                                }
                                            }
                                            if (!validateEmail1293549000027498002()) {
                                                return false;
                                            }
                                            if (!privacyAlert1293549000027498002()) {
                                                return false;
                                            }
                                            
                                            var urlparams = new URLSearchParams(window.location.search);
                                            if (urlparams.has('service') && (urlparams.get('service') === 'smarturl')) {
                                                var webform = document.getElementById('webform1293549000027498002');
                                                var service = urlparams.get('service');
                                                var smarturlfield = document.createElement('input');
                                                smarturlfield.setAttribute('type', 'hidden');
                                                smarturlfield.setAttribute('value', service);
                                                smarturlfield.setAttribute('name', 'service');
                                                webform.appendChild(smarturlfield);
                                            }
                                            
                                            // Delay disabling the submit button to prevent Chrome/Safari from cancelling the submit event
                                            setTimeout(function() {
                                                var btn = document.querySelector('.crmWebToEntityForm .formsubmit');
                                                if (btn) btn.setAttribute('disabled', true);
                                            }, 100);
                                            
                                            return true;
                                        }

                                        _wFa_ajax_will_be_replaced = false;
                                        if (typeof _wfa_fstprtcken == 'undefined') { _wfa_fstprtcken = {}; }
                                        _wfa_fstprtcken[1293549000027498002] = true;

                                        function tooltipShow1293549000027498002(el) {
                                            var tooltip = el.nextElementSibling;
                                            var tooltipDisplay = tooltip.style.display;
                                            if (tooltipDisplay == 'none') {
                                                var allTooltip = document.getElementsByClassName('zcwf_tooltip_over');
                                                for (i = 0; i < allTooltip.length; i++) {
                                                    allTooltip[i].style.display = 'none';
                                                }
                                                tooltip.style.display = 'block';
                                            } else {
                                                tooltip.style.display = 'none';
                                            }
                                        } 
                                    </script>
                                    <!-- Do not remove this --- Analytics Tracking code starts -->
                                    <script id='wf_anal' src='https://crm.zohopublic.in/crm/WebFormAnalyticsServeServlet?rid=f41644e43be40749ac2870965170b724b683af31c3bae5037b199c4f0db7b503561cead046836002e900237403dcb0ecgid30e8e1e7b4d9320e6606e5719f858fe185cdd57acb95aa9bac4b2f96cbf1aceagidbf6305fb1711fdd89364f1022671ac80f87f1cfc8ea510b44750257c9e7138fbgidef9b151a89b150272e093bc6f66921d210d6ce4dc4618d42073eeada5cab18dc&tw=11d42ae7478168eed4ecf01a7a580405b09d3eb87c8ea44b99c79c3d9dc6876a&version=v2'> </script>
                                    <!-- Do not remove this --- Analytics Tracking code ends. -->
                                </form>
                                <iframe name="zoho_hidden_iframe" id="zoho_hidden_iframe" style="display:none;" onload="if(window.zohoFormSubmitted) { window.top.location.href = '<?php echo esc_url( home_url( '/thank-you/' ) ); ?>'; }"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Global Presence Section (Reused from Home) -->
    <?php get_template_part( 'template-parts/home/presence' ); ?>

</main>



<?php
get_footer();
