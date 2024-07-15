const $button  = document.querySelector('#sidebar-toggle');
const $wrapper = document.querySelector('.wrapper');

$button.addEventListener('click', (e) => {
  e.preventDefault();
  $wrapper.classList.toggle('toggled');
});

function openNav() {
   document.getElementById("mySidepanel").style.display = "block";
}

function closeNav() {
  document.getElementById("mySidepanel").style.display = "none";
}

