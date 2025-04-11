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
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function login_auth_enqueue_scripts() {

    wp_enqueue_script(
        'login-auth-js',
        plugin_dir_url(__FILE__) . 'js/login-auth.js', 
        array('jquery'), 
        null, 
        true 
    );
    wp_localize_script('login-auth-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

}

add_action('login_enqueue_scripts', 'login_auth_enqueue_scripts');



function custom_login_extra_field() {
    
    echo '<p class="submit">
    <input type="submit" class="button button-primary button-large" id="clogin" value="Submit">  
    </p>';

    echo '<p class="otp_field_group">
    <label for="custom_otp"><span id="label_text">Enter OTP </span><span id="countdown">5:00</span></label>
    <input type="text" name="custom_otp" id="custom_otp">
    </p>';
    // echo '<script>
    // document.getElementById("user_login").parentElement.style.display = "none";
    // document.querySelector(".user-pass-wrap").style.display = "none";
    // document.querySelector(".forgetmenot").style.display = "none";
    // </script>';
}

add_action('login_form', 'custom_login_extra_field');


function send_otp_via_ajax() {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        wp_send_json(['success' => false, 'message' => 'Invalid request.']);
    }

    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    // if(!isset($_POST['data'])){
    //     wp_send_json(['success' => false, 'message' => 'Invalid request.']);
    // }
    // // $data = json_decode($_POST['data']); 
    // $data = $_POST['data']; 

    // $username = sanitize_text_field($data->username);
    // $password = sanitize_text_field($data->password);

    // Authenticate user
    $user = wp_authenticate($username, $password);
    if (is_wp_error($user)) {
        wp_send_json(['success' => false, 'message' => $user->get_error_message()]);
        wp_die();
    }

    $otp = wp_rand(100000,999999);
    $otp_time_countdown  = 300;
    // $otp = 12;
    update_user_meta($user->ID, 'custom_login_otp', $otp);
    update_user_meta($user->ID, 'custom_login_otp_expiry', time() + $otp_time_countdown); 


    $subject = "Your OTP Code";
    $message = "Your OTP for login is: $otp. It expires in 5 minutes.";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($user->user_email, $subject, $message, $headers);

    wp_send_json(['success' => true, 'message' => 'OTP sent.<br> Check your Email: '.$user->user_email, 'countdown' => $otp_time_countdown]);
    

}
add_action('wp_ajax_send_otp', 'send_otp_via_ajax');
add_action('wp_ajax_nopriv_send_otp', 'send_otp_via_ajax');

// -----------------------------------------------------------------------------------------------------
function otp_validation_via_ajax() {
    if (!isset($_POST['username']) || !isset($_POST['password'])|| !isset($_POST['otp'])) {
        wp_send_json(['success' => false, 'message' => 'Invalid request.']);
    }
    
    // if(!isset($_POST['data'])){
    //     wp_send_json(['success' => false, 'message' => 'Invalid request.']);
    // }
    // $data = json_decode($_POST['data']); 

    // $username = sanitize_text_field($data->username);
    // $password = sanitize_text_field($data->password);
    // $remember = isset($data->rememberme) && $data->rememberme === 'forever';

    // $otp_value =  sanitize_text_field($data->otp);

    
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);
    $remember = isset($_POST['rememberme']) && $_POST['rememberme'] === 'forever';

    $otp_value =  sanitize_text_field($_POST['otp']);

    // Authenticate user
    $user = wp_authenticate($username, $password);
    if (is_wp_error($user)) {
        wp_send_json(['success' => false, 'message' => $user->get_error_message()]);
        wp_die();
    }

    $stored_otp = get_user_meta($user->ID, 'custom_login_otp', true);
    $otp_expiry = get_user_meta($user->ID, 'custom_login_otp_expiry', true);

    
    // Validate OTP
    if ( $otp_value != $stored_otp  || time() > $otp_expiry) {
        wp_send_json(['success' => false, 'message' => 'Invalid OTP.']);
        wp_die();
        exit;
    }
    
    // Clear OTP after successful authentication
    delete_user_meta($user->ID, 'custom_login_otp');
    delete_user_meta($user->ID, 'custom_login_otp_expiry');

        
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, $remember);
    do_action('wp_login', $user->user_login, $user);


    wp_send_json(['success' => true, 'redirect' => admin_url()]);
    

}
add_action('wp_ajax_otp_validation', 'otp_validation_via_ajax');
add_action('wp_ajax_nopriv_otp_validation', 'otp_validation_via_ajax');