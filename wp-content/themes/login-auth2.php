<?php


// Hook into login authentication
add_filter('authenticate', 'login_auth_verify_credentials', 30, 3);
function login_auth_verify_credentials($user, $username, $password) {
    if (is_wp_error($user)) {
        return $user;
    }
    
    // Generate OTP
    $otp = wp_rand(100000, 999999);
    update_user_meta($user->ID, 'login_auth_otp', $otp);
    update_user_meta($user->ID, 'login_auth_otp_expiry', time() + 300);
    
    // Send OTP via email
    $email = $user->user_email;
    $subject = 'Your Login OTP';
    $message = "Your OTP for login is: $otp. It will expire in 5 minutes.";
    wp_mail($email, $subject, $message);
    
    // Show OTP input field
    add_action('login_enqueue_scripts','hideloginform');
    add_action('login_form_middle', 'login_auth_otp_field');
    return new WP_Error('authentication_required', __('OTP sent to your email. Enter OTP to continue.'));
}
function hideloginform(){
    echo '<style>#loginform {display:none !important}</style>';
  }
// OTP input field
function login_auth_otp_field() {
    return '<p><label for="otp_field">OTP<br>
        <input type="text" name="otp_field" id="otp_field" class="input" size="20"></label></p>';
}

// Verify OTP
add_filter('wp_authenticate_user', 'login_auth_check_otp', 30, 2);
function login_auth_check_otp($user, $password) {
    if (!isset($_POST['otp_field'])) {
        return $user;
    }
    
    $otp_entered = sanitize_text_field($_POST['otp_field']);
    $otp_stored = get_user_meta($user->ID, 'login_auth_otp', true);
    $otp_expiry = get_user_meta($user->ID, 'login_auth_otp_expiry', true);
    
    if ($otp_stored && $otp_stored == $otp_entered && time() < $otp_expiry) {
        delete_user_meta($user->ID, 'login_auth_otp');
        delete_user_meta($user->ID, 'login_auth_otp_expiry');
        return $user;
    } else {
        return new WP_Error('invalid_otp', __('Invalid or expired OTP. Please try again.'));
    }
}