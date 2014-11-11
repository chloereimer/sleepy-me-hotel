<section class="content">
  <div class="reservation-summary">
    <h1>Reservation Summary</h1>
    <p>Congratulations! Your reservation has been confirmed. Your card will have been charged $<?php echo $room->rate; ?>.</p>
    <p><a href="<?php echo site_url('reservations/download_pdf'); ?>">Click here to download a PDF receipt.</a></p>
  </div>
</section>
