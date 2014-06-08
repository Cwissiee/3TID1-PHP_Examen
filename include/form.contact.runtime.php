 <?php
 $error = array();
 
 if (!empty($_POST["form"])) {
   
   $destinataire = "christina.dimarco.hernandez@gmail.com";
   $message = "Contact iWanteacher\n";
   $message .= "Sujet: ".$_POST["sujet"]."\n";
   $message .= "Nom:".$_POST["nom"]."\n";
   $message .= "Prenom:".$_POST["prenom"]."\n";
   $message .= "Message: ".$_POST["message"]."\n";
   $header = "From: ".$_POST["email"]."\n";
   $sujet = "iWanteacher";
   
   if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //L'email est bonne
   $result = mail($destinataire, $sujet, $message, $header);
   }
   else {$erreur_mail="<p>Désolé, votre email est invalide</p>";}

   $error[]="<div id='confirmation_contact'>"; //Pour cibler mon p et le modifier.
   if ( $result ) {
      $error[]="<p>Merci, votre message est en cours d'envoie...<p>
      <p>Nous vous recontacterons dans les plus brefs délais.</p>";
   }
   elseif ($erreur_mail) {
    $error[]=$erreur_mail;
   }
   else {
   $error[]="<p>Désolé, suite à une erreur votre message n'a pas pu être transmis.</p>";
   }
   echo "</div>";
   }
?>