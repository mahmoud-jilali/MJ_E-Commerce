<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
    header('location: login.php');
}
include 'autres/fav.php';
if(isset($_POST['sprm_panier'])){
    $wl_id = $_POST['wl_id'];
    $sprm_wl = $conn->prepare("DELETE FROM `wishlist`
    WHERE Id = ?");
    $sprm_wl->execute([$wl_id]);
    $msgv[] = 'Le produit a été supprimé.';
}
if(isset($_GET['supprimer_tous'])){
    //$sprm_tous = $_GET['supprimer_tous'];
    $sprm_tous_wl = $conn->prepare("DELETE FROM `wishlist`
    WHERE IdClt = ?");
    $sprm_tous_wl->execute([$Clt_Id]);
    header('location : wishlist.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="ctg_prd">


    <div class="box-container">
        <?php 
            $total_wl = 0;
            $slct_wishlist = $conn->prepare("SELECT * FROM `wishlist` 
            WHERE IdClt = ?");
            $slct_wishlist->execute([$Clt_Id]);
            if($slct_wishlist->rowCount() > 0){
                while($fetch_wishlist = $slct_wishlist->fetch(PDO::FETCH_ASSOC)){
                    $total_wl += $fetch_wishlist['Prix'];
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="refprd" value="<?= $fetch_wishlist['RefPrd']; ?>">
            <input type="hidden" name="nom" value="<?= $fetch_wishlist['NomPrd']; ?>">
            <input type="hidden" name="prix" value="<?= $fetch_wishlist['Prix']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_wishlist['Image']; ?>">
            <input type="hidden" name="wl_id" value="<?= $fetch_wishlist['Id']; ?>">
            <a href="view.php?refprd=<?= $fetch_wishlist['RefPrd']; ?>" class="fas fa-eye"></a>
            <img src="Ajt_Imgs/<?= $fetch_wishlist['Image']; ?>" class="img" alt="">
            <div class="nom"><?= $fetch_wishlist['NomPrd']; ?></div>
            <div class="flex">
                <span>Quantité :</span><input type="number" name="qte" class="qte" min="1" max="100" 
                value="1" onkeypress="if(this.value.lenght == 2) return false;">
                <div class="prix"><?= $fetch_wishlist['Prix'] ;?><span> MAD</span></div>
            </div>
            <input type="submit" value="Ajouter au panier" name="ajt_panier" class="btn">
            <input type="submit" value="Supprimer" onclick="return confirm('Voulez-vous supprimer ce produit?');"
            name="sprm_panier" class="delete-btn">                  
        </form>
        <?php 
               }
            }else{
                echo '<p class="vide">Votre liste de souhaits est vide</p>';
            }
        ?>
    </div>
    <div class="wishlist_total">
        <p> Total : <span><?= $total_wl;?> MAD</span></p>
        <a href="produits.php" class="btn">Continuer</a>
        <a href="wishlist.php?supprimer_tous" class="delete-btn <?= ($total_wl > 1)
        ?'':"disabled";?>" onclick="return confirm
        ('Voulez-vous supprimer tous les produit?');">Supprimer tous</a>
    </div>                   
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>