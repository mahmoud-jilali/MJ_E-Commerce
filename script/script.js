let profil = document.querySelector('.header .flex .profil');
document.querySelector('#user-btn').onclick = () =>{
    profil.classList.toggle('active');
    navbar.classList.remove('active');
}
let navbar = document.querySelector('.header .flex .navbar');
document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profil.classList.remove('active');
}
window.onscroll = () =>{
    profil.classList.remove('active');
    navbar.classList.remove('active');
}
subImgs = document.querySelectorAll('.view .box .p-img .pt-img img');
MainImg = document.querySelector('.view .box .p-img .g-img img');
subImgs.forEach(images =>{
    images.onclick = () =>{
        let src = images.getAttribute('src');
        MainImg.src = src;
    }
});
const select = document.getElementById("mode_paiement");
const carteInfos = document.getElementById("carteInfos");
select.addEventListener("change", function(event){
    if(event.target.value == 'Carte bancaire'){
        carteInfos.style.display = "block";
    }else{
        carteInfos.style.display = "none";
    }
});