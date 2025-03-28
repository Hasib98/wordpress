<?php
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


function get_user_by_username_or_email($input) {
    if (strpos($input, '@') !== false) {
        return get_user_by('email', $input);
    } else {
        return get_user_by('login', $input);
    }
}


function custom_login_process($user, $username, $password){


    if(!$user){
        return new WP_Error('invalid_username', __("<strong>ERROR</strong>: Invalid username or email."));
    }


    remove_action('authenticate', 'wp_authenticate_username_password', 20);
    remove_action('authenticate', 'wp_authenticate_email_password', 20);

    $user  = get_user_by_username_or_email($username);


    



}

add_filter('authenticate', 'custom_login_process',5,3);