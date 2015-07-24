<?php 
	session_start();
	//pour inclure nos librairies composerinclude("db.php");
	include("includes.php");

	pr($_POST);
	
?>
<!doctype html>
<html lang="FR">
		<head>
			<meta charset="UTF-8">
			<title>Page Home Flojo</title>
			<!-- feuilles CSS -->
			<link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
			<!-- Font Google -->
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
		</head>
		<body>
			<h1>Bienvenue sur FloJo</h1>
				<!-- DIV MAIN -->
			<div class="main-home">
				<div class="forms">
						<!--|||||||||||||||||||| LOGIN FORM ||||||||||||||||||||  -->
					<div class="login-home">
							<h2>Connexion</h1>
		
							<form method="POST" action="login.php">
								<label for="email">Email ou Pseudo</label>
								<input type="text" name="email" placeholder="Email ou pseudo"/></br>
								<label for="password">Mot de passe</label>
								<input type="password" name="password" placeholder="Mot de passe"/></br>
								<input type="submit" value="Connexion"/>
							</form>
							<a href="forgot_password.php">Mot de passe oublié ?</a>
							<!-- error pour form login -->
							<?php 
								//si on a stocké un message d'erreur (dans login_handler.php)
								if(!empty($_SESSION['login_error'])){
									//affiche le message d'erreur
									echo $_SESSION['login_error']; 
									//on a affiché le message, alors on peut le virer
									unset($_SESSION['login_error']);
								}
							?>
							<!--  -->
					</div>
							<!-- ||||||||||||||||||FIN LOGIN FORM||||||||||||||||||||||||||||| -->

				<!--|||||||||||||||||||| INSCRIPTION FORM ||||||||||||||||||||-->
					<div class="register-home">
							<h2>Inscription !</h1>
							<form method="POST" id="login_form" action="register.php">
								<div>
									<label for="email">Votre email</label>
									<input type="email" name="email" id="email"/>
								</div>
								<div>
									<label for="username">Votre pseudo</label>
									<input type="text" name="username" id="username"/>
								</div>
								<div>
									<label for="password">Votre mot de passe</label>
									<input type="password" name="password" id="password"/>
								</div>
								<div>
									<label for="password_confirm">Encore une fois !</label>
									<input type="password" name="password_confirm" id="password_confirm"/>
								</div>
								<input type="submit" value="Valider"/>
								<!-- php error pour form inscription -->
								<?php 
								if (!empty($error)){
									echo '<div>' . $error . '</div>';
								}
								?>
								<!-- fin php error -->
							</form>
					</div>
						<!-- ||||||||||||||||||FIN INSCRIPTION FORM||||||||||||||||||||||||||||| -->
				</div>
				<!-- ||||||||||||||||||FIN DIV LOGINS||||||||||||||||||||||||||||| -->
		</body>
</html>