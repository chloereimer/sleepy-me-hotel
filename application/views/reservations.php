<section class="content">

  <ul class="reservation-steps">
    <li class="current">Select a Date</li>
    <li class="tbd">Select a Room</li>
    <li class="tbd">Guest Info & Payment</li>
    <li class="tbd">Confirmation</li>
  </ul>

  <div class="availability">
    <h1>Availability</h1>
    <div class="calendar"></div>
  </div>

  <div class="select-a-date">

    <h1>Select a Date</h1>

    <?php echo form_open( site_url('/reservations/select_a_room'), array( 'class' => 'select-a-date-form' ) ); ?>
      <?php echo foundation_form_input( 'arrival_date', array('class' => 'datepicker') ); ?>
      <?php echo foundation_form_input( 'departure_date', array('class' => 'datepicker') ); ?>
      <div class="error" style="display:none"></div>
      <?php echo form_submit( array( 'class' => 'button' ), 'Continue' ) ?>
    <?php echo form_close(); ?>

  </div>

</section>


<script>
  $(document).ready(function(){

    date = new Date();

    $('.calendar').load( '<?php echo site_url("reservations/calendar"); ?>/' + date.getFullYear() + '/' + (date.getMonth() + 1) , function(){
      $(window).resize();
    });

    $('.calendar').on('click', '.previous_link,.next_link', function(){
      $('.calendar').load( $(this).data('url') );
    });

    $('input[name=arrival_date]').datepicker({
      minDate: +1,
      defaultDate: +1,
      onClose: function(selectedDate) {
        $('input[name=departure_date]').datepicker('option', 'minDate', selectedDate);
        checkAvailability();
      }
    });

    $('input[name=departure_date]').datepicker({
      minDate: +1,
      defaultDate: +1,
      onClose: function(selectedDate) {
        $('input[name=arrival_date]').datepicker('option', 'maxDate', selectedDate);
        checkAvailability();
      }
    });

  });

  checkAvailability = function(){

    startDate = $('input[name=arrival_date]').val();
    endDate = $('input[name=departure_date]').val();

    if( startDate != undefined && endDate != undefined ){

      $.get( '<?php echo site_url("reservations/available_rooms"); ?>', { startDate: startDate, endDate: endDate }, function( data ){
        rooms = JSON.parse(data);
        if( rooms.length > 0 ){
          $('.error').hide();
          $('input[type=submit]').removeAttr('disabled');
          $('.select-a-date-form').unbind('submit');
        } else {
          $('.error').text('Sorry, there are no rooms available for the period you selected.').show();
          $('input[type=submit]').attr('disabled','disabled');
          $('.select-a-date-form').submit(function(e){ e.preventDefault() });
        }
      });

    }

  }

</script>
