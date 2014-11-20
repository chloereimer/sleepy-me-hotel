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

  <h1>Users</h1>
  <table>
    <thead>
      <tr>
        <th>
          Email
        </th>
        <th>
          Groups
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?php echo $user->email ?></td>
          <td>
            <?php foreach ($user->groups as $group) : ?>
              <?php echo $group->name; ?><br/>
            <?php endforeach; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
