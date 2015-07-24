<?php 
	session_start();
	include("includes.php");
	//pr($_SESSION);
	//vérification que l'utilisateur est bien connecté
	//lock();
	//sinon... on ne fait rien et la page ci-dessous s'affichera
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Page Home Flojo</title>
			<!-- feuilles CSS -->
			<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
			<!-- Font Google -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
	</head>
	<body>	
				<!-- Bonjour nom user + username -->
				<h1>Bonjour <?php echo $_SESSION['user']['username']; ?></h1>
				<div class="main-init-profil">
				<form method="POST" action="init_profil.php">
					<div class="form-init">
						<label for="description">Veuillez Inserer une photo</label>
						<input type="file" name="user_picture"/>
					</div>
						</br>
					<div class="form-init">
						<label for="description">Entrez votre descriptif</label>
						</br> 
						<textarea name="user_description" id="description" rows="4" cols="50" ></textarea>
					</div>
						</br>
						<input type="submit" value="Valider" />
				</form>
				</div>
				<a href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>
	
					<!-- Erreurs du form init profil php -->
					<?php 
							//si on a stocké un message d'erreur (dans login_handler.php)
					if(!empty($_SESSION['login_error'])){
								//affiche le message d'erreur
						echo $_SESSION['login_error']; 
								//on a affiché le message, alors on peut le virer
						unset($_SESSION['login_error']);
					}
					?>
					<!-- -->		
	</body>
</html>