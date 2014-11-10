<section class="content">

  <h1>Select a Room</h1>

  <?php echo form_open( site_url('/reservations/payment'), array( 'class' => 'select-a-date-form' ) ); ?>

    <table>

      <thead>
        <tr>
          <th>Room #</th>
          <th>Name</th>
          <th>Rate</th>
          <th>Info</th>
          <th>Select</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($rooms as $room) : ?>
          <tr>
            <td><?php echo $room->number; ?></td>
            <td><?php echo $room->name; ?></td>
            <td><?php echo $room->rate; ?></td>
            <td><span class="show-room-info" data-id="<?php echo $room->id; ?>">Info</span></td>
            <td><?php echo form_radio( array( 'name' => 'room', 'class' => 'select-room-radio'), $room->id); ?></td>
          </tr>
        <?php endforeach; ?>  
      </tbody>
    </table>

    <?php echo form_submit( array( 'class' => 'button' ), 'Continue' ) ?>

  <?php echo form_close(); ?>

</section>

<div class="modal room-info-modal" style="display: none">
  <div class="modal-content">
  </div>
</div>

<script>

  $(document).ready(function(){

    $('.show-room-info').click(function(){

      $.get( '<?php echo site_url("reservations/room_info"); ?>', { id: $(this).data('id') }, function(data){
        $('.modal-content').html(data);
        $('.modal').fadeIn(100);
      });

    });

    ensureRoomIsSelected();

    $('.select-room-radio').change(function(){
      ensureRoomIsSelected();      
    });

  });

  ensureRoomIsSelected = function(){

    if( $('.select-room-radio:checked').length == 1 ){
      $('input[type=submit]').removeAttr('disabled');
      $('.select-a-date-form').unbind('submit');
    } else {
      $('input[type=submit]').attr('disabled','disabled');
      $('.select-a-date-form').submit(function(e){ e.preventDefault() });
    }

  }
  
</script>
