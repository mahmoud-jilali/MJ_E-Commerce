<?php
if(isset($_POST['ajt_fav'])){
    if($Clt_Id == ''){
        header('location:login.php');
    }else{
        
        // $idclt = $_POST['idclt'];
        // $idclt = filter_var($idclt, FILTER_SANITIZE_STRING);
        $refprd = $_POST['refprd'];
        $refprd = filter_var($refprd, FILTER_SANITIZE_STRING);
        $nomprd = $_POST['nomprd'];
        $nomprd = filter_var($nomprd, FILTER_SANITIZE_STRING);
        $prix = $_POST['prix'];
        $prix = filter_var($prix, FILTER_SANITIZE_STRING);
        $img = $_POST['img'];
        $img = filter_var($img, FILTER_SANITIZE_STRING);

        $fav_num = $conn->prepare("SELECT * FROM `wishlist`
        WHERE IdClt = ? AND NomPrd = ?");
        $fav_num->execute([$Clt_Id, $nomprd]);

        $cart_num = $conn->prepare("SELECT * FROM `cart`
        WHERE IdClt = ? AND NomPrd = ?");
        $cart_num->execute([$Clt_Id, $nomprd]);

        if($fav_num->rowCount() > 0){
            $msg[] = 'Déjà ajouté dans la liste de souhaits';
        }elseif($cart_num->rowCount() > 0){
            $msg[] = 'Déjà ajouté dans le panier';
        }else{
            $ajt_fav = $conn->prepare("INSERT INTO `wishlist`
            (IdClt, RefPrd, NomPrd, Prix, Image) VALUES(?,?,?,?,?)");
            $ajt_fav->execute([$Clt_Id, $refprd, $nomprd, $prix, $img]);
            $msgv[] = 'Nouveau produit ajouté dans la liste de souhaits'; 
        }
    }
}

if(isset($_POST['ajt_panier'])){
    if($Clt_Id == ''){
        header('location:login.php');
    }else{      
        // $idclt = $_POST['idclt'];
        // $idclt = filter_var($idclt, FILTER_SANITIZE_STRING);
        $refprd = $_POST['refprd'];
        $refprd = filter_var($refprd, FILTER_SANITIZE_STRING);
        $nomprd = $_POST['nomprd'];
        $nomprd = filter_var($nomprd, FILTER_SANITIZE_STRING);
        $qte = $_POST['qte'];
        $qte = filter_var($qte, FILTER_SANITIZE_STRING);
        $prix = $_POST['prix'];
        $prix = filter_var($prix, FILTER_SANITIZE_STRING);
        $img = $_POST['img'];
        $img = filter_var($img, FILTER_SANITIZE_STRING);

        $cart_num = $conn->prepare("SELECT * FROM `cart`
        WHERE IdClt = ? AND NomPrd = ?");
        $cart_num->execute([$Clt_Id, $nomprd]);

        if($cart_num->rowCount() > 0){
            $msg[] = 'Déjà ajouté dans la panier';
        }
        else{
            $fav_num = $conn->prepare("SELECT * FROM `wishlist`
            WHERE IdClt = ? AND NomPrd = ?");
            $fav_num->execute([$Clt_Id, $nomprd]);
            if($fav_num->rowCount() > 0){
                $sprm_fav = $conn->prepare("DELETE FROM `wishlist`
                WHERE IdClt = ? AND NomPrd = ?");
                $sprm_fav->execute([$Clt_Id, $nomprd]);
            }
            $ajt_cart = $conn->prepare("INSERT INTO `cart`
            (IdClt, RefPrd, NomPrd, Qte, Prix, Image) VALUES(?,?,?,?,?,?)");
            $ajt_cart->execute([$Clt_Id, $refprd, $nomprd, $qte, $prix, $img]);
            $msgv[] = 'Nouveau produit ajouté dans la panier'; 
        }
    }
}
?>