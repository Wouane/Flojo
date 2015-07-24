<!doctype html>
<html lang="FR">
		<head>
				<meta charset="UTF-8">
				<title>Page Home Flojo</title>
				<!-- feuilles CSS -->
				<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
				<!-- Font Google -->
				<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<h1>FLOJO Connexion</h1>
			
			<form method="POST" action="login_handler.php">
				<input type="text" name="email" placeholder="Email ou pseudo" />
				<input type="password" name="password" placeholder="Mot de passe" />
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