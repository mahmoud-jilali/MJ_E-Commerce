<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $slct_clt = $conn->prepare("SELECT * FROM `clients` 
    WHERE EmailClt = ? AND Motdepasse = ?");
    $slct_clt->execute([$email, $pass]);
    $row = $slct_clt->fetch(PDO::FETCH_ASSOC);

    if($slct_clt->rowCount() > 0){
        $_SESSION['IdClt'] = $row['IdClt'];
        header('location:accueil.php');
    }else{
        $msg[] = 'Email ou mots de passe est incorrect!!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecter-Vous</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="form-container">
    <form action="" method="post">
        <h1>Connecter-vous</h1>
        <input type="email" required name="email" placeholder="Entrer votre email" 
        class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" required name="pass" placeholder="Entrer votre mot de passe" 
        class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="Connexion" class="btn" name="submit">
        <p>Vous n'avez pas un compte?</p>
        <a href="signup.php" class="option-btn">Créer votre compte</a>
    </form>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>