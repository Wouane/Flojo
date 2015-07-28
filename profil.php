<?php
session_start();

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

		// ||||||||||||||  AFFICHAGE MESSAGE
		
		$sql = "SELECT *
				FROM message 
				ORDER BY date_created DESC
				LIMIT 5";
		
		$sth = $dbh->prepare($sql);
				$sth->execute();
		$messages = $sth->fetchAll();

		// ||||||||||||||  AFFICHAGE USERNAME + USER_DESCRIPTION SOUS USER_PICTURE

		$sql = "SELECT username, user_description
				FROM user 
				WHERE id = :id"
				;

		$sth = $dbh ->prepare($sql);
		$sth-> bindValue(":id", $dbh->lastInsertId());
		$sth-> execute();

		$description_user = $sth->fetch();

		// ||||||||||||||||||||||||||||||||||||||||||||||||||

if(!empty($_POST)){

		if ($_POST['form_name'] == "2"){

			$description = trim(strip_tags($_POST['description']));
			$title = trim(strip_tags($_POST['title']));
			$url = trim(strip_tags($_POST['url']));
			$mess_picture = trim(strip_tags($_POST['mess_picture']));
	
			$sql = "INSERT INTO message (id_mess, title, description, url, mess_picture, date_created, date_expiry)
					VALUES (NULL, :title, :description, :url, :mess_picture, NOW(), NOW())";
	
			$sth = $dbh->prepare($sql);
			$sth ->bindValue(":title",$title);
			$sth ->bindValue(":description",$description); 
			$sth ->bindValue(":url",$url); 
			$sth ->bindValue(":mess_picture",$mess_picture); 
			$sth->execute();   
		}

		$sql = "SELECT description
				FROM message 
				ORDER BY date_created DESC
				LIMIT 5";
	
		$sth = $dbh ->prepare($sql);
		$sth-> execute();
		$messages = $sth->fetchAll();


		if($_POST['form_name'] == "1"){
		$sql = "SELECT date_created, description
				FROM message 
				ORDER BY date_created DESC
				LIMIT 5";

		$sth = $dbh ->prepare($sql);
		$sth-> execute();
		$messages = $sth->fetchAll();
		}

	
//////////////////////////////////////////////////////////////////////////
////// ajouter d'autres champs, ici uniquement message[description] //////
////// prevoir ajout d'autres champs dans d'autres tables en        //////
////// dupliquant l'INSERT ou en le modifiant                       //////
//////////////////////////////////////////////////////////////////////////

}

//pr($messages);
?>

<!DOCTYPE html>
<html lang="Fr">
		<head>
			<meta charset="UTF-8">
			<title>Page profil</title>
			<!-- feuilles CSS -->
			<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
			<!-- feuilles CSS -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<h2 class="title-profil">Bienvenue sur votre page profil<?php echo $_SESSION['user']['username']; ?></h2>
			<div class="main-profil">
					<div class="image-profil">
						<img src="img/default.jpg" alt="photo-profil"/>
						<p><?php echo $_SESSION['user']['username']; ?></p>
						<p><?php echo $_SESSION['user']['user_decription']; ?></p>
					</div>

			<div class="affiche10">
			<form method="POST" action="profil.php" id="affiche10" novalidate="novalidate">
				<input type="hidden" value="1" name="form_name"/>
				<input type="submit" class="affiche10" value="affichage 10mn"/>
			</form>
			</div>

			<form method="POST" action="profil.php" id="add-profil-message" novalidate="novalidate" enctype="multipart/form-data">
				<input type="hidden" value="2" name="form_name"/>
					<!-- TITRE DU MESSAGE  -->
				<!-- <label for="title">Saisir le Titre</label></br> -->
				<input type="text" name="title" id="title" placeholder="Tapez votre titre"/>
				</br>
					<!-- INTITULE DU MESSAGE  -->
				<!-- <label for="description">Entrez votre message</label></br> -->
				<textarea name="description" id="description" rows="4" cols="50" placeholder="Tapez votre description" ></textarea>
				</br>		
					<!-- UPLOADE PHOTO  -->
				<label for="mess_picture">Inserer une photo?</label>
				<input type="file" name="mess_picture"/>
				</br>	
					<!-- UPLOAD URL  -->
				<!-- <label for="url">Ajouter une URL?</label> -->
				<input type="url" name="url" id="url" placeholder="Votre URL" />
				</br>	
					<!-- CREER LE MESSAGE  -->	
				<input type="submit" class="add-profil-message" value="créer message"/>
			</form>
				</br>
				<a class="logout" href="logout.php" title="Me déconnecter">Déconnexion</a>
			</div>
		</br>
	<div class="affiche-message"> 
		<?php
				foreach ($messages as $message) {			
				echo '<pre>';
				echo "<div class='profil-message'><p>".$message['description']."</p>
				</div>";
				echo '</pre>';
				}
				?>
			</div>
			</body>
</html>