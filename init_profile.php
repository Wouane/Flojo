<?php 
	session_start();
	include("functions.php");
	pr($_SESSION);

	//vérification que l'utilisateur est bien connecté

	//voir functions.php
	lock();

	//sinon... on ne fait rien et la page ci-dessous s'affichera

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profil !</title>
</head>
<body>

	<a href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>

	<h1>Profil de <?php echo $_SESSION['user']['username']; ?></h1>
	<p>Cette page ne devrait être accessible que pour les utilisateurs connectés.</p>
<h1>FLOJO Connexion</h1>
	
	<form method="POST" action="init_profil.php">
		<input type="text" name="email" placeholder="inserer une photo" />
		<input type="text" name="description" placeholder="Description" />
		<input type="submit" value="OK" />
	</form>

	<a href="forgot_password.php">Mot de passe oublié ?</a>

	<?php 
		//si on a stocké un message d'erreur (dans login_handler.php)
		if(!empty($_SESSION['login_error'])){
			//affiche le message d'erreur
			echo $_SESSION['login_error']; 
			//on a affiché le message, alors on peut le virer
			unset($_SESSION['login_error']);
		}
	?>




</body>
</html>