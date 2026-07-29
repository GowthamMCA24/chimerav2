<?php
/**
 * Template part for displaying the single event content
 *
 * @package Chimera
 */

$categories = chimera_get_post_categories();
$is_upcoming = false;
if ( ! empty( $categories ) ) {
    foreach ( $categories as $cat ) {
        if ( strtolower( $cat->name ) === 'upcoming' || strtolower( $cat->slug ) === 'upcoming' ) {
            $is_upcoming = true;
            break;
        }
    }
}

// Form fields configuration
$form_heading = get_field( 'form_heading' ) ?: 'Register for Event';
$form_description = get_field( 'form_description' ) ?: 'Fill out the form below to secure your spot.';
$form_consent_text = get_field( 'form_consent_text' ) ?: 'I agree to the terms and conditions.';
?>

<section class="w-full bg-white py-[60px] md:py-[80px]">
    <div class="container">
        <div class="flex flex-col lg:flex-row gap-10 md:gap-[30px] xl:gap-[60px] items-start">
            
            <!-- Left Column: Content -->
            <div class="w-full lg:flex-1 flex flex-col gap-[60px]">
                
                <div class="flex flex-col gap-5">
                    
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
                
            </div>
            
            <!-- Right Column: Registration Form Sidebar -->
            <?php 
            // if ( $is_upcoming ) : ?>
            <div class="w-full md:w-[450px] xl:w-[550px] flex-shrink-0" id="register">
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
                    <form id='webform1293549000027528003' name='WebToLeads1293549000027528003' class="flex flex-col gap-[10px]" accept-charset='UTF-8'>
                        <input type='hidden' name='xnQsjsdp' value='465fdf78ee54adf56ca15bf643f9bb53dc63febf9ab17bff1e46107d80fbc109'>
                        <input type='hidden' name='zc_gad' id='zc_gad' value=''>
                        <input type='hidden' name='xmIwtLD' value='316afd4887db38039df047f588e2e8b16f2cf16a685fd6e7fd352d6d09e5e012a45a66cb055339cbc4a46f7316f755a4'>
                        <input type='hidden' name='actionType' value='TGVhZHM='>
                        <input type='hidden' name='returnURL' value='null'>

                        <!-- Event context fields -->
                        <input type="hidden" name="event_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                        <input type="hidden" name="event_title" value="<?php echo esc_attr( get_the_title() ); ?>">
                        
                        <div class="w-full">
                            <input type="text" id='Last_Name' name="Last Name" placeholder="Name *" aria-required='true' aria-label='Last Name' aria-valuemax='80' maxlength='80'
                                   class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                            <p class="text-red-500 text-xs hidden mt-1" id="error-Last_Name"></p>
                        </div>
                        
                        <div class="w-full">
                            <input type="email" id='Email' name="Email" ftype='email' autocomplete='false' placeholder="Work Email *" aria-required='true' aria-label='Email' aria-valuemax='100' maxlength='100'
                                   class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                            <p class="text-red-500 text-xs hidden mt-1" id="error-Email"></p>
                        </div>
                        
                        <div class="w-full">
                            <input type="text" id='Company' name="Company" placeholder="Company" aria-required='false' aria-label='Company' aria-valuemax='200' maxlength='200'
                                   class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        </div>
                        
                        <div class="w-full">
                            <input type="text" id='Designation' name="Designation" placeholder="Job Title" aria-required='false' aria-label='Designation' aria-valuemax='100' maxlength='100'
                                   class="w-full h-[46px] px-5 py-4 rounded-[8px] border border-dark/50 text-sm font-sans font-medium placeholder-[#666]/50 focus:outline-none focus:border-orange transition-colors duration-200 bg-white">
                        </div>

                        <input type='hidden' name='aG9uZXlwb3Q' value=''/>
                        
                        <!-- Consent Checkbox -->
                        <div class="w-full mt-2">
                            <div class="flex items-start gap-[10px]">
                                <input type="checkbox" name="consent" id="event-consent"
                                       class="mt-0.5 w-[18px] h-[18px] flex-shrink-0 rounded border-dark/50 text-orange focus:ring-orange accent-orange cursor-pointer">
                                <label for="event-consent" class="text-gray font-sans text-xs leading-[1.3]">
                                    <?php echo esc_html( $form_consent_text ); ?>
                                </label>
                            </div>
                            <p class="text-red-500 text-xs hidden mt-1" id="error-event-consent"></p>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" id="formsubmit"
                                class="formsubmit bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center justify-center gap-2 mt-3">
                            Register Now
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                                <path d="M9.75 0.75L13.75 4.75L9.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M0.75 4.75H13.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                    
                    <!-- Inline Success Message (Hidden by default) -->
                    <div id="inline-success-message" class="hidden flex-col items-center justify-center py-2 mt-4 rounded-[8px] bg-[#F5FAF5] border">
                        <p class="text-[#132C14] font-sans text-center text-sm font-medium px-4" id="inline-success-text"></p>
                    </div>

                    <script>
                    function clearErrors1293549000027528003() {
                        var errorSpans = document.querySelectorAll('[id^="error-"]');
                        errorSpans.forEach(function(span) {
                            span.classList.add('hidden');
                            span.innerText = '';
                        });
                        var inputs = document.forms['WebToLeads1293549000027528003'].querySelectorAll('input');
                        inputs.forEach(function(input) {
                            input.classList.remove('!border-red-500');
                        });
                    }

                    function showError1293549000027528003(fieldObj, message) {
                        var fieldId = fieldObj.id;
                        var errorSpan = document.getElementById('error-' + fieldId);
                        if(errorSpan) {
                            errorSpan.innerText = message;
                            errorSpan.classList.remove('hidden');
                        }
                        if(fieldObj.type !== 'checkbox') {
                            fieldObj.classList.add('!border-red-500');
                        }
                    }

                    function validateEmail1293549000027528003(){
                        var form = document.forms['WebToLeads1293549000027528003'];
                        var emailFld = form.querySelectorAll('[ftype=email]');
                        var i;
                        for(i = 0; i < emailFld.length; i++ ) {
                            var emailVal = emailFld[i].value;
                            if ((emailVal.replace (/^\s+|\s+$/g,'') ) .length != 0) {
                                var atpos = emailVal.indexOf('@');
                                var dotpos = emailVal.lastIndexOf('.');
                                if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= emailVal.length) {
                                    showError1293549000027528003(emailFld[i], 'Please enter a valid email address.');
                                    emailFld[i].focus();
                                    return false;
                                }
                            }
                        }
                        return true;
                    }
                    function checkMandatory1293549000027528003(isAjax){
                        clearErrors1293549000027528003();
                        var mndFileds = new Array('Last Name', 'Email', 'consent');
                        var fldLangVal = new Array('Name', 'Email', 'Consent');
                        for (i = 0; i < mndFileds.length; i++ ) {
                            var fieldObj = document.forms['WebToLeads1293549000027528003'] [mndFileds[i]];
                            if (fieldObj) {
                                if(((fieldObj.value) .replace (/^\s+|\s+$/g,'') ) .length == 0) {
                                    if (fieldObj.type == 'file') {
                                        showError1293549000027528003(fieldObj, 'Please select a file to upload.');
                                        fieldObj.focus();
                                        return false;
                                    }
                                    showError1293549000027528003(fieldObj, fldLangVal[i] + ' cannot be empty.');
                                    fieldObj.focus();
                                    return false;
                                } else if (fieldObj.nodeName == 'SELECT') {
                                    if (fieldObj.options[fieldObj.selectedIndex].value == '-None-') {
                                        showError1293549000027528003(fieldObj, fldLangVal[i] + ' cannot be none.');
                                        fieldObj.focus();
                                        return false;
                                    }
                                } else if (fieldObj.type == 'checkbox') {
                                    if (fieldObj.checked == false) {
                                        showError1293549000027528003(fieldObj, 'Please accept ' + fldLangVal[i]);
                                        fieldObj.focus();
                                        return false;
                                    }
                                }
                                try{
                                    if (fieldObj.name == 'Last Name') {
                                        name = fieldObj.value;
                                    }
                                } catch (e){}
                            }
                        }
                        if ( !validateEmail1293549000027528003 () ) {
                            return false;
                        }
                        var urlparams = new URLSearchParams(window.location.search);
                        if (urlparams.has ('service') && (urlparams.get ('service') === 'smarturl') ) {
                            var webform = document.getElementById('webform1293549000027528003');
                            var service = urlparams.get('service');
                            var smarturlfield = document.createElement('input');
                            smarturlfield.setAttribute('type', 'hidden');
                            smarturlfield.setAttribute('value', service);
                            smarturlfield.setAttribute('name', 'service');
                            webform.appendChild(smarturlfield);
                        }
                        document.querySelector('#webform1293549000027528003 .formsubmit').setAttribute('disabled', true);
                    }
                    function captchaFailedHandling1293549000027528003(message){
                        var capErr = document.getElementById('captchaErr1293549000027528003');
                        if (capErr) {
                            capErr.innerHTML = message;
                            capErr.style.visibility = 'visible';
                            var capFld = document.getElementById('captchaField1293549000027528003');
                            if (capFld) capFld.focus();
                            setTimeout(function(){
                                capErr.style.visibility = 'hidden';
                            }, 5000);
                        } else {
                            alert(message);
                        }
                    }
                    let isSubmitting1293549000027528003 = false;
                    document.getElementById('webform1293549000027528003').addEventListener('submit', function(e){
                        e.preventDefault();
                        if(isSubmitting1293549000027528003) return;
                        
                        var ismandatory = checkMandatory1293549000027528003(true);
                        if(ismandatory === undefined || ismandatory) {
                            isSubmitting1293549000027528003 = true;
                            var formBtn = document.querySelector('#webform1293549000027528003 .formsubmit');
                            var originalBtnText = '';
                            if (formBtn) {
                                originalBtnText = formBtn.innerHTML;
                                formBtn.setAttribute('disabled', 'true');
                                formBtn.style.opacity = '0.7';
                                formBtn.style.cursor = 'not-allowed';
                                formBtn.innerHTML = 'Registering...';
                            }

                            if(typeof _wfa_track !== 'undefined' && _wfa_track.wfa_submit) {
                                _wfa_track.wfa_submit(e);
                            }
                            var formData = new FormData(this );
                            fetch('https://crm.zoho.in/crm/WebToLeadForm', {
                                method: 'POST',
                                body: formData,
                                cache: 'no-cache'
                            }).then(response => {
                                const contentType = response.headers.get('Content-Type');
                                return contentType.includes('application/json') ? response.json(): response.text();
                            }).then(data => {
                                if(typeof data === 'object') {
                                    if(data.actionsubmit === 'Splash Message') {
                                        if(data.invalidCaptcha && data.invalidCaptcha == 'true') {
                                            captchaFailedHandling1293549000027528003(data.actionvalue);
                                        } else {
                                            if (typeof reloadImg1293549000027528003 !== 'undefined') {
                                                reloadImg1293549000027528003();
                                            }
                                            
                                            // Reset form
                                            document.getElementById('webform1293549000027528003').reset();

                                            // Show inline success message below the form
                                            var inlineSuccess = document.getElementById('inline-success-message');
                                            var inlineText = document.getElementById('inline-success-text');
                                            if(inlineSuccess && inlineText) {
                                                inlineText.innerText = data.actionvalue;
                                                inlineSuccess.classList.remove('hidden');
                                                inlineSuccess.classList.add('flex');
                                                
                                                // Hide success message after 8 seconds
                                                setTimeout(function(){
                                                    inlineSuccess.classList.add('hidden');
                                                    inlineSuccess.classList.remove('flex');
                                                }, 8000);
                                            }
                                            
                                            // Re-enable submit button
                                            isSubmitting1293549000027528003 = false;
                                            var formBtn = document.querySelector('#webform1293549000027528003 .formsubmit');
                                            if (formBtn) {
                                                formBtn.removeAttribute('disabled');
                                                formBtn.style.opacity = '';
                                                formBtn.style.cursor = '';
                                                if(originalBtnText) formBtn.innerHTML = originalBtnText;
                                            }

                                            if(typeof _wfa_track != 'undefined' && _wfa_track.wfa_post_submit) {
                                                _wfa_track.wfa_post_submit(e);
                                            }
                                        }
                                    } else if(data.actionsubmit === 'redirect_url' || data.actionsubmit === 'parent_redirect') {
                                        if(data.success) {
                                            if(typeof _wfa_track !== 'undefined' && _wfa_track.wfa_post_submit) {
                                                _wfa_track.wfa_post_submit(e);
                                            }
                                            if (typeof historyBack1293549000027528003 !== 'undefined') {
                                                window.addEventListener('focus', historyBack1293549000027528003);
                                            }
                                        }
                                        if(data.actionsubmit === 'redirect_url') {
                                            window.location.assign(data.redirectUrl);
                                        } else if(data.actionsubmit === 'parent_redirect') {
                                            parent.window.location = data.redirectUrl;
                                        }
                                    } else if(data.actionsubmit === 'parent_redirect') {
                                        parent.window.location = data.redirectUrl;
                                    } else if(data.actionsubmit === 'add_hash') {
                                        document.location.hash = data.hash;
                                    } else if(data.actionsubmit === 'error_msg') {
                                        alert(data.message);
                                    } else if(data.invalidCaptcha && data.invalidCaptcha === 'true') {
                                        captchaFailedHandling1293549000027528003(data.actionvalue);
                                        if(data.extraAction === 'parent_signal') {
                                            window.parent.postMessage('checkCaptchaError', '*');
                                        }
                                    } else if(data.actionsubmit === 'captcha_error') {
                                        alert(data.message);
                                        if(data.extraAction === 'parent_signal') {
                                            window.parent.postMessage('checkCaptchaError', '*');
                                        }
                                    } else if(data.actionsubmit === 'thankyou_page') {
                                        if(typeof _wfa_track !== 'undefined' && _wfa_track.wfa_post_submit) {
                                            _wfa_track.wfa_post_submit(e);
                                            if (typeof historyBack1293549000027528003 !== 'undefined') {
                                                window.addEventListener('focus', historyBack1293549000027528003);
                                            }
                                        }
                                        window.location.assign(data.redirectUrl);
                                    }
                                } else {
                                    document.write(data);
                                }
                                isSubmitting1293549000027528003 = false;
                                let formDom = document.querySelector('#webform1293549000027528003 .formsubmit');
                                if (formDom) {
                                    formDom.removeAttribute('disabled');
                                    formDom.style.opacity = '';
                                    formDom.style.cursor = '';
                                    if(originalBtnText) formDom.innerHTML = originalBtnText;
                                }
                            }).catch (error => {
                                isSubmitting1293549000027528003 = false;
                                let formDom = document.querySelector('#webform1293549000027528003 .formsubmit');
                                if (formDom) {
                                    formDom.removeAttribute('disabled');
                                    formDom.style.opacity = '';
                                    formDom.style.cursor = '';
                                    if(originalBtnText) formDom.innerHTML = originalBtnText;
                                }
                                alert('an error occurred');
                            });
                        }
                    });
                    if (typeof _wfa_fstprtcken == 'undefined') {
                        _wfa_fstprtcken = {};
                    }
                    _wfa_fstprtcken[1293549000027528003] = true;
                    </script>
                    <script id='wf_anal' src='https://crm.zohopublic.in/crm/WebFormAnalyticsServeServlet?rid=19abd77e350aa3b3a8366be1845e1ded30382eb2913e19dc2967fdc3ed2993e030d9fce068a78274adee28c6f0b0c2b2gida7cb2c404dd7f1646179780a3c5273e66cfe1b0874caad228214ced72702cd47gid84e28bd13908d28411dc4fc515b06a6ec74d02452a7c303821132d2d4586e9f5gidcd86923a55be4d0e93283cbc9511d06204412be5d8306c1594aba946c952e909&tw=9366af6542e4699f845c69b79aa70932017903a5fc0179aa62e8de4cb6c200ae&version=v2'></script>
                    </form>
                    
                </div>
            </div>
            <?
            // php endif; ?>
            
        </div>
    </div>
</section>
