<?php
function indian_resturant_register_style()
{
    $indian_resturant_custom_css = get_template_directory_uri() . '/assets/css/indian-resturant-custom.css';

    wp_enqueue_style(
        'indian-resturant-style',
        $indian_resturant_custom_css,
        // array(),
        array(
            'bootstrap-style',
            'swiper-style'
        ),
        filemtime(get_template_directory() . '/assets/css/indian-resturant-custom.css'),
        'all'
    );

    $indian_resturant_bootstrap_css = get_template_directory_uri() . '/assets/css/bootstrap.css';
    wp_enqueue_style(
        'bootstrap-style',
        $indian_resturant_bootstrap_css,
        array(),
        '5,3,3',
        'all'
    );
    wp_enqueue_style(
        'swiper-style',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '1,0,0',
        'all'
    );
wp_dequeue_style( 'contact-form-7' );

}

add_action('wp_enqueue_scripts', 'indian_resturant_register_style');

function indian_resturant_register_scripts()
{
    wp_enqueue_script('indian-resturant-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('indian-resturant-main-extra', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    wp_localize_script('indian-resturant-main', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'indian_resturant_register_scripts');
