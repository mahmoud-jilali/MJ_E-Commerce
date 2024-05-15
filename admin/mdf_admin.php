<?php 
include '../autres/bd_conn.php';
session_start();
$adm_id = $_SESSION['admin_id'];
if(!isset($adm_id)){
    header('location: admin_conex.php');
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $mdf_nom = $conn->prepare("UPDATE `admintbl` SET username = ? WHERE Id = ?");
    $mdf_nom->execute([$name, $adm_id]);
    $pass_vide = '';
    $sltc_ancien_pass = $conn->prepare("SELECT password FROM `admintbl` WHERE Id = ?");
    $sltc_ancien_pass->execute([$adm_id]);
    $fetch_anc_pass = $sltc_ancien_pass->fetch(PDO::FETCH_ASSOC);
    $anc_pass = $fetch_anc_pass['password'];
    $ancien_pass = sha1($_POST['oldpass']);
    $ancien_pass = filter_var($ancien_pass, FILTER_SANITIZE_STRING); 
    $nv_pass = sha1($_POST['nvpass']);
    $nv_pass = filter_var($nv_pass, FILTER_SANITIZE_STRING);
    $c_nv_pass = sha1($_POST['cfrmpass']);
    $c_nv_pass = filter_var($c_nv_pass, FILTER_SANITIZE_STRING);
    if($ancien_pass == $pass_vide){
        $msg[] = 'Entrer ancien mots de passe';
    }elseif($ancien_pass != $anc_pass){
        $msg[] = 'Vérifier votre mots de passe';
    }elseif($nv_pass != $c_nv_pass){
        $msg[] = 'Vérifier votre nouveau mots de passe';
    }else{
        if($nv_pass != $pass_vide){
            $mdf_pass = $conn->prepare("UPDATE `admintbl` SET password = ? WHERE Id= ?");
            $mdf_pass->execute([$c_nv_pass, $adm_id]);
            $msgv [] = 'Mots de passe est modifier';
        }else{
            $msg[] = 'Entrer nouveau mots de passe';
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
    <title>Modifier un administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>

    <section class="form-container">
            <form action="" method="POST">
                <h3>Modifier admin compte</h3><br><br>
                <input type="text" name="name" required placeholder="Utilisateur" class="box" value="<?= $fetch_profil['nom']?>"><br><br>
                <input type="password" name="oldpass" required placeholder="Mots de passe" class="box"><br><br>
                <input type="password" name="nvpass" required placeholder="Nouveau mots de passe" class="box"><br><br>
                <input type="password" name="cfrmpass" required placeholder="Confirmer nouveau mots de passe" class="box"><br><br>
                <input type="submit" value="Enregistrer" name="submit" class="option-btn">
            </form>
    </section>

































<script src = "../script/admin_script.js"></script>
</body>
</html>