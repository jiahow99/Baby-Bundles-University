var navbar = document.getElementById("navbar");
var dropdown_menu = document.getElementById("dropdown-menu");


window.onscroll = function(){
  if(window.scrollY > 10){
    navbar.classList.remove("bg-opacity-75");
    dropdown_menu.classList.remove("bg-opacity-75");
  }else{
    navbar.classList.add("bg-opacity-75");
    dropdown_menu.classList.add("bg-opacity-75");
  }
}