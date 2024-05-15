<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}

if(isset($_GET['delete'])){
    $sprm_clt = $_GET['delete'];
    $sprm_cltcompt = $conn->prepare("DELETE FROM `clients` WHERE IdClt = ?");
    $sprm_cltcompt->execute([$sprm_clt]);
    $sprm_com = $conn->prepare("DELETE FROM `commandes` WHERE CodeCmd = ?");
    $sprm_com->execute([$sprm_clt]);
    header('location:clients.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>

<section class="Compts">
    <div class="box_container">
        <?php 
            $slct_cltcomp = $conn->prepare("SELECT * FROM `clients`");
            $slct_cltcomp->execute();
            if($slct_cltcomp->rowCount() > 0){
                while($fetch_cltcomp = $slct_cltcomp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p>Client id : <span><?= $fetch_cltcomp['IdClt']; ?></span></p>
            <p>CIN : <span><?= $fetch_cltcomp['CIN']; ?></span></p>
            <p>Nom : <span><?= $fetch_cltcomp['NomClt']; ?></span></p>
            <p>Prenom : <span><?= $fetch_cltcomp['PrenomClt']; ?></span></p>
            <p>Téléphone : <span><?= $fetch_cltcomp['TelClt']; ?></span></p>
            <a href="clients.php?delete=<?= $fetch_cltcomp['IdClt']; ?>" 
            class="delete-btn" onclick="return confirm('Voulez-vous supprimer ce client?');">Supprimer</a>
        </div>
        <?php 
                }
            }else{
                echo '<p class="vide">Aucun client compte pour afficher</p>';
            }
        ?>
    </div>
</section>
































<script src = "../script/admin_script.js"></script>
</body>
</html>