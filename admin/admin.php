<?php
    session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM admin WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <nav class="navbar">
        <a href=""><h2 class="logo">Admin</h2></a>
        <ul>
            <li><a href="../connexion/Déconnexion.php">Se déconnecter</a></li>
            <li><a href="touteAnnonce.php">Les annonces</a></li>
            <li><a href="toutCompte.php">Toutes les comptes</a></li>
            <li><a href="../connexion/compte.php">Compte</a></li>
        </ul>
    </nav>
        <?php
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie` FROM `annonce`";
            
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