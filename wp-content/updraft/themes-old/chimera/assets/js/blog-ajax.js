document.addEventListener('DOMContentLoaded', () => {
    
    // Check if we are on an archive page by looking for the wrapper
    const gridWrapper = document.getElementById('ajax-grid-wrapper');
    if (!gridWrapper) return;

    let activeCategory = '';
    let searchQuery = '';
    let paged = 1;
    
    // Read dynamic attributes
    const postType = gridWrapper.getAttribute('data-post-type') || 'post';
    const taxonomy = gridWrapper.getAttribute('data-taxonomy') || 'category';

    const searchInput = document.querySelector('.ajax-search-input');
    const searchForm = document.querySelector('.ajax-search-form');

    // Prevent standard search form submission (so pressing enter doesn't reload the page)
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
        });
    }

    // Debounce function for live search
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const val = e.target.value;

            // Only trigger AJAX if the box is cleared, or if user typed more than 3 characters (4+)
            if (val.length === 0 || val.length >= 3) {
                searchTimeout = setTimeout(() => {
                    searchQuery = val;
                    paged = 1; // Reset to page 1 on new search
                    fetchPosts();
                }, 500); // 500ms debounce
            }
        });
    }

    // Use event delegation for category buttons and pagination 
    // because they get replaced by AJAX and lose their event listeners if attached directly
    document.addEventListener('click', (e) => {
        
        // Handle Category Buttons
        const catBtn = e.target.closest('.category-filter-btn');
        if (catBtn) {
            e.preventDefault();
            activeCategory = catBtn.getAttribute('data-category');
            paged = 1; // Reset to page 1 on category change
            
            // Update Button Styling visually
            document.querySelectorAll('.category-filter-btn').forEach(btn => {
                btn.classList.remove('bg-orange', 'text-white', 'border-orange', 'hover:text-white');
                btn.classList.add('bg-white', 'text-dark', 'border-dark', 'hover:border-orange', 'hover:text-orange');
            });
            catBtn.classList.remove('bg-white', 'text-dark', 'border-dark', 'hover:border-orange', 'hover:text-orange');
            catBtn.classList.add('bg-orange', 'text-white', 'border-orange', 'hover:text-white');

            fetchPosts();
        }

        // Handle Pagination Links
        const pageLink = e.target.closest('.ajax-pagination-link');
        if (pageLink) {
            e.preventDefault();
            paged = pageLink.getAttribute('data-page');
            fetchPosts();
            
            // Scroll nicely back to the top of the grid when changing pages
            const gridTop = document.getElementById('ajax-grid-wrapper').offsetTop - 100;
            window.scrollTo({ top: gridTop, behavior: 'smooth' });
        }
    });

    // Core AJAX function to fetch posts
    function fetchPosts() {
        // Visual loading state
        gridWrapper.style.opacity = '';
        gridWrapper.style.pointerEvents = 'none';

        const formData = new FormData();
        formData.append('action', 'filter_archive');
        formData.append('category', activeCategory);
        formData.append('s', searchQuery);
        formData.append('paged', paged);
        formData.append('post_type', postType);
        formData.append('taxonomy', taxonomy);

        fetch(chimeraAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            // Replace the grid content
            gridWrapper.innerHTML = html;
            
            // Remove visual loading state
            gridWrapper.style.opacity = '1';
            gridWrapper.style.pointerEvents = 'auto';
        })
        .catch(error => {
            console.error('Error fetching posts:', error);
            gridWrapper.style.opacity = '1';
            gridWrapper.style.pointerEvents = 'auto';
        });
    }

});
