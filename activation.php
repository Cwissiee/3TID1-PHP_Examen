<?php 
// Mettre le texte en utf8 pour épargner les carractères non reconnu
header('Content-Type: text/html; charset=utf-8');
// La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
require 'include/config.inc.php';
include("include/activation.runtime.php");
include("include/error.display.php");
?>