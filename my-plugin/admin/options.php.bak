<?php

function myplugin_register_settings() {
   add_option( 'myplugin_option_name', ' ');
   register_setting( 'myplugin_options_group', 'myplugin_option_name', 'myplugin_callback' );
}
add_action( 'admin_init', 'myplugin_register_settings' );


function myplugin_register_options_page() {
  add_options_page('My Plugin Settings', 'My Plugin', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');


function myplugin_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>My Plugin Settings Page</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'myplugin_options_group' ); ?>
  <h3></h3>
  <p>Shortcode: [ews_tab] </p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="myplugin_option_name">Order of service tab: </label></th>
  <td><input type="text" id="myplugin_option_name" name="myplugin_option_name" value="<?php echo get_option('myplugin_option_name'); ?>" />  use "ASC" OR "DESC"</td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>