<?php
	//include("config.php");
	// define : constante puis on l'appel en MAJ
     define("DBHOST", "localhost"); // DBHOST : serveur qui héberge le site 						// ip du serveur MySQL
     define("DBUSER", "root"); // DBUSER par défaut root, l'herbergeur donne un autre user 		// username MySQL
     define("DBPASS", ""); //DBPASS : sur mac le mdp est root                                    // mot de passe MySQL
     define("DBNAME", "flojo"); // on se connecte à la bdd avec le nom de la bdd           // nom de la base de donéne
	try {
		//cree un objet PDO 
		$dbh = new PDO( //Php Data Objects interface
			'mysql:host='.DBHOST.';dbname='.DBNAME, //Data Source Name
			DBUSER, 
			DBPASS, 
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // les requetes SQL vont communiqués avec le serveur MySQL avec la synthax utf_8 
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // on veut recevoir des arrays associatifs, dans les requêtes SELECT
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // on veut afficher  toutes les erruers MySQL
			)
		);
	} catch (PDOException $e) {
	    echo 'Erreur de connexion : ' . $e->getMessage();
	}