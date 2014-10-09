<section class="content">

  <h1 class="page-title">Rooms & Rates</h1>

  <?php foreach ($rooms as $room) : ?>
    <article class="room">

      <img src="<?php echo images_url( $room['image'] ) ; ?>" class="thumbnail" />

      <h1 class="number_name" >
        <span class="number">Room <?php echo $room['number']; ?></span>
        <span><?php echo $room['name']; ?></span>
      </h1>

      <div class="rate"><?php echo money_format('%=i.2n/night', $room['rate']); ?></div>

      <div class="description"><?php echo $room['description']; ?></div>

    </article>
  <?php endforeach; ?>

</section>
