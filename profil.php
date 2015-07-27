<?php
session_start();

//toujours appeler avant le html ou toutes sorties même echo
////////////////////////////////////////////////////////////////////////////////////
////// ****ICI**** faire l'include  des parametres  de connexion à la base    //////
////// contenant: hostname, database_name, name, password                      /////
////// malheureusement dangereux a passer dans github                          /////
////////////////////////////////////////////////////////////////////////////////////
 
include ("includes.php");

////////////////////////////////////////////////////////////////////////////////
////// delete des messages si message[date_created] dépassée de 10 minutes  ////
////// la date expiry n'a plus vraiment d'interet....       			        ////
////// un batch integrée en event dans la dbase pourrait etre 				////
//////  plus appropriée, a voir.....!!!!!		    								////
////////////////////////////////////////////////////////////////////////////////
// la bonne syntaxe....validée
// DELETE FROM message WHERE date_created < (NOW() - INTERVAL 10 MINUTE)
//
// en cas de date unix integer
// DELETE FROM message WHERE date_created < (UNIX_TIMESTAMP() - 600);
 $description = "";	
	if (!empty($_POST)){

		$description = strip_tags($_POST['description']);

		$sql = "INSERT INTO message (description, date_created, date_expiry)
				VALUES (:description, NOW(), NOW())";

		$sth = $dbh->prepare($sql);
		$sth ->bindValue(":description",$description);   
		$sth->execute();   
		}

	$sql = "SELECT description
			FROM message 
			ORDER BY date_created DESC
			LIMIT 5";

	$sth = $dbh ->prepare($sql);
	$sth-> execute();
	$messages = $sth->fetchAll();
//////////////////////////////////////////////////////////////////////////
////// ajouter d'autres champs, ici uniquement message[description] //////
////// prevoir ajout d'autres champs dans d'autres tables en        //////
////// dupliquant l'INSERT ou en le modifiant                       //////
//////////////////////////////////////////////////////////////////////////

	

?>

<!DOCTYPE html>
<html lang="Fr">
	<head>
		<meta charset="UTF-8">
		<title>Page profil</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
	</head>
	<body>
			<h2 class="title-profil">Bienvenue sur votre page profil<?php echo $_SESSION['user']['username']; ?></h2>
			<div class="main-profil">
				<div class="image-profil">
					<img src="img/default.jpg" alt="photo-profil"/>
				</div>
				<form method="POST" action="profil.php" id="add-profil-message" novalidate="novalidate">
					<label for="description">Entrez votre message</label>
					<textarea name="description" id="description" rows="4" cols="50" ></textarea>
					<input type="submit" class="add-profil-message" value="créer message"/>
				</form>
				</br>
				<div class="logout-profil">
					<a href="logout.php" title="Me déconnecter">Déconnexion</a>
				</div>
				<div class="affiche-message">		
	
				</div>
			</div>
				<?php
				foreach ($messages as $message) {			
				echo '<pre>';
				echo "<div class='profil-message'><p>".$message['description']."</p>
				</div>";
				echo '</pre>';
				}
				?>
	</body>
</html>