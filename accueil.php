<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
}
include 'autres/fav.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<div class="accueil-bg">
    <section class="swiper accueil">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <div class="img">
                    <img src="Imgs/hp_ellitebook 840 g3.png" alt="">
                </div>
                <div class="content">
                    <span>Découvrir -20% off</span>
                    <h3>HP ellitebook 840 g3</h3>
                    <a href="produits.php" class="btn">Découvrir</a>
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="img">
                    <img src="Imgs/asus_vivobook.png" alt="">
                </div>
                <div class="content">
                    <span>Découvrir -15% off</span>
                    <h3>asus vivobook</h3>
                    <a href="produits.php" class="btn">Découvrir</a>
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="img">
                    <img src="Imgs/ecran.png" alt="">
                </div>
                <div class="content">
                    <span>Meilleur gaming écran</span>
                    <h3>TUF Gaming VG27BQ HDR Gaming Monitor-27 inch QHD (2560x1440), 0.4ms*, 165Hz.</h3>
                    <a href="produits.php" class="btn">Découvrir</a>
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="img">
                    <img src="Imgs/gtx-1650.png" alt="">
                </div>
                <div class="content">
                    <span>Découvrir -10% off</span>
                    <h3>Nvidia gtx-1650</h3>
                    <a href="produits.php" class="btn">Découvrir</a>
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="img">
                    <img src="Imgs/msi.png" alt="">
                </div>
                <div class="content">
                    <span>Meilleur gaming pc-portable</span>
                    <h3>MSI GE63 Raider RGB-012 15.6"</h3>
                    <a href="produits.php" class="btn">Découvrir</a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </section>
</div>
<!-- *** -->
<section class="home-ctg">
    <h1>Catégories</h1>
    <div class="swiper ctg-slider">
        <div class="swiper-wrapper">
            <a href="categories.php?CodeCtg=1" class="swiper-slide slide">
                <img src="Imgs/pc-portable-icon.png" alt="">
                <h3>Ordinateur Portable</h3>
            </a>
            <a href="categories.php?CodeCtg=2" class="swiper-slide slide">
                <img src="Imgs/pc-bureau.png" alt="">
                <h3>Ordinateur Bureau</h3>
            </a>
            <a href="categories.php?CodeCtg=3" class="swiper-slide slide">
                <img src="Imgs/ecran-icon.png" alt="">
                <h3>Écran</h3>
            </a>
            <a href="categories.php?CodeCtg=4" class="swiper-slide slide">
                <img src="Imgs/carte-graphic-icon.png" alt="">
                <h3>Carte graphique</h3>
            </a>
            <a href="categories.php?CodeCtg=5" class="swiper-slide slide">
                <img src="Imgs/accessoires-icon.png" alt="">
                <h3>Accessoires</h3>
            </a>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> 
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- *** -->
<section class="home-prd">
    <h1>Nouveaux produits</h1>
    <div class="swiper prd-slider">
        <div class="swiper-wrapper">
            <?php 
                $slct_prd = $conn->prepare("SELECT * FROM `produits`");
                $slct_prd->execute();
                if($slct_prd->rowCount() > 0){
                    while($fetch_prd = $slct_prd->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="swiper-slide slide">
                <input type="hidden" name="refprd" value="<?= $fetch_prd['RefPrd']; ?>">
                <input type="hidden" name="nomprd" value="<?= $fetch_prd['NomPrd']; ?>">
                <input type="hidden" name="qte" value="<?= $fetch_prd['QtePrd']; ?>">
                <input type="hidden" name="prix" value="<?= $fetch_prd['Prix']; ?>">
                <input type="hidden" name="img" value="<?= $fetch_prd['Image_1']; ?>">
                <button type="submit" name="ajt_fav" class="fas fa-heart"></button>
                <a href="view.php?refprd=<?= $fetch_prd['RefPrd']; ?>" class="fas fa-eye"></a>
                <img src="Ajt_Imgs/<?= $fetch_prd['Image_1'];?>" class="img" alt="">
                <div class="nom"><?= $fetch_prd['NomPrd']; ?></div>
                <div class="flex">
                <span>Quantité :</span><input type="number" name="qte" class="qte" min="1" max="100" 
                value="1" onkeypress="if(this.value.lenght == 2) return false;">
                <div class="prix"><?= $fetch_prd['Prix']; ?><span> MAD</span></div>
                </div>
                <input type="submit" value="Ajouter au panier" name="ajt_panier" class="btn">
            </form>
            <?php 
                }
            }else{
                echo '<p class="vide">Aucun produit ajouté';
            }
            ?>
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
    var swiper = new Swiper(".accueil", {
        loop:true,
        grabCursor:true,
        slidesPerView : 'auto',
        spaceBetween : 30,
      pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
      },
      autoplay:{
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    }); 
    // *****   
    var swiper = new Swiper(".ctg-slider", {
        loop:true,
        grabCursor:true,
        slidesPerView : 'auto',
        spaceBetween : 30,
      pagination: {
        el: ".swiper-pagination",
      },
      autoplay:{
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    //****
    var swiper = new Swiper(".prd-slider", {
        loop:true,
        grabCursor:true,
        slidesPerView : 'auto',
        spaceBetween : 30,
      pagination: {
        el: ".swiper-pagination",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>
</body>
</html>