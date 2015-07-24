<?php
	session_start();
	include("includes.php");



	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users 
			WHERE email = :email 
			OR username = :email 
			LIMIT 1";

	$sth = $dbh->prepare($sql);
	$sth->bindValue(":email", $email);
	$sth->execute();

	$foundUser = $sth->fetch();

	if ($foundUser){
		//vérifie le mot de passe
		/*
		||||||| Attention : PHP 5.5 ou plus !!! |||||||||
		||||  Sinon, depuis 5.3.7 : https://github.com/ircmaxell/password_compat
		*/
		$isValidPassword = password_verify($password, $foundUser['password']);

		if ($isValidPassword){
			//on préfère ne pas stocker le mdp en session, 
			//même si pas très grave...
			unset($foundUser['password']);

			//on stocke l'array de l'utilisateur en session
			//toutes les données seront disponible sur toutes les pages !
			$_SESSION["user"] = $foundUser;

			//redirection vers la page protégée 
			header("Location: profil.php");
			die();
		}
		else {
			//redirection vers login avec message d'erreur
			$_SESSION['login_error'] = "Mauvais mot de passe !";
			header("Location:home.php");
			die();
		}

	}
	else {
		//redirection vers login avec message d'erreur
		$_SESSION['login_error'] = "Utilisateur non trouvé !";
		header("Location: login.php");
		die();
	}