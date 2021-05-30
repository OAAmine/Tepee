//header-hixed-when-scroling
const navbar = document.querySelector(".navbar-backg-color");
const links = document.querySelector(".navbar-right");
window.addEventListener("scroll" , function(){
    navbar.classList.toggle("stikky" , window.scrollY > 0)
    links.classList.toggle("stikky" , window.scrollY > 0)
})