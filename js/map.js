function initialize() {
    map = new google.maps.Map(document.getElementById("map_canvas"), {
          zoom: 15,
          center: new google.maps.LatLng(50.503887, 4.4699359999999615),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          //désactive le zoom de la souris
          scrollwheel: false,
          //empêche l'utilisateur de faire glisser la carte
          draggable:false,
          //désactive les boutons de contrôle
          disableDefaultUI: true
        });   
  } 
   
  if (navigator.geolocation)
    var watchId = navigator.geolocation.watchPosition(successCallback,
                              null,
                              {enableHighAccuracy:true});
  else
    alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");    
   
  function successCallback(position){
    map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));

    var image = {
    url: 'imgs/marqueur.png',
    size: new google.maps.Size(40, 56),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 20)
};
    
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude), 
      map: map,
      icon: image
    }); 
   }