<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar">
    <a href="admin.php"><h2 class="logo">Admin</h2></a>
        <ul>
            <li><a href="Déconnexion.php">Se déconnecter</a></li>
            <li><a href="toutCompte.php">Toutes les comptes</a></li>
            <i class="fa-solid fa-filter"></i>  
        </ul>
    </nav>
        <?php
        // Connexion et choix de la base de données
            $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
            if ($connexion -> connect_errno){
                echo"Y marche pas gars";
            }
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie`,`pseudo` FROM `annonce`";
            
            $result=mysqli_query($connexion,$sql)  or die ("bad query");

            while ($row=mysqli_fetch_assoc($result)){?>
            <section>
                <div>
                    <?php echo "<h1>{$row['titre']}</h1>
                                <h3> Catégorie :</h3>{$row['categorie']}
                                <h3> Descrption : </h3>{$row['description']}<br>
                                <h3> Localisation :</h3>{$row['localisation']} <br>
                                <p>Déposer par : <strong> {$row['pseudo']} </strong> </p>"; ?>

                </div>
            </section>
                <?php
            }
        ?>
    </div>
</body>
</html>