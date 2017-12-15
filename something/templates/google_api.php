  <style>
    <?php include('css/map.css'); ?>
  </style>
  <div class="google_api">
    <div id="floating-panel">
      <input id="address" type="textbox" value="<?=preg_replace("/[^a-zA-Z\s]/", '', $request['location']);?>" readonly>
      <span><?=$request['location']?></span>
    </div>
    <div id="map"></div>
    <script type="text/javascript" src="javascript/map.js"></script>
    <script type="text/javascript" async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE_UlQuw6zj8Xg-FKYNP1PemRTwLtiz5k&callback=initMap&libraries=geometry">
    </script>
  </div>
