$(document).ready(function() {
    setTimeout(clickbutton, 5000);
    initMap();
    
});
function initMap() {
    const map = new google.maps.Map(mapDiv, {
       center: { lat: -34.397, lng: 150.644 },
       zoom: 20,
    });
 
    const marker = new google.maps.Marker({
       position: { lat: -34.397, lng: 150 },
       map,
    });
 
       if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
             ({ coords: { latitude, longitude } }) => {
                //console.log(;
                const coords = {
                   lat: latitude,
                   lng: longitude,
                };
 
              
               map.setCenter(coords);
               map.setZoom(8);
               marker.setPosition(coords);
               console.log(coords);
             },
             () => {
                console.log("Tu navegador esta bien pero ocurrio un error");
             })
       } else {
          alert('Geolocation is not supported by this browser.');
 
       }
   
 
 }
 