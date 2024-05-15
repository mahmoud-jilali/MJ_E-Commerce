<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}

if(isset($_GET['delete'])){
    $sprm_msg = $_GET['delete'];
    $sprm_msgs = $conn->prepare("DELETE FROM `messages` WHERE IdMsg = ?");
    $sprm_msgs->execute([$sprm_msg]);
    header('location:msgs.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>
<section class="msgs">
    <div class="box_container">
        <?php 
            $slct_msgs = $conn->prepare("SELECT * FROM `messages`");
            $slct_msgs->execute();
            if($slct_msgs->rowCount() > 0){
                while($fetch_msg = $slct_msgs->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p><span>Nom : </span><?=$fetch_msg['Nom'] ?></p>
            <p><span>Téléphone : </span><?=$fetch_msg['TelClt'] ?></p>
            <p><span>EMail : </span><?=$fetch_msg['Email'] ?></p>
            <p><span>Message : </span><?=$fetch_msg['Message'] ?></p>
            <a href="msgs.php?delete=<?= $fetch_msg['IdMsg']; ?>" 
            class="delete-btn" onclick="return confirm('Voulez-vous supprimer cette message?');">Supprimer</a>
        </div>
        <?php 
                }
            }else{
                echo '<p class="vide">Aucun message pour afficher</p>';
            }
        ?>
    </div>
</section>
































<script src = "../script/admin_script.js"></script>
</body>
</html>