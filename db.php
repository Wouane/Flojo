<?php

    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "auth");

	try {
		$dbh = new PDO(
			'mysql:host='.DBHOST.';dbname='.DBNAME, 
			DBUSER, 
			DBPASS, 
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
			)
		);
	} catch (PDOException $e) {
	    echo 'Erreur de connexion : ' . $e->getMessage();
	}