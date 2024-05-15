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

<a href="admin_page.php" class="logo">Admini<span>Stration</span></a>

<nav class="navbar">
    <a href="admin_page.php">Accueil</a>
    <a href="admin_compt.php">Admins</a>
    <a href="categories.php">Catégories</a>
    <a href="clients.php">Clients</a>
    <a href="commandes.php">Commandes</a>
    <a href="msgs.php">Messages</a>
    <a href="produits.php">Produits</a>
    <a href="../accueil.php">SiteWeb</a>
</nav>

<div class="icons">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div id="user-btn" class="fas fa-user"></div>
</div>
<div class="profil">
    <?php 
        $slct_profil = $conn->prepare("SELECT * FROM `admintbl` WHERE Id = ?");
        $slct_profil->execute([$adm_id]);
        $fetch_profil = $slct_profil->fetch(PDO::FETCH_ASSOC);
    ?>
    <p><?= $fetch_profil['nom']; ?></p>
    <a href="mdf_admin.php" class="btn">Modifier</a>
    <div class="felx-btn">
        <a href="admin_conex.php" class="option-btn">Connexion</a>
        <a href="ajt_adm.php" class="option-btn">Ajouter</a>
    </div>
    <a href="../autres/adm_deconex.php" onclick="return confirm
    ('Voulez-vous déconnecter?')" class="delete-btn">Déconnexion</a>
</div>

</section>    

</header>