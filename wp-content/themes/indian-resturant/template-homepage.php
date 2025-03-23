<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>

<?php
    
    // echo do_shortcode( '[contact-form-7 id="e9e7453" title="Contact"]');
    get_template_part('template-parts/section', 'hero');
    get_template_part('template-parts/section', 'about');
    get_template_part('template-parts/section', 'food_post');
    get_template_part('template-parts/section', 'daily_offer');
    get_template_part('template-parts/section', 'checkout_menu');
    get_template_part('template-parts/section', 'reservation');
    get_template_part('template-parts/section', 'location_address');
?>


<?php
get_footer();

?>

<!-- <?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?> -->