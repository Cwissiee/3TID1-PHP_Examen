$(document).ready(function() {
	var input = document.getElementById("citySearch");
	var options = {
		types: ['(regions)'],
		componentRestrictions: {country: 'be'}
	};
	var autocomplete = new google.maps.places.Autocomplete(input,options);
 });
