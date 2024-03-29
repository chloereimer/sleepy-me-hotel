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
        Or you can <a href="<?php echo site_url('/admin/logout'); ?>">logout</a>.
      </ul>
  </nav>

  <h1>Manage Rooms</h1>

  <div class="actions"><a href="<?php echo site_url('/admin/new_room'); ?>" class="button">Add a New Room</a></div>

  <?php if( !empty($rooms) ) : ?>

    <table class="rooms-table">

      <thead>
        <tr>
          <th>Number</th>
          <th class="name">Name</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($rooms as $room) : ?>
          <tr>
            <td><?php echo $room->number; ?></td>
            <td class="name"><?php echo $room->name; ?></td>
            <td><a href="<?php echo site_url('/admin/show_room/' . $room->id ); ?>" class="button">View</a></td>
            <td><a href="<?php echo site_url('/admin/edit_room/' . $room->id ); ?>" class="button">Edit</a></td>
            <td><a href="<?php echo site_url('/admin/delete_room/' . $room->id ); ?>" class="button">Delete</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      
    </table>

  <?php else : ?>

    <div class="error">No rooms found.</div>

  <?php endif; ?>

  <div class="actions"><a href="<?php echo site_url('/admin/new_room'); ?>" class="button">Add a New Room</a></div>

</section>
