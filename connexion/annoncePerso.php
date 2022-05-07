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
            <li><a href="rechercheAvance.php">Recherche</a></li>
            <li><a href="insert.php">Déposer une annonce</a></li>
<!-- <li><a href="compte.php">Compte</a></li>-->        </ul>
    </nav>
    <div class="pageC">
        <?php
            
        // Affihce les valeur de la base de donnée
            $sql="SELECT `titre`, `description`, `localisation`, `contact`, `categorie`,`pseudo` FROM `annonce` WHERE `pseudo` LIKE '$pseudo' ";
            $result = $bdd->query($sql);
            
            $result->execute();
            $comp = $result->rowCount();
                if( $comp == 0 ){
                    ?>
                    <section>
                    <div>
                        <?php 
                            echo "Vos n'avait posté aucune annoce pour le moment";
                        ?>

                    </div>
                </section>
                <?php
                }

            ?>
            
            
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <section>
                <div>
                    <?php echo "<h1>{$row['titre']}</h1>
                                <h3> Catégorie :</h3>{$row['categorie']}
                                <h3> Descrption : </h3>{$row['description']}<br>
                                <h3> Localisation :</h3>{$row['localisation']} <br>";
                         echo ' <a href="mailto:'.$row['contact'].'"><h3>Contact</h3></a> '; ?>
                         <form action="supp.php" method="GET">
                                     Supprimer : <?php echo '<td><input type="submit" name="supp" value="'.$row['titre'].'" /></td>';?>
                                 </form>

                </div>
                
            </section>
                <?php
            }
              
            
        ?>
        
    </div>
</body>
</html>