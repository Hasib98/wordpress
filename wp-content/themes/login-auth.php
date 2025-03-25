<?php
/**
 * @package Login_Auth
 * @version 1.0.0
 */
/*
Plugin Name: Login Auth
Plugin URI: http://wordpress.org/plugins/login-auth/
Description: Amet et fugiat irure ad Lorem eiusmod deserunt esse. Cillum eiusmod pariatur non in. Sunt dolor ea ullamco ex deserunt reprehenderit do commodo do. Veniam labore est quis mollit deserunt elit est cillum ut.
Author: S. M. Hasib
Version: 1.0.0
Author URI: http://smhasib.com/
*/

// function test(){
//     if ( is_login() ) {
//         echo( "
//         <h1>Welcome to the login screen!</h1>
//         <input type='text'>
//         " );
//     }
// }


// add_action( 'init', 'test' );
function get_user_by_username_or_email($input) {
    if (strpos($input, '@') !== false) {
        // Input contains "@", so treat it as an email
        return get_user_by('email', $input);
    } else {
        // Otherwise, treat it as a username
        return get_user_by('login', $input);
    }
}



function my_added_login_field(){
    ?>
    <p>
        <label for="my_extra_field">OTP<br>
        <input type="text" tabindex="20" size="20" value="" class="input" id="login_otp" name="login_otp"></label>
    </p>
    <?php
}
add_action('login_form','my_added_login_field');


function my_custom_authenticate( $user, $username, $password ){
    // Example Usage
    $input = $_POST('log');
    $user_email = get_user_by_username_or_email($input)->user_email;
 
    $my_value = $_POST['login_otp'];
    
    
    // $stored_value = "1111";
    $stored_value = get_user_meta($user->ID, 'my_ident_code', true);
    
    if(!$user || empty($my_value) || $my_value !=$stored_value){
        //User note found, or no value entered or doesn't match stored value - don't proceed.
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20); 
        
        //Create an error to return to user
        return new WP_Error( 'denied', __("<strong>ERROR</strong>: You're unique identifier was invalid.") );
    }
    //Make sure you return null 
    return null;
}
add_filter( 'authenticate', 'my_custom_authenticate', 10, 3 );

