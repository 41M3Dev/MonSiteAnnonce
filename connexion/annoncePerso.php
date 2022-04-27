<?php
    session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    $pseudo = $data['pseudo'];
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site d'annonce</title>
    <link rel="stylesheet" href="../css/annoncePerso.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<script>
        function supp(msg) {
            alert(msg);
            
        }
        function aucuneAnnonce(msg) {
            alert(msg);
            
        }
    </script>
    <nav class="navbar">
        <a href="index.php"><h2 class="logo">WebSite</h2></a>
        <ul>
            <li><a href="../config/deconnexion.php">Se Déconnecter</a></li>
            <li><a href="recherche.php">Recherche</a></li>
            <li><a href="insert.php">Déposer une annonce</a></li>
<!-- <li><a href="compte.php">Compte</a></li>-->        </ul>
    </nav>
    <div class="pageC">
        <?php

        // Connexion et choix de la base de données
            $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie`,`pseudo` FROM `annonce` WHERE `pseudo` LIKE '$pseudo' ";
            
            $result=mysqli_query($connexion,$sql)  or die ("bad query");?>
            <form id="form_field"  method="GET" >
            <input id ="form_input" type="text" name="supp" placeholder="Titre de l'annonce à supprimer">
                <button id="searchButton" ><i class="fa-solid fa-ban"></i> Supprimer</button>
                
            </form>
        <?php
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
              
            if(!empty($_GET['supp'])){
                $supp= $_GET['supp'];
                $supp = htmlspecialchars($supp);
                $check = $bdd->prepare('SELECT titre FROM annonce WHERE titre = ?');
                $check->execute(array($supp));
                $data = $check->fetch();
                $row = $check->rowCount();
                if( $row > 0 ){
            $requete = "DELETE FROM `annonce` WHERE titre = '$supp' AND pseudo = '$pseudo' ";
            mysqli_query($connexion, $requete);
            echo'<script>supp("Votre annonce à bine été supprimer");</script>';
                }
            }
        ?>
        
    </div>
</body>
</html>