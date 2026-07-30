<?php
/**
 * Static Related Resources Section
 *
 * @package Chimera
 */

$related_resources = [
    ['BLOG', 'June 16, 2026', 'Human + AI: The New Operating Model for Modern Enterprises', '/wp-content/uploads/2026/06/blog-image-1.png'],
    ['WHITEPAPER', 'June 18, 2026', 'Getting Started with Claude Code: Delegating Coding Tasks from Your Terminal', '/wp-content/uploads/2026/06/Frame-6.png'],
    ['CASE STUDY', 'June 20, 2026', 'Gen AI–Enabled Intelligent Insurance Endorsement Processing', '/wp-content/uploads/2026/06/Frame-6-1.png']
];
?>

<section class="w-full bg-[#F5F5F5] py-16 md:py-24">
    <div class="container">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-14">
            <div class="inline-flex font-jost items-center justify-center px-4 py-1.5 bg-white border border-[#FF4A0333] rounded-[8px] text-xs font-semibold uppercase text-orange mb-5">
                MORE RESOURCES
            </div>

            <h2 class="text-dark leading-tight text-3xl md:text-4xl lg:text-5xl font-bold">
                Related <span class="text-orange">Resources</span>
            </h2>
        </div>

        <!-- Resources Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            <?php foreach ($related_resources as $resource) : ?>
                <?php $detail_url = esc_url( site_url( '/resource-detail/?title=' . urlencode( $resource[2] ) . '&cat=' . urlencode( $resource[0] ) . '&date=' . urlencode( $resource[1] ) . '&img=' . urlencode( $resource[3] ) ) ); ?>
                <article
                    class="resource-card bg-white border border-lightGray/80 rounded-[12px] overflow-hidden flex flex-col transition-all duration-300 group hover:border-orange hover:bg-[#FFF6F0]"
                >

                    <!-- Image -->
                    <a href="<?php echo $detail_url; ?>" class="block">
                        <div class="h-[220px] overflow-hidden">
                            <img
                                src="<?php echo $resource[3]; ?>"
                                alt="<?php echo $resource[2]; ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                    </a>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-1">

                        <div class="flex items-center gap-4 mb-4">

                            <span class="inline-flex items-center px-3 py-1.5 bg-orange/10 text-orange border border-orange/20 rounded-[8px] text-[11px] font-semibold uppercase">
                                <?php echo $resource[0]; ?>
                            </span>

                            <span class="text-[#666666] text-xs">
                                <?php echo $resource[1]; ?>
                            </span>

                        </div>

                        <a href="<?php echo $detail_url; ?>" class="block mb-6 flex-1">
                            <h4 class="text-dark text-base md:text-[17px] font-semibold leading-[1.4] transition-colors duration-300 group-hover:text-orange">
                                <?php echo $resource[2]; ?>
                            </h4>
                        </a>

                        <a href="<?php echo $detail_url; ?>" class="text-orange font-bold text-sm flex items-center gap-2 mt-auto">
                            Read Article

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12h14M12 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    </div>

                </article>
            <?php endforeach; ?>

        </div>

        <!-- View All Resources -->
        <div class="text-center mt-10">
            <a
                href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"
                class="inline-flex items-center gap-2 bg-orange hover:opacity-90 text-white px-8 py-3.5 rounded-[8px] text-sm font-semibold transition-all duration-200"
            >
                View all resources

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                    />
                </svg>
            </a>
        </div>

    </div>
</section>
