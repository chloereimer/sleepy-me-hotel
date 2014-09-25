<?php echo validation_errors(); ?>

<?php echo form_open( base_url('contact/index'), array( 'class' => 'contact-form' ) ); ?>

  <label>
    Username
    <?php echo form_input( array( 'name' => 'username', 'id' => 'username', 'value' => set_value('username') ) ); ?>
  </label>
  <label>
    First Name
    <?php echo form_input( array( 'name' => 'first_name', 'id' => 'first_name', 'value' => set_value('first_name') ) ); ?>
  </label>
  <label>
    Last Name
    <?php echo form_input( array( 'name' => 'last_name', 'id' => 'last_name', 'value' => set_value('last_name') ) ); ?>
  </label>
  <label>
    Age
    <?php echo form_input( array( 'name' => 'age', 'id' => 'age', 'value' => set_value('age') ) ); ?>
  </label>
  <label>
    Program
    <?php echo form_dropdown( 'program', array( '' => 'Select Program', 'technology' => 'Technology', 'business' => 'Business', 'environment' => 'Environment' ), set_value('program') ) ?>
  </label>

  <?php echo form_submit( array( 'class' => 'button' ), 'Submit' ) ?>

<?php echo form_close(); ?>
