<?php get_header(); ?>

<?php
    // ACF Fields
    $food_image = get_field('food_image');
    $food_title = get_field('food_title');
    $food_description = get_field('food_description');
?>
<img src="<?php echo $food_image; ?> " alt="">

<h1><?php echo $food_title; ?></h1>
<p><?php echo $food_description; ?></p>

<?php get_footer(); ?>