<?php get_header(); ?>




<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        $product_id = get_the_ID();
        $product_name = get_the_title();
        $description = get_the_post_type_description();
        $price = get_post_meta(get_the_ID(), '_product_price', true);
        $discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
        $quantity = get_post_meta(get_the_ID(), '_product_quantity', true);
        $posted_by = get_post_meta(get_the_ID(), '_product_posted_by', true);

        $product_image = get_the_post_thumbnail_url();
        $author_id = get_the_author_meta('ID');
?>
<section class="d-flex justify-content-center align-items-center">

    <div class="container single_post">
        <div class="row gap-5">
            <div class="col img_parent">
                <img src="<?php echo the_post_thumbnail_url('post-thumbnail'); ?> " alt="">
            </div>
            <div class=" col">
                <h1><?php echo ucwords(get_the_title()); ?></h1>
                <p><?php the_content(); ?></p>
                <br>
                <p><strong>Price:</strong><?php echo get_post_meta(get_the_ID(), '_product_price', true); ?></p>
                <p><strong>Discount
                        Price:</strong><?php echo get_post_meta(get_the_ID(), '_product_discount_price', true); ?>
                </p>
                <p><strong>Quantity:</strong> <?php echo get_post_meta(get_the_ID(), '_product_quantity', true); ?>
                </p>

            </div>
        </div>
    </div>

</section>

<?php
    endwhile;
endif;
?>
<?php get_footer(); ?>