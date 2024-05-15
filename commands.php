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
    <title>Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>


<section class="afch_commandes">
    <h1>Votre commandes</h1>
    <div class="box-container">
        <?php
            $afch_commandes = $conn->prepare("SELECT * FROM `commandes`
            WHERE IdClt = ?");
            $afch_commandes->execute([$Clt_Id]);
            if($afch_commandes->rowCount() > 0){
                while($fetch_commandes = $afch_commandes->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p><span>Nom : </span><?= $fetch_commandes['NomClt'];?></p>
            <p><span>Téléphone : </span><?= $fetch_commandes['TelClt'];?></p>
            <p><span>Email : </span><?= $fetch_commandes['EmailClt'];?></p>
            <p><span>Adresse : </span><?= $fetch_commandes['AdrssClt'];?></p>
            <p><span>Date commande : </span><?= $fetch_commandes['DateCmd'];?></p>
            <p><span>Total des produits : </span><?= $fetch_commandes['TotalPrds'];?></p>
            <p><span>Prix total : </span><?= $fetch_commandes['PrixTotal'];?> MAD</p>
        </div>
        <?php    
                }
            }else{
                echo '<p class="vide">Aucun commande pour afficher</p>';
            }
        ?>
    </div>
</section>




















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>