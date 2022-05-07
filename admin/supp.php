<?php
        // Connexion et choix de la base de données
    require_once '../config/config.php';
    
    $supp= $_GET['supp'];
    $supp = htmlspecialchars($supp);
        if(!empty($_GET['supp'])){
            $check = $bdd->prepare('SELECT titre FROM annonce WHERE titre = ?');
            $check->execute(array($supp));
            $data = $check->fetch();
            $row = $check->rowCount();
            if( $row > 0 ){
        $requete = "DELETE FROM `annonce` WHERE titre = '$supp'";
        $supp = $bdd->prepare($requete);
        $supp->execute();
        header('Location:touteAnnonce.php');
            }
        }
?>