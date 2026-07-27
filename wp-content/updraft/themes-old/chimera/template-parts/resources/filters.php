<?php
/**
 * Static Resource Filters Section
 *
 * @package Chimera
 */
?>

<section class="w-full pb-6 md:pb-10 relative z-10">

    <div class="container">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 pb-2">

            <!-- Filter Buttons -->
            <div class="flex-1 w-full overflow-hidden">
                <div class="flex items-center gap-3 overflow-x-auto scrollbar-hide w-full md:w-auto pb-1 md:pb-0">

                    <button
                        type="button"
                        data-filter="ALL"
                        class="resource-filter flex-shrink-0 bg-orange text-white border-orange px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300"
                    >
                        ALL
                    </button>

                    <button
                        type="button"
                        data-filter="BLOG"
                        class="resource-filter flex-shrink-0 bg-white text-dark border-dark px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                    >
                        BLOG
                    </button>

                    <button
                        type="button"
                        data-filter="WHITEPAPER"
                        class="resource-filter flex-shrink-0 bg-white text-dark border-dark px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                    >
                        WHITEPAPER
                    </button>

                    <button
                        type="button"
                        data-filter="EVENT"
                        class="resource-filter flex-shrink-0 bg-white text-dark border-dark px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                    >
                        EVENTS
                    </button>

                    <button
                        type="button"
                        data-filter="WEBINAR"
                        class="resource-filter flex-shrink-0 bg-white text-dark border-dark px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                    >
                        WEBINARS
                    </button>

                    <button
                        type="button"
                        data-filter="CASE STUDY"
                        class="resource-filter flex-shrink-0 bg-white text-dark border-dark px-5 py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                    >
                        CASE STUDY
                    </button>

                </div>
            </div>

            <!-- Search Box -->
            <div class="relative w-full md:w-[250px] lg:w-[320px] flex-shrink-0 mt-4 md:mt-0">

                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#666666]">

                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>

                </span>

                <input
                    id="resource-search"
                    type="text"
                    placeholder="Search article"
                    class="w-full h-[48px] pl-10 pr-4 rounded-[14px] border-2 border-dark bg-white text-sm focus:outline-none focus:border-orange transition-colors duration-200"
                >

            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.resource-filter');
    const searchInput = document.getElementById('resource-search');
    const cards = document.querySelectorAll('.resource-card');
    const pagination = document.getElementById('resources-pagination');

    const itemsPerPage = 12;
    let currentPage = 1;
    let activeFilter = 'ALL';
    let searchQuery = '';

    function scrollToGrid() {
        const gridSection = document.getElementById('resources-grid-section');
        if (gridSection) {
            const yOffset = -120; // Account for sticky header (top-0) and some margin
            const y = gridSection.getBoundingClientRect().top + (window.scrollY || window.pageYOffset) + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    }

    function renderPagination(totalItems) {
        if (!pagination) return;
        pagination.innerHTML = '';

        const totalPages = Math.ceil(totalItems / itemsPerPage);
        if (totalPages <= 1) {
            pagination.style.display = 'none';
            return;
        }

        pagination.style.display = 'flex';

        // Prev button (←)
        const prevBtn = document.createElement('button');
        prevBtn.className = currentPage === 1 
            ? 'py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark cursor-not-allowed transition-all duration-300'
            : 'py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark hover:border-orange hover:text-orange transition-all duration-300';
        prevBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M19 12H5" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 5L5 12L12 19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
        prevBtn.disabled = currentPage === 1;
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                filterAndPaginate();
                scrollToGrid();
            }
        });
        pagination.appendChild(prevBtn);

        // Page buttons (1, 2, 3...)
        let range = 1;
        let pages = [];
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - range && i <= currentPage + range)) {
                pages.push(i);
            }
        }
        
        let lastP = null;
        for (let p of pages) {
            if (lastP) {
                if (p - lastP === 2) {
                    addPageBtn(lastP + 1);
                } else if (p - lastP > 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'w-[52px] h-[40px] flex items-center justify-center text-gray text-sm';
                    ellipsis.innerText = '...';
                    pagination.appendChild(ellipsis);
                }
            }
            addPageBtn(p);
            lastP = p;
        }

        function addPageBtn(i) {
            const pageBtn = document.createElement('button');
            pageBtn.className = i === currentPage 
                ? 'py-[16px] px-5 rounded-[16px] bg-orange text-white font-semibold text-sm flex items-center justify-center font-sans transition-all duration-300'
                : 'py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark font-semibold text-sm font-sans hover:border-orange hover:text-orange transition-all duration-300';
            pageBtn.innerText = i;
            pageBtn.addEventListener('click', () => {
                currentPage = i;
                filterAndPaginate();
                scrollToGrid();
            });
            pagination.appendChild(pageBtn);
        }

        // Next button (→)
        const nextBtn = document.createElement('button');
        nextBtn.className = currentPage === totalPages 
            ? 'py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark cursor-not-allowed transition-all duration-300'
            : 'py-[16px] px-5 flex items-center justify-center rounded-[16px] border-2 border-dark text-dark hover:border-orange hover:text-orange transition-all duration-300';
        nextBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M5 12H19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 5L19 12L12 19" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                filterAndPaginate();
                scrollToGrid();
            }
        });
        pagination.appendChild(nextBtn);
    }

    function filterAndPaginate() {
        const matchedCards = [];

        // Check matching status for all cards
        cards.forEach(card => {
            const category = card.getAttribute('data-category') || '';
            const title = card.querySelector('h4').textContent.toLowerCase();
            
            const matchesFilter = (activeFilter === 'ALL' || category === activeFilter);
            const matchesSearch = title.includes(searchQuery);

            if (matchesFilter && matchesSearch) {
                matchedCards.push(card);
            } else {
                card.style.display = 'none';
            }
        });

        const totalMatched = matchedCards.length;
        const totalPages = Math.ceil(totalMatched / itemsPerPage);

        // Adjust currentPage if it exceeds totalPages
        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        // Show only cards for the current page
        matchedCards.forEach((card, index) => {
            const start = (currentPage - 1) * itemsPerPage;
            const end = currentPage * itemsPerPage;
            if (index >= start && index < end) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });

        // Render dynamic pagination buttons
        renderPagination(totalMatched);

        // Handle empty state
        let noResults = document.getElementById('no-resources-found');
        if (totalMatched === 0) {
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.id = 'no-resources-found';
                noResults.className = 'col-span-full text-center py-16 text-gray-500 font-sans w-full';
                noResults.innerHTML = `
                    <p class="text-lg font-semibold text-dark mb-2">No resources found</p>
                    <p class="text-sm text-gray">Try adjusting your search or filter options</p>
                `;
                const gridContainer = document.querySelector('.resource-card').parentNode;
                gridContainer.appendChild(noResults);
            } else {
                noResults.style.display = 'block';
            }
        } else {
            if (noResults) {
                noResults.style.display = 'none';
            }
        }
    }

    filters.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Update active state classes on buttons
            filters.forEach(b => {
                b.classList.remove('bg-orange', 'text-white', 'border-orange');
                b.classList.add('bg-white', 'text-dark', 'border-dark', 'hover:text-orange', 'hover:border-orange');
            });

            btn.classList.add('bg-orange', 'text-white', 'border-orange');
            btn.classList.remove('bg-white', 'text-dark', 'border-dark', 'hover:text-orange', 'hover:border-orange');

            activeFilter = btn.getAttribute('data-filter') || 'ALL';
            currentPage = 1; // Reset to page 1 on filter change
            filterAndPaginate();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase().trim();
            currentPage = 1; // Reset to page 1 on search change
            filterAndPaginate();
        });
    }

    // Initialize layout on page load
    filterAndPaginate();
});
</script>