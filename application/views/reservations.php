<section class="content">

  <div class="availability">
    <h1>Availability</h1>
    <div class="calendar"></div>
  </div>

  <div class="select-a-date">
    <h1>Select a Date</h1>
    <label>Arrival Date <input type="text" class="datepicker" id="arrival_date" name="arrival_date"></label>
    <label>Departure Date <input type="text" class="datepicker" id="departure_date" name="departure_date"></label>
    <div class="error" style="display:none"></div>
    <button>Continue</button>
  </div>

</section>


<script>
  $(document).ready(function(){

    SleepyMe.initializeCalendar();

    $('#arrival_date').datepicker({
      minDate: +1,
      defaultDate: +1,
      onClose: function(selectedDate) {
        $('#departure_date').datepicker('option', 'minDate', selectedDate);
        checkAvailability();
      }
    });

    $('#departure_date').datepicker({
      minDate: +1,
      defaultDate: +1,
      onClose: function(selectedDate) {
        $('#arrival_date').datepicker('option', 'maxDate', selectedDate);
        checkAvailability();
      }
    });

  });

  checkAvailability = function(){

    startDate = $('#arrival_date').val();
    endDate = $('#departure_date').val();

    $.get('available_rooms', { startDate: startDate, endDate: endDate }, function( data ){
      // handle returned data
    });

  }

</script>
