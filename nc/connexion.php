<!DOCTYPE html>
<?php 
    // Connexion et choix de la base de données
    require_once '../config/config.php';
?>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/conex.css">
	<title>Document</title>
</head>
<body>
    <script>
        function connexionNonValide(msg) {
            console.log(msg)
            alert(msg);
        }
        function connexionValide(msg) {
            console.log(msg)
            alert(msg);
        }
    </script>
	<header>
		<nav class="navbar">
			<a href="../index.php"><h2 class="logo">MonSite</h2></a>
			<ul>
				<li><a href="inscription.php">S'inscire</a></li>
				<li><a href="insert.php">Déposer une annonce</a></li>
			</ul>
		</nav>
	</header>
    <main>
        <form class="body" method="POST">
            <div class="container">
                <label>Pseudo:</label>
                <input class="test" name="pseudo" type="text" placeholder="Entrer votre pseudo" required>
                <label>Mot de passe:</label>
                <input class="test" name="mdp" type="password" placeholder="Mot de passe" required>
                <button class="boutonC" type="submit">Se connecter</button>
            </div>
        </form>
    </main>
</body>
</html>
<?php
        session_start();
        if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) && $_POST['pseudo'] != 'admin123')
        {
            $pseudo = htmlspecialchars($_POST['pseudo']); 
            $mdp = htmlspecialchars($_POST['mdp']);
            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $check = $bdd->prepare('SELECT pseudo, password FROM utilisateurs WHERE pseudo = ?');
            $check->execute(array($pseudo));
            $data = $check->fetch();
            $row = $check->rowCount();
            if( $row > 0 ){
                if(password_verify($mdp, $data['password'])){
                    $_SESSION['pseudo'] = $data['pseudo'];
                    header('Location:../connexion/index.php');
                }else{
                    ?>
                    <script>connexionNonValide("Mot de passe incorrect.");</script>
                    <?php
                }
            }else{
                ?>
                    <script>connexionNonValide("Nom d'utilisateur incorrect.");</script>
                    <?php
            }
        }   
 
        
    else
        {   
            if(!empty($_GET['pseudo']) && !empty($_GET['mdp']))
            {
                $pseudo = htmlspecialchars($_GET['pseudo']); 
                $mdp = htmlspecialchars($_GET['mdp']);
                $check = $bdd->prepare('SELECT pseudo, password FROM admin WHERE pseudo = ?');
                $check->execute(array($pseudo));
                $data = $check->fetch();
                $row = $check->rowCount();
                if( $row > 0 )
                {
                    if(password_verify($mdp, $data['password']))
                    {
                        $_SESSION['pseudo'] = $data['pseudo'];
                        header('Location:../admin/admin.php');
                    }else{echo"mdp pas bon";}
                }
            }      
            }
?>