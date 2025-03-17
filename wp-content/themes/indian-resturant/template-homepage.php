<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>


<?php get_template_part('template-parts/section', 'hero'); ?>
<?php get_template_part('template-parts/section', 'about'); ?>
<?php get_template_part('template-parts/section', 'food_post'); ?>
<?php get_template_part('template-parts/section', 'daily_offer'); ?>
<?php get_template_part('template-parts/section', 'checkout_menu'); ?>
<?php get_template_part('template-parts/section', 'reservation'); ?>
<?php get_template_part('template-parts/section', 'location_address'); ?>
<?php get_template_part('template-parts/section', 'newsletter'); ?>


<?php
get_footer();

?>

<!-- <?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?> -->