<?php 
	include("includes.php");
	//si le form est soumis...
	if (!empty($_POST)){

		$error = "";

		//sécurisation de l'email
		$email = trim(strip_tags($_POST['email']));
		//validation rapide
		//email vide ?
		if(empty($email)){
			$error = "Veuillez renseigner votre email !";
		}
		//email valide ?
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Votre email n'est pas valide !";
		}
		//email trop long ?
		elseif(strlen($email) > 100){
			$error = "Votre email est long, trop long.";
		}
		//si valide
		if ($error == ""){

			//email présent dans la base ?
			$sql = "SELECT *
					FROM users
					WHERE email = :email";

			$sth = $dbh->prepare($sql);
			//l'array remplace le bindValue()
			$sth->execute(array(":email" => $email));
			$user = $sth->fetch();

			//si trouvé
			if ($user){
				//on génère un token pour l'utilisateur
				$factory = new RandomLib\Factory;
				$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
				$token = $generator->generateString(80, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-');

				//date d'expiration
				$expiry = date("Y-m-d H:i:s", strtotime("+ 1 day"));

				//on sauvegarde ce token et sa date d'expiraiton
				$sql = "UPDATE users 
						SET token = :token,
						token_expiry = :expiry,
						date_modified = NOW() 
						WHERE id = :id";

				$hashedToken = password_hash($token, PASSWORD_DEFAULT);

				$sth = $dbh->prepare($sql);
				$sth->bindValue(":token", $hashedToken);
				$sth->bindValue(":expiry", $expiry);
				$sth->bindValue(":id", $user['id']);

				if ($sth->execute()){
					//on génère le lien complet
					$resetLink = ROOTURL . "/reinit_password.php?token=$token&email=$email";
					//die($resetLink);

					//instance de PHPMailer
					$mail = getConfiguredMailer();

					//qui envoie, et qui reçoit
					$mail->setFrom('wouanou00@gmail.com', 'Wouane');
					$mail->addAddress('wouanou00@gmail.com', 'Florian Wouane'); //retirer en prod
					$mail->addAddress('wouaneou00@gmail.com, Florian Wouane');
					// $mail->addAddress($email, $user['username']); // prod

					//sujet 
					$mail->Subject = 'Oubli du mot de passe chez WF3 ?';

					//message (avec balises possibles)
					$mail->Body = 
					'<p>Vous avez oublié votre mot de passe ?<br />
					<a href="'.$resetLink.'">
					Cliquez ici pour créer un nouveau mot de passe</a></p>
					<p>Si vous n\'êtes pas à l\'origine de cette demande, vous pouvez ignorer ce message</p>';

					//pièce jointe
					//$mail->addAttachment('panda.gif');

					//send the message, check for errors
					if (!$mail->send()) {
						$error = "Une erreur de survenue. Le mail n'a pas été envoyé !";
					} else {
						$message = "Merci, Allez voir vos mails !";
					}
				}
				else {
					//écrire un message dans un fichier de log
				}
			}
			//sinon, erreur
			else {
				$error = "Cet email n'est pas inscrit ici !";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="fr">
		<head>
				<meta charset="UTF-8">
				<title>Mot de passe oublié</title>
				<!-- feuilles CSS -->
				<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
				<!-- Font Google -->
				<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<div class="main-forgot-password">
				<h1 class="forgot-password">Mot de passe oublié</h1>
				<p class="forgot-password">Veuillez entrer l'adresse email utilisée lors de votre inscription.</p>
				<p class="forgot-password">Nous y enverrons un message permettant de créer un nouveau mot de passe.</p>
				<form class="form-forgot-password" method="POST">
						<input class="email-forgot-password" type="text" name="email" placeholder="Votre email" />
						<input class="submit-forgot-password" type="submit" value="OK" />
				</form>
				<div class="error">
						<?php 
							if (!empty($error)){
								echo $error;
							}
						?>
				</div>
				<div class="message">
						<?php 
							if (!empty($message)){
								echo $message;
							}
						?>
				</div>
			</div>
		</body>
</html>