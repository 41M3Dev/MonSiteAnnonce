<!DOCTYPE html>
<?php
    session_start();
    require_once '../../config/config.php';
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../../css/style2.css">
</head>
<body id="bodyEN">
    <nav class="navbar">
        <a href="../index.php"><h2 class="logo">WebSite</h2></a>
        <ul>
            <li><a href="../Déconnexion.php">Se Déconnecter</a></li>
            <li><a href="../recherche.php">Recherche</a></li>
            <li><a href="../insert.php">Déposer une annonce</a></li>
            <li><a href="../annoncePerso.php">Vos une annonce</a></li>
<!-- <li><a href="compte.php">Compte</a></li>-->        </ul>
    </nav>
        <?php
    $check = $bdd->prepare( "SELECT `titre`, `description`, `localisation`, `contact`, `categorie` FROM `annonce` WHERE `categorie` LIKE 'Electromenager'"  );
        $check->execute();
        $comp = $check->rowCount();
            if( $comp == 0 ){
                ?>
                <section>
                <div>
                    <?php 
                        echo "Na pas d'annonce gars RIP pour toi $comp";
                    ?>

                </div>
            </section>
            <?php
            }
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie` FROM `annonce` WHERE `categorie` LIKE 'Electromenager'";
            
             $result = $bdd->query($sql);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <section>
                <div>
                    <?php echo "<h1>{$row['titre']}</h1>
                                <h3> Catégorie :</h3>{$row['categorie']}
                                <h3> Descrption : </h3>{$row['description']}<br>
                                <h3> Localisation :</h3>{$row['localisation']} <br>";
                         echo ' <a href="mailto:'.$row['contact'].'"><h3>Contact</h3></a> '; ?>

                </div>
            </section>
                <?php
            }
        ?>
    </div>
</body>
</html>