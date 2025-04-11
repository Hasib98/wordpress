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
    wp_enqueue_script(
        'login-auth-js', 
        plugin_dir_url(__FILE__) . 'js/login-auth.js', 
        array('jquery'), 
        null, 
        true 
    );

    wp_localize_script('login-auth-js', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('login_enqueue_scripts', 'login_auth_enqueue_scripts');



function my_added_login_field() {
    ?>
<p>
    <!-- <input type="button" value="Send OTP" class="button-primary" name="send_otp_btn" id="send_otp_btn"
        onclick="send_otp_btn()"> -->
    <label for="otp_field">OTP<br>
        <input value=123456 type="text" tabindex="20" size="20" value="" class="input" id="otp_field"
            name="otp_field"></label>
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


function generate_and_send_otp($email_id) {
        
        if (!empty($_POST['log']) || !empty($_POST['pwd']) ) {
            $input = sanitize_text_field($_POST['log']);
            $user = get_user_by_username_or_email($input);
            
            if ($user) {
                $otp = wp_rand(100000, 999999);     
                // $otp = 123456;     
                update_user_meta($user->ID, 'my_login_otp', $otp);
                
                $subject = "Your OTP for Login";
                $message = "Hello " . $user->display_name . ",\n\nYour OTP for login is: " . $otp . "\n\nUse this to complete your login.";
                $headers = "From: no-reply@yourdomain.com";
                
                wp_mail($user->user_email, $subject, $message, $headers);
            }
        }
    
}
// add_action('login_init', 'generate_and_send_otp');


function my_custom_authenticate($user, $username, $password) {

    
    // if (empty($username) || empty($password)) {
    //     return new WP_Error('empty_credentials', __('Username and Password are required.'));
    // }
   
    // $otp_value = isset($_POST['otp_field']) ? sanitize_text_field($_POST['otp_field']) : '';
    // if(!$user){
    //     return new WP_Error('invalid_username', __("<strong>ERROR</strong>: Invalid username or email nai beda."));

    // }

    
    // if (!$user) {
    //     return new WP_Error('invalid_username', __("<strong>ERROR</strong>: Invalid username or email."));
    // }

    // $user = get_user_by_username_or_email($username);
    $user = get_user_by( 'login', $username );
    // var_dump($user);
    
    // if($user){
    //     remove_action('authenticate', 'wp_authenticate_username_password', 0);
    //     remove_action('authenticate', 'wp_authenticate_email_password', 0);
        
    //     return new WP_Error('empty_credentials', __('Username and Password are required.'.$user->user_email));
    // }
    
    
  
    $stored_otp = get_user_meta($user->ID, 'my_login_otp', true);
    
    if (empty($otp_value) || $otp_value !== $stored_otp) {
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20);
        
        return new WP_Error('denied', __("<strong>ERROR</strong>: Incorrect OTP."));
    }
    
  
    delete_user_meta($user->ID, 'my_login_otp');
    
    return $user;
}
add_action('authenticate', 'my_custom_authenticate', 10, 3);