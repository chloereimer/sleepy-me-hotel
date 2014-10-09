<section class="content">

  <?php echo form_open( site_url('/admin/save_room'), array( 'class' => 'admin-form' ), array( 'id' => isset($room->id)? $room->id : null ) ); ?>
    
    <?php echo foundation_form_input( 'number', array( 'default_value' => isset($room->number)? $room->number : null ) ); ?>
    <?php echo foundation_form_input( 'name', array( 'default_value' => isset($room->name)? $room->name : null ) ); ?>
    <?php echo foundation_form_input( 'rate', array( 'default_value' => isset($room->rate)? $room->rate : null ) ); ?>
    <?php echo foundation_form_input( 'description' , array( 'as' => 'text', 'default_value' => isset($room->description)? $room->description : null ) ); ?>
    <?php echo foundation_form_input( 'image', array( 'default_value' => isset($room->image)? $room->image : null ) ); ?>

    <?php echo form_submit( array( 'class' => 'button' ), 'Submit' ) ?>

  <?php echo form_close(); ?>

</section>

<script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description' );
</script>
