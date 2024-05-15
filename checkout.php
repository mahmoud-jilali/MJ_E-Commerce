<?php
include 'autres/bd_conn.php';
session_start();
if(isset($_SESSION['IdClt'])){
    $Clt_Id = $_SESSION['IdClt'];
}else{
    $Clt_Id = '';
    header('location: login.php');
}
if(isset($_POST['continuer'])){
    $nom = $_POST['nom'];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $tel = $_POST['tel'];
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $adrss = $_POST['flat'].', '.$_POST['ville'];
    $adrss = filter_var($adrss, FILTER_SANITIZE_STRING);
    $mode_paiement = $_POST['mode_paiement'];
    $mode_paiement = filter_var($mode_paiement, FILTER_SANITIZE_STRING);
    $total_prds = $_POST['total_prds'];
    $total_prds = filter_var($total_prds, FILTER_SANITIZE_STRING);
    $prix_total = $_POST['prix_total'];
    $prix_total = filter_var($prix_total, FILTER_SANITIZE_STRING);

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE IdClt = ?");
    $check_cart->execute([$Clt_Id]);

    if($check_cart->rowCount() > 0){
        $ajt_com = $conn->prepare("INSERT INTO `commandes`
        (IdClt, NomClt, TelClt, EmailClt, AdrssClt, TotalPrds, PrixTotal, mode_paiement)
        VALUES (?,?,?,?,?,?,?,?)");
        $ajt_com->execute([$Clt_Id, $nom, $tel, $email, $adrss, $total_prds, $prix_total, $mode_paiement]);

        $msgv[] = 'Votre commande a été effectué, Merci';

        $sprm_panier = $conn->prepare("DELETE FROM `cart` WHERE IdClt = ?");
        $sprm_panier->execute([$Clt_Id]);
    }else{
        $msg[] = 'Votre panier est vide.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de la commande</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'autres/clt_header.php'; ?>

<section class="pass_com">
    <div class="display_com">
        <?php 
            $total_p = 0;
            $cart_prds[] = '';
            $slct_cart = $conn->prepare("SELECT * FROM `cart` 
            WHERE IdClt = ?");
            $slct_cart->execute([$Clt_Id]);
            if($slct_cart->rowCount() > 0){
                while($fetch_cart = $slct_cart->fetch(PDO::FETCH_ASSOC)){
                    $total_p += ($fetch_cart['Prix'] * $fetch_cart['Qte']);
                    $cart_prds[] = $fetch_cart['NomPrd'] . ' ( ' .$fetch_cart['Qte'].') -';
                    $total_prds = implode($cart_prds);
        ?>
        <p> <?= $fetch_cart['NomPrd']; ?> <span><?= $fetch_cart['Prix']; ?> MAD x
        <?= $fetch_cart['Qte']; ?> </span></p>
        <?php 
               }
            }else{
                echo '<p class="vide">Votre panier est vide</p>';
            }
        ?>
    </div>
    <p class="total_prix"> Total : <span><?= $total_p;?> MAD</span></p>
   <form action="" method="post">
        <input type="hidden" name="total_prds" value="<?= $total_prds; ?>">
        <input type="hidden" name="prix_total" value="<?= $total_p; ?>">
        <div class="flex">
            <div class="inputBox">
                <span>Nom :</span>
                <input type="text"  placeholder="Entrer votre nom" 
                required class="box" name="nom">
            </div>
            <div class="inputBox">
                <span>Téléphone :</span>
                <input type="text"  placeholder="Entrer votre téléphone" 
                required class="box" name="tel">
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email"  placeholder="Entrer votre email" 
                required class="box" name="email">
            </div>
            <div class="inputBox">
                <span>Ville :</span>
                <input type="text"  placeholder="Entrer votre Ville" 
                required class="box" name="ville">
            </div>
            <div class="inputBox">
                <span>Adresse :</span>
                <input type="text"  placeholder="Entrer votre adresse" 
                required class="box" name="flat">
            </div>
            <div class="inputBox">
                <span>Mode de paiement :</span>
                <select name="mode_paiement" class="box" id="mode_paiement">
                    <option selected disabled>Selecter le mode de paiement</option>
                    <option value="Paiement à la livraison">Paiement à la livraison</option>
                    <option value="Carte bancaire">Carte bancaire</option>
                </select>
            </div>
            <!-- ****** -->
            <div class="carte_infos">
                <div id="carteInfos">
                <div class="inputBox">
                    <span>N° de la carte :</span>
                    <input type="text" maxlength="16" class="box" placeholder="N° de la carte">
                </div>    
            <div class="flexbox"> 
                <div class="inputBox">
                    <span>Mois d'expiration :</span>
                    <select name="" id="" class="box">
                        <option value="Mois" selected disabled>Mois</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Année d'expiration :</span>
                    <select name="" id="" class="box">
                        <option value="Annee" selected disabled>Année</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                        <option value="2033">2033</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>CVC :</span>
                    <input type="text" maxlength="5" class="box" placeholder="CVC">
                </div>   
            </div>
            </div>
        </div>  
        </div>
        <input type="submit" name="continuer" class="option-btn <?= ($total_p > 1)
        ?'':'disabled';?>" value="Continuer">
   </form>
</section>





















<?php include 'autres/footer.php'; ?>
<script src="script/script.js"></script>
</body>
</html>