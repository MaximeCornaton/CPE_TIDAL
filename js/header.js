const header = document.getElementById("header");

// document.addEventListener('DOMContentLoaded', function() {
//     header.classList.add("header-loaded");
// }, false);


document.onscroll = function() {
    if (window.pageYOffset > 10) {
        header.classList.add("header-scrolled");
    } else {
        header.classList.remove("header-scrolled");
    }
}