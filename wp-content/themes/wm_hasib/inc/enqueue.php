<?php  

function webermelon_scripts() {
    
    $bootstrap_css = get_template_directory_uri() . '/assets/css/bootstrap.css';
    wp_enqueue_style(
        'bootstrap-style',
        $bootstrap_css,
        array(),
        '5,3,3',
        'all'
    );
    wp_enqueue_style( 'wm_style', get_template_directory_uri().'/assets/css/wm_style.css', array('swiper-style','bootstrap-style'), filemtime(get_template_directory(  ).'/assets/css/wm_style.css'),'all');
    wp_enqueue_style(
        'swiper-style',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '1,0,0',    
        'all'
    );
    wp_enqueue_script( 'wm_script', get_template_directory_uri() . '/assets/js/main.js', array('swiper-js'), filemtime(get_template_directory(  ).'/assets/js/main.js'), true );
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '1.0.0', true);

}

add_action( 'wp_enqueue_scripts', 'webermelon_scripts' );