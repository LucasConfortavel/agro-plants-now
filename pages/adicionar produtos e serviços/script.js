// script.js
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerMenu = document.querySelector('.jp_hamburger-menu');
    const sidebar = document.querySelector('.jp_sidebar');
    const overlay = document.querySelector('.jp_overlay');
    
    hamburgerMenu.addEventListener('click', function() {
        hamburgerMenu.classList.toggle('active');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function() {
        hamburgerMenu.classList.remove('active');
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideHamburger = hamburgerMenu.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickInsideHamburger && sidebar.classList.contains('active')) {
            hamburgerMenu.classList.remove('active');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});