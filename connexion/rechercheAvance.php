<!DOCTYPE html>
<!--OK POUR LE MOMENT-->
<?php session_start();
    require_once '../config/config.php';
    if(!$_SESSION['pseudo']){
        header('Location: connexion.php');
    }
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }

?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/test.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        <nav class="navbar">
                <a href="index.php"><h2 class="logo">MonSite</h2></a>
                <ul>
                    <li><a href="../config/deconnexion.php">Se Déconnecter</a></li>
                    <li><a href="insert.php">Déposer une annonce</a></li>
                    <li><a href="annoncePerso.php">Vos une annonce</a></li>
                </ul>
        </nav>
           
                <h1>Votre recherche</h1>
                <form method="GET">
                <div class="container">
                        <input class="test" name="titre" type="text" placeholder="Que cherchez-vous ?" required>
                        <select class="inputbox"  name="cate" >
                            <option value="">Catégorie</option>
                            <option value="Decoration">Décoration</option>
                            <option value="Electromenager">Electroménager</option>
                            <option value="Electronique">Electronique</option>
                            <option value="Immobilier">Immobilier</option>
                            <option value="Mode">Mode</option>
                            <option value="Vehicule">Véhicule</option>
                        </select>
                        <input class="test" name="loca" type="text" placeholder="Votre localisation" >
                        <button name="valider" class="boutonC" type="submit"> <i class="fa-solid fa-magnifying-glass"></i>Envoyer</button>
                    </div>
                </form>
        <?php
        if(isset($_GET['valider'])){
            // Récupère la recherche
            if(!empty($_GET['titre']) && empty($_GET['cate']) && empty($_GET['localisation'])){
                $rechercheTitre = $_GET['titre'];
                $sql="SELECT `id`, `titre`, `description`, `vente_location`, `localisation`, `contact`, `categorie`, `pseudo`, `datePublication`
                FROM `annonce` WHERE `titre` LIKE '%$rechercheTitre%'";
                $search = $bdd->query($sql);
            }
            if(!empty($_GET['titre']) && !empty($_GET['cate'])){
                $rechercheCate = $_GET['cate'];
                $rechercheTitre = $_GET['titre'];
                $sql="SELECT `id`, `titre`, `description`, `vente_location`, `localisation`, `contact`, `categorie`, `pseudo`, `datePublication`
                FROM `annonce` WHERE `titre` LIKE '%$rechercheTitre%' AND `categorie` = '$rechercheCate'";
                 $search = $bdd->query($sql);
            }
                
            if(!empty($_GET['titre']) && !empty($_GET['cate']) && !empty($_GET['localisation'])){
                $rechercheLoca = $_GET['localisation'];
                $rechercheCate = $_GET['cate'];
                $rechercheTitre = $_GET['titre'];
                $sql="SELECT `id`, `titre`, `description`, `vente_location`, `localisation`, `contact`, `categorie`, `pseudo`, `datePublication`
                FROM `annonce` WHERE `titre` LIKE '%$rechercheTitre%' AND `categorie` = '$rechercheCate' AND `localisation` = '$rechercheLoca'";
                 $search = $bdd->query($sql);
            }
                
            // affichage du résultat
                while ($row = $search->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <section>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Catégorie</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Localisation</th>
                                        <th scope="col">Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="col"><?=$row['titre']?></td>
                                        <td scope="col"><?=$row['categorie']?></td>
                                        <td scope="col"><?=$row['description']?></td>
                                        <td scope="col"><?=$row['localisation']?></td>
                                        <td scope="col"><?php echo ' <a href="mailto:'.$row['contact'].'"><h4>Contact</h4></a> ';?></td>
                                    </tr>
                </tbody>
                </table>
                        </div>
                    </section>
                    <?php
                }}
            ?>
    </body>
</html>