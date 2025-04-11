<?php
/**
 * @package Login_Auth
 * @version 1.0.0
 */
/*
Plugin Name: Login Auth
Plugin URI: http://wordpress.org/plugins/login-auth/
Description: A simple WordPress login authentication plugin with OTP.
Author: S. M. Hasib
Version: 1.0.0
Author URI: http://smhasib.com/
*/


function login_auth_enqueue_scripts() {
    // Enqueue the JS file for the login page
    wp_enqueue_script(
        'login-auth-js', // Handle (unique name for the script)
        plugin_dir_url(__FILE__) . 'js/login-auth.js', // Path to the JS file
        array('jquery'), // Optional: Dependencies (jQuery is a dependency here)
        null, // Version (optional, can use a version number)
        true // Load in the footer
    );

    // Localize the script to pass the AJAX URL to JS
    wp_localize_script('login-auth-js', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('login_enqueue_scripts', 'login_auth_enqueue_scripts');



function my_added_login_field() {
    ?>
<p>
    <input type="button" value="Send OTP" class="button-primary" name="send_otp_btn" id="send_otp_btn"
        onclick="send_otp_btn()">
    <label for="otp_field">OTP<br>
        <input type="text" tabindex="20" size="20" value="" class="input" id="otp_field" name="otp_field"></label>
</p>
<?php
}
add_action('login_form', 'my_added_login_field');


function get_user_by_username_or_email($input) {
    if (strpos($input, '@') !== false) {
        return get_user_by('email', $input);
    } else {
        return get_user_by('login', $input);
    }
}

function generate_and_send_otp() {
        
        if (!empty($_POST['log']) || !empty($_POST['pwd']) ) {
            $input = sanitize_text_field($_POST['log']);
            $user = get_user_by_username_or_email($input);
            
            if ($user) {
                $otp = wp_rand(100000, 999999);       
                update_user_meta($user->ID, 'my_login_otp', $otp);
                    
                
                $subject = "Your OTP for Login";
                $message = "Hello " . $user->display_name . ",\n\nYour OTP for login is: " . $otp . "\n\nUse this to complete your login.";
                $headers = "From: no-reply@yourdomain.com";
                
                wp_mail($user->user_email, $subject, $message, $headers);
            }
        }
    // }
}
add_action('login_init', 'generate_and_send_otp');


function my_custom_authenticate($user, $username, $password) {
   
    $otp_value = isset($_POST['otp_field']) ? sanitize_text_field($_POST['otp_field']) : '';
    

    $user = get_user_by_username_or_email($username);
    
    if (!$user) {
        return new WP_Error('invalid_username', __("<strong>ERROR</strong>: Invalid username or email."));
    }

  
    $stored_otp = get_user_meta($user->ID, 'my_login_otp', true);
    
    if (empty($otp_value) || $otp_value !== $stored_otp) {
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20);
        
        return new WP_Error('denied', __("<strong>ERROR</strong>: Incorrect OTP."));
    }
  
    delete_user_meta($user->ID, 'my_login_otp');
    
    return $user;
}
add_filter('authenticate', 'my_custom_authenticate', 10, 3);