<?php
/**
 * Template part for displaying the Industry Solutions section
 * Sticky scroll-stacking cards animation
 *
 * @package Chimera
 */

$solutions = get_field('industry_solutions') ?: [];
$badge_text = $solutions['badge_text'] ?? 'Our HealthTech Solutions';
$heading = $solutions['heading'] ?? 'Healthcare Technology Solutions';
$heading_highlight = $solutions['heading_highlight'] ?? 'for Connected Care Ecosystems';
$description = $solutions['description'] ?? '';
$card_bg_image = $card['background_image'] ?? '/wp-content/uploads/2026/07/industries-solutions-bg.png';
$cards = is_array($solutions['cards'] ?? []) ? ($solutions['cards'] ?? []) : [];
$card_count = count($cards);
?>

<style>
    .ind-solution-card {
        position: sticky;
    }

    .solutions-stack {
        gap: 20px;
    }
</style>

<section class="ind-solutions w-full bg-lightGray py-[60px] md:py-[80px] relative">
    <div class="container relative z-10">
        <div class="flex flex-col gap-[60px]">

            <!-- Centered Section Header -->
            <div class="text-center flex flex-col items-center gap-5">
                <!-- Badge -->
                <div
                    class="inline-flex font-jost items-center justify-center px-3 py-1.5 h-[32px] bg-white border border-[rgba(255,74,3,0.2)] rounded-[8px] text-xs font-semibold uppercase text-orange w-[max-content]">
                    <?php echo esc_html($badge_text); ?>
                </div>

                <!-- Heading -->
                <h2 class="leading-[1.2]">
                    <span class="text-dark block"><?php echo esc_html($heading); ?></span>
                    <span class="text-orange block"><?php echo esc_html($heading_highlight); ?></span>
                </h2>

                <?php if ($description): ?>
                    <p class="font-sans font-normal text-gray text-base leading-[1.5] max-w-[1100px] mx-auto md:px-10">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Solutions Card Stack -->
            <?php if ($cards): ?>
                <div class="solutions-stack flex flex-col gap-4">
                    <?php foreach ($cards as $index => $card):
                        $card_title = $card['title'] ?? '';
                        $card_desc = $card['description'] ?? '';
                        $card_image = $card['image'] ?? null;
                        $link_text = $card['link_text'] ?? $card['button_text'] ?? 'Inquire Details';
                        $link_url = $card['link_url'] ?? $card['button_link'] ?? '#';
                        $top_offset = 80 + ($index * 30);
                        ?>
                        <div class="ind-solution-card bg-white rounded-[10px] overflow-hidden will-change-transform origin-top shadow-[0_2px_16px_rgba(0,0,0,0.06)] relative"
                            style="top: <?php echo $top_offset; ?>px; z-index: <?php echo 10 + $index; ?>; transition: transform 0.5s ease-out, filter 0.5s ease-out;"
                            data-card-index="<?php echo $index; ?>">
                            <div class="grid grid-cols-1 sm:grid-cols-2 items-start gap-10 lg:gap-[40px] relative z-10">

                                <!-- Text Content -->
                                <div
                                    class="w-full py-8 pl-8 md:py-[60px] md:pl-[60px]  lg:flex-1 flex flex-col gap-[60px] min-h-[300px] lg:min-h-[400px]">
                                    <div class="flex flex-col gap-5">
                                        <h4
                                            class="font-jost font-semibold text-[20px] md:text-[24px] text-dark leading-none tracking-[-0.12px]">
                                            <?php echo esc_html($card_title); ?>
                                        </h4>
                                        <p class="font-sans max-w-3xl font-normal text-gray text-sm md:text-base leading-[1.5]">
                                            <?php echo esc_html($card_desc); ?>
                                        </p>
                                    </div>
                                    <div class="mt-8 lg:mt-0">
                                        <a href="<?php echo esc_url($link_url); ?>"
                                            class="bg-orange-gradient hover:opacity-95 text-white px-6 py-3 rounded-[8px] text-base font-semibold tracking-normal inline-flex items-center gap-2">
                                            <?php echo esc_html($link_text); ?>
                                            <div class="w-[13px] h-[8px] flex items-center justify-center">
                                                <svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 5H13M13 5L9 1M13 5L9 9" stroke="white" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div
                                    class="w-full flex py-8 pr-8 md:py-[60px] md:pr-[60px] items-center justify-center relative rounded-[10px] overflow-hidden flex-shrink-0">
                                    <!-- Background Pattern for Image -->
                                    <div class="absolute inset-0 pointer-events-none bg-no-repeat bg-center bg-cover"
                                        style="background-image: url('<?php echo esc_url($card_bg_image); ?>');">
                                    </div>

                                    <?php if ($card_image): ?>
                                        <img src="<?php echo esc_url($card_image['url']); ?>"
                                            alt="<?php echo esc_attr($card_image['alt'] ?? $card_title); ?>"
                                            class="relative z-10">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Sticky Scroll Stack Animation -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.ind-solution-card');
        if (!cards.length) return;

        let ticking = false;

        function updateCards() {
            cards.forEach((card, index) => {
                const rect = card.getBoundingClientRect();
                const cardTop = parseInt(card.style.top) || 80;

                // Is this card currently stuck at its sticky position?
                const isStuck = rect.top <= cardTop + 2;

                const nextCard = cards[index + 1];
                if (nextCard && isStuck) {
                    const nextRect = nextCard.getBoundingClientRect();

                    // How much of this card's height is overlapped by the next card
                    const overlapAmount = Math.max(0, rect.bottom - nextRect.top);
                    const overlapProgress = Math.min(1, overlapAmount / (rect.height * 0.6));

                    // Subtle scale-down and dim as card gets pushed back
                    const scale = 1 - (overlapProgress * 0.05);
                    const brightness = 1 - (overlapProgress * 0.1);

                    card.style.transform = `scale(${scale})`;
                    card.style.filter = `brightness(${brightness})`;
                } else {
                    card.style.transform = 'scale(1)';
                    card.style.filter = 'brightness(1)';
                }
            });

            ticking = false;
        }

        function onScroll() {
            if (!ticking) {
                requestAnimationFrame(updateCards);
                ticking = true;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });

        // Run once on load
        updateCards();
    });
</script>