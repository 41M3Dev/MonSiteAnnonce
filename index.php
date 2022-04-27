<!DOCTYPE html>
<?php 
    // Connexion et choix de la base de données
    require_once 'config/config.php';
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Site d'annonce</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <header>
            <nav class="navbar" id="myNavbar">
                <a href=""><h2 class="logo">MonSite</h2></a>
                <ul id="main_pages">
                    <li><a href="nc/connexion.php">Se Connecter</a></li>
                    <li><a href="nc/inscription.php">S'inscire</a></li>
                    <li><a href="nc/insert.php">Déposer une annonce</a></li>
                </ul>
            </nav>

        </header>
        
  <form method="GET">

    <div class="form__field">
              <input name="titre" type="text" class="form__input" required>
            <button type="submit" class="searchButton">
             <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button class="critèreB"><a href="nc/rechercheAvance.php">plus de critère</a></button>
            
    </div>
    <?php
    if(!isset($_GET['titre'])){
        
    ?>
  </form>
        <div class="container">
            <div class="main-card">
                    <div class="cards">
                        <div class="cardH">
                            <div class="content">
                                <div class="img">
                                    <img src="img/deco.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"><a href="nc/categorie/decoration.php">Decoration</a></div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="cardH">
                            <div class="content">
                                <div class="img">
                                    <img src="img/mode.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"> <a href="nc/categorie/mode.php">Mode</a></div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="cardH" id="cardHG">
                            <div class="content">
                                <div class="img">
                                    <img src="img/loto.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"> <a href="nc/categorie/vehicule.php">Véhicule</a> </div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="cardB">
                            <div class="content">
                                <div class="img">
                                    <img src="img/imobilier.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"> <a href="nc/categorie/immobilier.php">Immobilier</a></div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="cardB">
                            <div class="content">
                                <div class="img">
                                    <img src="img/electromenager.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"> <a href="nc/categorie/electromenager.php">Electroménager</a></div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="cardB" id="cardBG">
                            <div class="content">
                                <div class="img">
                                    <img src="img/multimedia.jpg" alt="">
                                </div>
                                <div class="details">
                                    <div class="job"> <a href="nc/categorie/electronique.php">Electronique</a></div>
                                </div>
                            
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php
    }
            
            // Récupère la recherche
            elseif(!empty($_GET['titre'])){
                $rechercheTitre = $_GET['titre'];
                $sql="select * from annonce WHERE titre LIKE '%$rechercheTitre%'";
                $ann = $bdd->query($sql);
                // affichage du résultat
                while ( $row = $ann->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <section>
                        <div>
                            <?php 
                                echo "<h1 id='titre_cate'>{$row['titre']}</h1>
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