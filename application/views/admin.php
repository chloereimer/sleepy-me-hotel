<section class="content">

  <h1 class="page-title">Admin Dashboard</h1>

    <ul>
      <li>
        <a href="<?php echo site_url('/admin/index_users'); ?>">View Users</a> (owners only)
      </li>
      <li>
        <a href="<?php echo site_url('/admin/index_rooms'); ?>">Manage Rooms</a> (owners & managers only)
      </li>
      <li>
        <a href="<?php echo site_url('/admin/index_reservations'); ?>">View Reservations</a> (owners, managers & frontdesk only)
      </li>
      <li>
        <a href="<?php echo site_url('/admin/reset_database'); ?>">Reset Database</a>
    </ul>
  
</section>
