<section class="content">

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

    SleepyMe.initializeCalendar();

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

      $.get('available_rooms', { startDate: startDate, endDate: endDate }, function( data ){
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
