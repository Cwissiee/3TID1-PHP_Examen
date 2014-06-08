<?php
$error = array();
if (!empty($_POST["form"])) {
   
   $destinataire = "christina.dimarco.hernandez@gmail.com";
   $message = "Contact depuis mon profil\n";
   $message .= "Sujet: ".$_POST["sujet"]."\n";
   $message .= "Message: ".$_POST["message"]."\n";
   $sujet = "iWanteacher";
   $header = "";
   
   $result = mail($destinataire, $sujet, $message, $header);
   
   $error[]="<div id='confirmation_contact'>"; //Pour cibler mon p et le modifier.
   if ( $result ) {
      $error[]="<p>Merci, votre message est en cours d'envoie...<p>
      <p>La personne vous répondra dès la réception de votre message.</p>";
   } else {
      $error[]="<p>Désolé, votre message n'a pas pu être transmis.</p>";
   }
} 
?>