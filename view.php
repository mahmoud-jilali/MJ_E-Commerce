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
    <title>Produit infos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="view">
    <h1>Produit infos</h1>
<?php 
        $ref_prd = $_GET['refprd'];
        $slct_prd = $conn->prepare("SELECT * FROM `produits` WHERE 
        RefPrd = ?");
        $slct_prd->execute([$ref_prd]);
        if($slct_prd->rowCount() > 0){
            while($fetch_prd = $slct_prd->fetch(PDO::FETCH_ASSOC)){
?>
    <form action="" method="post" class="box">
        <input type="hidden" name="refprd" value="<?= $fetch_prd['RefPrd']; ?>">
        <input type="hidden" name="nomprd" value="<?= $fetch_prd['NomPrd']; ?>">
        <input type="hidden" name="qte" value="<?= $fetch_prd['QtePrd']; ?>">
        <input type="hidden" name="prix" value="<?= $fetch_prd['Prix']; ?>">
        <input type="hidden" name="img" value="<?= $fetch_prd['Image_1']; ?>">
        <div class="p-img">
            <div class="g-img">
                <img src="Ajt_Imgs/<?= $fetch_prd['Image_1'];?>" alt="">
            </div>
            <div class="pt-img">
                <img src="Ajt_Imgs/<?= $fetch_prd['Image_1'];?>" alt="">
                <img src="Ajt_Imgs/<?= $fetch_prd['Image_2'];?>" alt="">
                <img src="Ajt_Imgs/<?= $fetch_prd['Image_3'];?>" alt="">
            </div>
        </div>
        <!-- <button type="submit" name="ajt_fav" class="fas fa-heart"></button> -->
        <div class="content">
            <div class="nom"><?= $fetch_prd['NomPrd']; ?></div>
            <div class="flex">
                <span>Quantité :</span><input type="number" name="qte" class="qte" min="1" max="100" 
                value="1" onkeypress="if(this.value.lenght == 2) return false;">
                <div class="prix"><?= $fetch_prd['Prix']; ?><span> MAD</span></div>
            </div>
            <div class="description"><?= $fetch_prd['Description']; ?></div>
            <div class="felx-btn">
                <input type="submit" value="Ajouter au panier" name="ajt_panier" class="btn">
                <input type="submit" value="Ajouter au list de souhaits" name="ajt_fav" class="btn">
            </div>
        </div>            
    </form>
<?php 
    }
    }else{
        echo '<p class="vide">Aucun produit trouvé';
    }
?>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>