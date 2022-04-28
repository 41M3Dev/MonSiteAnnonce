<!DOCTYPE html>
<?php 
    // Connexion et choix de la base de données
    require_once '../config/config.php';
?>
<?php
    $user='root';
    $pass='';
    $db='projetannonce';
?>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/connexion.css">
	<title>Document</title>
</head>
<body>
    <script>
        function incriptionNonValide(msg) {
            console.log(msg)
            alert(msg);
            
        }
        function incriptionValide(msg) {
            console.log(msg)
            alert(msg);
            document.location.href="connexion.php";     
        }
    </script>
	<header>
		<nav class="navbar">
			<a href="../index.php"><h2 class="logo">WebSite</h2></a>
			<ul>
				<li><a href="connexion.php">Se connecter</a></li>
				<li><a href="insert.php">Déposer une annonce</a></li>
			</ul>
		</nav>
	</header>
    <main>
        <form class="body" method="POST">
            <div class="container">
                <label>Pseudo:</label>
                <input class="test" name="pseudo" type="text" placeholder="Entrer votre pseudo" autofocus required>
                <label>email:</label>
                <input class="test" name="email" type="text" placeholder="Adresse mail" required>
                <label>Mot de passe:</label>
                <input class="test" name="mdp" type="password" placeholder="Mot de passe" required>
                <label>Re-tapez votre mot de passe:</label>
                <input class="test" name="mdp_retaper" type="password" placeholder="Re-tapez le mot de passe" required>
                <button class="boutonC" type="submit">S'inscrire</button>
           

<?php       
        // Connexion et choix de la base de données
        
            if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_retaper'])){
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $mdp = htmlspecialchars($_POST['mdp']);
                $mdp_retaper = htmlspecialchars($_POST['mdp_retaper']);
                $email = strtolower($email);
                    $checkP = $bdd->prepare('SELECT pseudo, password FROM utilisateurs WHERE pseudo = ?');
                    $checkP->execute(array($pseudo));
                    $rowP = $checkP->rowCount();
                    $checkM = $bdd->prepare('SELECT pseudo, password, email FROM utilisateurs WHERE email = ?');
                    $checkM->execute(array($email));
                    $rowM = $checkM->rowCount();
                    if($pseudo == 'admin123'){
                        echo'<script>incriptionValide("Nom d\'utilisateur invalide");</script>';

                    }
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){      
                        if( $rowP == 0 ){
                            if($rowM == 0){
                                if($mdp == $mdp_retaper){
                                    $mdp = password_hash($mdp,PASSWORD_DEFAULT);
                                    
                                    //Insertion de la base de donnée
                                    $requete = "INSERT INTO `utilisateurs`(`pseudo`, `email`, `password`) VALUES (?,?,?)";

                                    $res = $bdd->prepare($requete);
                                    $exec = $res->execute(array($pseudo,$email,$mdp));
                                    echo'<script>incriptionValide("Incription réussi");</script>';
                                    header('connexion.php');
                                }else{
                                    ?>
                                                <script>incriptionNonValide("Mot de passe différent");</script>
                                    <?php
                                } 
                            }else {
                                    ?>
                                        
                                            <script>incriptionNonValide("Mail déjà pris.");</script>
                                        
                                    <?php
                                    }
                        }else{
                            ?>
                                    <script>incriptionNonValide("Pseudo déjà pris.");</script>
                            <?php

                        }
                    }else {
                            ?>
                                 <script>incriptionNonValide("Mail incorrecte.");</script>
                            <?php
                    }
            }
        ?>
 </div>
        </form>
    </main>
</body>
</html>