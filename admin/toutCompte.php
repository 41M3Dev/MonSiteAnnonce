<!DOCTYPE html>
<?php 
    // Connexion et choix de la base de données
    require_once '../config/config.php';
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../css/annonce.css">
</head>
<body>
<nav class="navbar">
        <a href=""><h2 class="logo">Admin</h2></a>
        <ul>
            <li><a href="../connexion/Déconnexion.php">Se déconnecter</a></li>
            <li><a href="touteAnnonce.php">Les annonces</a></li>
            <li><a href="toutCompte.php">Toutes les comptes</a></li>
        </ul>
    </nav>
        <?php
        // Affihce les valeur de la base de donnée
            $sql="SELECT `pseudo`, `email`, `date_inscription` FROM `utilisateurs`";
            
             $result = $bdd->query($sql);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <section>
                <div>
                    <?php echo "<h1>{$row['pseudo']}</h1>
                                <h3> Email :</h3>{$row['email']}
                                <h3> Date d'inscription : </h3>{$row['date_inscription']}<br>"; ?>

                </div>
            </section>
                <?php
            }
        ?>
    </div>
</body>
</html>