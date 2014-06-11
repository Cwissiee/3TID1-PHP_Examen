<?php 
   // Mettre le texte en utf8 pour épargner les carractères non reconnu
   header('Content-Type: text/html; charset=utf-8');
   // La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
   require 'include/config.inc.php';
   include("include/inscription.runtime.php");
   ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="fr">
   <![endif]-->
   <!--[if IE 7 ]>
   <html class="ie ie7" lang="fr">
      <![endif]-->
      <!--[if IE 8 ]>
      <html class="ie ie8" lang="fr">
         <![endif]-->
         <!--[if (gte IE 9)|!(IE)]><!-->
         <html lang="fr">
            <head>
               <meta charset="utf-8" />
               <title>iWanteacher | Inscription</title>
               <meta name="keywords" content="esiaj, web design, échecs, école, students, étudiants, teachers, profs, parents, témoignages, évaluations, experience" />
               <meta name="description" content="iWanteacher, à la recherche d'un prof particulier" />
               <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
               <meta name="apple-mobile-web-app-capable" content="yes"/>
               <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
               <link rel="stylesheet" type="text/css" href="css/reset.css"/>
               <link rel="stylesheet" type="text/css" href="css/styles.css"/>
               <link rel="icon" type="image/png" href="imgs/favicon.ico" />
               <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'/>
               <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
               <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
               <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;libraries=places&amp;sensor=true"></script>
            </head>
            <body onload="initialize()">
               <?php if(!$id) { ?> <!-- ne s'affiche que si la personne n'est pas connectée -->
               <div id="content-opacity">
                  <div id="login">
                     <h3><span>i</span>Wanteacher</h3>
                     <div class="champs-connection">
                        <form action="login.php" method="POST" >
                           <input type="text" id="mail" value="" name="mail" placeholder="Votre email" required/>
                           <input type="password" name="mdp" id="mdp" placeholder="Votre password" required/>
                           <button class="btn-connexion" type="submit">Se connecter</button>
                        </form>
                        <ul class="help">
                           <li><a href="inscription.php" class="no-inscrit">Pas encore inscrit?</a></li>
                           <li><a href="#" class="no-mdp">Mot de passe oublié?</a></li>
                        </ul>
                        <!-- End help -->
                     </div>
                     <!-- End champ-connection -->
                  </div>
                  <!-- End login -->
               </div>
               <!-- End content-opacity -->
               <?php }?>
               <header id="header">
                  <div class="header-wrapper">
                     <div class="container clearfix">
                        <h1>
                           <a href="index.php"><img src="imgs/logo.png" alt="logo iWanteacher" class="visible-desktop"/></a>
                           <a href="index.php"><img src="imgs/logo-iphone.png" alt="logo iWanteacher" class="visible-iphone"/></a>
                        </h1>
                        <nav class="user-nav">
                           <ul class="clearfix">
                              <?php if($id) { ?> <!-- ne s'affiche que si la personne est connectée -->
                              <li class="nologged"><a href="logout.php">Se déconnecter</a></li>
                              <li class="nologged"><a href="profil.php?id=<?php echo $id ?>">Mon profil</a></li>
                              <?php } else { ?> <!-- ne s'affiche que si la personne n'est pas connectée -->
                              <li class="nologged connexion"><a href="login.php">Se connecter</a></li>
                              <li class="nologged"><a href="inscription.php" class="active">S'inscrire</a></li>
                              <?php } ?>
                              <li class="nologged padnone"><a href="contact.php">Contact</a></li>
                              <li class="languages no-iphone"><a href="#">Fr</a></li>
                              <li class="no-iphone">/</li>
                              <li class="languages no-iphone"><a href="#">Nl</a></li>
                           </ul>
                        </nav>
                     </div>
                     <!-- end container -->
                  </div>
                  <!-- end header wrapper -->
               </header>
               <!-- end header -->  
               <div class="container clearfix">
                  <div id="slogan-inscription">
                     <p class="pourquoi-inscription">Pourquoi vous inscrire ?</p>
                     <p>iWanteacher vous permet dès votre première visite, de lancer une <strong>recherche</strong> aboutie et voir ainsi les <strong>profils</strong> afin de vous familiariser avec le site.
                     Cependant, pour pouvoir entrer en <strong>contact</strong> avec autrui, vous serez dans l'obligation de vous inscrire afin d'une part que la personne puisse avoir accès à vos <strong>informations</strong> et d'autre part afin de protéger la <strong>vie privée</strong> des utilisateurs.
                     L'<strong>inscription</strong> est <strong>rapide</strong> et permettra également à des <strong>professeurs</strong> de vous proposer leur <strong>aide</strong>.</p>
                  </div>
               </div>
               <div class="container clearfix">
                  <div class="fleche-form"></div>
               </div>
               <section id="banner-infos" class="clearfix"></section>
               <hr>
               <!-- end map -->
               <section id="content-inscription">
                  <div class="container clearfix">
                     <?php 
                        if ($_SESSION['inscription']['etape'] == 1) {
                           ?> <!-- Affichage du fomulaire de l'étape 1 -->
                     <h3>Inscription <span>1/3</span></h3>
                     <form id="form-inscription" class="page1" action="#content-inscription" method="POST">
                        <label for="prenom">Votre prénom</label>
                        <?php if (isset($erreurs['prenom'])) {echo $erreurs['prenom'];} ?> <!-- On affiche l'erreur prénom si il y en a une -->
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?php if (isset($prenom)) {echo $prenom;} ?>"> <!-- on garde en mémoir le prénom précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        <label for="nom">Votre nom</label>
                        <?php if (isset($erreurs['nom'])) {echo $erreurs['nom'];} ?> <!-- On affiche l'erreur nom si il y en a une -->
                        <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php if (isset($nom)) {echo $nom;} ?>"> <!-- on garde en mémoir le nom précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        <label for="email">Votre adresse mail</label>
                        <?php if (isset($erreurs['email'])) {echo $erreurs['email'];} ?> <!-- On affiche l'erreur email si il y en a une -->
                        <input type="text" name="email" id="email" placeholder="Adresse mail" value="<?php if (isset($email)) {echo $email;} ?>"> <!-- on garde en mémoir l'email précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        <label for="passe">Votre mot de passe</label>
                        <?php if (isset($erreurs['passe'])) {echo $erreurs['passe'];} ?><!-- On affiche l'erreur mot de passe si il y en a une -->
                        <input type="password" name="passe" id="passe" placeholder="Mot de passe">
                        <label for="verif_passe">Confirmation de votre mot de passe</label>
                        <?php if (isset($erreurs['verif_passe'])) {echo $erreurs['verif_passe'];} ?> <!-- On affiche l'erreur vérif mot de passe si il y en a une -->
                        <input type="password" name="verif_passe" id="verif_passe" placeholder="Mot de passe">
                        <h4>Votre Statut</h4>
                        <?php if (isset($erreurs['statut'])) {echo $erreurs['statut'];} ?> <!-- On affiche l'erreur statut si il y en a une -->
                        <div class="menuDeroulant">
                           <ul>
                              <li>
                                 <span id="statut">Statut</span> 
                              </li>
                           </ul>
                           <div class="sousMenu">
                              <input type="hidden" name="statut">
                              <ul>
                                 <li><span>Élève</span></li>
                                 <li><span>Parent</span></li>
                                 <li><span>Professeur</span></li>
                              </ul>
                           </div>
                        </div>
                        <input type="submit" value="Suivant">
                     </form>
                     <form id="form-annulation" action="?annule=ok" method="POST">
                        <input type="submit" value="Annuler">
                     </form>
                     <div class="conditions">
                        <p>En vous inscrivant à iWanteacher, vous acceptez les <a href="#">Conditions d'utilisation</a> ainsi que la 
                           <a href="confidentialite.php">Politique de conﬁdentialité</a>.
                        </p>
                     </div>
                     <?php    
                        } 
                        if ($_SESSION['inscription']['etape'] == 2) {
                           ?> <!-- Affichage du fomulaire de l'étape 2 -->
                     <h3>Inscription <span>2/3</span></h3>
                     <form id="form-inscription" class="page2" action="#content-inscription" method="POST" enctype="multipart/form-data">
                        <h4>Choisissez une photo de profil</h4>
                        <?php if (isset($erreurs['photo'])) {echo $erreurs['photo'].'<br>';} ?> <!-- erreur -->
                        <div class="choose-image">
                           <input type="file" name="photo" id="photo"/><span class="filename"></span><br>
                        </div>
                        <div class="choose-image-error">
                           <p>Attention, l'upload d'image n'est pas accessible sur iphone !</p>
                        </div>
                        <h4>Niveau auquel vous <?php if ($statut == 'Professeur') {echo "enseignez";}else {echo "recherché";}?></h4>
                        <!-- Si le statut est prof on affiche "enseignez", si non "recherché" -->
                        <?php if (isset($erreurs['niveau'])) {echo $erreurs['niveau'];} ?> <!-- erreur -->
                        <div class="menuDeroulant">
                           <ul>
                              <li><span id="niveau">Niveau</span></li>
                           </ul>
                           <div class="sousMenu">
                              <input type="hidden" name="niveau">
                              <ul>
                                 <li><span>Instruction en famille</span></li>
                                 <li><span>Maternelle</span></li>
                                 <li><span>Primaire</span></li>
                                 <li><span>Secondaire artistique</span></li>
                                 <li><span>Secondaire général</span></li>
                                 <li><span>Secondaire professionnel</span></li>
                                 <li><span>Secondaire technique</span></li>
                                 <li><span>Spécialisation</span></li>
                                 <li><span>Supérieur de type court</span></li>
                                 <li><span>Supérieur de type long</span></li>
                                 <li><span>Promotion sociale</span></li>
                                 <li><span>Universitaire</span></li>
                              </ul>
                           </div>
                        </div>
                        <h4>Votre matière</h4>
                        <?php if (isset($erreurs['matiere'])) {echo $erreurs['matiere'];} ?> <!-- erreur -->
                        <div class="menuDeroulant">
                           <ul>
                              <li><span id="matiere">Matière</span></li>
                           </ul>
                           <div class="sousMenu">
                              <input type="hidden" name="matiere">
                              <ul>
                                 <li><span>Allemand</span></li>
                                 <li><span>Anglais</span></li>
                                 <li><span>Biologie</span></li>
                                 <li><span>Chimie</span></li>
                                 <li><span>Comptabilité</span></li>
                                 <li><span>Économie</span></li>
                                 <li><span>EDM</span></li>
                                 <li><span>Espagnol</span></li>
                                 <li><span>Éveil</span></li>
                                 <li><span>Français</span></li>
                                 <li><span>Géographie</span></li>
                                 <li><span>Histoire</span></li>
                                 <li><span>Informatique</span></li>
                                 <li><span>Latin</span></li>
                                 <li><span>Mathématiques</span></li>
                                 <li><span>Musique</span></li>
                                 <li><span>Néerlandais</span></li>
                                 <li><span>Philosophie</span></li>
                                 <li><span>Physique</span></li>
                                 <li><span>Sciences</span></li>
                                 <li><span>Social</span></li>
                                 <li><span>Sport</span></li>
                                 <li><span>Technologie</span></li>
                              </ul>
                           </div>
                        </div>
                        <h4>Votre adresse</h4>
                        <?php if (isset($erreurs['adresse'])) {echo $erreurs['adresse'];} ?> <!-- erreur -->
                        <input type="text" name="adresse" id="citySearch" value="<?php if (isset($adresse)) {echo $adresse;} ?>"> <!-- on garde en mémoir l'adresse précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        <h4>Votre <?php if ($statut == 'Professeur') {echo "salaire horaire";}else {echo "tarif horaire maximum";}?></h4>
                        <!-- Si le statut est prof on affiche "salaire horaire", si non "tarif horaire maximum" -->
                        <?php if (isset($erreurs['tarif'])) {echo $erreurs['tarif'];} ?> <!-- erreur -->
                        <div class="menuDeroulant">
                           <ul>
                              <li><span id="tarif">Tarif</span></li>
                           </ul>
                           <div class="sousMenu">
                              <input type="hidden" name="tarif"> 
                              <ul>
                                 <li><span>5€</span></li>
                                 <li><span>10€</span></li>
                                 <li><span>20€</span></li>
                                 <li><span>30€</span></li>
                                 <li><span>40€</span></li>
                                 <li><span>50€</span></li>
                                 <li><span>60€</span></li>
                              </ul>
                           </div>
                        </div>
                        <h4>Vos disponibilités</h4>
                        <?php if (isset($erreurs['horaire'])) {echo $erreurs['horaire'];} ?> <!-- erreur -->
                        <div class="agenda-inscription">
                           <table>
                              <tr>
                                 <th></th>
                                 <th>Lu</th>
                                 <th>Ma</th>
                                 <th>Me</th>
                                 <th>Je</th>
                                 <th>Ve</th>
                                 <th>Sa</th>
                                 <th>Di</th>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">6 - 9h</th>
                                 <td><input type="checkbox" name="horaire[0]" id="style-box1">
                                    <label for="style-box1"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[1]" id="style-box2">
                                    <label for="style-box2"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[2]" id="style-box3">
                                    <label for="style-box3"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[3]" id="style-box4">
                                    <label for="style-box4"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[4]" id="style-box5">
                                    <label for="style-box5"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[5]" id="style-box6">
                                    <label for="style-box6"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[6]" id="style-box7">
                                    <label for="style-box7"></label>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">9 - 12h</th>
                                 <td><input type="checkbox" name="horaire[7]" id="style-box8">
                                    <label for="style-box8"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[8]" id="style-box9">
                                    <label for="style-box9"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[9]" id="style-box10">
                                    <label for="style-box10"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[10]" id="style-box11">
                                    <label for="style-box11"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[11]" id="style-box12">
                                    <label for="style-box12"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[12]" id="style-box13">
                                    <label for="style-box13"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[13]" id="style-box14">
                                    <label for="style-box14"></label>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">12 - 15h</th>
                                 <td><input type="checkbox" name="horaire[14]" id="style-box15">
                                    <label for="style-box15"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[15]" id="style-box16">
                                    <label for="style-box16"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[16]" id="style-box17">
                                    <label for="style-box17"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[17]" id="style-box18">
                                    <label for="style-box18"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[18]" id="style-box19">
                                    <label for="style-box19"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[19]" id="style-box20">
                                    <label for="style-box20"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[20]" id="style-box21">
                                    <label for="style-box21"></label>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">15 - 18h</th>
                                 <td><input type="checkbox" name="horaire[21]" id="style-box22">
                                    <label for="style-box22"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[22]" id="style-box23">
                                    <label for="style-box23"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[23]" id="style-box24">
                                    <label for="style-box24"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[24]" id="style-box25">
                                    <label for="style-box25"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[25]" id="style-box26">
                                    <label for="style-box26"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[26]" id="style-box27">
                                    <label for="style-box27"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[27]" id="style-box28">
                                    <label for="style-box28"></label>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">18 - 21h</th>
                                 <td><input type="checkbox" name="horaire[28]" id="style-box29">
                                    <label for="style-box29"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[29]" id="style-box30">
                                    <label for="style-box30"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[30]" id="style-box31">
                                    <label for="style-box31"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[31]" id="style-box32">
                                    <label for="style-box32"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[32]" id="style-box33">
                                    <label for="style-box33"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[33]" id="style-box34">
                                    <label for="style-box34"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[34]" id="style-box35">
                                    <label for="style-box35"></label>
                                 </td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">21 - 00h</th>
                                 <td><input type="checkbox" name="horaire[35]" id="style-box36">
                                    <label for="style-box36"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[36]" id="style-box37">
                                    <label for="style-box37"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[37]" id="style-box38">
                                    <label for="style-box38"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[38]" id="style-box39">
                                    <label for="style-box39"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[39]" id="style-box40">
                                    <label for="style-box40"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[40]" id="style-box41">
                                    <label for="style-box41"></label>
                                 </td>
                                 <td><input type="checkbox" name="horaire[41]" id="style-box42">
                                    <label for="style-box42"></label>
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <input type="submit" value="Suivant">
                     </form>
                     <form id="form-annulation" action="?annule=ok" method="POST">
                        <input type="submit" value="Annuler">
                     </form>
                     <div class="conditions">
                        <p>En vous inscrivant à iWanteacher, vous acceptez les <a href="#">Conditions d'utilisation</a> ainsi que la 
                           <a href="confidentialite.php">Politique de conﬁdentialité</a>.
                        </p>
                     </div>
                     <?php    
                        }
                        if ($_SESSION['inscription']['etape'] == 3) {
                           ?> <!-- Affichage du fomulaire de l'étape 3 -->
                     <h3>Inscription <span>3/3</span></h3>
                     <form id="form-inscription" class="page3" action="#content-inscription" method="POST">
                        <h4>Votre présentation</h4>
                        <div class="etape3-presentation">
                           <p>Ceci sera la première chose qui sera vue sur votre proﬁl, veillez donc à ce que ça soit irréprochable et ne négligez pas votre orthographe.</p>
                           <p>Présentez-vous brièvement en faisant part de vos motivations et indiquez votre expérience.</p>
                           <?php if (isset($erreurs['presentation'])) {echo '<span class="error">'.$erreurs['presentation'].'</span>';} ?> <!-- erreur -->
                           <textarea name="presentation" id="presentation" placeholder="Laissez parler votre plume..."><?php if (isset($presentation)) {echo $presentation;} ?></textarea>
                           <!-- on garde en mémoir la présentation précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        </div>
                        <h4>Détails sur votre profil</h4>
                        <div class="etape3-age">
                           <label for="age">Quel âge avez-vous ?</label>
                           <input type="text" <?php if (isset($erreurs['age'])) {echo 'style="color: #e74c3c; border-color: #e74c3c"';} ?> name="age" id="age" placeholder="<?php if (isset($erreurs['age'])) {echo $erreurs['age'];} else {echo "43 ans";} ?>" value="<?php if (isset($age)) {echo $age;} ?>"> <!-- erreur spécifiée dans le placeholder et border de l'input -->
                        </div>
                        <div class="etape3-permis">
                           <span>Disposez-vous du permis de conduire ?</span>
                           <input type="radio" id="permis-oui" name="permis" value="Oui">
                           <label for="permis-oui">Oui</label>
                           <input type="radio" id="permis-non" name="permis" value="Non" checked>
                           <label for="permis-non">Non</label>
                        </div>
                        <div class="etape3-fumeur">
                           <span>Êtes-vous fumeur ?</span>
                           <input type="radio" id="fumeur-oui" name="fumeur" value="Oui">
                           <label for="fumeur-oui">Oui</label>
                           <input type="radio" id="fumeur-non" name="fumeur" value="Non" checked>
                           <label for="fumeur-non">Non</label>
                        </div>
                        <?php    
                           if ($statut == 'Professeur') {
                              ?> <!-- On affiche ce qui suit uniquement si on a le statut professeur -->
                        <div class="etape3-materiel">
                           <span>Avez-vous du matériel à dispositon ?</span>
                           <input type="radio" id="materiel-oui" name="materiel" value="Oui">
                           <label for="materiel-oui">Oui</label>
                           <input type="radio" id="materiel-non" name="materiel" value="Non" checked>
                           <label for="materiel-non">Non</label>
                        </div>
                        <div class="etape3-experience">
                           <label for="exp">Quelles-sont vos années d'expérience ?</label>
                           <input type="text" <?php if (isset($erreurs['exp'])) {echo 'style="color: #e74c3c; border-color: #e74c3c"';} ?> name="exp" id="exp" placeholder="<?php if (isset($erreurs['exp'])) {echo $erreurs['exp'];} else {echo "10 ans";} ?>" value="<?php if (isset($exp)) {echo $exp;} ?>"> <!-- erreur spécifiée dans le placeholder et border de l'input -->
                        </div>
                        <?php    
                           } 
                           ?>
                        <div class="etape3-cours">
                           <span><?php if ($statut == 'Professeur') {echo "Quel type de cours donnez-vous ?"; } else {echo "Quel type de cours voulez-vous ?"; } ?></span> <!-- Si le statut est prof on affiche "Quel type de cours donnez-vous ?", si non "Quel type de cours voulez-vous ?" -->
                           <input type="radio" id="cours-seul" name="cours" value="Seul">
                           <label for="cours-seul">Seul</label>
                           <input type="radio" id="cours-groupe" name="cours" value="Groupe">
                           <label for="cours-groupe">Groupe</label>
                           <input type="radio" id="cours-2" name="cours" value="Seul ou en groupe" checked>
                           <label for="cours-2">Seul ou en groupe</label>
                        </div>
                        <div class="etape3-deplacements">
                           <span>Effectuez-vous des déplacements ?</span>
                           <input type="radio" id="deplacement-oui" name="deplacement" value="Oui">
                           <label for="deplacement-oui">Oui</label>
                           <input type="radio" id="deplacement-non" name="deplacement" value="Non" checked>
                           <label for="deplacement-non">Non</label>
                           <input type="text" <?php if (isset($erreurs['dp_km'])) {echo 'style="color: #e74c3c; border-color: #e74c3c"';} ?> name="dp_km" id="dp_km" placeholder="<?php if (isset($erreurs['dp_km'])) {echo $erreurs['dp_km'];} else {echo "10 Km";} ?>" value="<?php if (isset($dp_km)) {echo $dp_km;} ?>"> <!-- erreur spécifiée dans le placeholder et border de l'input -->
                        </div>

                        <?php    
                           if ($statut == 'Professeur') {
                              ?> <!-- On affiche ce qui suit uniquement si on a le statut professeur -->
                        <div class="etape3-lieu">
                           <label for="lieu">Où se donneront vos cours ?</label>
                           <input type="text" <?php if (isset($erreurs['lieu'])) {echo 'style="color: #e74c3c; border-color: #e74c3c"';} ?> name="lieu" id="lieu" placeholder="<?php if (isset($erreurs['lieu'])) {echo $erreurs['lieu'];} else {echo "À mon domicile";} ?>" value="<?php if (isset($lieu)) {echo $lieu;} ?>"> <!-- erreur spécifiée dans le placeholder et border de l'input -->
                        </div>
                        <h4>Votre parcours de formation</h4>
                        <div class="etape3-niveau">
                           <label for="etude">Quel est votre niveau d'études ?</label>
                           <input type="text" name="etude" id="etude" placeholder="Primaire" value="<?php if (isset($etude)) {echo $etude;} ?>"> <!-- on garde en mémoir le niveau d'étude précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        </div>
                        <div class="etape3-activite">
                           <label for="activite">Quelle est votre activité actuellement ?</label>
                           <input type="text" name="activite" id="activite" placeholder="Retraité" value="<?php if (isset($activite)) {echo $activite;} ?>"> <!-- on garde en mémoir l'activité précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        </div>
                        <div class="etape3-langue">
                           <label for="langue">Quelle(s) langue(s) parlez-vous?</label>
                           <input type="text" name="langue" id="langue" placeholder="Français, Anglais" value="<?php if (isset($langue)) {echo $langue;} ?>"> <!-- on garde en mémoir les langues précédemment taper si il y a une erreur afin de ne pas devoir le retaper-->
                        </div>
                        <?php    
                           } 
                           ?> 
                        <input type="submit" value="Suivant" <?php if ($statut != 'Professeur' && $_SESSION['inscription']['etape'] == 3) {echo "class='notProf'";} ?>>
                     </form>
                     <form id="form-annulation" action="?annule=ok" method="POST">
                        <input type="submit" value="Annuler">
                     </form>
                     <div class="conditions">
                        <p>En vous inscrivant à iWanteacher, vous acceptez les <a href="#">Conditions d'utilisation</a> ainsi que la 
                           <a href="confidentialite.php">Politique de conﬁdentialité</a>.
                        </p>
                     </div>
                     <?php    
                        } 
                        if ($_SESSION['inscription']['etape'] == 5) {
                           ?> <!-- Affichage du message de l'étape 5 -->
                     <div class="confirmation-inscription">
                        <p class="inscrit">L'inscription est terminée, vous allez recevoir un mail de confirmation...</p>
                     </div>
                     <?php 
                        // On vide les données en mémoir du form vu qu'elles sont envoyés vèrs la base de donnée
                        $_SESSION['inscription'] = array(); 
                        $_POST = array();
                        // Après 5 secondes la page est redirigée automatiquement vers index.php
                        echo '<meta http-equiv="Refresh" content="5;URL=index.php">';
                        } 
                        ?>
                  </div>
                  <!-- End container-->
               </section>
               <!-- Fin content1 -->
               <footer id="footer">
                  <div class="container clearfix">
                     <div class="colonne1">
                        <h5>A propos du projet</h5>
                        <ul>
                           <li><a href="#">Conditions d'utilisation</a></li>
                           <li><a href="confidentialite.php">Politique de confidentialité</a></li>
                        </ul>
                        <p>© iWanteacher 2014 - Tous droits réservés, créé par <a href="http://www.dimarco-christina.be/">Christina Di Marco</a></p>
                     </div>
                     <!-- End colonne1-->
                     <div class="colonne2">
                        <h5>Remerciements</h5>
                        <ul>
                           <li>Tous les professeurs de DWM</li>
                           <li>Ma famille pour sa participation</li>
                           <li><a href="http://www.dimarco-christina.be/tfe/credits.html">Crédits</a></li>
                        </ul>
                     </div>
                     <!-- End colonne2 -->
                     <div class="colonne3">
                        <h5>Nous contacter</h5>
                        <ul>
                           <li>Tél.: +32 (0)81 10 92 51</li>
                           <li><a href="mailto:iwanteacher@info.be">iwanteacher@info.be</a></li>
                           <li><a href="#" class=" twitter">@iWanteacher</a></li>
                        </ul>
                     </div>
                     <!-- End colonne3 -->
                  </div>
                  <!-- End container -->
               </footer>
               <script type="text/javascript" src="js/champ-geolocalisation.js"></script>
               <script type="text/javascript" src="js/script-1.js"></script>
            </body>
         </html>