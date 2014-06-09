<?php 
   // La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
   require 'include/config.inc.php';
   include("include/ckeck.session.runtime.php");
   // Vérification qu'il y a un id dans l'url si pas, la page retourne sur index.php
   if (!empty($_GET['id'])) { $id_profil = $_GET['id']; } else {header('Location: index.php'); }
   // Préparation de la requête à faire en récupérant toutes les infos liées à l'id. limit 0,1 est une sécurité qui fait primer la première id si il y en a 2 les mêmes (casi impossible)
   $req = $bdd->prepare("SELECT * FROM `users` WHERE id = '".$id_profil."' LIMIT 0 , 1");
   // On exécute la requête
   $req->execute();
   // On récupère toutes les données pour les mettres dans un tableau (Array donc plusieurs valeurs dans 1 seule variable)
   $res = $req->fetchAll();
   // Si aucune donnée n'est récupérée, on retombe sur la page index.php
   if (empty($res)) { header('Location: index.php'); }
   // On trie le tableau dans un tableau, donc en gros si 2 personnes on la même variable (nom) on récupère les infos et un id est attribué auto suivant l'ordre des 2 variables (0 ou 1)
   // Donc pour ne pas devoir aller dans le sous-tableau de tableau, on "remonte" le sous-tableau pour y avoir accès plus facilement.
   $res = $res[0];
   // On coupe la chaine de carractères par rapport aux "," donc en gros pour trier l'agenda entre la suite de 0 et de 1, on sépare les données entre chaque virdule pour les gerer indépendemment
   $h = explode(',', $res['horaire']);
   // On récupère le statut afin d'adapter la page et ces infos par rapport à son statut
   $statut = $res['statut'];
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
               <title>iWanteacher | Mon profil</title>
               <meta name="keywords" content="esiaj, web design, échecs, école, students, étudiants, teachers, profs, parents, témoignages, évaluations, experience" />
               <meta name="description" content="iWanteacher, à la recherche d'un prof particulier" />
               <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
               <meta name="apple-mobile-web-app-capable" content="yes"/>
               <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
               <link rel="stylesheet" type="text/css" href="css/reset.css"/>
               <link rel="stylesheet" type="text/css" href="css/styles.css"/>
               <link rel="stylesheet" type="text/css" href="css/hugrid.css" />
               <link rel="icon" type="image/png" href="imgs/favicon.ico" />
               <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'/>
               <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
               <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
            </head>
            <body class="profil">
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
                              <li class="nologged"><a href="profil.php?id=<?php echo $id ?>" class="active">Mon profil</a></li>
                              <?php } else { ?> <!-- ne s'affiche que si la personne n'est pas connectée -->
                              <li class="nologged connexion"><a href="login.php">Se connecter</a></li>
                              <li class="nologged"><a href="inscription.php">S'inscrire</a></li>
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
               <section id="banner-cours" class="clearfix">
                  <img src="<?php if ($res['matiere'] == 'Mathématiques') { echo 'imgs/math2.png'; } else { echo 'imgs/francais1.png'; } ?>" alt="Banner cours"/>
               </section>
               <!-- end map -->
               <div class="container clearfix">
                  <section id="p-user">
                     <h2><strong><?php echo $res['prenom'].' '.$res['nom'] ?>,</strong> <span><?php echo $res['statut'] ?></span></h2>
                  </section>
                  <?php if ($id == $_GET['id']) { ?> <!-- Si id de la session est la même que l'id de l'url, donc qu'on est bien connecté, on affiche le sous-menu -->
                  <ul class="back-list">
                     <li><a href="#">Désinscrire</a></li>
                     <li><a href="inscription.php">Éditer</a></li>
                     <?php if ($statut != 'Professeur') { ?> <!-- Si on n'a pas le statut prof, la suite peut s'afficher-->
                     <li><a href="favoris.php">Favoris<sup> 3</sup></a></li>
                     <li><a href="recherche.php">Annonces</a></li>
                     <?php } ?> <!-- Fin de conditions -->
                  </ul>
                  <?php } 
                     else {
                     ?> <!-- Si la condition n'est pas réalisé, donc si id de session est diff de id de la page (url) alors la suite est affiché donc en gros le statut sera affiché comme si on le visitait et non comme le notre -->
                  <div class="back-list">
                     <a href="recherche.php">Retour à la liste</a>
                  </div>
                  <?php } ?>
                  <!--profil -->
                  <aside class="sidebar">
                     <div class="informations-user">
                        <span class="photo-profil">
                           <img src="imgs/<?php echo $res['photo'] ?>" alt="<?php echo $res['prenom'].' '.$res['nom'] ?>"> <!-- récupération de la photo de profil -->
                        </span>
                        <h4>Informations</h4>
                        <ul>
                           <li class="icone-niveau"><?php echo $res['niveau'] ?></li>
                           <!-- récupération -->
                           <li class="icone-matiere"><?php echo $res['matiere'] ?></li>
                           <!-- récupération -->
                           <li class="icone-ville"><?php echo $res['adresse'] ?></li>
                           <!-- récupération -->
                           <li class="icone-coeur">30 coups de coeur</li>
                        </ul>
                     </div>
                     <div class="tarif-user">
                        <h4>Tarif</h4>
                        <ul>
                           <li class="icone-tarif"><?php echo $res['tarif'] ?><span> / H</span></li>
                           <!-- récupération -->
                        </ul>
                     </div>
                     <div class="agenda-user">
                        <h4>Agenda</h4>
                        <table>
                           <thead>
                              <tr class="t-bg">
                                 <th>&nbsp;</th>
                                 <th>L</th>
                                 <th>M</th>
                                 <th>M</th>
                                 <th>J</th>
                                 <th>V</th>
                                 <th>S</th>
                                 <th>D</th>
                                 <th>&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <th class="tranches-heures">6-9h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[0] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[1] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[2] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[3] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[4] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[5] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[6] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr class="t-bg">
                                 <th class="tranches-heures">9-12h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[7] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[8] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[9] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[10] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[11] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[12] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[13] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">12-15h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[14] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[15] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[16] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[17] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[18] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[19] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[20] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr class="t-bg">
                                 <th class="tranches-heures">15-18h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[21] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[22] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[23] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[24] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[25] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[26] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[27] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <th class="tranches-heures">18-21h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[28] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[29] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[30] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[31] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[32] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[33] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[34] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr class="t-bg">
                                 <th class="tranches-heures">21-00h</th>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[35] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[36] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[37] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[38] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[39] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[40] == 0) {echo "d-none";} ?>"></td>
                                 <td><img src="imgs/icone-agenda_valide.png" alt="icone jour dispo" class="<?php if ($h[41] == 0) {echo "d-none";} ?>"></td>
                                 <td>&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="suivi-user">
                        <h4>Suivi par 2 personnes</h4>
                        <ul>
                           <li><a href="profil.php?id=13" title="user-maria"><img src="imgs/user-maria.png" alt="Maria Del Rio"></a></li>
                           <li><a href="profil.php?id=11" title="user-christina"><img src="imgs/user-christina.png" alt="Christina Di Marco"></a></li>
                        </ul>
                     </div>
                  </aside>
                  <article class="main-content">
                     <h3>Présentation</h3>
                     <p><?php echo $res['presentation'] ?></p>
                     <!-- récupération -->
                     <h3>Détails du proﬁl</h3>
                     <ul class="details-profil">
                        <li><span>Age :</span> <i><?php echo $res['age'] ?> ans</i></li>
                        <!-- récupération -->
                        <li><span>Permis de conduire :</span> <?php echo $res['permis'] ?></li>
                        <!-- récupération -->
                        <li><span>Fumeur :</span> <?php echo $res['fumeur'] ?></li>
                        <!-- récupération -->
                        <?php if ($statut == 'Professeur') { ?> <!-- Si le statut est reconnu comme professeur, la suite peut alors être affiché -->
                        <li><span>Matériel à disposition :</span> <?php echo $res['materiel'] ?></li>
                        <!-- récupération -->
                        <li><span>Années d'expérience :</span> <?php echo $res['exp'] ?> ans</li>
                        <!-- récupération -->
                        <?php } ?>
                        <li><span>Type de cours :</span> <?php echo $res['cours'] ?></li>
                        <!-- récupération -->
                        <li><span>Déplacement :</span> <?php if ($res['deplacement'] == 'Oui') { echo $res['dp_km'].' km'; } else { echo 'Non'; }?></li>
                        <!-- récupération -->
                        <?php if ($statut == 'Professeur') { ?> <!-- Si le statut est reconnu comme professeur, la suite peut alors être affiché -->
                        <li><span>Lieux des cours :</span> <?php echo $res['lieu'] ?></li>
                        <!-- récupération -->
                        <?php } ?>
                     </ul>
                     <?php if ($statut == 'Professeur') { ?> <!-- Si le statut est reconnu comme professeur, la suite peut alors être affiché -->
                     <h3>Parcours de formation</h3>
                     <ul class="formation">
                        <li><span>Niveau d’études :</span> <i><?php echo $res['etude'] ?></i></li>
                        <!-- récupération -->
                        <li><span>Activité actuelle :</span> <?php echo $res['activite'] ?></li>
                        <!-- récupération -->
                        <li><span>Langues :</span> <?php echo $res['langue'] ?></li>
                        <!-- récupération -->
                     </ul>
                     <h3>Les évaluations</h3>
                     <div class="bloc-temoins">
                        <!-- End bg-temoins-->
                        <div class="bg-temoins">
                           <a href="profil.php?id=11">
                              <div class="img-temoins2">
                                 <ul>
                                    <li class="identite">Christina Di Marco, <span>1 septembre 2014</span></li>
                                    <li class="statut">Élève</li>
                                    <li class="commentaire">“Avant, j’étais souvent en échec et je n’avais pas une bonne méthode de travail, mais ça, c’était avant!”</li>
                                 </ul>
                              </div>
                           </a>
                           <!-- End img-temoins-->
                           <div class="options-statut">
                              <ul>
                                 <li class="messages"><a href="#">2</a></li>
                                 <li class="reponses"><a href="#">1</a></li>
                              </ul>
                           </div>
                           <!-- End options-statut -->
                        </div>
                        <!-- End bg-temoins-->
                        <div class="bg-temoins">
                           <a href="profil.php?id=13">
                              <div class="img-temoins3">
                                 <ul>
                                    <li class="identite">Maria Del Rio, <span>12 juillet 2014</span></li>
                                    <li class="statut">Parent</li>
                                    <li class="commentaire">“Je suis la maman d’une jeune étudiante en difficulté qui a réussi à s’en sortir grâce à votre aide. Merci!”</li>
                                 </ul>
                              </div>
                           </a>
                           <!-- End img-temoins-->
                           <div class="options-statut">
                              <ul>
                                 <li class="messages"><a href="#">10</a></li>
                                 <li class="reponses"><a href="#">4</a></li>
                              </ul>
                           </div>
                           <!-- End options-statut -->
                        </div>
                        <!-- End bg-temoins-->
                     </div>
                     <?php } ?>
                     <!-- End bloc-temoins-->
                  </article>
               </div>
               <!-- End container -->
               <div class="contact-profil">
               <div class="container clearfix">
               <h3>Prendre contact</h3>
               <form id="form_contact" action="profil.php?id=<?php echo $id ?>#form_contact" method="post">
               <?php
                  include("include/form.profil.runtime.php");
                  include("include/error.display.php"); 
                  ?>
                  <div class="sujet">
                     <fieldset>
                        <label for="sujet">L’objet du message</label>
                        <input type="text" name="sujet" id="sujet" placeholder="Sujet">
                     </fieldset>
                     <fieldset>
                        <label for="message">Votre message</label>
                        <textarea name="message" id="message" placeholder="N’oubliez pas d’écrire vos coordonnées pour être recontacté"></textarea>
                     </fieldset>
                     <fieldset>
                        <input type="hidden" name="form" value="contact" />
                     </fieldset>
                     <fieldset>  
                        <button type="submit" class="btn-envoyer">Envoyer</button>
                     </fieldset>
                  </div>
                  </form>
               </div>
            </div>
            <!-- End container -->
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
               <script type="text/javascript" src="js/hugrid.js"></script>
               <script type="text/javascript" src="js/form.js"></script>
            </body>
         </html>