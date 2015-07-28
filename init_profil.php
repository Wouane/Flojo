<?php 
	session_start();
	include("includes.php");
	pr($_SESSION);
	//vérification que l'utilisateur est bien connecté
	//lock();
	//sinon... on ne fait rien et la page ci-dessous s'affichera

	if(!empty($_POST)){
	//initialisation des variables
	$user_description = trim(strip_tags($_POST['user_description']));
	// $user_picture = ;
	
	// ||||||||||||||||| VALIDATION

		// si le champ description est vide

	// champ bio vide ?
	if(empty($user_description)){
		$error = "Veuillez renseignez votre bio";
	}

	// bio trop grande ?
	elseif(strlen($user_description) > 140){
		$error = "Votre biographie est trop grande";
	}

	// --------------------------------------------------------------
	// ||||||||||||||||||||||||||||||||UPDATE INSERT BDD WITH USER_DESCRIPTION
	// -------------------------------------------------------------

	$sql = "UPDATE users 
			SET user_description = :user_description,
			date_modified = NOW()
			WHERE id = :id";

	$sth = $dbh->prepare($sql);
	$sth->bindValue(":user_description", $user_description);
	// $sth->bindValue(":user_picture", $user_picture);
	$sth->bindValue(":id", $_SESSION['user']['id']);
	// $sth->bindValue(":user_picture", $user_picture);
	$sth->execute();

	// --------------------------------------------------------------
	// ||||||||||||||||||||||||||||||||UPDATE INSERT BDD WITH USER_PICTURE
	// -------------------------------------------------------------

	$acceptedMimes = array("image/jpeg", "image/gif", "image/png");
	$acceptedExtensions = array("jpeg", "jpg", "gif", "png");
	$maxSize = 1000000;
	$minWidth = 100;
	$minHeight = 100;

	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Page Home Flojo</title>
			<!-- feuilles CSS -->
			<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
			<!-- feuilles CSS -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
	</head>
	<body>	
				<!-- Bonjour nom user + username -->
			<h1>Bonjour <?php echo $_SESSION['user']['username']; ?></h1>
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
				
					<!-- Erreurs du form init profil php -->
				<div class="init-profil-error">
					<?php 
						if (!empty($error)){
						echo '<div>' . $error . '</div>';
						}
					?>
					<!-- -->
				</div>
			</div>		
			<a class="logout" href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>
	</body>
</html>