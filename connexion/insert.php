<!--OK POUR LE MOMENT-->
<?php session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
    //On vérifie qu'une session a bien étati démarer
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }

    $req = $bdd->prepare('SELECT `email` FROM `utilisateurs` WHERE `pseudo` = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $mail = $data['email'];

?>
        
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/insert.css">
    </head>
    <body>
    <script>
        function erreur(msg) {
            alert(msg);
        }
        function envoye(msg) {
            alert(msg);
        }
    </script>
        <nav class="navbar">
            <a class="logo" href="index.php"><h2 >WebSite</h2></a>
            <ul>
                <li><a href="../config/deconnexion.php">Se Déconnecter</a></li>
                <li><a href="rechercheAvance.php">Recherche</a></li>
                <li><a href="insert.php">Déposer une annonce</a></li>
                <li><a href="annoncePerso.php">Vos une annonce</a></li>
            </ul>
        </nav>
            
            <main>
                <form class="body" method="GET">
                    <div class="container">
                        <label>titre:</label>
                        <input class="test" name="titre" type="text" placeholder="Votre titre" required></input>
                        <select class="inputbox"  name="cate" required>
                            <option value="">Catégorie</option>
                            <option value="Decoration">Décoration</option>
                            <option value="Electromenager">Electroménager</option>
                            <option value="Electronique">Electronique</option>
                            <option value="Immobilier">Immobilier</option>
                            <option value="Mode">Mode</option>
                            <option value="Vehicule">Véhicule</option>
                        </select><br> <br>
                        <input type="checkbox" id="location" name="location" value="location" >
                        <label for="location">Location</label>
                        <input type="checkbox" id="vente" name="vente" value=
                        "vente" >
                        <label for="vente"> Vente </label>
                        <br> <br>
                        <label>La description:</label>
                        <input class="test" name="descrip" type="text" placeholder="Votre description" required>
                        <label>Votre localisation:</label>
                        <input class="test" name="loca" type="text" placeholder="Votre localisation" required>
                        <button class="boutonC" type="submit">Envoyer</button>
                    </div>
                </form>
            </main>
    </body>
</html>

<?php
    // Connexion et choix de la base de données
        $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
        if(!empty($_GET['titre']) && !empty($_GET['descrip']) && !empty($_GET['vente']) && !empty($_GET['loca'])  && !empty($_GET['cate']))
        {
    //Récpétration des valeur
        $titre = htmlspecialchars($_GET['titre']);
        $descrip = htmlspecialchars($_GET['descrip']);
        $vente = htmlspecialchars($_GET['vente']);
        $loca = htmlspecialchars($_GET['loca']);
        $cate = $_GET['cate']; 
    // Insertion des valeur dans la base de donnée
        $requete = "INSERT INTO `annonce`(`titre`, `description`,`vente_location`, `localisation`, `contact`, `categorie`, `pseudo`) VALUES ('$titre','$descrip','$vente','$loca','$mail','$cate','$pseudo')";
        mysqli_query($connexion, $requete);
        echo '<script>envoye("Votre annonce a bien était publié");</script>';
        }
        
        elseif (!empty($_GET['titre']) && !empty($_GET['descrip']) && !empty($_GET['location']) && !empty($_GET['loca'])  && !empty($_GET['cate']))
        {
    //Récpétration des valeur
        $titre = htmlspecialchars($_GET['titre']);
        $descrip = htmlspecialchars($_GET['descrip']);
        $location = htmlspecialchars($_GET['location']);
        $loca = htmlspecialchars($_GET['loca']);
        $cate = $_GET['cate']; 
    // Insertion des valeur dans la base de donnée
        $requete = "INSERT INTO `annonce`(`titre`, `description`,`vente_location`, `localisation`, `contact`, `categorie`, `pseudo`) VALUES ('$titre','$descrip','$location','$loca','$mail','$cate','$pseudo')";
        mysqli_query($connexion, $requete);
        echo '<script>envoye("Votre annonce a bien était publié");</script>';}
        

    
?>
