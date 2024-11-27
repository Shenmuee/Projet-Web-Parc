const btnMenu = document.querySelector('.btnmenu'); 
const nav = document.querySelector('.nav');        

btnMenu.addEventListener('click', () => {
  nav.classList.toggle('active');  
});



document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup");
    const btnLogin = document.querySelector(".btnlogin");
    const btnClose = document.querySelector(".icon-close");
  
    btnLogin.addEventListener("click", () => {
      popup.classList.toggle("hidden");
    });
  
    btnClose.addEventListener("click", () => {
      popup.classList.add("hidden");
    });
  });
  