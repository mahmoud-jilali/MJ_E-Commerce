<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['MdfBtn'])){
    $codecom = $_POST['CodeCom'];
    $paiment = $_POST['payment'];
    $paiment = filter_var($paiment, FILTER_SANITIZE_STRING);
    $mdf_paiment = $conn->prepare("UPDATE `commandes` SET paiement = ? 
    WHERE CodeCmd = ?");
    $mdf_paiment->execute([$paiment, $codecom]);
    $msgv [] = 'Paiment a été modifier';
    }

    if(isset($_GET['delete'])){
        $sprm_cmd = $_GET['delete'];
        $sprm_com = $conn->prepare("DELETE FROM `commandes` WHERE CodeCmd = ?");
        $sprm_com->execute([$sprm_cmd]);
        header('location:commandes.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="commands">
    <div class="box_container">
        <?php 
            $slct_com = $conn->prepare("SELECT * FROM `commandes`");
            $slct_com->execute();
            if($slct_com->rowCount() > 0){
                while($fetch_com = $slct_com->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p>Code Command : <span><?= $fetch_com['CodeCmd']; ?></span></p>
            <p>Id Client : <span><?= $fetch_com['IdClt']; ?></span></p>
            <p>Nom : <span><?= $fetch_com['NomClt']; ?></span></p>
            <p>Téléphone : <span><?= $fetch_com['TelClt']; ?></span></p>
            <p>Email : <span><?= $fetch_com['EmailClt']; ?></span></p>
            <p>Adresse : <span><?= $fetch_com['AdrssClt']; ?></span></p>
            <p>Date Commande : <span><?= $fetch_com['DateCmd']; ?></span></p>
            <p>Total des produits : <span><?= $fetch_com['TotalPrds']; ?></span></p>
            <p>Prix Total : <span><?= $fetch_com['PrixTotal']; ?> MAD</span></p>
            <p>Methode du Paiment : <span><?= $fetch_com['mode_paiement']; ?></span></p>
            <form action="" method="POST">
            <p>Paiment : <span><?= $fetch_com['paiement']; ?></span></p>
                <input type="hidden" name="CodeCom" value="<?= $fetch_com['CodeCmd']; ?>">
                <select name="payment" class="drop-down">
                <option selected disabled><?= $fetch_com['paiement']; ?></option>
                    <option value="Non">Non</option>
                    <option value="Oui">Oui</option>
                </select>
            <div class="felx-btn">
                <input type="submit" value="Modifier" class="option-btn" name="MdfBtn">
                <a href="commandes.php?delete=<?= $fetch_com['CodeCmd']; ?>" 
                class="delete-btn" onclick="return confirm('Voulez-vous supprimer cette command?');">Supprimer</a>
            </div>
            </form>
        </div>
        <?php 
                }
            }else{
                echo '<p class="vide">Aucun commande pour afficher</p>';
            }  
        ?>
    </div>
</section>

































<script src = "../script/admin_script.js"></script>
</body>
</html>