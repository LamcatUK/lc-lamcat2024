// Add your custom JS here.
document.addEventListener('DOMContentLoaded', function() {
    var mainNav = document.querySelector('header');
    var lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        var scrollTop = window.scrollY || document.documentElement.scrollTop;
        
        // Prevent negative scrollTop (elastic scroll) from causing the nav to hide
        if (scrollTop < 0) {
            scrollTop = 0;
        }

        if (scrollTop > lastScrollTop) {
            // Scrolling down
            mainNav.classList.add('hidden');
        } else {
            // Scrolling up
            mainNav.classList.remove('hidden');
        }

        lastScrollTop = scrollTop;
    });

});