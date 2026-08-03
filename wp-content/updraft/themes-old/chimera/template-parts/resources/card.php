<?php
/**
 * Static Resource Card
 *
 * @package Chimera
 */
?>

<article class="bg-white border border-lightGray/80 rounded-[12px] overflow-hidden flex flex-col transition-all duration-300 group hover:border-orange hover:shadow-lg">

    <!-- Image -->
    <a href="#" class="block">
        <div class="h-[200px] md:h-[220px] w-full overflow-hidden relative bg-lightGray">
            <img
                src="/wp-content/uploads/2026/06/box.png"
                alt="Resource Image"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            >
        </div>
    </a>

    <!-- Content -->
    <div class="p-6 flex flex-col flex-1">

        <!-- Tag & Date -->
        <div class="flex items-center gap-4 mb-4">

            <span class="inline-flex items-center px-[14px] py-[6px] bg-transparent text-orange border border-orange/40 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-wider">
                Technology
            </span>

            <span class="text-[#666666] text-xs md:text-[13px] font-sans font-medium">
                June 16, 2026
            </span>

        </div>

        <!-- Title -->
        <a href="#" class="block mb-4 md:mb-8 flex-1">
            <h4 class="text-dark font-sans text-base md:text-[17px] font-semibold leading-[1.4] transition-colors duration-300 group-hover:text-orange">
                How AI is Transforming Modern Businesses
            </h4>
        </a>

        <!-- Read Link -->
        <a
            href="#"
            class="text-orange font-bold text-sm font-sans flex items-center gap-2 transition-all duration-300 mt-auto group-hover:gap-3"
        >
            Read Article

            <svg
                class="w-4 h-4 transition-all duration-300"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 12h14M12 5l7 7-7 7"
                ></path>
            </svg>

        </a>

    </div>

</article>