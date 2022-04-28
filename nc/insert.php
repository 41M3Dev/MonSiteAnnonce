<!--OK POUR LE MOMENT-->

<!DOCTYPE html>
<?php 
    // Connexion et choix de la base de données
    require_once '../config/config.php';
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/insert.css">
    </head>
    <body>
    <script>
        function erreur(msg) {
            console.log(msg)
            alert(msg);
        }
        function envoye(msg) {
            console.log(msg)
            alert(msg);
        }
    </script>
        <nav class="navbar">
            <a href="../index.php"><h2 class="logo">WebSite</h2></a>
            <ul>
                <li><a href="connexion.php">Se Connecter</a></li>
                <li><a href="inscription.php">S'inscire</a></li>
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
                        <input type="checkbox" id="vente" name="vente" value="vente" >
                        <label for="vente"> Vente </label>
                        <br> <br>
                        <label>La description:</label>
                        <input class="test" name="descrip" type="text" placeholder="Votre description" required>
                        <label>Votre localisation:</label>
                        <input class="test" name="loca" type="text" placeholder="Votre localisation" required>
                        <label>Mail:</label>
                        <input class="test" name="mail" type="text" placeholder="Votre mail" required>
                        <button class="boutonC" type="submit">Envoyer</button>
                    </div>
                </form>
            </main>
    </body>
</html>

<?php
        if(!empty($_GET['titre']) && !empty($_GET['descrip']) && !empty($_GET['vente']) && !empty($_GET['loca']) && !empty($_GET['mail']) && !empty($_GET['cate']))
        {
    //Récpétration des valeur
        $titre = htmlspecialchars($_GET['titre']);
        $descrip = htmlspecialchars($_GET['descrip']);
        $vente = htmlspecialchars($_GET['vente']);
        $loca = htmlspecialchars($_GET['loca']);
        $mail = $_GET['mail'];
        $cate = $_GET['cate'];
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){  
    // Insertion des valeur dans la base de donnée
        $requete = "INSERT INTO `annonce`(`titre`, `description`,`vente_location`, `localisation`, `contact`, `categorie`, `pseudo`) VALUES (?,?,?,?,?,?,?)";
        
        $res = $bdd->prepare($requete);
        $exec = $res->execute(array($titre,$descrip,$vente,$loca,$mail,$cate,'Invité'));
        echo '<script>envoye("Votre annonce a bien était publié");</script>';
        }
            else{
                echo '<script>erreur("Mail incorrect");</script>';
            }
        }
        elseif (!empty($_GET['titre']) && !empty($_GET['descrip']) && !empty($_GET['location']) && !empty($_GET['loca']) && !empty($_GET['mail']) && !empty($_GET['cate']))
        {
    //Récpétration des valeur
        $titre = htmlspecialchars($_GET['titre']);
        $descrip = htmlspecialchars($_GET['descrip']);
        $location = htmlspecialchars($_GET['location']);
        $loca = htmlspecialchars($_GET['loca']);
        $mail = $_GET['mail'];
        $cate = $_GET['cate'];
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){  
    // Insertion des valeur dans la base de donnée
        $requete = "INSERT INTO `annonce`(`titre`, `description`,`vente_location`, `localisation`, `contact`, `categorie`, `pseudo`) VALUES (?,?,?,?,?,?,?)";
        
        $res = $bdd->prepare($requete);
        $exec = $res->execute(array($titre,$descrip,$location,$loca,$mail,$cate,'Invité'));
        echo '<script>envoye("Votre annonce a bien était publié");</script>';}
        else{
            echo '<script>erreur("Mail incorrect");</script>';
        }

    }
?>