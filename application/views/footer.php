</main>
<footer class="site-footer">
  <p class="statement-of-authorship"><strong>StAuthcomp10125:</strong> I Chloe Reimer, 000280557 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.</p>
</footer>
<script src="<?php echo javascripts_url('modernizr/modernizr.js'); ?>"></script> <!-- yes yes this should be a custom modernizr eventually -->
<script src="<?php echo javascripts_url('jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo javascripts_url('application.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
  var map;

  function initializeGoogleMap() {
    var styles = [
      {
        stylers: [
          { hue: "#626c7a" },
          { saturation: -60 }
        ]
      },{
        featureType: "road",
        elementType: "geometry",
        stylers: [
          { saturation: -60 },
          { lightness: -30 },
          { visibility: "simplified" }
        ]
      },
    ];
    var mapOptions = {
      zoom: 12,
      center: new google.maps.LatLng(40.383164,-105.518294),
      styles: styles,
      scrollwheel: false,
    };
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  }
</script>
<script>
  $(document).ready(function(){
    SleepyMe.initializeStickyFooter();
    initializeGoogleMap();
  });
</script>
</body>
</html>
