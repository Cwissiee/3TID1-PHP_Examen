   <?php 
   // Si en allant sur la page inscription, aucune étape n'est en cours de réalisation, alors on arrive à l'étape 1 par défaut
   if (empty($_SESSION['inscription']['etape'])) {$_SESSION['inscription']['etape'] = 1;}
      // Si la variable session inscription statut existe, alors on récupère les données en rapport avec le statut
   if (isset($_SESSION['inscription']['statut'])) {$statut = $_SESSION['inscription']['statut'];}
     // $statut = 'Professeur'; pour avoir tout le contenu pour coder plus facilement sans devoir à chaque fois tout remplir
      
      // Si on annule, l'inscription est alors remise à neuf (vidée) et on retombe sur index
      if (isset($_GET['annule']) && $_GET['annule'] == 'ok') {
         $_SESSION['inscription'] = array();
         $_POST = array();
         header('Location: index.php');
      }
      // Si il y a eu soumission du formulaire pour aller au suivant (post)
      if (isset($_POST)) {
         // On récupère toutes les infos qui ont été entrées dans les formulaires et on simplifie les infos en passant de $_POST['statut'] à $statut (exemple)
         if (!empty($_POST)) {
            extract($_POST);
         }
         // On créer quand même un tableau d'erreur, même si il est vide les erreurs viendrons s'y placer si il y en a et plus simple à récupérer
         $erreurs = array();
         // Si étape = 1 on vérifie le formulaire 1 est correct ou pas
         if ($_SESSION['inscription']['etape'] == 1 && !empty($_POST)) {
            if (!preg_match('#[a-zA-Z]{2,}#', $prenom)) {
               // vérif prenom
               $erreurs['prenom'] = 'Veuillez indiquer votre prénom';
            }
            if (!preg_match('#[a-zA-Z]{2,}#', $nom)) {
               // vérif nom
               $erreurs['nom'] = 'Veuillez indiquer votre nom';
            }
            // vérif si c'est bien une adresse email (structure)
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $res = $bdd->query("SELECT email FROM users WHERE email = '$email'");
               if ($res->fetch()) {
                  // vérif aussi si l'email n'est pas déjà utilisé (donc si il n'existe pas encore dans la BDD)
                  $erreurs['email'] = 'Cette adresse email est déjà utilisée';
               }
            }
            else {
               $erreurs['email'] = 'Veuillez inscrire une adresse email valide';
            }
            if (!preg_match('#.{4,}#', $passe)) {
                // vérif mot de passe
               $erreurs['passe'] = 'Veuillez choisir un mot de passe de 4 caractères minimum';
            }
            if ($verif_passe != $passe) {
                // vérif si 2 mot de passe correspond bien au premier
               $erreurs['verif_passe'] = 'Veuillez retaper correctement votre mot de passe';
            }
            if (!in_array($statut, array("Élève", "Parent", "Professeur"))) {
                // vérif statut
               $erreurs['statut'] = 'Veuillez indiquer un statut';
            }
            // Si il n'y a aucune erreur on passe à l'épate suivante et on enrengistre les données et on supprime le $_POST
            if (empty($erreurs)) {
               $_POST = array();
               $_SESSION['inscription']['etape'] = 2;
               $_SESSION['inscription']['prenom'] = $prenom;
               $_SESSION['inscription']['nom'] = $nom;
               $_SESSION['inscription']['email'] = $email;
               $_SESSION['inscription']['passe'] = $passe;
               $_SESSION['inscription']['statut'] = $statut;
            }
         }
         //  Si étape = 2 on vérifie le formulaire 2 est correct ou pas
         if ($_SESSION['inscription']['etape'] == 2 && !empty($_POST)) {
            if (empty($_SESSION['inscription']['photo'])) {
                // Vérif photo uploadé
               if ($_FILES['photo']['error'] == 0) {
                   // On récupère l'extention de la photo
                  $ext = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
                  // Vérif l'extention
                  if (!in_array($ext, array('jpg','jpeg','gif','png'))) {
                     $erreurs['photo'] = 'Cette photo n\'a pas la bonne extension';
                  }
                  // Vérif le poid de la photo
                  // Pour calculer 15360 = 15 qui est le poid toléré pour la photo X 1024
                  elseif ($_FILES['photo']['size'] > 15360) {
                     $erreurs['photo'] = 'Attention, cette photo dépasse les 15 ko !';
                  }
                  else {
                     // On donne un nom unique à la photo en récupérant l'adresse mail encrypté
                     $nom_photo = md5($_SESSION['inscription']['email']).'.'.$ext;
                     // On déplace la photo uploadé vers le dossier imgs
                     move_uploaded_file($_FILES['photo']['tmp_name'],'imgs/'.$nom_photo);
                     // On met le nom de la photo récupérée via l'email dans la variable session pour passer cette donnée vers les autres pages (profil.php)
                     $_SESSION['inscription']['photo'] = $nom_photo;
                  }
               }
               else {
                  // Si aucun n'upload de photo n'est fait
                  $erreurs['photo'] = 'Veuillez choisir une photo';
               }  
            }
            
            // vérif niveau
            if (!in_array($niveau, array("Instruction en famille","Maternelle","Primaire","Secondaire artistique","Secondaire général","Secondaire professionnel","Secondaire technique","Spécialisation","Supérieur de type court","Supérieur de type long","Promotion sociale","Universitaire"))) {
               $erreurs['niveau'] = 'Veuillez indiquer un niveau';
            }
            // vérif matière
            if (!in_array($matiere, array("Allemand","Anglais","Biologie","Chimie","Comptabilité","Économie","EDM","Espagnol","Éveil","Français","Géographie","Histoire","Informatique","Latin","Mathématiques","Musique","Néerlandais","Philosophie","Physique","Sciences","Social","Sport","Technologie"))) {
               $erreurs['matiere'] = 'Veuillez indiquer une matière';
            }
            // vérif adresse (localisation)
            if (!preg_match('#[a-zA-Z]{2,}#', $adresse)) {
               $erreurs['adresse'] = 'Veuillez indiquer une adresse correcte';
            }
            // vérif tarif
            if (!in_array($tarif,array("5€","10€","20€","30€","40€","50€","60€"))) {
               $erreurs['tarif'] = 'Veuillez indiquer un tarif';
            }
            // vérif horaire
            if (empty($horaire)) {
               $erreurs['horaire'] = 'Veuillez cocher vos disponibilités';
            }
            // Si il n'y a aucune erreur on passe à l'épate suivante et on enrengistre les données et on supprime le $_POST
            if (empty($erreurs)) {
               $_POST = array();
               $_SESSION['inscription']['etape'] = 3;
               $_SESSION['inscription']['niveau'] = $niveau;
               $_SESSION['inscription']['matiere'] = $matiere;
               $_SESSION['inscription']['adresse'] = $adresse;
               $_SESSION['inscription']['tarif'] = $tarif;
               $_SESSION['inscription']['horaire'] = $horaire;
            }
         }
         //  Si étape = 3 on vérifie le formulaire 3 est correct ou pas
         if ($_SESSION['inscription']['etape'] == 3 && !empty($_POST)) {
            // On vérifie que dans la présentation il y a plus que 20 caractères
            if (!preg_match('#.{20,}#', $presentation)) {
               $erreurs['presentation'] = 'Veuillez compléter votre présentation de 20 caractères minimum';
            }
            // vérif age
            if (!preg_match('#[0-9]{1,3}#', $age)) {
               $erreurs['age'] = '43 ans';
            }
            // vérif déplacement et si c'est oui, alors on vérifie si le champ pour indiquer le nombre de km est completé ou non
            if ($deplacement == 'Oui' && !preg_match('#[0-9]{1,3}#', $dp_km)) {
               $erreurs['dp_km'] = 'Nombre de km ?';
            }
            // si la réponse à déplacement est non, alors le champs indique 0
            if ($deplacement == 'Non') {
               $dp_km = '0 Km';
            }
            // Si on a le statut professeur, alors on vérifie la suite qui n'apparait que pour les professeurs
            if ($statut == 'Professeur') {
               // verif expérience
               if (!preg_match('#[0-9]{1,3}#', $exp)) {
                  $erreurs['exp'] = '10 ans';
               }
               // vérif lieu des cours
               if (!preg_match('#[a-zA-Z\s]{2,}#', $lieu)) {
                  $erreurs['lieu'] = 'À mon Domicile';
               }
            }
            // Si il n'y a aucune erreur on passe à l'épate suivante et on enrengistre les données et on supprime le $_POST
            if (empty($erreurs)) {
               $_POST = array();
               $_SESSION['inscription']['etape'] = 4;
               $_SESSION['inscription']['presentation'] = $presentation;
               $_SESSION['inscription']['age'] = $age;
               $_SESSION['inscription']['permis'] = $permis;
               $_SESSION['inscription']['fumeur'] = $fumeur;
               $_SESSION['inscription']['deplacement'] = $deplacement;
               $_SESSION['inscription']['dp_km'] = $dp_km;
               $_SESSION['inscription']['cours'] = $cours;
               if ($statut == 'Professeur') {
                  $_SESSION['inscription']['materiel'] = $materiel;
                  $_SESSION['inscription']['exp'] = $exp;
                  $_SESSION['inscription']['lieu'] = $lieu;
                  $_SESSION['inscription']['etude'] = $etude;
                  $_SESSION['inscription']['activite'] = $activite;
                  $_SESSION['inscription']['langue'] = $langue;
               }
            }
         }
         //  Si étape = 4 on met les infos dans la base de donnée et le mail de confirmation est envoyé
         if ($_SESSION['inscription']['etape'] == 4) {
            // On récupère toutes les infos qui ont été entrées dans les formulaires et on simplifie les infos en passant de $_POST['statut'] à $statut (exemple)
            extract($_SESSION['inscription']);
            // On va transformer l'horaire qui est en tableau en code binaire car plus simple à récupérer
            $horaireFinal = '';
               // On va de 0 à 41 car 41 valeurs
            for ($i=0; $i < 42; $i++) { 
                  // Si la case radio est cochée, alors on met 1
              if (isset($horaire[$i])) {
               $horaireFinal .= '1,';
            }
                  // Si la case radio n'est pas cochée, alors on met 0
            else {
               $horaireFinal .= '0,';
            } 
         }
            // On supprime la dernière "," du code binaire afin que ça ne prête pas à préjudice
         $horaireFinal = substr($horaireFinal, 0, -1); 
            // On prépare la requête de toutes les infos pour les entrées dans la BDD.
         $req = $bdd->prepare('INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `mdp`, `statut`, `niveau`, `matiere`, `adresse`, `tarif`, `horaire`, `presentation`, `age`, `permis`, `fumeur`, `deplacement`, `dp_km`, `materiel`, `exp`, `cours`, `lieu`, `etude`, `langue`, `activite`, `photo`, `activate`)
            VALUES (NULL, :prenom, :nom, :email, :mdp, :statut, :niveau, :matiere, :adresse, :tarif, :horaire, :presentation, :age, :permis, :fumeur, :deplacement, :dp_km, :materiel, :exp, :cours, :lieu, :etude, :langue, :activite, :photo, 0)');
            // On vérif si la variable est existante si non on met une variable vide ou une valeur par défaut dans la base de donnée (impossible en principe vu la vérif)
         if (!isset($prenom)) {$prenom = '';}
         if (!isset($nom)) {$nom = '';}
         if (!isset($email)) {$email = '';}
         if (isset($passe)) {$mdp = md5($passe);} else {$mdp = '';}
         if (!isset($statut)) {$statut = '';}
         if (!isset($niveau)) {$niveau = '';}
         if (!isset($matiere)) {$matiere = '';}
         if (!isset($adresse)) {$adresse = '';}
         if (!isset($tarif)) {$tarif = '';}
         if (isset($horaireFinal)) {$horaire = $horaireFinal;} else {$horaire = '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';}
         if (isset($presentation)) {$presentation = htmlentities($presentation);} else {$presentation = '';}
         if (!isset($age)) {$age = '0';}
         if (!isset($permis)) {$permis = 'Non';}
         if (!isset($fumeur)) {$fumeur = 'Non';}
         if (!isset($deplacement)) {$deplacement = 'Non';}
         if (!isset($dp_km)) {$dp_km = '0';}
         if (!isset($materiel)) {$materiel = 'Non';}
         if (!isset($exp)) {$exp = '0';}
         if (!isset($cours)) {$cours = 'Seul';}
         if (isset($lieu)) {$lieu = htmlentities($lieu);} else {$lieu = '';}
         if (isset($etude)) {$etude = htmlentities($etude);} else {$etude = '';}
         if (isset($langue)) {$langue = htmlentities($langue);} else {$langue = '';}
         if (isset($activite)) {$activite = htmlentities($activite);} else {$activite = '';}
         if (!isset($photo)) {$photo = '';}
            // On crée un tableau (array) avec toutes les données dans la variable requête avant de le transféré vers la BDD (donc d'exécuter la requête)
         $requete = array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'mdp' => $mdp,
            'statut' => $statut,
            'niveau' => $niveau,
            'matiere' => $matiere,
            'adresse' => $adresse,
            'tarif' => $tarif,
            'horaire' => $horaire,
            'presentation' => $presentation,
            'age' => $age,
            'permis' => $permis,
            'fumeur' => $fumeur,
            'deplacement' => $deplacement,
            'dp_km' => $dp_km,
            'materiel' => $materiel,
            'exp' => $exp,
            'cours' => $cours,
            'lieu' => $lieu,
            'etude' => $etude,
            'langue' => $langue,
            'activite' => $activite,
            'photo' => $photo
            );
            // On récupère toutes les données du tableau ici au dessus et on exécute la requête en transférant les infos vèrs la base de donnée
         $req->execute($requete);
            // On récupère l'email dans la base de donnée afin de vérifier si les infos s'y trouvent
         $req = $bdd->prepare("SELECT * FROM `users` WHERE email = '".$_SESSION['inscription']['email']."' LIMIT 0 , 1");
            // On exécute la requête précédente (si l'email est bien dans la BDD avec les infos)
         $req->execute();
            // On récupère les données de la requête précédente (si l'email est bien dans la BDD avec les infos)
         $res = $req->fetchAll();
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
         $message_txt = "Bienvenue sur iWanteacher. Un dernier point avant de pouvoir utiliser les fonctionnalités du sites. Rendez-vous sur www.dimarco-christina.be/tfe/finale/activation.php?id=".$res[0]['id']."&code=".md5($res[0]['id'].$res[0]['email']).". Vous receverez ensuite un mail de confirmation.";
         $message_html =  "<html> <head> </head> <body> <b>Bienvenue sur iWanteacher</b><br> Un dernier point avant de pouvoir utiliser les fonctionnalités du sites. <a href='www.dimarco-christina.be/tfe/finale/activation.php?id=".$res[0]['id']."&code=".md5($res[0]['id'].$res[0]['email'])."'>Cliquez ici</a> pour activer votre compte.<br> Vous receverez ensuite un mail de confirmation.<br> </body> </html>";
         
         
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
            // On passe à l'étape 5 qui est le message de confirmation de l'envoie du mail
         $_SESSION['inscription']['etape'] = 5;
      }
   }
      // Toutes les erreurs en span du form jusque à présentation de l'étape 3
   if ($_SESSION['inscription']['etape'] != 3) {
         // On ajoute à chaque erreur du tableau la class span error
      foreach ($erreurs as $i => $erreur) {
         $erreurs[$i] = '<span class="error">'.$erreur.'</span>';
      }
   }
      // On vérifie que la variable session compte id existe
   if (isset($_SESSION['compte']['id'])) {
         // dans la variable id on insère session compte id qui vérifie si la personne est connectée
      $id = $_SESSION['compte']['id'];
   }
   else {
      $id = false;
   }
   ?>