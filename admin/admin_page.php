<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($msg)){
    foreach($msg as $msg){
        echo
            '<div class="msg">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="ATB">
    <div class="box">
        <h2>BIENVENUE</h2>
        <h3><?= $fetch_profil['nom'];?></h3>
        <a href="mdf_admin.php" class="btn">Modifier profil</a>
    </div>
    <div class="box">
        <?php
            $slct_adm = $conn->prepare("SELECT * FROM `admintbl`");
            $slct_adm->execute();
            $nbr_adm = $slct_adm->rowCount();
        ?>
        <h2>Administrateurs</h2>
        <h3><?= $nbr_adm; ?></h3>
        <a href="admin_compt.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php 
            $revenus = 0.00;
            $slct_revenus = $conn->prepare("SELECT * FROM `commandes` WHERE
            paiement = ?");
            $slct_revenus->execute(['Oui']);
            while($fetch_revenus = $slct_revenus->fetch(PDO::FETCH_ASSOC)){
                $revenus += $fetch_revenus['PrixTotal'];
            }
        ?>
        <h2>Revenus</h2>
        <h3><?= $revenus; ?><span> MAD</span></h3>
        <a href="commandes.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php 
            $pendings = 0.00;
            $slct_pendings = $conn->prepare("SELECT * FROM `commandes` WHERE
            paiement = ?");
            $slct_pendings->execute(['Non']);
            while($fetch_pendings = $slct_pendings->fetch(PDO::FETCH_ASSOC)){
                $pendings += $fetch_pendings['PrixTotal'];
            }
        ?>
        <h2>En attente paiement</h2>
        <h3><?= $pendings; ?><span> MAD</span></h3>
        <a href="commandes.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php
            $slct_cmd = $conn->prepare("SELECT * FROM `commandes`");
            $slct_cmd->execute();
            $nbr_cmd = $slct_cmd->rowCount();
        ?>
        <h2>Commandes</h2>
        <h3><?= $nbr_cmd; ?></h3>
        <a href="commandes.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php
            $slct_prd = $conn->prepare("SELECT * FROM `categories`");
            $slct_prd->execute();
            $nbr_prd = $slct_prd->rowCount();
        ?>
        <h2>Catégories</h2>
        <h3><?= $nbr_prd; ?></h3>
        <a href="categories.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php
            $slct_prd = $conn->prepare("SELECT * FROM `produits`");
            $slct_prd->execute();
            $nbr_prd = $slct_prd->rowCount();
        ?>
        <h2>Produits</h2>
        <h3><?= $nbr_prd; ?></h3>
        <a href="produits.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php
            $slct_clt = $conn->prepare("SELECT * FROM `clients`");
            $slct_clt->execute();
            $nbr_clt = $slct_clt->rowCount();
        ?>
        <h2>Clients</h2>
        <h3><?= $nbr_clt; ?></h3>
        <a href="clients.php" class="btn">Afficher</a>
    </div>
    <div class="box">
        <?php
            $slct_msg = $conn->prepare("SELECT * FROM `messages`");
            $slct_msg->execute();
            $nbr_msg = $slct_msg->rowCount();
        ?>
        <h2>Messages</h2>
        <h3><?= $nbr_msg; ?></h3>
        <a href="msgs.php" class="btn">Afficher</a>
    </div>
</section>
































<script src = "../script/admin_script.js"></script>
</body>
</html>