<section class="content">

  <h1 class="page-title">Contact Us</h1>

  <?php echo form_open( site_url('/contact/mail'), array( 'class' => 'contact-form' ) ); ?>

    <?php echo foundation_form_input( 'name' ); ?>
    <?php echo foundation_form_input( 'address' ); ?>
    <?php echo foundation_form_input( 'postal_code' ); ?>
    <?php echo foundation_form_input( 'phone' ); ?>
    <?php echo foundation_form_input( 'email' ); ?>
    <?php echo foundation_form_input( 'comment' , array( 'as' => 'text' ) ); ?>

    <?php echo form_submit( array( 'class' => 'button' ), 'Submit' ) ?>

  <?php echo form_close(); ?>

  <div id="map_canvas" style="height: 400px"></div>

</section>

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
  initializeGoogleMap();
</script>
