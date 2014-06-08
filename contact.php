<?php 
  // Ouverture d'une nouvelle session, pour utiliser les variables session qui permettent l'échange d'infos entres les pages sans besoin de requêtes.
   session_start();
   include("include/ckeck.session.runtime.php");
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
               <title>iWanteacher | Contact</title>
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
                              <li class="nologged"><a href="inscription.php">S'inscrire</a></li>
                              <?php } ?>
                              <li class="nologged padnone"><a href="contact.php" class="active">Contact</a></li>
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
               <div id="slogan" class="banner-contact">
                  <p class="bienvenue-contact">Bienvenue sur iWanteacher,</p>
                  <p class="ecoute-contact">Nous sommes à votre écoute</p>
               </div>
               <section id="banner2" class="clearfix"></section>
               <hr>
               <!-- end map -->
               <section id="content-contact">
                  <div class="container clearfix">
                  <h3>Nous contacter</h3>
                  <div class="contact">
                     <div class="intro-contact">
                        <p>N'hésitez pas à nous contacter si vous avez la moindre question ou suggestion.</p>
                        <p>iWanteacher se tient à votre service.</p>
                     </div>
                     <div class="container clearfix">
                        <form id="form_contact2" action="contact.php#form_contact2" method="post">
                           <?php
                              include("include/form.contact.runtime.php");
                              include("include/error.display.php");
                           ?>
                           <div class="sujet">
                              <fieldset>
                                 <label for="sujet">L’objet du message<abbr title="Champs requis">*</abbr></label>
                                 <input type="text" name="sujet" id="sujet" placeholder="Sujet">
                                 <label for="nom">Votre nom<abbr title="Champs requis">*</abbr></label>
                                 <input type="text" name="nom" id="nom" placeholder="Nom">
                                 <label for="prenom">Votre prénom<abbr title="Champs requis">*</abbr></label>
                                 <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                                 <label for="email">Votre email<abbr title="Champs requis">*</abbr></label>
                                 <input type="text" name="email" id="email" placeholder="Email">
                              </fieldset>
                           </div>
                           <!-- End sujet -->
                           <div class="message">
                              <fieldset>
                                 <label for="message">Votre message<abbr title="Champs requis">*</abbr></label>
                                 <textarea name="message" id="message" placeholder="N’oubliez pas d’écrire vos coordonnées pour être recontacté"></textarea>
                              </fieldset>
                           </div><!-- End message -->
                           <fieldset>
                              <input type="hidden" name="form" value="contact" />
                           </fieldset>
                           <fieldset>  
                              <button type="submit" class="btn-envoyer">Envoyer</button>
                           </fieldset>
                        </form>
                     </div>
                     <!-- End contact -->
                  </div>
                  <!-- End container -->
               </div>
               </section>
               <!-- End content-contact-->
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
               <script type="text/javascript" src="js/script-1.js"></script>
               <script type="text/javascript" src="js/form.js"></script>
            </body>
         </html>