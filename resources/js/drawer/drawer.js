const bodyElement = document.querySelector("body");
const hamburgerButtonElement = document.querySelector("#hamburger");
const closeButtonElement = document.querySelector("#close");
const drawerElement = document.querySelector("#menu");
const overlay = document.querySelector("#overlay");

hamburgerButtonElement.addEventListener("click", event => {
    drawerElement.classList.toggle("show-menu");
    overlay.classList.toggle("show-overlay");
    bodyElement.classList.toggle("no-scroll-bar");
    event.stopPropagation();
});

overlay.addEventListener("click", event => {
    drawerElement.classList.remove("show-menu");
    overlay.classList.remove("show-overlay");
    bodyElement.classList.remove("no-scroll-bar");
    event.stopPropagation();
})

closeButtonElement.addEventListener("click", event => {
    drawerElement.classList.remove("show-menu");
    overlay.classList.remove("show-overlay");
    bodyElement.classList.remove("no-scroll-bar");
    event.stopPropagation();
})