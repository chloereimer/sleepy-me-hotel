<section class="content">

  <ul class="reservation-steps">
    <li><a href="<?php echo site_url('reservations'); ?>">Select a Date</a></li>
    <li class="current">Select a Room</li>
    <li class="tbd">Guest Info & Payment</li>
    <li class="tbd">Confirmation</li>
  </ul>

  <div class="reservation-summary">
    <h1>Reservation Summary</h1>
    <p><strong>Arrival Date:</strong> <?php echo $startDate; ?></p>
    <p><strong>Departure Date:</strong> <?php echo $endDate; ?></p>
    <p class="room_name" style="display: none;"></p>
  </div>

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
            <td><?php echo form_radio( array( 'name' => 'room', 'class' => 'select-room-radio', 'data-number' => $room->number, 'data-name' => $room->name ), $room->id); ?></td>
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

      if( $('.select-room-radio:checked').length == 1 ){
        // I didn't think it was really necessary to have ANOTHER ajax call here.
        // Hopefully the other ajax calls in this lab (through both .get and .load)
        // are sufficient to demonstrate my understanding.
        $('.reservation-summary .room_name').html( '<strong>Room:</strong> No. ' + $(this).data('number') + ', ' + $(this).data('name') ).show();
      }

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
