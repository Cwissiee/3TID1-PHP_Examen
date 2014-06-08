<?php 
// La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
require 'include/config.inc.php';
$error = array();
// Si on se connecte avec une adresse mail et un mot de passe
if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {
   	// On vérifie l'existance dans ma base de donnée du mail et du mot de passe
	$req = $bdd->prepare("SELECT * FROM `users` WHERE email = ? AND mdp = ? LIMIT 0 , 1");
	// On exécute la requête en remplacant le mail et le mot de passe dans la requête avec ce que je viens de lui fournir par les correspondants 
	$req->execute(array($_POST['mail'],md5($_POST['mdp'])));
	// On récupère toutes les données pour les mettres dans un tableau (Array donc plusieurs valeurs dans 1 seule variable)
	$res = $req->fetchAll();
	// Si il ne reçoit aucune donnée, il considèrera que le mail et le mot de passe sont fau et donc affichera un message d'erreur
	if (empty($res)) { $error[]="Cette adresse email ou ce mot de passe n'est pas correct"; }
	else {
		// Si non, dans la session compte id il met l'id de l'user
		$_SESSION['compte']['id'] = $res[0]['id'];
		// Et la redirection se fait vers le profil correspondant à l'id
		header('Location: profil.php?id='.$res[0]['id']);
	}
}
// Si on soumet un formulaire vide, la page nous redirige vèrs index.php
else { header('Location: index.php'); }

include("include/error.display.php");
?>