<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_GET['delete'])){
    $sprm_adm = $_GET['delete'];
    $sprm_acompt = $conn->prepare("DELETE FROM `admintbl` WHERE Id = ?");
    $sprm_acompt->execute([$sprm_adm]);
    header('location:admin_compt.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur comptes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="Compts">
    <div class="box_container">
        <div class="box">
            <p>Ajouter Nouveau admin compte</p>
            <a href="ajt_adm.php" class="option-btn">Ajouter</a>
        </div>
        <?php 
            $slct_acomp = $conn->prepare("SELECT * FROM `admintbl`");
            $slct_acomp->execute();
            if($slct_acomp->rowCount() > 0){
                while($fetch_acomp = $slct_acomp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p><span>Admin Id : </span><?= $fetch_acomp['Id']; ?></p>
            <p><span>Nom : </span><?= $fetch_acomp['username']; ?></p>
            <div class="felx-btn">
                <a href="admin_compt.php?delete=<?= $fetch_acomp['Id']; ?>" 
                 class="delete-btn" onclick="return confirm('Voulez-vous supprimer cette admin compte?');">Supprimer</a>
                 
                 <?php 
                    if($fetch_acomp['Id'] == $adm_id){
                        echo '<a href="mdf_admin.php" class="option-btn">Modifier</a>';
                    }
                 ?>
            </div>
        </div>
        <?php 
                }
            }else{
                echo '<p class="vide">Aucun compte pour afficher</p>';
            }
        ?>
    </div>
</section>
































<script src = "../script/admin_script.js"></script>
</body>
</html>