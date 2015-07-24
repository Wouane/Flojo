<?php

	//déconnexion !
	session_start(); //même pour effacer la session, on doit la démarrer
	unset($_SESSION['user']);
	header("Location: login.php");
