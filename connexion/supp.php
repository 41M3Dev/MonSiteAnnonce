
<?php
    session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
    if(!$_SESSION['pseudo']){
        header('Location: connexion.php');
    }
?>
<!DOCTYPE html>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // Connexion et choix de la base de données
        $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
        $supp= $_POST['supp'];
        $supp = htmlspecialchars($supp);
        $requete = "DELETE FROM `annonce` WHERE titre = '$supp' AND pseudo = '$pseudo' ";
        mysqli_query($connexion, $requete);
        header("Location:annoncePerso.php");
        exit();
    ?>
</body>
</html>