<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['MdfPrd'])){
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $Qte = $_POST['Qte'];
    $Qte = filter_var($Qte, FILTER_SANITIZE_STRING);
    $prix = $_POST['prix'];
    $prix = filter_var($prix, FILTER_SANITIZE_STRING);
    $CodeCtg = $_POST['Ctg'];
    $CodeCtg = filter_var($CodeCtg, FILTER_SANITIZE_STRING);
    $Descri = $_POST['Descri'];
    $Descri = filter_var($Descri, FILTER_SANITIZE_STRING);

    $mdf_prd = $conn->prepare("UPDATE `produits` SET NomPrd = ?, QtePrd = ?,
    Prix = ?, CodeCtg = ?, Description = ? WHERE RefPrd = ?");
    $mdf_prd->execute([$name, $Qte, $prix, $CodeCtg, $Descri, $pid]);

    $msgv[] = 'Produit a été modifier';

    $old_img_1 = $_POST['old_img_1'];
    $img1 = $_FILES['img_1']['name'];
    $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
    $img1_size = $_FILES['img_1']['size'];
    $img1_tmp_nom = $_FILES['img_1']['tmp_name'];
    $img1_size = $_FILES['img_1']['size'];
    $img1_dossier = '../Ajt_Imgs/'.$img1;

    if(!empty($img1)){
        if($img1_size > 2000000){
            $msg[] = "La taille de l'image est très large";
        }else{
            $mdf_img_1 = $conn->prepare("UPDATE `produits` SET Image_1 = ? WHERE RefPrd = ?");
            $mdf_img_1->execute([$img1, $pid]);
            move_uploaded_file($img1_tmp_nom, $img1_dossier);
            unlink('../Ajt_Imgs/'.$old_img_1);
            $msgv[] = 'Image a été modifier';
        }
    }

    $old_img_2 = $_POST['old_img_2'];
    $img2 = $_FILES['img_2']['name'];
    $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
    $img2_size = $_FILES['img_2']['size'];
    $img2_tmp_nom = $_FILES['img_2']['tmp_name'];
    $img2_size = $_FILES['img_2']['size'];
    $img2_dossier = '../Ajt_Imgs/'.$img2;

    if(!empty($img2)){
        if($img2_size > 2000000){
            $msg[] = "La taille de l'image est très large";
        }else{
            $mdf_img_2 = $conn->prepare("UPDATE `produits` SET Image_2 = ? WHERE RefPrd = ?");
            $mdf_img_2->execute([$img2, $pid]);
            move_uploaded_file($img2_tmp_nom, $img2_dossier);
            unlink('../Ajt_Imgs/'.$old_img_2);
            $msgv[] = 'Image a été modifier';
        }
    }

    $old_img_3 = $_POST['old_img_3'];
    $img3 = $_FILES['img_3']['name'];
    $img3 = filter_var($img3, FILTER_SANITIZE_STRING);
    $img3_size = $_FILES['img_3']['size'];
    $img3_tmp_nom = $_FILES['img_3']['tmp_name'];
    $img3_size = $_FILES['img_3']['size'];
    $img3_dossier = '../Ajt_Imgs/'.$img3;

    if(!empty($img3)){
        if($img3_size > 2000000){
            $msg[] = "La taille de l'image est très large";
        }else{
            $mdf_img_3 = $conn->prepare("UPDATE `produits` SET Image_3 = ? WHERE RefPrd = ?");
            $mdf_img_3->execute([$img3, $pid]);
            move_uploaded_file($img3_tmp_nom, $img3_dossier);
            unlink('../Ajt_Imgs/'.$old_img_3);
            $msgv[] = 'Image a été modifier';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="MdfPrd">
        <?php 
            $mdf_ref = $_GET['update'];
            $afch_prds = $conn->prepare("SELECT * FROM `produits` WHERE RefPrd = ?");
            $afch_prds->execute([$mdf_ref]);
            if($afch_prds->rowCount() > 0){
                while($fetch_prds = $afch_prds->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?=$fetch_prds['RefPrd'] ?>">
            <input type="hidden" name="old_img_1" value="<?=$fetch_prds['Image_1'] ?>">
            <input type="hidden" name="old_img_2" value="<?=$fetch_prds['Image_2'] ?>">
            <input type="hidden" name="old_img_3" value="<?=$fetch_prds['Image_3'] ?>">
        <h3>Modifier le produit</h3>
            <div class="ImgContainer">
                <div class="MainImg">
                    <img src="../Ajt_Imgs/<?=$fetch_prds['Image_1'] ?>" alt="">
                </div>
                <div class="SubImgs">
                <img src="../Ajt_Imgs/<?= $fetch_prds['Image_1'] ?>" alt="">
                <img src="../Ajt_Imgs/<?= $fetch_prds['Image_2'] ?>" alt="">
                <img src="../Ajt_Imgs/<?= $fetch_prds['Image_3'] ?>" alt="">
                </div>
            </div>
                <span>Nom produit :</span>
                <input type="text" required placeholder="Nom produit" 
                name="name" class="box" value="<?= $fetch_prds['NomPrd'] ?>">
                <span>Quantité :</span>
                <input type="number" required name="Qte" class="box" value="<?= $fetch_prds['QtePrd'] ?>">
                <span>Prix :</span>
                <input type="number" required min="0" max="9999999" name="prix" 
                onkeypress="if(this.value.lenght == 10) return false;" class="box" value="<?= $fetch_prds['Prix'] ?>">
                <span>Image :</span>
                <input type="file" name="img_1" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" >
                <span>Image :</span>
                <input type="file" name="img_2" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" >
                <span>Image :</span>
                <input type="file" name="img_3" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" >
                <span>Categorie :</span>
                <input type="number" name="Ctg" class="box" value="<?= $fetch_prds['CodeCtg'] ?>">
                <span>Description :</span>
                <textarea name="Descri" class="box" placeholder="Description" required 
                maxlength="500" cols="35" rows="15"><?= $fetch_prds['Description'] ?></textarea>
                <div class="felx-btn">
                    <input type="submit" value="Modifier" name="MdfPrd" class="option-btn">
                    <a href="produits.php" class="btn">Annuler</a>
                </div>
        </form>
        <?php
                }
        }else{
            echo '<p class="vide"> aucun produit ajouter</p>';
        }
        ?>
</section>

































<script src = "../script/admin_script.js"></script>
</body>
</html>