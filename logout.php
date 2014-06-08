<?php
	// La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
   	require 'include/config.inc.php';
	// supprimer la connection à l'id et donc au profil qui s'y relie, donc en gros se déconnecter
	unset($_SESSION['compte']['id']);
	// redirection vèrs la page index
	header('location: index.php');
?>