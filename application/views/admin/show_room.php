<section class="content">

  <h1><strong>Room <?php echo $room->number; ?></strong>: <?php echo $room->name; ?></h1>

  <div class="actions">
    <a href="<?php echo site_url('admin/edit_room/' . $room->id ); ?>" class="button">Edit</a>
    <a href="<?php echo site_url('admin/delete_room/' . $room->id ); ?>" class="button">Delete</a>
  </div>

  <dl>
    <dt>Number</dt>
    <dd><?php echo $room->number; ?></dd>

    <dt>Name</dt>
    <dd><?php echo $room->name; ?></dd>

    <dt>Rate</dt>
    <dd><?php echo $room->rate; ?></dd>

    <dt>Description</dt>
    <dd><?php echo $room->description; ?></dd>

    <dt>Image</dt>
    <dd>
      <img src='<?php echo images_url("$room->image"); ?>' />
    </dd>
  </dl>

  <div class="actions">
    <a href="<?php echo site_url('admin/edit_room/' . $room->id ); ?>" class="button">Edit</a>
    <a href="<?php echo site_url('admin/delete_room/' . $room->id ); ?>" class="button">Delete</a>
  </div>

</section>
