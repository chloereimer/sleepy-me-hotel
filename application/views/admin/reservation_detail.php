<h1>Details for <span class="date"><?php echo "$year/$month/$day"; ?></span></h1>

<?php if ( count( $reservations ) <= 0 ) : ?>

  <p>No reservations found for this day.</p>

<?php else : ?>

  <ul class="reservation-list">
    <?php foreach ($reservations as $reservation) : ?>
      <li class="reservation" data-room="<?php echo $reservation->room->id ?>"> <strong>Room <?php echo $reservation->room->number; ?>, <?php echo $reservation->room->name; ?></strong> reserved by <?php echo $reservation->customer->first_name . " " . $reservation->customer->last_name ?></li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>

<div class="modal room-info-modal" style="display: none">
  <div class="modal-content">
  </div>
</div>

<script>
  $(document).ready(function(){

    $('.reservation').on('click', function(){

      $('.modal-content').load('<?php echo site_url("admin/reservation_room_detail") ?>/' + $(this).data('room'), function(){
        $('.modal').fadeIn(100);
      });

    });

  });
</script>
