<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['MdfCtg'])){
    $code = $_POST['Code'];
    $code = filter_var($code, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $mdf_ctg = $conn->prepare("UPDATE `categories` SET LebCtg = ? WHERE CodeCtg = ?");
    $mdf_ctg->execute([$name, $code]);

    $msgv[] = 'Catégories a été modifier';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un catégorie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="MdfCtg">
        <?php 
            $mdf_ref = $_GET['update'];
            $afch_ctg = $conn->prepare("SELECT * FROM `categories` WHERE CodeCtg = ?");
            $afch_ctg->execute([$mdf_ref]);
            if($afch_ctg->rowCount() > 0){
                while($fetch_ctg = $afch_ctg->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="POST">
        <input type="hidden" name="Code" value="<?=$fetch_ctg['CodeCtg'] ?>">
        <h3>Modifier le catégorie</h3>
            <span>Nom catégorie :</span>
            <input type="text" required placeholder="Nom catégorie" 
            name="name" class="box" value="<?= $fetch_ctg['LebCtg'] ?>">
            <div class="felx-btn">
                <input type="submit" value="Modifier" name="MdfCtg" class="option-btn">
                <a href="categories.php" class="btn">Annuler</a>
            </div>
        </form>
        <?php
                }
        }else{
            echo '<p class="vide"> aucun catégorie ajouter</p>';
        }
        ?>
</section>

































<script src = "../script/admin_script.js"></script>
</body>
</html>