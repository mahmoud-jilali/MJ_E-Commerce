<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['AjtCtg'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $slct_ctg = $conn->prepare("SELECT * FROM `categories` WHERE LebCtg = ?");
    $slct_ctg->execute([$name]);
    
    if($slct_ctg->rowCount() > 0){
        $msg[] = 'Catégorie existe déja';
    }else{
            $ajtprd = $conn->prepare("INSERT INTO `categories` (LebCtg) VALUES(?)");
            $ajtprd->execute([$name]);
            $msgv[] = 'Nouveau catégorie a été ajouté';
        }
}
if(isset($_GET['delete'])){
    $sprm_id = $_GET['delete'];
    $sprm_ctg = $conn->prepare("DELETE FROM `categories` WHERE CodeCtg = ?");
    $sprm_ctg->execute([$sprm_id]);
    header('location:categories.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>

<section class="AjtCtgSection">
    <form action="" method="POST">
        <h3>Ajouter un catégorie</h3>
        <div class="flex">
            <div class="InputBox">
                <span>Nom catégorie :</span>
                <input type="text" required placeholder="Nom catégories" name="name" class="box">
            </div>
            <input type="submit" value="Ajouter" name="AjtCtg" class="option-btn">
        </div>
    </form>
</section>

<section class="Afch_Ctgs">
    <div class="box_container">
        <?php 
            $afch_prds = $conn->prepare("SELECT * FROM `categories` ");
            $afch_prds->execute();
            if($afch_prds->rowCount() > 0){
                while($fetch_prds = $afch_prds->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <div class="nom"><p><span>Id catégorie : </span><?= $fetch_prds['CodeCtg'];?></p></div>
            <div class="nom"><p><span>Nom catégorie : </span><?= $fetch_prds['LebCtg'];?></p></div>
            <div class="FlexBtn">
                <a href="mdf_ctg.php?update=<?= $fetch_prds['CodeCtg'];?>" 
                class="option-btn">Modifier</a>
                <a href="categories.php?delete=<?= $fetch_prds['CodeCtg'];?>" 
                class="delete-btn" onclick="return confirm('Voulez-vous supprimer cette catégories?');">Supprimer</a>
            </div>
        </div>
        <?php
                }
        }else{
            echo '<p class="vide"> aucun produit ajouter</p>';
        }
        ?>
    </div>
</section>





























<script src = "../script/admin_script.js"></script>
</body>
</html>