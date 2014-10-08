<section class="content">

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
