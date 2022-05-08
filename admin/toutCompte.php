<?php
    session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM admin WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    if($_SESSION['pseudo'] != 'admin'){
        header('Location: ../nc/connexion.php');
    }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../css/annonce.css">
</head>
<body>
<nav class="navbar">
        <a href="admin.php"><h2 class="logo">Admin</h2></a>
        <ul>
            <li><a href="../config/deconnexion.php">Se déconnecter</a></li>
            <li><a href="touteAnnonce.php">Les annonces</a></li>
            <li><a href="toutCompte.php">Toutes les comptes</a></li>
        </ul>
    </nav>
        <?php
        // Affihce les valeur de la base de donnée
            $sql="SELECT `pseudo`, `email`, `date_inscription` FROM `utilisateurs`";
            $result = $bdd->query($sql);
            $row = $result->rowCount();
            echo"<h1>Il a $row compte. </h1>";

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