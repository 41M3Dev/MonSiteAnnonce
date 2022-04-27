<?php
    session_start();
    require_once '../config/config.php';
    
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $req->execute(array($_SESSION['pseudo']));
    $data = $req->fetch();
    if(!$_SESSION['pseudo']){
        header('Location: ../nc/connexion.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/recherche.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <script>
            function aucunResultat(msg){
                alert(msg);
        }
        </script>
        <nav class="navbar">
                <a href="index.php"><h2 class="logo">RodeUnNom</h2></a>
                <ul>
                    <li><a href="../config/deconnexion.php">Se Déconnecter</a></li>
                    <li><a href="insert.php">Déposer une annonce</a></li>
                    <li><a href="annoncePerso.php">Vos une annonce</a></li>
                   <!-- <li><a href="compte.php">Compte</a></li>-->
                </ul>
        </nav>
        <form action="resultat.php" method="GET">

    <div class="form__field">
              <input name="titre" type="text" class="form__input" required>
            <button type="submit" class="searchButton">
             <i class="fa-solid fa-magnifying-glass"></i>
            </button>
    </div>

  </form>
           
                <h1 id="titre">Résultat de votre recherche</h1>

        <?php
            // Connexion et choix de la base de données
            $connexion = mysqli_connect("127.0.0.1", "root", "","projetAnnonce");
            // Récupère la recherche
            if(!empty($_GET['titre'])){
                $rechercheTitre = $_GET['titre'];
                $check = $bdd->prepare('SELECT titre FROM annonce WHERE titre = ?');
                $check->execute(array($rechercheTitre));
                $data = $check->fetch();
                $row = $check->rowCount();
    if( $row == 0 ){
        echo'<script>aucunResultat("Aucun résulta pour votre recherche essayer avec un autre mot clé");</script>';}
        $sql="select * from annonce WHERE titre LIKE '%$rechercheTitre%'";
        $result=mysqli_query($connexion,$sql)  or die ("bad query");
            // affichage du résultat
                while ($row=mysqli_fetch_assoc($result)){
        ?>
                    <section>
                        <div>
                            <?php echo "<h1 id='titre_cate'>{$row['titre']}</h1>
                                        <div class='annonce'><h3> Catégorie :</h3><p>{$row['categorie']}</p></div>
                                        <div  class='annonce'><h3> Descrption : </h3>{$row['description']}<br></div>
                                        <div  class='annonce'><h3> Localisation :</h3>{$row['localisation']} <br></div>";
                                echo ' <div  class="annonce"><a href="mailto:'.$row['contact'].'"><h3>Contact</h3></a></div> ';
                            ?>

                        </div>
                    </section>
                    <?php
                }
                }
            
            
                ?>

    </body>
</html>