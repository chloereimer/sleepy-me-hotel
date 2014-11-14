<section class="content">
  <h1>Reservations</h1>

  <div class="calendar"></div>
</section>

<script>

  $(document).ready(function(){

    date = new Date();

    $('.calendar').load( '<?php echo site_url("admin/reservation_calendar"); ?>/' + date.getFullYear() + '/' + (date.getMonth() + 1) , function(){
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

</script>
