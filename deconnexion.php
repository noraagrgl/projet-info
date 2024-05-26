<?php

	session_start();
    // Détruit toutes les données de la session actuelle
	session_destroy();
    // Redirige l'utilisateur vers la page d'accueil
	header("location:acceuil.html");
	exit;

?>
