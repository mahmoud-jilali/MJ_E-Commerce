<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="apropos">
    <div class="row">
        <div class="eshop">
            <p>E-<span>SHOP</span></p>
        </div>
        <div class="content">
        <h3>Qui sommes-nous?</h3>
            <p>
                E-SHOP, spécialiste de la vente sur Internet de matériel informatique, 
                High-Tech et multimédia.<br>
                E-SHOP a dès sa fondation souhaité trouver un positionnement différenciant,
                largement centré sur son offre et sa relation client.<br>
                E-SHOP est attaché à la qualité de la relation client, 
                vous pourrez donc vous rapprocher sans hésiter une seule seconde de notre service 
                Relation Client pour tout conseil avant-vente d’un PC portable ou PC de bureau.
            </p>
        <a href="contact.php" class="btn">Contactez-nous</a>
        </div>
    </div>
</section>
<section class="commentaires">
    <h1>Clients avis</h1>
    <div class="swiper avis-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
            <img src="Imgs/pic-1.png" alt="">
            <h3>Client x1</h3>
            <p>
                Excellent prix
                Excellent service.
                Merci
            </p>
            <div class="avis">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-half-alt"></i>
            </div>
            </div>
        <div class="swiper-slide slide">
            <img src="Imgs/pic-2.png" alt="">
            <h3>Client x2</h3>
            <p>
                Bon prix
                Bon service.
                Merci
            </p>
            <div class="avis">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-half-alt"></i>
            </div>           
        </div>
        <div class="swiper-slide slide">
            <img src="Imgs/pic-3.png" alt="">
            <h3>Client x1</h3>
            <p>
                respect de délais de livraison, 
                parfaite communication avec le vendeur, 
                pc livré en bon état
            </p>
            <div class="avis">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-half-alt"></i>
            </div>  
        </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> 
        <div class="swiper-pagination"></div>
    </div>
</section>




















<?php include 'autres/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="script/script.js"></script>
<script>
    var swiper = new Swiper(".avis-slider", {
        loop:true,
        grabCursor:true,
      pagination: {
        el: ".swiper-pagination",
        //type: "progressbar",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    }); 
</script>
</body>
</html>