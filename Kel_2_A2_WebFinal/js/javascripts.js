const toggler = document.getElementById('toggler');
const navbar = document.querySelector('.navbar');

toggler.addEventListener('change', function () {
    if (this.checked) {
        navbar.style.display = 'block';
    } else {
        navbar.style.display = 'none';
    }
});

var icon = document.getElementById("icon");

icon.onclick = function(){
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")){
        icon.src="../images/moon.png";
    } else{
       icon.src = "../images/sun.png";
    } 
}