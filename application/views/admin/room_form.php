<section class="content">

  <?php echo form_open_multipart( site_url('/admin/save_room'), array( 'class' => 'admin-form' ), array( 'id' => isset($room->id)? $room->id : null ) ); ?>
    
    <?php echo foundation_form_input( 'number', array( 'default_value' => isset($room->number)? $room->number : null ) ); ?>
    <?php echo foundation_form_input( 'name', array( 'default_value' => isset($room->name)? $room->name : null ) ); ?>
    <?php echo foundation_form_input( 'rate', array( 'default_value' => isset($room->rate)? $room->rate : null ) ); ?>
    <?php echo foundation_form_input( 'description' , array( 'as' => 'text', 'default_value' => isset($room->description)? $room->description : null ) ); ?>
    <?php if( isset($room->image) ) : ?>
      <label>Current Featured Image</label>
      <img src="<?php echo uploads_url($room->image); ?>" />
      <label>Upload New Featured Image <input type="file" name="image" /></label>
    <?php else : ?>
      <label>Upload Featured Image <input type="file" name="image" /></label>
    <?php endif; ?>

    <?php echo form_submit( array( 'class' => 'button' ), 'Submit' ) ?>

  <?php echo form_close(); ?>

</section>

<script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description' , {
    filebrowserImageUploadUrl: '../../../uploader.php'

  });
</script>
