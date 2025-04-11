<?php

/*
 * Template Name: Food Items List
 */
get_header();
?>
<h1>Our Food Menu</h1>
<div class="food-items">
    <?php
    $query = new WP_Query(array('post_type' => 'food_item', 'posts_per_page' => 10));
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            ?>
    <div class="food-item-card">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_post_thumbnail('medium'); ?>
        <!-- <img src="<?php echo get_the_post_thumbnail_url('post-thumbnail'); ?>" alt=""> -->
        <p><strong>Price:</strong> $<?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
        <p><strong>Discount Price:</strong> $<?php echo get_post_meta(get_the_ID(), 'discount_price', true); ?></p>
        <p><strong>Quantity:</strong> <?php echo get_post_meta(get_the_ID(), 'quantity', true); ?></p>
    </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>No food items found.</p>';
    endif;
    ?>
</div>
<?php get_footer(); ?>