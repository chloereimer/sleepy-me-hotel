<section class="content">
  <h1><?php echo lang('login_heading');?></h1>
  <p><?php echo lang('login_subheading');?></p>

  <p>Log in below using the information in this table. (Note: This table is static for debugging purposes. The dynamic table can be seen when you log in as an owner and access the "Users" page.</p>

  <table>
    <thead>
      <tr>
        <th>
          Username
        </th>
        <th>
          Password
        </th>
        <th>
          Privilege Level
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>owner@owner.com</td>
        <td>password</td>
        <td>owner</td>
      </tr>
      <tr>
        <td>manager@manager.com</td>
        <td>password</td>
        <td>manager</td>
      </tr>
      <tr>
        <td>frontdesk@frontdesk.com</td>
        <td>password</td>
        <td>frontdesk</td>
      </tr>
    </tbody>
  </table>

  <?php echo form_open("auth/login");?>

    <p>
      <?php echo lang('login_identity_label', 'identity');?>
      <?php echo form_input($identity);?>
    </p>

    <p>
      <?php echo lang('login_password_label', 'password');?>
      <?php echo form_input($password);?>
    </p>

    <p>
      <?php echo lang('login_remember_label', 'remember');?>
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
    </p>


    <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

  <?php echo form_close();?>

  <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</section>
