<?php

	//affiche un array dans une balise <pre>
	//sur fond noir 
	function pr($var)
	{
		echo '<pre style="background-color: #000; color: #FFF;">';
		print_r($var);
		echo '</pre>';
	}


	//convertit une date du format MySQL, vers le français
	function convertDateToFrench($dateMysql)
	{
		$unix = strtotime($dateMysql);
		$frenchDate = date("d-m-Y H:i:s", $unix);

		return $frenchDate;
	}

	//si l'utilisateur n'est pas connecté, on le redirige vers login.php
	function lock()
	{
		//si on a oublié d'appeler session_start()
		if (!isset($_SESSION)){
			session_start();
		}

		if (empty($_SESSION['user'])){
			header("Location: login.php");
			die();
		}
	}

	function getConfiguredMailer()
	{
		$mail = new PHPMailer;

		//config de l'envoi
		$mail->isSMTP();
		$mail->setLanguage('fr');
		$mail->CharSet = 'UTF-8';

		//debug
		$mail->SMTPDebug = 0;	//0 pour désactiver les infos de débug
		$mail->Debugoutput = 'html';

		//config du serveur smtp
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = SMTPUSER;
		$mail->Password = SMTPPASS;

		//mail au format HTML
		$mail->isHTML(true); 

		return $mail;
	}