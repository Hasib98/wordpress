<?php

/*
 * My Theme Function
 */

// All Default theme function here
include_once ('inc/default.php');

// Theme CSS  and jQuery File  calling
include_once ('inc/enqueue.php');
// include_once('inc/default.php');
// include_once('inc/default.php');

/* function themeslug_enqueue_style() {
    wp_enqueue_style( 'my-theme', 'style.css', false );
}

function themeslug_enqueue_script() {
    wp_enqueue_script( 'my-js', 'filename.js', false );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' ); */

function add_svg_to_upload_mimes($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'add_svg_to_upload_mimes');

?>