<?php 
	session_start();
	include("includes.php");
	pr($_SESSION);
	//vérification que l'utilisateur est bien connecté
	//lock();
	//sinon... on ne fait rien et la page ci-dessous s'affichera


	$user_description = trim(strip_tags($_POST['user_description']));
	$user_picture = trim(strip_tags($_POST['user_picture']));

	if(!empty($_POST)){

	$sql = "INSERT INTO users (user_description, user_picture)
			VALUES (:user_description, :user_picture)";

	$sth->bindValue(":user_description", $user_description);
	$sth->bindValue(":user_picture", $user_description);

	$sth = $dbh->prepare($sql);
	$sth->execute();
	$profil_user = $sth->fetchAll();

	}

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
				<h1>Bonjour</h1>
				<div class="main-init-profil">
				<form class="form-init-profil" method="POST" enctype="multipart/form-data">
						<label for="user_description">Entrez votre Bio</label>
						</br> 
						<textarea name="user_description" id="description" rows="4" cols="50" placeholder="Max 140 caractères" ></textarea>
						</br>					
						<label for="user_picture">Photo de profil : </label>
						<input type="file" name="user_picture"/>
						</br>
						<input class="submit-init-profil" type="submit" value="Valider"/>
				</form>
				</div>
				<a class="logout" href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>
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