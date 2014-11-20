<section class="content">

  <h1 class="page-title">Admin Dashboard</h1>

    <?php if( $logged_in ) : ?>
      <p>You are logged in as <strong><?php echo $identity; ?></strong>. Try your privileges on the pages below, or <a href="<?php echo site_url('/admin/logout'); ?>">logout</a>.</p>
    <?php else : ?>
      <p><a href="<?php echo site_url('/admin/login'); ?>">Log in to try out different privilege levels.</a></p>
    <?php endif; ?>

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
      </li>
    </ul>
  
</section>
