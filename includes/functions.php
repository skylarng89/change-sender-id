<?php
/**
 * Set the custom sender name and email address
 */
function change_sender_id_set_sender( $phpmailer ) {
    $sender_name = get_option( 'custom_name' );
    $sender_email = get_option( 'custom_email' );
    
    if ( ! empty( $sender_name ) ) {
        $phpmailer->FromName = $sender_name;
    }
    if ( ! empty( $sender_email ) ) {
        $phpmailer->From = $sender_email;
        $phpmailer->Sender = $sender_email;
        $phpmailer->AddReplyTo( $sender_email, $sender_name );
    }
}
add_action( 'phpmailer_init', 'change_sender_id_set_sender' );

/**
 * Get the custom sender name and email address for display purposes
 */
function change_sender_id_get_sender() {
    $sender_name = get_option( 'custom_name' );
    $sender_email = get_option( 'custom_email' );
    
    if ( ! empty( $sender_name ) && ! empty( $sender_email ) ) {
        return $sender_name . '<' . $sender_email . '>';
    } elseif ( ! empty( $sender_name ) ) {
        return $sender_name;
    } elseif ( ! empty( $sender_email ) ) {
        return $sender_email;
    } else {
        return '';
    }
}

?>