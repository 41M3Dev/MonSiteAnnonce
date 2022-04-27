<?php
    session_start();
    require_once '../config/config.php';
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../css/compte.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php"><h2 class="logo">WebSite</h2></a>
        <ul>
            <li><a href="../config/deconnexion.php">Se Déconnecter</a></li>
            <li><a href="recherche.php">Recherche</a></li>
            <li><a href="insert.php">Déposer une annonce</a></li>
            <li><a href="annoncePerso.php">Vos une annonce</a></li>
        </ul>
    </nav>
    <?php echo $data['pseudo'] ;?>
    <div class="pageC">
        <div class="sidenav">
            <a href="#contact">Changer de mot de passe</a>
        </div>
        <div class="page">
        <?php

        // Connexion et choix de la base de données
            $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
            if ($connexion -> connect_errno){
                echo"Y marche pas gars";
            }
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie`,`pseudo` FROM `annonce` WHERE `pseudo` LIKE '$pseudo' ";
            
            $result=mysqli_query($connexion,$sql)  or die ("bad query");?>
            <form action="supp.php" method="POST">
            <input type="text" name="supp" required="required">
                <button><p>Supprimer</p></button>
                
            </form>
        <?php
            while ($row=mysqli_fetch_assoc($result)){?>
            <section>
                <div>
                    <?php echo "<h1>{$row['titre']}</h1>
                                <h3> Catégorie :</h3>{$row['categorie']}
                                <h3> Descrption : </h3>{$row['description']}<br>
                                <h3> Localisation :</h3>{$row['localisation']} <br>";
                         echo ' <a href="mailto:'.$row['contact'].'"><h3>Contact</h3></a> ';
                         echo $data['pseudo'] ; ?>

                </div>
                
            </section>
                <?php
            }
        ?>
        </div>
    </div>
</body>
</html>