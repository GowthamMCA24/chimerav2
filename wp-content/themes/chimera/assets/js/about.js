/**
 * About Page Interactions
 */
document.addEventListener('DOMContentLoaded', () => {
    
    // Timeline horizontal scroll support (drag to scroll on desktop/mobile)
    const timelineContainer = document.querySelector('.scrollbar-hide');
    if (timelineContainer) {
        let isDown = false;
        let startX;
        let scrollLeft;

        timelineContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            timelineContainer.classList.add('active');
            startX = e.pageX - timelineContainer.offsetLeft;
            scrollLeft = timelineContainer.scrollLeft;
        });

        timelineContainer.addEventListener('mouseleave', () => {
            isDown = false;
            timelineContainer.classList.remove('active');
        });

        timelineContainer.addEventListener('mouseup', () => {
            isDown = false;
            timelineContainer.classList.remove('active');
        });

        timelineContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - timelineContainer.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed multiplier
            timelineContainer.scrollLeft = scrollLeft - walk;
        });
    }

});
