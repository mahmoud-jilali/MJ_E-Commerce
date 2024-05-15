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
subImgs = document.querySelectorAll('.MdfPrd .ImgContainer .SubImgs img');
MainImg = document.querySelector('.MdfPrd .ImgContainer .MainImg img');
subImgs.forEach(images =>{
    images.onclick = () =>{
        let src = images.getAttribute('src');
        MainImg.src = src;
    }
});