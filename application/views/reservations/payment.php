<section class="content">

  <ul class="reservation-steps">
    <li><a href="<?php echo site_url('reservations'); ?>">Select a Date</a></li>
    <li><a href="<?php echo site_url('reservations/select_a_room'); ?>">Select a Room</a></li>
    <li class="current">Guest Info & Payment</li>
    <li class="tbd">Confirmation</li>
  </ul>

  <div class="reservation-summary">
    <h1>Reservation Summary</h1>
    <p><strong>Arrival Date:</strong> <?php echo $startDate; ?></p>
    <p><strong>Departure Date:</strong> <?php echo $endDate; ?></p>
    <p><strong>Room:</strong> No. <?php echo $room->number ?>, <?php echo $room->name ?></p>
  </div>

  <?php echo form_open( site_url('/reservations/confirm'), array( 'class' => 'select-a-date-form' ) ); ?>

    <h1>Guest Information</h1>
    <?php echo foundation_form_input( 'first_name' ); ?>
    <?php echo foundation_form_input( 'last_name' ); ?>
    <?php echo foundation_form_input( 'email' ); ?>

    <h1>Payment Information</h1>

    <?php echo form_submit( array( 'class' => 'button' ), 'Continue' ) ?>
  <?php echo form_close(); ?>

</section>
