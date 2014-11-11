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

  <?php echo form_open( site_url('/reservations/confirm'), array( 'id' => 'select-a-date-form' ) ); ?>

    <h1>Guest Information</h1>
    <?php echo foundation_form_input( 'first_name' ); ?>
    <?php echo foundation_form_input( 'last_name' ); ?>
    <?php echo foundation_form_input( 'email' ); ?>

    <h1>Payment Information</h1>

    <div class="error" style="display: none"></div>

    <label>
      Card Number
      <?php echo form_input( array( 'data-stripe' => 'number' ) ); ?>
    </label>

    <label>
      CVC
      <?php echo form_input( array( 'data-stripe' => 'cvc' ) ); ?>
    </label>

    <label>
      <div>Expiration (MM/YYYY)</div>
      <div class="expiration-month">
        <?php echo form_input( array( 'data-stripe' => 'exp-month', 'placeholder' => 'MM') ); ?>
      </div>
      <div class="expiration-month">
        <?php echo form_input( array( 'data-stripe' => 'exp-year', 'placeholder' => 'YYYY' ) ); ?>
      </div>
    </label>

    <?php echo form_submit( array( 'class' => 'button' ), 'Continue' ) ?>

  <?php echo form_close(); ?>

</section>

<script>
  $(function($) {
    $('#select-a-date-form').submit(function(event) {
      var $form = $(this);
      $form.find('input[type=submit]').attr('disabled','disabled');
      Stripe.card.createToken($form, stripeResponseHandler);
      return false;
    });
  });

  function stripeResponseHandler(status, response) {
    var $form = $('#select-a-date-form');

    if (response.error) {
      // Show the errors on the form
      $form.find('.error').text(response.error.message).show();
      $form.find('input[type=submit]').removeAttr('disabled');
    } else {
      // response contains id and card, which contains additional card details
      var token = response.id;
      // Insert the token into the form so it gets submitted to the server
      $form.append($('<input type="hidden" name="stripeToken" />').val(token));
      // and submit
      $form.get(0).submit();
    }
  };
</script>
