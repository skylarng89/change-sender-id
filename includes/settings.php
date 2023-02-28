<?php
/**
* Add settings page to WordPress admin menu
*/
function change_sender_id_add_settings_page() {
   add_options_page( __( 'Change Sender ID', 'change-sender-id' ), __( 'Change Sender ID', 'change-sender-id' ), 'manage_options', 'change-sender-id', 'change_sender_id_settings_page' );
}
add_action( 'admin_menu', 'change_sender_id_add_settings_page' );

/**
* Create the settings page
*/
function change_sender_id_settings_page() {
   // Save settings if form submitted
   if ( isset( $_POST['change_sender_id_save_settings'] ) ) {
       check_admin_referer( 'change_sender_id_save_settings' );
       update_option( 'custom_name', sanitize_text_field( $_POST['custom_name'] ) );
       update_option( 'custom_email', sanitize_email( $_POST['custom_email'] ) );
       ?>
       <div class="notice notice-success is-dismissible">
           <p><?php _e( 'Settings saved.', 'change-sender-id' ); ?></p>
       </div>
       <?php
   }
   
   // Get current settings
   $sender_name = get_option( 'custom_name' );
   $sender_email = get_option( 'custom_email' );
   ?>
   <div id="csid-wrapper">
       <h1><?php _e( 'Change Sender ID Settings', 'change-sender-id' ); ?></h1>
       <form method="post">
           <?php wp_nonce_field( 'change_sender_id_save_settings' ); ?>
           <table class="form-group">
               <tbody>
                   <tr>
                       <th scope="row">
                        <label for="custom_name"><?php _e( 'Sender Name', 'change-sender-id' ); ?></label>
                       </th>
                       <td>
                        <input type="text" id="custom_name" name="custom_name" value="<?php echo esc_attr( $sender_name ); ?>" class="csid-input-txt">
                       </td>
                   </tr>
                   <tr>
                       <th scope="row">
                        <label for="custom_email"><?php _e( 'Sender Email Address', 'change-sender-id' ); ?></label>
                       </th>
                       <td>
                        <input type="email" id="custom_email" name="custom_email" value="<?php echo esc_attr( $sender_email ); ?>" class="csid-input-txt">
                       </td>
                   </tr>
               </tbody>
           </table>
           <?php submit_button( __( 'Save', 'change-sender-id' ), 'csid-save-btn', 'change_sender_id_save_settings' ); ?>
           <p class="csid-copyright">Made by: <a href="https://github.com/skylarng89" target="_blank" class="csid-copyright">Patrick Aziken</a></p>
       </form>
   </div>
   <?php
}

?>