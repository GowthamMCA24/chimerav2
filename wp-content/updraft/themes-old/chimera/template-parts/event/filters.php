<?php
/**
 * Event Filters Section
 *
 * @package Chimera
 */

$taxonomy = $args['taxonomy'] ?? 'category';
$terms = get_terms( array(
    'taxonomy'   => $taxonomy,
    'hide_empty' => true,
) );
?>

<section class="w-full relative z-10">

    <div class="container">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 pb-2">

            <!-- Filter Buttons -->
            <div class="flex-1 w-full overflow-hidden">
                <div class="flex items-center gap-3 overflow-x-auto scrollbar-hide w-full md:w-auto pb-1 md:pb-0">

                    <button
                        type="button"
                        data-filter="ALL"
                        class="event-filter flex-shrink-0 bg-orange text-white border-orange px-[12px] py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300"
                    >
                        ALL
                    </button>

                    <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                        <?php foreach ( $terms as $term ) : ?>
                            <button
                                type="button"
                                data-filter="<?php echo esc_attr( strtoupper( $term->name ) ); ?>"
                                class="event-filter flex-shrink-0 bg-white text-dark border-dark px-[12px] py-[10px] rounded-[14px] border-2 text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:border-orange hover:text-orange"
                            >
                                <?php echo esc_html( strtoupper( $term->name ) ); ?>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Search Box removed for Event archive (search preserved elsewhere) -->

        </div>

    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.event-filter');
    const searchInput = document.getElementById('event-search');
    const cards = document.querySelectorAll('.event-card');
    const pagination = document.getElementById('events-pagination');

    const itemsPerPage = 5; // Use 5 items per page for horizontal cards
    let currentPage = 1;
    let activeFilter = 'ALL';
    let searchQuery = '';

    function scrollToGrid() {
        const gridSection = document.getElementById('ajax-grid-wrapper');
        if (gridSection) {
            const yOffset = -120;
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
        prevBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 5L5 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
        prevBtn.disabled = currentPage === 1;
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                filterAndPaginate();
                scrollToGrid();
            }
        });
        pagination.appendChild(prevBtn);

        // Page buttons
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
        nextBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
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

        cards.forEach(card => {
            const category = card.getAttribute('data-category') || '';
            const title = card.querySelector('h3').textContent.toLowerCase();
            
            const matchesFilter = (activeFilter === 'ALL' || category.toUpperCase() === activeFilter);
            const matchesSearch = title.includes(searchQuery);

            if (matchesFilter && matchesSearch) {
                matchedCards.push(card);
            } else {
                card.style.display = 'none';
            }
        });

        const totalMatched = matchedCards.length;
        const totalPages = Math.ceil(totalMatched / itemsPerPage);

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        matchedCards.forEach((card, index) => {
            const start = (currentPage - 1) * itemsPerPage;
            const end = currentPage * itemsPerPage;
            if (index >= start && index < end) {
                card.style.display = 'flex'; // Changed to flex because cards are horizontal flexboxes
            } else {
                card.style.display = 'none';
            }
        });

        renderPagination(totalMatched);

        let noResults = document.getElementById('no-events-found');
        if (totalMatched === 0) {
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.id = 'no-events-found';
                noResults.className = 'text-center py-16 text-gray-500 font-sans w-full';
                noResults.innerHTML = `
                    <p class="text-lg font-semibold text-dark mb-2">No events found</p>
                    <p class="text-sm text-gray">Try adjusting your search or filter options</p>
                `;
                const gridContainer = document.querySelector('.event-card')?.parentNode;
                if(gridContainer) gridContainer.appendChild(noResults);
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
            
            filters.forEach(b => {
                b.classList.remove('bg-orange', 'text-white', 'border-orange');
                b.classList.add('bg-white', 'text-dark', 'border-dark', 'hover:text-orange', 'hover:border-orange');
            });

            btn.classList.add('bg-orange', 'text-white', 'border-orange');
            btn.classList.remove('bg-white', 'text-dark', 'border-dark', 'hover:text-orange', 'hover:border-orange');

            activeFilter = btn.getAttribute('data-filter') || 'ALL';
            currentPage = 1;
            filterAndPaginate();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase().trim();
            currentPage = 1;
            filterAndPaginate();
        });
    }

    setTimeout(filterAndPaginate, 100);
});
</script>
