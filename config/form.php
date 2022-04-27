<?php
    session_start();
    require_once 'config.php';
    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
    // Connexion et choix de la base de données
        $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
        if ($connexion -> connect_errno){
            echo"Y marche pas gars";
        }
    //Récpétration des valeur
        $titre = htmlspecialchars($_POST['titre']);
        $descrip = htmlspecialchars($_POST['descrip']);
        $loca = htmlspecialchars($_POST['loca']);
        $mail = $_POST['mail'];
        $cate = $_POST['cate'];
    // Insertion des valeur dans la base de donnée
        $requete = "INSERT INTO `annonce`(`titre`, `description`, `localisation`, `contact`, `categorie`, `pseudo`) VALUES ('$titre','$descrip','$loca','$mail','$cate','$pseudo')";
        mysqli_query($connexion, $requete);
        header("Location:../connexion/annoncePerso.php");
        exit();
?>