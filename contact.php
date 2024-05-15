<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
}
if(isset($_POST['envoyer'])){
    $nom = $_POST['nom'];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $tel = $_POST['tel'];
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $c_msg = $_POST['msg'];
    $c_msg = filter_var($c_msg, FILTER_SANITIZE_STRING);

    $slct_msg = $conn->prepare("SELECT * FROM `messages` WHERE Nom = ? AND TelClt = ?
    AND Email = ? AND Message = ?");
    $slct_msg->execute([$nom, $tel, $email, $c_msg]);
    if($slct_msg->rowCount() > 0){
        $msg[] = 'Message déjà envoyé';
    }else{
        $env_msg = $conn->prepare("INSERT INTO `messages` (Nom, TelClt, Email, message)
        VALUES(?,?,?,?)");
        $env_msg->execute([$nom, $tel, $email, $c_msg]);
        $msgv[] = 'Message envoyé';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="form-container">
    <form action="" method="post" class="box">
        <h1>Contactez-nous</h1>
        <input type="text" name="nom" required placeholder="Entrer votre nom" maxlength="65" class="box">
        <input type="text" name="tel" required placeholder="Entrer votre téléphone" maxlength="20" class="box">
        <input type="text" name="email" required placeholder="Entrer votre email" maxlength="65" class="box">
        <textarea name="msg" placeholder="Comment pouvons-nous vous aider?" required class="box" cols="35" rows="10"></textarea>
        <input type="submit" value="Envoyer" class="btn" name="envoyer">
    </form>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>