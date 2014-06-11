<?php 
   // La page doit récupérer le fichier config.inc.php qui contient mes identifiants et les protèges si non rien ne s'affiche 
   require 'include/config.inc.php';
   include("include/ckeck.session.runtime.php");
   // Préparation de la requête à faire en récupérant toutes les infos liées à l'id. limit 0,1 est une sécurité qui fait primer la première id si il y en a 2 les mêmes (casi impossible)
   $req = $bdd->prepare("SELECT * FROM `users` WHERE id = '".$id."' LIMIT 0 , 1");
   // On exécute la requête
   $req->execute();
   // On récupère toutes les données pour les mettres dans un tableau (Array donc plusieurs valeurs dans 1 seule variable)
   $res = $req->fetchAll();
   // On trie le tableau dans un tableau, donc en gros si 2 personnes on la même variable (nom) on récupère les infos et un id est attribué auto suivant l'ordre des 2 variables (0 ou 1)
   // Donc pour ne pas devoir aller dans le sous-tableau de tableau, on "remonte" le sous-tableau pour y avoir accès plus facilement.
   $res = $res[0];
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
               <title>iWanteacher | Mes favoris</title>
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
               <div id="slogan">
                  <p class="selection-favoris">Voici votre sélection de professeurs particuliers</p>
               </div>
               <section id="banner-cours" class="clearfix favoris-banner">
                  <img src="<?php if ($res['matiere'] == 'Mathématiques') { echo 'imgs/math2.png'; } else { echo 'imgs/francais1.png'; } ?>" alt="Banner cours"/> <!-- On récupère les données concernant la matière afin d'adapter la benner-->
               </section>
               <!-- end map -->
               <!-- Champs de recherche -->
               <section id="recherche-favoris">
                  <div class="container clearfix">
                     <form action="recherche.php" method="post">
                        <div class="champ-recherche">
                           <div class="chp-ville">
                              <input type="text" id="citySearch" placeholder="Ville ou Code postal"/>
                           </div>
                           <div class="menuDeroulant">
                              <ul>
                                 <li class="title"><span>Matière</span></li>
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
                           <div class="menuDeroulant">
                              <ul>
                                 <li class="title"><span>Niveau</span></li>
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
                           <input type="submit" value="Recherche" class="submit" name="submit">
                        </div>
                     </form>
                  </div>
               </section>
               <!-- Fin Champs de recherche -->
               <section id="content-favoris">
                  <div class="container clearfix">
                     <h3>Vos favoris</h3>
                  </div>
                  <!-- End container-->
                  <div class="bloc-temoins favoris">
                     <div class="bg-temoins">
                        <div class="container clearfix">
                           <a href="profil.php?id=10">
                              <div class="img-temoins1">
                                 <ul>
                                    <li class="identite">Elisa Hernandez</li>
                                    <li class="statut">20€ / h</li>
                                    <li class="icone-niveau"><span>Niveau:</span> Supérieur de type court</li>
                                    <li class="icone-matiere"><span>Matière:</span> Mathématiques</li>
                                    <li class="icone-ville"><span>Ville:</span> Namur</li>
                                 </ul>
                              </div>
                           </a>
                           <!-- End img-temoins-->
                           <div class="options-statut">
                              <ul>
                                 <li class="like"><a href="#">30</a></li>
                                 <li class="messages"><a href="#">87</a></li>
                                 <li class="reponses"><a href="#">11</a></li>
                              </ul>
                           </div>
                           <!-- End options-statut -->
                        </div>
                        <!-- End container-->
                     </div>
                     <!-- End bg-temoins-->
                     <div class="bg-temoins">
                        <div class="container clearfix">
                           <a href="profil.php?id=21">
                              <div class="img-temoins4">
                                 <ul>
                                    <li class="identite">Monique Fere</li>
                                    <li class="statut">30€ / h</li>
                                    <li class="icone-niveau"><span>Niveau:</span> Supérieur de type court</li>
                                    <li class="icone-matiere"><span>Matière:</span> Mathématiques</li>
                                    <li class="icone-ville"><span>Ville:</span> Namur</li>
                                 </ul>
                              </div>
                           </a>
                           <!-- End img-temoins-->
                           <div class="options-statut">
                              <ul>
                                 <li class="like"><a href="#">11</a></li>
                                 <li class="messages"><a href="#">14</a></li>
                                 <li class="reponses"><a href="#">10</a></li>
                              </ul>
                           </div>
                           <!-- End options-statut -->
                        </div>
                        <!-- End container-->
                     </div>
                     <!-- End bg-temoins-->
                     <div class="bg-temoins">
                        <div class="container clearfix">
                           <a href="profil.php?id=22">
                              <div class="img-temoins5">
                                 <ul>
                                    <li class="identite">Sebastien Neemans</li>
                                    <li class="statut">40€ / h</li>
                                    <li class="icone-niveau"><span>Niveau:</span> Supérieur de type long</li>
                                    <li class="icone-matiere"><span>Matière:</span> Mathématiques</li>
                                    <li class="icone-ville"><span>Ville:</span> Namur</li>
                                 </ul>
                              </div>
                           </a>
                           <!-- End img-temoins-->
                           <div class="options-statut">
                              <ul>
                                 <li class="like"><a href="#">5</a></li>
                                 <li class="messages"><a href="#">6</a></li>
                                 <li class="reponses"><a href="#">6</a></li>
                              </ul>
                           </div>
                           <!-- End options-statut -->
                        </div>
                        <!-- End container-->
                     </div>
                     <!-- End bg-temoins-->
                  </div>
                  <!-- End bloc-temoins-->
               </section>
               <!-- End content3-->
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
               <script type="text/javascript" src="js/script-1.js"></script>
               <script type="text/javascript" src="js/champ-geolocalisation.js"></script>
            </body>
         </html>