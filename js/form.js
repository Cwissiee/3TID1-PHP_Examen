$(document).ready(function() {

		
 	//Quand je vais valider/soumettre mon formulaire.
	$("#form_contact").submit(function() {	

		//Vérification à la fin du formulaire pour voir s' il y a un champ vide (erreur).
		var error = false;

		// On vérifie si la valeur du champ input avec comme id "sujet" est vide et là il va récupérer "val" donc 
		//la valeur du formulaire et puis "length" pour vérifier si il y a une taille et si la taille est à 0 il va mettre le champ en rouge.
  		if (!$("input[id='sujet']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

 			//L'imput name met une bordure rouge et un commentaire.
   			$("input[id='sujet']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}
 		// Si la condition ci-dessus n'est pas respectée on va voir le else.
 		//Si le champ n'est pas vide, il met un contour #ccc autour de celui-ci.
 		else {
 		$("input[id='sujet']").css("border-color", "#3D464D");
		}

		//On recommence l'opération avec le suivant.
  		if (!$("textarea[id='message']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

   			$("textarea[id='message']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}

 		else {
 		$("textarea[id='message']").css("border-color", "#3D464D");
		}


		//Si pas d'erreurs, le formulaire s'envoie pas si une erreur, il ne s'enverra pas jusqu'à la correction de celle-ci.
		if (error) { return false; } else {return true; }
 });

//Quand je vais valider/soumettre mon formulaire.
	$("#form_contact2").submit(function() {	

		//Vérification à la fin du formulaire pour voir s' il y a un champ vide (erreur).
		var error = false;

		// On vérifie si la valeur du champ input avec comme id "sujet" est vide et là il va récupérer "val" donc 
		//la valeur du formulaire et puis "length" pour vérifier si il y a une taille et si la taille est à 0 il va mettre le champ en rouge.
  		if (!$("input[id='sujet']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

 			//L'imput name met une bordure rouge et un commentaire.
   			$("input[id='sujet']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}
 		// Si la condition ci-dessus n'est pas respectée on va voir le else.
 		//Si le champ n'est pas vide, il met un contour #ccc autour de celui-ci.
 		else {
 		$("input[id='sujet']").css("border-color", "#3D464D");
		}

		if (!$("input[id='nom']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

 			//L'imput name met une bordure rouge et un commentaire.
   			$("input[id='nom']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}
 		// Si la condition ci-dessus n'est pas respectée on va voir le else.
 		//Si le champ n'est pas vide, il met un contour #ccc autour de celui-ci.
 		else {
 		$("input[id='nom']").css("border-color", "#3D464D");
		}

		if (!$("input[id='prenom']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

 			//L'imput name met une bordure rouge et un commentaire.
   			$("input[id='prenom']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}
 		// Si la condition ci-dessus n'est pas respectée on va voir le else.
 		//Si le champ n'est pas vide, il met un contour #ccc autour de celui-ci.
 		else {
 		$("input[id='prenom']").css("border-color", "#3D464D");
		}

		if (!$("input[id='email']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

 			//L'imput name met une bordure rouge et un commentaire.
   			$("input[id='email']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}
 		// Si la condition ci-dessus n'est pas respectée on va voir le else.
 		//Si le champ n'est pas vide, il met un contour #ccc autour de celui-ci.
 		else {
 		$("input[id='email']").css("border-color", "#3D464D");
		}

		//On recommence l'opération avec le suivant.
  		if (!$("textarea[id='message']").val().length) {

 			//Vérifier qu'il y a une erreur.
 			error = true;

   			$("textarea[id='message']").css({ color: "#e74c3c", borderColor: "#e74c3c" }).attr("placeHolder", "Ce champ est vide !");
  		}

 		else {
 		$("textarea[id='message']").css("border-color", "#3D464D");
		}


		//Si pas d'erreurs, le formulaire s'envoie pas si une erreur, il ne s'enverra pas jusqu'à la correction de celle-ci.
		if (error) { return false; } else {return true; }
 });

});