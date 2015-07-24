<?php 
session_start();
include("functions.php");
	//pr($_SESSION);

	//vérification que l'utilisateur est bien connecté

	//voir functions.php
	//lock();

	//sinon... on ne fait rien et la page ci-dessous s'affichera

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profil !</title>
</head>
<body>

	

	<!--<h1>Profil de <?php echo $_SESSION['user']['username']; ?></h1>-->
	
	<h1>FLOJO init_Profil</h1> 
	<!--!!!!!!!!!!!!!attention  "action" doit pointer sur profil.php!!!!!!!!!!!!!! -->
	<form method="POST" action="init_profil.php">
		<label for="description">Inserer une photo</label>
	</br>
	<input type="file" name="user_picture"/>
</br>
</br>
<label for="description">Entrez votre descriptif</label>
</br> 
<textarea name="user_description" id="description" rows="4" cols="50" > 

</textarea>
</br>

<!--<input type="text" name="description" placeholder="Description" />-->
<input type="submit" value="OK" />
</form>
</br>
<a href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>

<!--<a href="forgot_password.php">Mot de passe oublié ?</a>-->

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