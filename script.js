const menuToggle = document.querySelector('.menu-button');
const sidebar = document.querySelector('.sidebar');
const closeMenu = document.querySelector('.close-menu');

menuToggle.addEventListener('click', () => {sidebar.classList.add('active')});
closeMenu.addEventListener('click', () => {sidebar.classList.remove('active')});