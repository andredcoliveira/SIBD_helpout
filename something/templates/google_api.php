  <style>
    <?php include('css/map.css'); ?>
  </style>
  <div class="google_api">
    <div id="floating-panel">
      <input id="address" type="textbox" value="Porto, Portugal" readonly>
    </div>
    <div id="map"></div>
    <script type="text/javascript">
      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 41.1622023, lng: -8.6569732}
        });
        var geocoder = new google.maps.Geocoder();

        geocodeAddress(geocoder, map);

      }

      function geocodeAddress(geocoder, resultsMap) {

        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Ocorreu um erro na procura do endereço: ' + status);
          }
        });

      }
    </script>
    <script type="text/javascript" async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE_UlQuw6zj8Xg-FKYNP1PemRTwLtiz5k&callback=initMap">
    </script>
  </div>
