<?php
/**
 * Template part for displaying the single post content
 *
 * Includes two-column layout with Author details, Post Content, TOC, Share icons, and Sidebar CTA
 *
 * @package Chimera
 */

$author_id = get_post_field('post_author', get_the_ID());
$author_name = get_the_author_meta('display_name', $author_id);
$author_desc = get_user_meta($author_id, 'designation', true);
if (empty($author_desc)) {
    $author_desc = 'Designation, Company';
}
$author_avatar = get_avatar_url($author_id);
$post_url = urlencode(get_permalink());
$post_title_encoded = urlencode(get_the_title());
$pt_class = (get_post_type() === 'casestudies') ? 'pt-[80px]' : 'pt-[155px]';

$toc = get_field('toc');
$toc_title = $toc['title'] ?? 'Some good heading here...';
$toc_btn_text = $toc['btn']['text'] ?? 'Button Text';
$toc_btn_link = $toc['btn']['link'] ?? '#';
$social_icons = get_field('social_icon', 'options');
$social_title = $social_icons['title'] ?? 'Share article tests';
$social_linkedin_link = $social_icons['linkedin']['link'] ?? '#';
$social_linkedin_image = $social_icons['linkedin']['img']['url'] ?? '#';
$social_linkedin_color = $social_icons['linkedin']['hover_color'] ?? '';
$social_twitter_link = $social_icons['twitter']['link'] ?? '#';
$social_twitter_image = $social_icons['twitter']['img']['url'] ?? '#';
$social_twitter_color = $social_icons['twitter']['hover_color'] ?? '';

?>

<section class="w-full bg-white pb-[100px] md:pb-24 <?php echo esc_attr($pt_class); ?>">
    <div class="container">

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_260px] gap-12 lg:gap-[100px]">

            <!-- Left Column: Main Content -->
            <div class="main-content-column">

                <!-- Author & Date Row -->
                <?php if (false && get_post_type() !== 'casestudies'): ?>
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 pb-5 border-b border-lightGray">
                        <!-- Author Info -->
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden border border-orange flex-shrink-0">
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
                            <div class="flex flex-col">
                                <span
                                    class="text-[#666666] font-jost text-sm md:text-base font-semibold leading-tight"><?php echo esc_html($author_name); ?></span>
                                <span
                                    class="text-[#666666] font-sans text-xs md:text-sm"><?php echo esc_html($author_desc); ?></span>
                            </div>
                        </div>

                        <!-- Published Date -->
                        <div class="flex flex-col sm:items-end">
                            <span
                                class="text-gray font-sans text-sm font-semibold capitalize tracking-wider mb-0.5">Published</span>
                            <span
                                class="text-gray font-sans text-xs font-medium"><?php echo esc_html(get_the_date('F j, Y')); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Article Content -->
                <?php
                $content_classes = 'blog-entry-content prose prose-lg prose-orange max-w-none [&>*:first-child]:!mt-0';
                ?>
                <div class="<?php echo esc_attr($content_classes); ?>">
                    <?php the_content(); ?>
                </div>

                <!-- Post Tags (Bottom of content) -->
                <?php
                $tags = get_the_tags();
                if ($tags):
                    ?>
                    <div class="flex flex-wrap items-center gap-2 mt-12 pt-8 border-t border-lightGray">
                        <span class="text-dark font-sans text-sm font-semibold mr-1">Tags:</span>
                        <?php foreach ($tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                class="px-3 py-1.5 bg-lightGray/50 border border-lightGray rounded-[6px] text-gray font-sans text-xs font-medium hover:bg-orange hover:text-white hover:border-orange transition-all duration-200">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Right Column: Sidebar -->
            <aside class="sidebar-column">
                <div class="md:sticky top-24 lg:top-32 space-y-[30px]">

                    <!-- Table of Contents -->
                    <div class="toc-widget">
                        <h3 class="text-dark font-jost text-lg font-semibold mb-4">Table of contents</h3>
                        <nav id="toc-container" class="space-y-3 text-sm font-sans text-gray">
                            <!-- TOC injected via JS -->
                        </nav>
                    </div>

                    <!-- Share Article (Blog & Whitepaper) -->
                    <div>
                        <h3 class="text-dark font-jost text-lg font-semibold mb-4"><?php echo $social_title; ?></h3>
                        <div class="flex items-center gap-3">
                            <!-- LinkedIn -->
                            <a href="<?php echo esc_attr('https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url); ?>"
                                target="_blank" rel="noopener noreferrer"
                                onmouseover="this.style.color='<?php echo esc_attr($social_linkedin_color); ?>'" onmouseout="this.style.color=''"
                                class="w-10 h-10 rounded-[8px] bg-lightGray/60 text-gray flex items-center justify-center transition-all duration-200 shadow-sm"
                                aria-label="Share on LinkedIn">
                                <span class="w-4 h-4 inline-block transition-colors duration-200"
                                      style="-webkit-mask-image: url('<?php echo esc_url($social_linkedin_image); ?>'); mask-image: url('<?php echo esc_url($social_linkedin_image); ?>'); -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat; mask-position: center; -webkit-mask-position: center; background-color: currentColor;">
                                </span>
                            </a>
                            <!-- Twitter/X -->
                            <a href="<?php echo esc_attr('https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title_encoded); ?>"
                                target="_blank" rel="noopener noreferrer"
                                onmouseover="this.style.color='<?php echo esc_attr($social_twitter_color); ?>'" onmouseout="this.style.color=''"
                                class="w-10 h-10 rounded-[8px] bg-lightGray/60 text-gray flex items-center justify-center transition-all duration-200 shadow-sm"
                                aria-label="Share on Twitter">
                                <span class="w-4 h-4 inline-block transition-colors duration-200"
                                      style="-webkit-mask-image: url('<?php echo esc_url($social_twitter_image); ?>'); mask-image: url('<?php echo esc_url($social_twitter_image); ?>'); -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat; mask-position: center; -webkit-mask-position: center; background-color: currentColor;">
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar CTA Widget -->
                    <?php if (get_field('show_sidebar_cta')): ?>
                        <div
                            class="sidebar-cta bg-orange rounded-[10px] py-5 px-[30px] text-center shadow-lg relative overflow-hidden text-white">
                            <?php
                            $is_whitepaper = get_post_type() === 'whitepaper';
                            $btn_text = $is_whitepaper ? 'Download Now' : 'Button Text';
                            $btn_href = $is_whitepaper ? '#download-popup' : '#contact';
                            $btn_onclick = $is_whitepaper ? 'onclick="document.getElementById(\'whitepaper-popup\').classList.remove(\'hidden\'); return false;"' : '';
                            ?>
                            <h3 class="font-jost text-lg font-semibold text-white mb-4 leading-tight">
                                <?php echo $toc_title ?? 'Some good heading here...'; ?></h3>
                            <a href="<?php echo esc_attr($toc_btn_link); ?>" <?php echo $btn_onclick; ?>
                                class="inline-flex items-center gap-2 bg-white text-orange font-semibold px-6 py-3 rounded-[20px] text-sm hover:bg-gray-50 transition-all duration-200 group shadow-md">
                                <?php echo esc_html($toc_btn_text); ?>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </aside>

        </div>

    </div>
</section>

<?php if (isset($is_whitepaper) && $is_whitepaper): ?>
    <!-- Whitepaper Download Popup -->
    <div id="whitepaper-popup" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-dark/40 backdrop-blur-[15px]"
            onclick="document.getElementById('whitepaper-popup').classList.add('hidden');"></div>

        <!-- Modal -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-[500px] bg-white rounded-[16px] shadow-2xl p-8 sm:p-10 z-10 flex flex-col">

            <!-- Close Button -->
            <button onclick="document.getElementById('whitepaper-popup').classList.add('hidden');"
                class="absolute top-4 right-4 text-gray hover:text-dark transition-colors" aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="1.5"></circle>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9l-6 6M9 9l6 6"></path>
                </svg>
            </button>

            <div class="text-center mb-6">
                <h3 class="font-jost text-2xl font-semibold text-dark mb-2">Download whitepaper</h3>
                <p class="text-gray text-sm font-normal">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
            </div>

            <div id="whitepaper-form-wrapper">
                <form id="whitepaper-form" action="#" method="POST" class="space-y-4">
                    <input type="hidden" name="action" value="submit_whitepaper">
                    <input type="hidden" name="whitepaper_file"
                        value="<?php echo esc_url(get_field('whitepaper_file')); ?>">
                    <input type="hidden" name="whitepaper_title" value="<?php echo esc_attr(get_the_title()); ?>">

                    <div>
                        <input type="text" name="name" required placeholder="Jhon Doe *"
                            class="w-full px-4 py-3 border border-bordergray rounded-[8px] focus:outline-none focus:border-orange focus:ring-1 focus:ring-orange transition-all text-sm text-dark placeholder:text-gray/70 font-medium">
                    </div>
                    <div>
                        <input type="email" name="work_email" required placeholder="Work Email *"
                            class="w-full px-4 py-3 border border-bordergray rounded-[8px] focus:outline-none focus:border-orange focus:ring-1 focus:ring-orange transition-all text-sm text-dark placeholder:text-gray/70">
                    </div>
                    <div>
                        <input type="text" name="company" placeholder="Company"
                            class="w-full px-4 py-3 border border-bordergray rounded-[8px] focus:outline-none focus:border-orange focus:ring-1 focus:ring-orange transition-all text-sm text-dark placeholder:text-gray/70">
                    </div>

                    <div class="flex items-start gap-3 mt-4 pt-2">
                        <input type="checkbox" id="consent" checked required
                            class="mt-0.5 w-4 h-4 accent-orange text-orange rounded cursor-pointer">
                        <label for="consent" class="text-[12px] text-gray leading-tight cursor-pointer">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </label>
                    </div>

                    <div id="whitepaper-error" class="hidden text-red-500 text-[13px] mt-3 text-center font-medium"></div>

                    <button type="submit"
                        class="w-full bg-orange text-white font-semibold py-3.5 rounded-[30px] mt-6 flex items-center justify-center gap-2 hover:bg-orangeLight transition-colors">
                        <span>Download Now</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <div id="whitepaper-success" class="hidden text-center py-8">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="font-jost text-2xl font-semibold text-dark mb-2">Success!</h3>
                <p class="text-gray text-sm font-normal">Please check your email. We've sent the download link to your
                    inbox.</p>
            </div>

        </div>
    </div>

    <script>
        (function () {
            const form = document.getElementById('whitepaper-form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const btnText = submitBtn.querySelector('span') || submitBtn;
                    const originalText = btnText.innerHTML;
                    const errorDiv = document.getElementById('whitepaper-error');

                    // Hide previous errors
                    if (errorDiv) errorDiv.classList.add('hidden');

                    btnText.innerHTML = 'Sending...';
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-70', 'cursor-not-allowed');

                    const formData = new FormData(form);
                    const searchParams = new URLSearchParams(formData);
                    const ajaxUrl = '<?php echo esc_url(admin_url("admin-ajax.php")); ?>';

                    fetch(ajaxUrl, {
                        method: 'POST',
                        body: searchParams
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Temporarily hide the entire popup on success instead of showing success msg
                                const popup = document.getElementById('whitepaper-popup');
                                if (popup) popup.classList.add('hidden');

                                // Reset form state in case they open it again
                                document.getElementById('whitepaper-form-wrapper').classList.remove('hidden');
                                document.getElementById('whitepaper-success').classList.add('hidden');
                                if (form) form.reset();
                                btnText.innerHTML = originalText;
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');

                                // Open the PDF in a new tab
                                if (data.data && data.data.url) {
                                    window.open(data.data.url, '_blank');
                                }
                            } else {
                                console.error('AJAX Error:', data.data);
                                if (errorDiv) {
                                    errorDiv.innerHTML = typeof data.data === 'string' ? data.data : 'Something went wrong. Please try again.';
                                    errorDiv.classList.remove('hidden');
                                }
                                btnText.innerHTML = originalText;
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch Error:', error);
                            if (errorDiv) {
                                errorDiv.innerHTML = 'A network error occurred. Please try again.';
                                errorDiv.classList.remove('hidden');
                            }
                            btnText.innerHTML = originalText;
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                        });
                });
            }
        })();
    </script>
<?php endif; ?>