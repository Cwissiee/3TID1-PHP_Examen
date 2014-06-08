<?php 
   // On vérifie que la variable session compte id existe
   if (isset($_SESSION['compte']['id'])) {
      // dans la variable id on insère session compte id qui vérifie si la personne est connectée
      $id = $_SESSION['compte']['id'];
   }
   else {
      $id = false;
   }
   ?>