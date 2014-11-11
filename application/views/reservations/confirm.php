<section class="content">

  <ul class="reservation-steps">
    <li><a href="<?php echo site_url('reservations'); ?>">Select a Date</a></li>
    <li><a href="<?php echo site_url('reservations/select_a_room'); ?>">Select a Room</a></li>
    <li><a href="<?php echo site_url('reservations/payment'); ?>">Guest Info & Payment</a></li>
    <li class="current">Confirmation</li>
  </ul>

  <div class="reservation-summary">
    <h1>Reservation Summary</h1>
    <p>Please review your reservation below. If you wish to make any changes, click the relevant step above.</p>
    <p><strong>Arrival Date:</strong> <?php echo $startDate; ?></p>
    <p><strong>Departure Date:</strong> <?php echo $endDate; ?></p>
    <p><strong>Room:</strong> No. <?php echo $room->number ?>, <?php echo $room->name ?></p>
    <p><strong>Name:</strong> <?php echo $first_name ?> <?php echo $last_name ?></p>
    <p><strong>Email:</strong> <?php echo $email ?></p>
  </div>

  <?php echo form_open( site_url('/reservations/new_reservation'), array( 'id' => 'confirmation-form' ) ); ?>

    <?php echo form_submit( array( 'class' => 'button' ), 'Confirm' ) ?>

  <?php echo form_close(); ?>

</section>
