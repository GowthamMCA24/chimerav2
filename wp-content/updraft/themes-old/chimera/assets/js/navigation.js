document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = !mobileMenu.classList.contains('hidden');
            if (isOpen) {
                mobileMenu.classList.add('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
            } else {
                mobileMenu.classList.remove('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'true');
            }
        });
    }

    // Desktop Dropdown Toggles
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    
    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdownMenu = trigger.nextElementSibling;
            if (!dropdownMenu) return;

            const isHidden = dropdownMenu.classList.contains('hidden');
            
            // Close all dropdowns first
            closeAllDropdowns();

            // Toggle current dropdown
            if (isHidden) {
                dropdownMenu.classList.remove('hidden');
                dropdownMenu.classList.add('animate-fade-in');
            }
        });
    });

    // Prevent closing when clicking inside the mobile menu
    if (mobileMenu) {
        mobileMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    // Mobile Dropdown Sub-menu Toggle
    const mobileDropdownTriggers = document.querySelectorAll('.mobile-dropdown-trigger');
    mobileDropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            const menu = trigger.nextElementSibling;
            const arrow = trigger.querySelector('svg');
            if (menu) {
                const isHidden = menu.classList.contains('hidden');
                if (isHidden) {
                    menu.classList.remove('hidden');
                    if (arrow) arrow.classList.add('rotate-180');
                } else {
                    menu.classList.add('hidden');
                    if (arrow) arrow.classList.remove('rotate-180');
                }
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', () => {
        closeAllDropdowns();
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});
