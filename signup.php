<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
}
if(isset($_POST['submit'])){
    $cin = $_POST['cin'];
    $cin = filter_var($cin, FILTER_SANITIZE_STRING);
    $nom = $_POST['nom'];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $prenom = $_POST['prenom'];
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
    $adrss = $_POST['adrss'];
    $adrss = filter_var($adrss, FILTER_SANITIZE_STRING);
    $tel = $_POST['tel'];
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $slct_clt = $conn->prepare("SELECT * FROM `clients` WHERE EmailClt = ?");
    $slct_clt->execute([$email]);
    $row = $slct_clt->fetch(PDO::FETCH_ASSOC);

    if($slct_clt->rowCount() > 0){
        $msg[] = 'Cet e-mail existe. Essaie un autre';
    }else{
        if($pass != $cpass){
            $msg[] = 'Confirmer votre mot de passe';
        }else{
        $ajt_clt = $conn->prepare("INSERT INTO `clients` 
        (CIN, NomClt, PrenomClt, AdresseClt, TelClt, EmailClt, Motdepasse)
        VALUES(?,?,?,?,?,?,?);");
        $ajt_clt->execute([$cin, $nom, $prenom, $adrss, $tel, $email, $cpass]);
        $msgv[] = 'Votre compte a été créé avec succès. Bienvenue';
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
    <title>Créer votre compte</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="form-container">
    <form action="" method="post">
        <h1>Créer votre compte</h1>
        <input type="text" required name="cin" placeholder="Entrer votre CIN" 
        class="box">
        <input type="text" required name="nom" placeholder="Entrer votre nom" 
        class="box">
        <input type="text" required name="prenom" placeholder="Entrer votre prénom" 
        class="box">
        <input type="text" required name="adrss" placeholder="Entrer votre adresse" 
        class="box">
        <input type="text" required name="tel" placeholder="Entrer votre téléphone" 
        class="box">
        <input type="email" required name="email" placeholder="Entrer votre email" 
        class="box">
        <input type="password" required name="pass" placeholder="Entrer votre mot de passe" 
        class="box">
        <input type="password" required name="cpass" placeholder="Confirmer votre mot de passe" 
        class="box">
        <input type="submit" value="Créer votre compte" class="option-btn" name="submit">
        <p>Vous avez déjà un compte?</p>
        <a href="login.php" class="btn">Connexion</a>
    </form>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>