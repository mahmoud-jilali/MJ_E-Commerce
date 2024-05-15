<?php 
if(isset($msg)){
    foreach($msg as $msg){
        echo
            '<div class="msg">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
    }
}
if(isset($msgv)){
    foreach($msgv as $msgv){
        echo
            '<div class="msgv">
            <span>'.$msgv.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
    }
}
?>
<header class="header">

<section class="flex">

<a href="accueil.php" class="logo">E-<span>Shop</span></a>

<nav class="navbar">
    <a href="accueil.php">accueil</a>
    <a href="produits.php">produits</a>
    <a href="apropos.php">à propos</a>
    <a href="contact.php">contact</a>
</nav>

<div class="icons">
    <?php
        $count_wl_prds = $conn->prepare("SELECT * FROM `wishlist`
        WHERE IdClt = ?");
        $count_wl_prds->execute([$Clt_Id]);
        $total_wl_prds = $count_wl_prds->rowCount();

        $count_cart_prds = $conn->prepare("SELECT * FROM `cart`
        WHERE IdClt = ?");
        $count_cart_prds->execute([$Clt_Id]);
        $total_cart_prds = $count_cart_prds->rowCount();
    ?>
    <div id="menu-btn" class="fas fa-bars"></div>
    <a href="recherch.php"><i class="fas fa-search"></i></a>
    <a href="wishlist.php"><i class="fas fa-heart"></i>
    <span>(<?= $total_wl_prds; ?>)</span></a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i>
    <span>(<?= $total_cart_prds; ?>)</span></a>
    <div id="user-btn" class="fas fa-user"></div>
</div>
<div class="profil">
    <?php 
        $slct_profil = $conn->prepare("SELECT * FROM `clients` WHERE IdClt = ?");
        $slct_profil->execute([$Clt_Id]);
        if($slct_profil->rowCount() > 0){
            $fetch_profil = $slct_profil->fetch(PDO::FETCH_ASSOC);   
    ?>
    <p><?= $fetch_profil['NomClt']; ?></p>
    <p><?= $fetch_profil['PrenomClt']; ?></p>
    <div class="felx-btn">
        <a href="mdfclt.php" class="option-btn">Modifier profil</a>
        <a href="mdfpsclt.php" class="option-btn">Modifier mot de passe</a>
    </div>    
    <a href="commands.php" class="btn">Commandes</a>
    <a href="autres/clt_deconex.php" onclick="return confirm
    ('Voulez-vous déconnecter?')" class="delete-btn">Déconnexion</a>
    <?php
        }else{       
    ?>
    <p>Connecter-vous s'il vous plaît</p>
    <div class="felx-btn">
        <a href="login.php" class="btn">Connexion</a>
        <a href="signup.php" class="option-btn">Créer un compte</a>
    </div>
    <?php
        }
    ?>

</section>    

</header>