<?php 
	include("includes.php");

	//récupère les données de l'URL
	if (empty($_GET['token']) || empty($_GET['email'])){
		header("Location: forgot_password.php");
		die();
	}

	$error = "";

	$email = $_GET['email'];
	$token = $_GET['token'];
	
	//token expiré ?
	$sql = "SELECT token, token_expiry FROM users
			WHERE email = :email";
	
	$sth = $dbh->prepare($sql);
	$sth->bindValue(":email", $email);

	$sth->execute();
	$user = $sth->fetch();

	if (!password_verify($token, $user['token'])){
		header("Location: http://www.disney.com");
		die();
	}

	if ($user['token_expiry'] < date("Y-m-d H:i:s")){
		header("Location: forgot_password.php");
		die();
	}


	//si le form est soumis...
	if (!empty($_POST)){

		$password = trim(strip_tags($_POST['password']));
		$password_confirm = trim(strip_tags($_POST['password_confirm']));

		//mots de passe correspondent ?
		if ($password != $password_confirm){
			$error = "Vos mots de passe ne correspondent pas !";
		}
		//longueur minimale
		elseif(strlen($password) <= 6){
			$error = "Veuillez saisir un mot de passe d'au moins 7 caractères !";
		}
		else {
			//le mot de passe contient au moins une lettre ?
			$containsLetter  = preg_match('/[a-zA-Z]/', $password);
			//le mot de passe contient au moins un chiffre ?
			$containsDigit   = preg_match('/\d/', $password);
			//le mot de passe contient au moins un autre caractère ?
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

			//si une des conditions n'est pas remplie... erreur
			if (!$containsLetter || !$containsDigit || !$containsSpecial){
				$error = "Veuillez choisir un mot de passe avec au moins une lettre, 
						un chiffre et un caractère spécial.";
			}
		}
		if ($error == ""){

			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			$sql = "UPDATE users 
					SET password = :password,
					date_modified = NOW(),
					token = NULL,
					token_expiry = NULL 
					WHERE email = :email";
			$sth = $dbh->prepare($sql);

			$sth->bindValue(":password", $hashedPassword);
			$sth->bindValue(":email", $email);

			if ($sth->execute()){
				header("Location:profil.php");
				die();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Créez votre nouveau mot de passe</title>
</head>
<body>
	
	<h1>Choisissez votre nouveau mot de passe</h1>

	<p>Veuillez entrer 2 fois votre nouveau mot de passe ci-dessous</p>
	<form method="POST">
		<div>
			<label for="password">Votre mot de passe</label>
			<input type="password" name="password" id="password" />
		</div>
		<div>
			<label for="password_confirm">Encore une fois !</label>
			<input type="password" name="password_confirm" id="password_confirm" />
		</div>

		<input type="hidden" name="token" value="<?php echo $token; ?>" />
		<input type="hidden" name="email" value="<?php echo $email; ?>" />

		<input type="submit" value="Sauvegarder" />
	</form>

	<?php echo $error; ?>

</body>
</html>