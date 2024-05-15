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
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $nom = $_POST['nom'];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);

    $select_adm = $conn->prepare("SELECT * FROM `admintbl` WHERE username = ? ");
    $select_adm->execute([$name]);
    

    if($select_adm->rowCount() > 0){
        $msg[] = 'Utilisateur existe déja';
    }else{
        if($pass != $cpass){
            $msg[] = 'Entrer le même mots de passe';
        }
        else{
            $Ajt_admin = $conn -> prepare("INSERT INTO `admintbl`(username, password, nom)
            VALUES(?,?,?)");
            $Ajt_admin->execute([$name, $cpass, $nom]);
            $msgv[] = 'Nouveau admin a été ajouter';
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
    <title>Ajouter un administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>
<?php 
include '../autres/adm_header.php';
?>

    <section class="form-container">
            <form action="" method="POST">
                <h3>Ajouter un admin</h3><br><br>
                <input type="text" name="name" required placeholder="Utilisateur" class="box"><br><br>
                <input type="password" name="pass" required placeholder="Mots de passe" class="box"><br><br>
                <input type="password" name="cpass" required placeholder="Confirmer Mots de passe" class="box"><br><br>
                <input type="text" name="nom" required placeholder="Nom" class="box"><br><br>
                <input type="submit" value="Ajouter" name="submit" class="btn">
            </form>
    </section>

































<script src = "../script/admin_script.js"></script>
</body>
</html>