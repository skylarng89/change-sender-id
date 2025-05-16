<?php
/**
 * Register plugin settings
 */
function change_sender_id_register_settings() {
    register_setting( 'change-sender-id-settings-group', 'custom_name', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ) );
    register_setting( 'change-sender-id-settings-group', 'custom_email', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default' => ''
    ) );
}
add_action( 'admin_init', 'change_sender_id_register_settings' );

/**
 * Add settings section
 */
function change_sender_id_add_settings_section() {
    add_settings_section(
        'change-sender-id-section', // ID
        __( 'Sender Details', 'change-sender-id' ), // Title
        'change_sender_id_section_callback', // Callback
        'change-sender-id' // Page
    );
}
add_action( 'admin_init', 'change_sender_id_add_settings_section' );

/**
 * Settings section callback
 */
function change_sender_id_section_callback() {
    _e( 'Configure the sender name and email address for outgoing WordPress emails.', 'change-sender-id' );
}

/**
 * Add settings fields
 */
function change_sender_id_add_settings_fields() {
    add_settings_field(
        'custom_name', // ID
        __( 'Sender Name', 'change-sender-id' ), // Title
        'change_sender_id_name_callback', // Callback
        'change-sender-id', // Page
        'change-sender-id-section' // Section
    );

    add_settings_field(
        'custom_email', // ID
        __( 'Sender Email Address', 'change-sender-id' ), // Title
        'change_sender_id_email_callback', // Callback
        'change-sender-id', // Page
        'change-sender-id-section' // Section
    );
}
add_action( 'admin_init', 'change_sender_id_add_settings_fields' );

/**
 * Sender Name field callback
 */
function change_sender_id_name_callback() {
    $sender_name = get_option( 'custom_name' );
    ?>
    <input type="text" name="custom_name" value="<?php echo esc_attr( $sender_name ); ?>" class="regular-text">
    <?php
}

/**
 * Sender Email field callback
 */
function change_sender_id_email_callback() {
    $sender_email = get_option( 'custom_email' );
    ?>
    <input type="email" name="custom_email" value="<?php echo esc_attr( $sender_email ); ?>" class="regular-text">
    <?php
}

/**
 * Add settings page to WordPress admin menu
 */
function change_sender_id_add_settings_page() {
    add_options_page(
        __( 'Change Sender ID', 'change-sender-id' ), // Page title
        __( 'Change Sender ID', 'change-sender-id' ), // Menu title
        'manage_options', // Capability
        'change-sender-id', // Menu slug
        'change_sender_id_settings_page_html' // Callback function
    );
}
add_action( 'admin_menu', 'change_sender_id_add_settings_page' );

/**
 * Settings page HTML
 */
function change_sender_id_settings_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'change-sender-id-settings-group' );
            do_settings_sections( 'change-sender-id' );
            submit_button( __( 'Save Settings', 'change-sender-id' ) );
            ?>
        </form>
    </div>
    <?php
}
