$(document).ready(function() {

	// Champ-click.js
	$('.menuDeroulant').children('ul').children('li').children('span').click(function() {  
	var sousMenu = $(this).parent('li').parent('ul').next('.sousMenu'); 
	if (sousMenu.css('display') == 'none') { sousMenu.css('display','block') } 
	else { sousMenu.css('display','none') } 
	return false; 
	});

	// content-opacity.js
	$('.connexion').click(function(e){
		e.preventDefault();
		$('#login,#content-opacity').fadeIn(200);
	});
	
	$("#content-opacity").click(function(e){
		if(e.target != this) return; 
		$(this).fadeOut(200);
	});

	// filename.js
	$('#photo').change(function () { 
		$(this).next('.filename').text($(this).val().split("\\").pop());
	}) 

	// statut.js
	$('.sousMenu').children('ul').children('li').children('span').click(function(){
	$(this).parents('.sousMenu').children('input').val($(this).text());
	$(this).parents('.sousMenu').prev('ul').children('li').children('span').text($(this).text());
	$(this).parents('.sousMenu').css('display','none');
	})

});