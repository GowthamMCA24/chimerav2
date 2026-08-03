/**
 * Chimera Blog Interactivity
 *
 * Handles category filter UX, copy-to-clipboard, and reading progress bar
 *
 * @package Chimera
 */

document.addEventListener('DOMContentLoaded', () => {

    // ========================================
    // Copy Link Button (Single Post Page)
    // ========================================
    const copyLinkBtn = document.getElementById('copy-link-btn');
    if (copyLinkBtn) {
        copyLinkBtn.addEventListener('click', () => {
            const url = copyLinkBtn.dataset.url || window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                // Show success feedback
                const originalHTML = copyLinkBtn.innerHTML;
                copyLinkBtn.innerHTML = `
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                `;
                copyLinkBtn.classList.add('bg-orange', 'text-white');
                
                setTimeout(() => {
                    copyLinkBtn.innerHTML = originalHTML;
                    copyLinkBtn.classList.remove('bg-orange', 'text-white');
                }, 2000);
            }).catch(() => {
                // Fallback: select and copy from a temporary input
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            });
        });
    }

    // ========================================
    // Smooth scroll for anchor links
    // ========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return; // Skip empty anchors
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offset = 100; // Adjust for fixed header
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });

    // ========================================
    // Category filter scrollbar hide (horizontal scroll)
    // ========================================
    const filterContainer = document.getElementById('blog-category-filters');
    if (filterContainer) {
        // Add mouse wheel horizontal scroll
        filterContainer.addEventListener('wheel', (e) => {
            if (Math.abs(e.deltaX) < Math.abs(e.deltaY)) {
                e.preventDefault();
                filterContainer.scrollLeft += e.deltaY;
            }
        }, { passive: false });
    }

    // ========================================
    // Dynamic Table of Contents (Single Post Page)
    // ========================================
    const content = document.querySelector('.blog-entry-content');
    const tocContainer = document.getElementById('toc-container');

    if (content && tocContainer) {
        const headings = content.querySelectorAll('h2');
        if (headings.length === 0) {
            // If no headings, hide the TOC widget completely
            const widget = tocContainer.closest('.toc-widget');
            if (widget) widget.style.display = 'none';
        } else {
            const list = document.createElement('ul');
            list.className = 'border-l-2 border-lightGray';
            const links = [];

            headings.forEach((heading, index) => {
                // Ensure heading has an ID
                if (!heading.id) {
                    const text = heading.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
                    heading.id = text ? text : 'heading-' + index;
                }

                const li = document.createElement('li');
                
                // Indent h3 elements
                let plClass = 'pl-4';
                if (heading.tagName.toLowerCase() === 'h3') {
                    plClass = 'pl-8';
                }

                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;
                a.className = `block py-2.5 ${plClass} -ml-[2px] border-l-2 border-transparent hover:text-orange transition-colors text-dark text-sm duration-200`;
                
                // Optional: Add smooth scrolling
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    const offset = 100; // Adjust for fixed header
                    const elementPosition = heading.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                    // Update URL hash without jumping
                    history.pushState(null, null, '#' + heading.id);
                    
                    // Immediately update active state visually on click
                    links.forEach(item => {
                        item.link.classList.remove('border-orange', 'bg-[#FFF6F0]', 'text-orange', 'font-medium');
                        item.link.classList.add('border-transparent', 'text-dark');
                    });
                    a.classList.remove('border-transparent', 'text-dark');
                    a.classList.add('border-orange', 'bg-[#FFF6F0]', 'text-orange', 'font-medium');
                });

                li.appendChild(a);
                list.appendChild(li);
                links.push({ heading, link: a });
            });

            tocContainer.appendChild(list);

            // Update active state on scroll
            const setActiveTOC = () => {
                let current = headings[0];
                headings.forEach(h => {
                    const rect = h.getBoundingClientRect();
                    // if the heading is above a certain threshold (e.g., top 30% of viewport)
                    if (rect.top <= window.innerHeight * 0.3) {
                        current = h;
                    }
                });

                links.forEach(item => {
                    if (item.heading === current) {
                        item.link.classList.remove('border-transparent', 'text-dark');
                        item.link.classList.add('border-orange', 'bg-[#FFF6F0]', 'text-orange', 'font-medium');
                    } else {
                        item.link.classList.remove('border-orange', 'bg-[#FFF6F0]', 'text-orange', 'font-medium');
                        item.link.classList.add('border-transparent', 'text-dark');
                    }
                });
            };

            window.addEventListener('scroll', setActiveTOC, { passive: true });
            // Initial call
            setTimeout(setActiveTOC, 100);
        }
    }

});
