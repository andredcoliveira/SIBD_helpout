  <style>
    <?php include('css/map.css'); ?>
  </style>
  <div class="google_api">
    <div id="floating-panel">
      <input id="address" type="textbox" value="<?=$request['location']?>" readonly>
      <span><?=$request['location']?></span>
    </div>
    <div id="map"></div>
    <script type="text/javascript">
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12
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

      /*
      var p1 = new google.maps.LatLng(45.463688, 9.18814);
      var p2 = new google.maps.LatLng(46.0438317, 9.75936230000002);

      alert(calcDistance(p1, p2));

      //calculates distance between two points in km's
      function calcDistance(p1, p2) {
        return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
      }
      */

    </script>
    <script type="text/javascript" async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE_UlQuw6zj8Xg-FKYNP1PemRTwLtiz5k&callback=initMap&libraries=geometry">
    </script>
  </div>
