const nav = document.querySelector(".mobile-nav");
const burger = document.querySelector(".burger-toggle");
const links = nav.querySelectorAll("a");

burger.addEventListener("click", () => {
    nav.classList.toggle("inactive-menu");
    // burger.classList.toggle("inactive-menu");
});

links.forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.toggle("inactive-menu");
        // burger.classList.toggle("inactive-menu");
    })
});