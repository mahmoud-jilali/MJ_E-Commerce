<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['AjtPrd'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $Qte = $_POST['Qte'];
    $Qte = filter_var($Qte, FILTER_SANITIZE_STRING);
    $prix = $_POST['prix'];
    $prix = filter_var($prix, FILTER_SANITIZE_STRING);

    $img1 = $_FILES['img_1']['name'];
    $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
    $img1_size = $_FILES['img_1']['size'];
    $img1_tmp_nom = $_FILES['img_1']['tmp_name'];
    $img1_size = $_FILES['img_1']['size'];
    $img1_dossier = '../Ajt_Imgs/'.$img1;
    
    $img2 = $_FILES['img_2']['name'];
    $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
    $img2_size = $_FILES['img_2']['size'];
    $img2_tmp_nom = $_FILES['img_2']['tmp_name'];
    $img2_size = $_FILES['img_2']['size'];
    $img2_dossier = '../Ajt_Imgs/'.$img2;

    $img3 = $_FILES['img_3']['name'];
    $img3 = filter_var($img3, FILTER_SANITIZE_STRING);
    $img3_size = $_FILES['img_3']['size'];
    $img3_tmp_nom = $_FILES['img_3']['tmp_name'];
    $img3_size = $_FILES['img_3']['size'];
    $img3_dossier = '../Ajt_Imgs/'.$img3;
    
    $categ = $_POST['Ctg'];
    $categ = filter_var($categ, FILTER_SANITIZE_STRING);
    $descri = $_POST['Descri'];
    $descri = filter_var($descri, FILTER_SANITIZE_STRING);

    $slct_prd = $conn->prepare("SELECT * FROM `produits` WHERE NomPrd = ?");
    $slct_prd->execute([$name]);
    
    if($slct_prd->rowCount() > 0){
        $msg[] = 'Produit existe déja';
    }else{
        if($img1_size > 2000000 OR $img2_size > 2000000 OR $img3_size > 2000000){
            $msg[] = "La taille de l'image est très large";
        }else{
            move_uploaded_file($img1_tmp_nom, $img1_dossier);
            move_uploaded_file($img2_tmp_nom, $img2_dossier);
            move_uploaded_file($img3_tmp_nom, $img3_dossier);

            $ajtprd = $conn->prepare("INSERT INTO `produits` (NomPrd, QtePrd, Prix, 
            Image_1, Image_2, Image_3, CodeCtg, Description) VALUES(?,?,?,?,?,?,?,?)");
            $ajtprd->execute([$name, $Qte, $prix, $img1, $img2, $img3, $categ, $descri]);
            $msgv[] = 'Nouveau produit a été ajouté';
        }
    }
}
if(isset($_GET['delete'])){
    $sprm_id = $_GET['delete'];
    $sprm_prd_img = $conn->prepare("SELECT * FROM `produits` WHERE RefPrd = ?");
    $sprm_prd_img->execute([$sprm_id]);
    $fetch_sprm_img = $sprm_prd_img->fetch(PDO::FETCH_ASSOC);
    unlink('../Ajt_Imgs/'.$fetch_sprm_img['Image_1']);
    unlink('../Ajt_Imgs/'.$fetch_sprm_img['Image_2']);
    unlink('../Ajt_Imgs/'.$fetch_sprm_img['Image_3']);
    $sprm_prd = $conn->prepare("DELETE FROM `produits` WHERE RefPrd = ?");
    $sprm_prd->execute([$sprm_id]);
    header('location:produits.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>

<section class="AjtPrdSection">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Ajouter un produit</h3>
        <div class="flex">
            <div class="InputBox">
                <span>Nom produit :</span>
                <input type="text" required placeholder="Nom produit" name="name" class="box">
            </div>
            <div class="InputBox">
                <span>Quantité :</span>
                <input type="number" required name="Qte" class="box">
            </div>          
            <div class="InputBox">
                <span>Prix :</span>
                <input type="number" required min="0" max="9999999" name="prix" 
                onkeypress="if(this.value.lenght == 10) return false;" class="box">
            </div>
            <div class="InputBox">
                <span>Image :</span>
                <input type="file" name="img_1" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" required>
            </div>
            <div class="InputBox">
                <span>Image :</span>
                <input type="file" name="img_2" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" required>
            </div>
            <div class="InputBox">
                <span>Image :</span>
                <input type="file" name="img_3" class="box" accept="image/jpg, image/jpeg,
                image/png, image/webp" required>
            </div>
            <div class="InputBox">
                <span>Categorie</span>
                <input type="number" name="Ctg" class="box">
            </div>
            <div class="InputBox">
                <span>Description :</span>
                <textarea name="Descri" class="box" placeholder="Description" required 
                maxlength="500" cols="35" rows="15"></textarea>
            </div>
            <input type="submit" value="Ajouter" name="AjtPrd" class="option-btn">
        </div>
    </form>
</section>

<section class="Afch_Prds">
    <div class="box_container">
        <?php 
            $afch_prds = $conn->prepare("SELECT * FROM `produits` ");
            $afch_prds->execute();
            if($afch_prds->rowCount() > 0){
                while($fetch_prds = $afch_prds->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <img src="../Ajt_Imgs/<?= $fetch_prds['Image_1'];?>">
            <div class="nom"><p><span>Nom : </span><?= $fetch_prds['NomPrd'];?></p></div>
            <div class="Qte"><p><span>Quantité : </span><?= $fetch_prds['QtePrd'];?></p></div>
            <div class="Prix"><p><span>Prix : </span><?= $fetch_prds['Prix'];?> MAD</p></div>
            <div class="CodeCtg"><p><span>Categorie : </span><?= $fetch_prds['CodeCtg'];?></p></div>
            <div class="Decri"><p><span>Description : </span><br><?= $fetch_prds['Description'];?></p></div>
            <div class="FlexBtn">
                <a href="mdf_prd.php?update=<?= $fetch_prds['RefPrd'];?>" 
                class="option-btn">Modifier</a>
                <a href="produits.php?delete=<?= $fetch_prds['RefPrd'];?>" 
                class="delete-btn" onclick="return confirm('Voulez-vous supprimer ce produit?');">Supprimer</a>
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