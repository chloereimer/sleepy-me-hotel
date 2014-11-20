<section class="content">

  <nav class="admin_navigation">
      <ul>
        You are logged in as <strong><?php echo $identity; ?></strong>. Try your privileges on these pages:
        <li>
          <a href="<?php echo site_url('/admin/index_users'); ?>">Users</a>
        </li>
        <li>
          <a href="<?php echo site_url('/admin/index_rooms'); ?>">Rooms</a>
        </li>
        <li>
          <a href="<?php echo site_url('/admin/index_reservations'); ?>">Reservations</a>
        </li>
      </ul>
  </nav>

  <p><strong>Note:</strong> You can reset the database, if necessary, <a href="reset_database">here</a>.</p>

  <div class="reservations-calendar">
    <h1>Reservations</h1>
    <div class="calendar"></div>
  </div>

  <div class="reservation-detail">
  </div>

</section>

<style>
  .rooms-booked-<?php echo $max_rooms; ?>{
    color: red;
    font-weight: bold;
  }
</style>

<script>

  $(document).ready(function(){

    date = new Date();

    $('.calendar').load( '<?php echo site_url("admin/reservation_calendar"); ?>/' + date.getFullYear() + '/' + (date.getMonth() + 1) , function(){
      $('.calendar table').data('year', date.getFullYear() );
      $('.calendar table').data('month', (date.getMonth() + 1) );
      $(window).resize();
    });

    $('.calendar').on('click', '.previous_link,.next_link', function(){
      year = $(this).data('url').split('/').reverse()[1];
      month = $(this).data('url').split('/').reverse()[0];
      $('.calendar').load( $(this).data('url'), function(){
        $('.calendar table').data('year', year );
        $('.calendar table').data('month', month );
      });
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

    $('.calendar').on('click', '.day', function(){
      $('.reservation-detail').load( '<?php echo site_url("admin/reservation_detail"); ?>/' + $(this).closest('table').data('year') + '/' + $(this).closest('table').data('month') + '/' + $(this).data('day') );
    });

  });

</script>
