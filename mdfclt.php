<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
    header('location: accueil.php');
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

    $mdf_profil = $conn->prepare("UPDATE `clients` SET CIN = ?, NomClt = ?, PrenomClt = ?,
    AdresseClt = ?, TelClt = ?, EmailClt = ?
    WHERE IdClt = ?");
    $mdf_profil->execute([$cin, $nom, $prenom, $adrss, $tel, $email, $Clt_Id]);
    $msgv[] = 'Votre informations a été modifié.'; 

    // $pass_vide = '';
    // $slct_ancpass = $conn->prepare("SELECT Motdepasse FROM `clients` WHERE IdClt = ?");
    // $slct_ancpass->execute([$Clt_Id]);
    // $fetch_ancpass = $slct_ancpass->fetch(PDO::FETCH_ASSOC);
    // $ancpass = $fetch_ancpass['Motdepasse'];
    // $anc_pass = sha1($_POST['ancpass']);
    // $anc_pass = filter_var($anc_pass, FILTER_SANITIZE_STRING);
    // $nv_pass = sha1($_POST['nvpass']);
    // $nv_pass = filter_var($nv_pass, FILTER_SANITIZE_STRING);
    // $cnv_pass = sha1($_POST['cnvpass']);
    // $cnv_pass = filter_var($cnv_pass, FILTER_SANITIZE_STRING);

    // if($anc_pass == $pass_vide){
    //     $msg[] = 'Entrer votre mot de passe.';
    // }elseif($anc_pass != $ancpass){
    //     $msg[] = 'Vérifier votre mot de passe.';
    // }elseif($nv_pass != $cnv_pass){
    //     $msg[] = 'Confirmer votre mot de passe.';
    // }else{
    //     if($nv_pass != $pass_vide){
    //         $mdf_pass = $conn->prepare("UPDATE `clients` SET Motdepasse = ?
    //         WHERE IdClt = ?");
    //         $mdf_pass->execute([$cnv_pass, $Clt_Id]);
    //         $msgv[] = 'Votre mots de passe a été modifié.';       
    //     }else{
    //         $msg[] = 'Entrer nouveau mot de passe.';
    //     }
    // }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="form-container">
    <form action="" method="post">
        <h1>Modifier votre compte</h1>
        <input type="text" required name="cin" placeholder="Entrer votre CIN" 
        class="box" value="<?= $fetch_profil['CIN']; ?>">
        <input type="text" required name="nom" placeholder="Entrer votre nom" 
        class="box" value="<?= $fetch_profil['NomClt']; ?>">
        <input type="text" required name="prenom" placeholder="Entrer votre prenom" 
        class="box" value="<?= $fetch_profil['PrenomClt']; ?>">
        <input type="text" required name="adrss" placeholder="Entrer votre adresse" 
        class="box" value="<?= $fetch_profil['AdresseClt']; ?>">
        <input type="text" required name="tel" placeholder="Entrer votre téléphone" 
        class="box" value="<?= $fetch_profil['TelClt']; ?>">
        <input type="email" required name="email" placeholder="Entrer votre email" 
        class="box" value="<?= $fetch_profil['EmailClt'] ?>">
        <!-- <input type="password" name="ancpass" placeholder="Entrer votre mot de passe" 
        class="box">
        <input type="password" name="nvpass" placeholder="Entrer votre nouveau mot de passe" 
        class="box">
        <input type="password" name="cnvpass" placeholder="Confirmer votre nouveau mot de passe" 
        class="box"> -->
        <input type="submit" value="Enregistre" class="option-btn" name="submit">
    </form>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>