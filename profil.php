<?php
session_start();

include ("includes.php");
//charge simpleimage (et autres bibliothèque installées par composer)
// require("vendor/autoload.php");
// 
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
				FROM users 
				WHERE id = :id";

		$sth = $dbh ->prepare($sql);
		$sth-> bindValue(":id", $_SESSION['user']['id']);
		// $sth-> bindValue(":user_description", $_SESSION['user']['user_description']);

		$sth-> execute();
		$profile_user = $sth->fetchAll();

		// pr($profile_user);

		



		/////////////////////////////////////////////////////////		



			// ---------------------------------------------------------------------------
		// ||||||||||||||||||||INSERTION DU MESSAGE SUR LA PAGE||||||||||||||||||||||||||||||
			// ---------------------------------------------------------------------------



if(!empty($_POST)){

		if ($_POST['form_name'] == "2"){
			// |||||||||||||INSCRIPTION MESSAGE DANS LA BDD
			$description = trim(strip_tags($_POST['description']));
			$title = trim(strip_tags($_POST['title']));
			$url = trim(strip_tags($_POST['url']));
			
	
			$sql = "INSERT INTO message (id_mess, title, description, url, date_created, date_expiry)
					VALUES (NULL, :title, :description, :url, NOW(), NOW())";
	
			$sth = $dbh->prepare($sql);
			$sth ->bindValue(":title",$title);
			$sth ->bindValue(":description",$description); 
			$sth ->bindValue(":url",$url); 
			
			$sth->execute();   
		}

}
//////////INSERTION PHOTO///////////////////////////////

if(!empty($_FILES)){
		$maxSize = 5000000; //5 Mo à peu près
		$acceptedMimes = array("image/jpeg", "image/gif", "image/png");
		$acceptedExtensions = array("jpeg", "jpg", "gif", "png"); //qui sait...
		$minWidth = 15;
		$minHeight = 15;

		//si on a des fichiers uploadés...
		if(!empty($_FILES['mess_picture']) && $_FILES['mess_picture']['error'] !=4){

		//iniatilisation de notre variable d'erreur
		$error = "";

		echo '<pre style="background-color: #2c3e50; color: #fff; font-size: 14px; font-family: Consolas, Monospace; padding: 20px;">';
		print_r($_FILES);
		echo '</pre>';

		//chemin vers le fichier uploadé
		$tmpName = $_FILES['mess_picture']['tmp_name'];

		//erreurs d'upload détectées par PHP ?
		if ($_FILES['mess_picture']['error'] != 0){
			switch ($_FILES['mess_picture']['error']) {
				case 1:
					//par rapport au php.ini...
					$error = "Votre fichier est trop gros !";
					break;
				case 4:
					//peut ne pas être une erreur si le fichier est optionnel...
					$error = "Aucun fichier n'a été sélectionné !";
					break;
				default:
					$error = "Une erreur est survenue lors du chargement du fichier !";
					break;
			}
		}

		//poids de l'image ok ?
		if ($_FILES['mess_picture']['size'] > $maxSize){
			$error = "Votre image est trop lourde ! $maxSize octets maximum !";
		}

		//largeur et hauteur ok ?
		$imageSizes = getimagesize($tmpName);

		if ($imageSizes[0] < $minWidth){
			$error = "Votre image n'est pas assez large ! $minWidth pixels minimum !";
		}

		elseif($imageSizes[1] < $minHeight){
			$error = "Votre image n'est pas assez haute ! $minHeight pixels minimum !";
		}

		//extension du fichier
		$ext = pathinfo($_FILES['mess_picture']['name'], PATHINFO_EXTENSION);

		//extension dans notre white list ?
		if (!in_array(strtolower($ext), $acceptedExtensions)){
			$error = "Ce type de fichier n'est pas accepté !";
		}

		//vérifie le type mime
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $tmpName);

		//le type mime détecté est accepté ?
		if (!in_array($mime, $acceptedMimes)){
			$error = "Type de fichier refusé !";
		}

		//si on n'a pas détecté d'erreurs, on poursuit avec l'upload...
		if(empty($error)){

		//nouveau nom du fichier, sécuritaire (contre les XSS, les espaces, les guillemets, etc.)
		$newName = md5($tmpName . time() . uniqid()) . "." . $ext;

		//chemin vers le répertoire où nous déplacerons l'image
		$destinationDirectory = __DIR__ . "/img/uploads/";

		//si le fichier existe déjà avec ce nom (malheureux hasard)
		if (file_exists($destinationDirectory."originals/".$newName)){
			//on ajoute un identifiant unique à la fin du fichier
			$newName = md5($tmpName . time() . uniqid()) . uniqid() . "." . $ext;
		}

		//déplace le fichier temporaire vers un autre répertoire sur notre serveur
		move_uploaded_file($tmpName, $destinationDirectory."originals/".$newName);

		$img = new abeautifulsite\SimpleImage($destinationDirectory."originals/".$newName);
		//mediums
		$img->best_fit(600,600)->save($destinationDirectory."mediums/".$newName);
		//thumbnails
		$img->thumbnail(150,150)->sepia()->save($destinationDirectory."thumbnails/".$newName);
		$sql = "UPDATE message 
			SET mess_picture = :mess_picture
		
			WHERE id_mess = :id_mess";

		$sth = $dbh->prepare($sql);
		$sth->bindValue(":mess_picture",$newName);
		// $sth->bindValue(":user_picture", $user_picture);
		$sth->bindValue(":id_mess", $dbh->lastInsertId());
		// $sth->bindValue(":user_picture", $user_picture);
		$sth->execute();
		}
		//erreur présente donc...
		else {
		//rediriger avec un message d'erreur vers la page contenant le form
		echo $error;
	}
	
}

		// ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
		//      AFFICHAGE MESSAGE SUR PAGE PROFIL.PHP


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

		$sql = "SELECT mess_picture
				FROM message 
				WHERE id_mess = :id_mess
				ORDER BY date_created DESC";
	
		$sth = $dbh ->prepare($sql);
		$sth-> execute();
		$message = $sth->fetchAll();

}

// pr($messages);
	
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
			<!-- feuilles CSS -->
			<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
			<!-- feuilles CSS -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<!-- TITRE DE LA PAGE -->
			<h2 class="title-profil">Bienvenue sur votre page profil<?php echo $_SESSION['user']['username']; ?></h2>
			<!-- VIGNETTE USER_PICTURE + USERNAME + USER_DESCRIPTION -->
			<div class="main-profil">

				<!-- VIGNETTE USER_PICTURE + USERNAME + USER_DESCRIPTION -->

					<div class="image-profil">
						<!-- il faut insérer l'image ci dessous -->
						<div class="user_picture">
							<img src="img/default.jpg" alt="photo-profil"/>
						</div>
						<!-- Pseudo user -->
						<p class="username"><?php echo $_SESSION['user']['username'];?></p>
						<!-- Bio user -->
						<p class="user_description"><?php echo $_SESSION['user']['user_description'];?></p>
						<a class="link-modif-profil" href="modif-profil.php">Modifier votre profil</a>
					</div>
					<!-- ............................................ -->
					

							<!-- FORM POUR ECRIRE LE MESSAGE (tweet) -->

			<form method="POST" action="profil.php" class="add-profil-message" novalidate="novalidate" enctype="multipart/form-data">
				<input type="hidden" value="2" name="form_name"/>

							<!-- TITRE DU MESSAGE  -->
				<!-- <label for="title">Saisir le Titre</label></br> -->
				<input type="text" name="title" class="title-message" id="title" placeholder="Titre de votre message"/>
				</br>

							<!-- INTITULE DU MESSAGE  -->
				<!-- <label for="description">Entrez votre message</label></br> -->
				<textarea name="description" class="description-message" id="description" rows="4" cols="50" placeholder="Votre message (max 140 caractères)" ></textarea>
				</br>
									<!-- UPLOAD URL  -->
				<!-- <label for="url">Ajouter une URL?</label> -->
				<input type="url" name="url" class="url-message" id="url" placeholder="Votre URL" />
				</br>	

							<!-- UPLOADE PHOTO  -->
				<div class="picture-message">
				<label class="mess_picture">Inserer une photo?</label>
				<input type="file" name="mess_picture"/>
				</div>
					<!-- CREER LE MESSAGE  -->	
				<input type="submit" class="create-message" value="créer message"/>
			</form>

						<!-- ............................................ -->

								<!-- BOUTON AFFICHE 10MIN -->


			<div class="affiche10">
			<form method="POST" action="profil.php" id="affiche10" novalidate="novalidate">
				<input type="hidden" value="1" name="form_name"/>
				<input type="submit" class="affiche10" value="affichage 10mn"/>
			</form>
			</div>

					<!-- ............................................ -->
				</br>
			</div>
			<a class="logout" href="logout.php" title="Me déconnecter">Déconnexion</a>
		</br>
						<!-- AFFICHAGE DES MESSAGEs (tweet) -->

		<div class="affiche-message"> 
				<?php
					foreach ($messages as $message) {			
					echo '<pre>';
					echo "<div class='profil-message'><p>".$message['description']."</p></div>";
					if(!empty($_SESSION['message']['mess_picture'])){
					echo "<img src='".$_SESSION['message']['mess_picture']."'/>";
				}
					echo '</pre>';
					
				}
				?>
		</div>
	</body>
</html>