<?php echo form_open( base_url('contact/index'), array( 'class' => 'contact-form' ) ); ?>

  <?php echo foundation_form_input( 'username' ); ?>
  <?php echo foundation_form_input( 'first_name' ); ?>
  <?php echo foundation_form_input( 'last_name' ); ?>
  <?php echo foundation_form_input( 'age' ); ?>
  <?php echo foundation_form_input( 'program', array( 'as' => 'collection', 'allow_blank' => true, 'collection' => array( 'business' => 'Business', 'technology' => 'Technology', 'environment' => 'Environment' ) ) ); ?>

  <?php echo form_submit( array( 'class' => 'button' ), 'Submit' ) ?>

<?php echo form_close(); ?>

<div class="flex-video">
  <div id="map_canvas" style="height: 400px"></div>
</div>
