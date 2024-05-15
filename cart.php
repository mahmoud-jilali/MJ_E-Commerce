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
    $cart_id = $_POST['cart_id'];
    $sprm_cart = $conn->prepare("DELETE FROM `cart`
    WHERE Id = ?");
    $sprm_cart->execute([$cart_id]);
    $msgv[] = 'Le produit a été supprimé.';
}
if(isset($_GET['supprimer_tous'])){
    //$sprm_tous = $_GET['supprimer_tous'];
    $sprm_tous_cart = $conn->prepare("DELETE FROM `cart`
    WHERE IdClt = ?");
    $sprm_tous_cart->execute([$Clt_Id]);
    header('location : cart.php');
}
if(isset($_POST['mdf_qte'])){
    $cart_id = $_POST['cart_id'];
    $Qte = $_POST['qte'];
    $mdf_qte = $conn->prepare("UPDATE `cart` SET Qte = ?
    WHERE Id = ?");
    $mdf_qte->execute([$Qte, $cart_id]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="ctg_prd">


    <div class="box-container">
        <?php 
            $total_p = 0;
            $slct_cart = $conn->prepare("SELECT * FROM `cart` 
            WHERE IdClt = ?");
            $slct_cart->execute([$Clt_Id]);
            if($slct_cart->rowCount() > 0){
                while($fetch_cart = $slct_cart->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['Id'];?>">
            <a href="view.php?refprd=<?= $fetch_cart['RefPrd'];?>" class="fas fa-eye"></a>
            <img src="Ajt_Imgs/<?= $fetch_cart['Image']; ?>" class="img" alt="">
            <div class="nom"><?= $fetch_cart['NomPrd'];?></div>
            <div class="flex">
                <span>Quantité :</span><input type="number" name="qte" class="qte" min="1" max="100" 
                value="1" onkeypress="if(this.value.lenght == 2) return false;">
                <div class="prix"><?= $fetch_cart['Prix'];?><span> MAD</span></div>
                <button type="submit" class="fas fa-edit" name="mdf_qte"></button>
            </div>
            <div class="total-paiment">Total à payer : 
                <span><?= $total_payer = ($fetch_cart['Prix'] * $fetch_cart['Qte']); ?> MAD</span>
            </div>
            <input type="submit" value="Supprimer" onclick="return confirm('Voulez-vous supprimer ce produit?');"
            name="sprm_panier" class="delete-btn">                  
        </form>
        <?php 
                $total_p += $total_payer;
               }
            }else{
                echo '<p class="vide">Votre panier est vide</p>';
            }
        ?>
    </div>
    <div class="cart_total">
        <p> Total : <span><?= $total_p;?> MAD</span></p>
        <a href="produits.php" class="btn">Continuer</a>
        <a href="cart.php?supprimer_tous" class="delete-btn <?= ($total_p > 1)
        ?'':"disabled";?>" onclick="return confirm
        ('Voulez-vous supprimer tous les produit?');">Supprimer tous</a>
        <a href="checkout.php" class="option-btn <?= ($total_p > 1)
        ?'':"disabled";?>">Valider la commande</a>
    </div>                   
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>