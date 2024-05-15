<?php 
include '../autres/bd_conn.php';

session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_adm = $conn->prepare("SELECT * FROM `admintbl` WHERE username = ? AND
    password = ?");
    $select_adm->execute([$name, $pass]);

    if($select_adm->rowCount() > 0){
        $fetch_adm_id = $select_adm->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_adm_id['Id'];
        header('location:admin_page.php');
    }else{
        $msg[] = 'Utilisateur ou mots de passe est incorrect!!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adm_style.css">
</head>
<body>

<?php 
if(isset($msg)){
    foreach($msg as $msg){
        echo
            '<div class="msg">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
    }
}

?>

    <section class="form-container">
        <form action="" method="POST">
            <h3>Connecter-Vous</h3><br><br>
            <input type="text" name="name" required placeholder="Utilisateur" class="box"><br><br>
            <input type="password" name="pass" required placeholder="Mots de passe" class="box"><br><br>
            <input type="submit" value="Connexion" name="submit" class="btn">
        </form>
    </section>







</body>
</html>