<?php 
// Préparation de la requête à faire en récupérant toutes les infos liées à l'id. limit 0,1 est une sécurité qui fait primer la première id si il y en a 2 les mêmes (casi impossible)
$req = $bdd->prepare("SELECT * FROM `users` WHERE id = '".$_GET['id']."' LIMIT 0 , 1");
// On exécute la requête
$req->execute();
// On récupère toutes les données pour les mettres dans un tableau (Array donc plusieurs valeurs dans 1 seule variable)
$res = $req->fetchAll();

$error = array();

// Si aucune donnée n'est récupérée, message d'erreur
if (empty($res)) {
	$error[]="Ce profil n'existe pas, désolée";
}
// Si le profil a déjà été activé, message d'erreur
elseif ($res[0]['activate'] == 1) {
	$error[]="Ce profil est déjà activé, désolée";
}
// Le mail contient un code pour que la vérification ne se fasse pas de n'importe qui
elseif ($_GET['code'] == md5($res[0]['id'].$res[0]['email'])) {
	// Activé le compte en passant de 0 à 1
	$req = $bdd->prepare("UPDATE `users` SET `activate`=1 WHERE id = ".$res[0]['id']);
	// On exécute la requête
	$req->execute();
	// On place le mail dans une variable mail
	$mail = $res[0]['email'];
	// On vérifie si c'est une adresse hotmail, live ou msn car la structure de retour à la ligne diffère
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
	{
		// passage à la ligne pour hotmail, live ou msn
		$passage_ligne = "\r\n";
	}
	else
	{
		// passage à la ligne pour les autres messageries
		$passage_ligne = "\n";
	}
	// Déclaration des messages au format texte et au format HTML.
	$message_txt = "Bonjour ".$res[0]['prenom'].". Merci de votre inscription au site iWanteacher. Nous vous confirmons que celle-ci a bien été enregistrée. À bientôt sur iwanteacher.be !";
	$message_html =  "<html> <head> </head> <body> <b>Bonjour ".$res[0]['prenom']."</b><br>Merci de votre inscription au site iWanteacher. <br>Nous vous confirmons que celle-ci a bien été enregistrée. <br>À bientôt sur <a href='www.dimarco-christina.be/tfe/beta/index.php'>iwanteacher.be</a> !<br> </body> </html>";


	// Création de la boundary (Frontière) qui va permettre de séparer les différentes parties de notre e-mail.
    // Pour faire la chaîne aléatoire (rand = un genre d'id), la méthode la plus utilisée est de faire un encryptage d'un nombre aléatoire et casi unique à chaque email.
    $boundary = "-----=".md5(rand());

	// Définition du sujet du mail.
	$sujet = "Inscription iWanteacher.be";

	// Création du header de l'e-mail.
	$header = "From: \"iWanteacher\"<no-reply@iwanteacher.be>".$passage_ligne;
	// Informe la messagerie du type de contenu du mail
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

	// Création du message format texte pour les messageries qui ne reconnaissent pas l'html.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	// Ajout du message au format texte en ISO (autre cryptage de caractère spéciaux style utf8).
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;

	// Création du message au format html pour les autres.
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	// Ajout du message au format HTML en ISO (autre cryptage de caractère spéciaux style utf8).
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;

	// Délimite la fin du message
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;


	// Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);
	// Redirige cette page vers l'index
	header('Location: index.php');
}
else {
	$error[]="Le code ne correspond pas";
}
?>