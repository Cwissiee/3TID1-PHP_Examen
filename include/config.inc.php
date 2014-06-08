<?php
// Création d'un tableau users
$users = array();
// Création d'un nouvel utilisateur
$users[] = array(
	'username' => 'dimarcocbdd',
	'password' => 'KODov840',
	'dbname' => 'dimarcocbdd',
	'host' => 'mysql51-99.perso'
);
// Ouverture d'une nouvelle session, pour utiliser les variables session qui permettent l'échange d'infos entres les pages sans besoin de requêtes.
session_start();
// Je me connecte à la base de donnée
$bdd = new PDO('mysql:host='.$users[0]['host'].';dbname='.$users[0]['dbname'], $users[0]['username'], $users[0]['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

?>