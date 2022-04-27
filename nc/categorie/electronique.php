<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../../../css/style2.css">
</head>
<body id="bodyEN">
<nav class="navbar">
        <a href="../index.php"><h2 class="logo">WebSite</h2></a>
        <ul>
            <li><a href="../connexion.php">Se Connecter</a></li>
            <li><a href="../inscription.php">S'inscire</a></li>
            <li><a href="../rechercheAvance.php">Recherche</a></li>
            <li><a href="../insert.php">Déposer une annonce</a></li>
        </ul>
    </nav>
        <?php
    require_once '../../config/config.php';
        $check = $bdd->prepare( "SELECT `titre`, `description`, `localisation`, `contact`, `categorie` FROM `annonce` WHERE `categorie` LIKE 'Electronique'"  );
        $check->execute();
        $comp = $check->rowCount();
            if( $comp == 0 ){
                ?>
                <section>
                <div>
                    <?php 
                        echo "Aucune annonce n'a était posté pour cette catégorie pour le moment.";
                    ?>

                </div>
            </section>
            <?php
            }
        // Connexion et choix de la base de données
            $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
            if ($connexion -> connect_errno){
                echo"Y marche pas gars";
            }
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie` FROM `annonce` WHERE `categorie` LIKE 'Electronique'";
            
            $result=mysqli_query($connexion,$sql)  or die ("bad query");

            while ($row=mysqli_fetch_assoc($result)){?>
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