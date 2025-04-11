<?php get_header(); ?>




<?php
// if (have_posts()):
//     while (have_posts()):
//         the_post();
?>
<h1>hiiiiiiiiiiiiiiiiiiiiii</h1>
<!-- <div class="single-food-item">
    <h1><?php the_title(); ?></h1>
    <?php the_post_thumbnail('large'); ?>
    <p><?php the_content(); ?></p>
    <p><strong>Price:</strong> $<?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
    <p><strong>Discount Price:</strong> $<?php echo get_post_meta(get_the_ID(), 'discount_price', true); ?></p>
    <p><strong>Quantity:</strong> <?php echo get_post_meta(get_the_ID(), 'quantity', true); ?></p>
    <p><strong>Category:</strong> <?php the_terms(get_the_ID(), 'food_category'); ?></p>
</div> -->
<?php
//     endwhile;
// endif;
?>
<?php get_footer(); ?>