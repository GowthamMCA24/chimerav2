document.addEventListener('DOMContentLoaded', () => {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    if (!scrollToTopBtn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
            scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});