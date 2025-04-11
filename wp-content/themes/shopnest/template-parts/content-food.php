<section class="food-items ">
    <h2>Our Special Menu</h2>

    <div class="row ">
        <div class="food-grid col-9">
            <?php
            // query_posts('post_type=product&post_status=publish&order=ASC&paged=' . get_query_var('post'));
            query_posts('post_type=product&post_status=publish&posts_per_page=15&order=DESC&paged=' . get_query_var('post'));
            if (have_posts()):
                while (have_posts()):
                    the_post();

                    // Retrieve the custom meta values

                    $product_id = get_the_ID();
                    $product_name = get_the_title();
                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
                    $quantity = get_post_meta(get_the_ID(), '_product_quantity', true);
                    $posted_by = get_post_meta(get_the_ID(), '_product_posted_by', true);

                    $product_image = get_the_post_thumbnail_url();
                    $author_id = get_the_author_meta('ID');

                    ?>
            <div class="food-card">
                <a href="<?php echo get_post_permalink(); ?>">
                    <!-- <?php echo the_post_thumbnail('product') ?> -->
                    <img src="<?php echo the_post_thumbnail_url('product') ?>" ? alt="">
                    <h3> <?php
                    ucwords(the_title());
                    ?></h3>
                    <div class='posted_by'> Added By: <?php echo $posted_by . ' #' . $author_id ?></div>
                    <div class='limited-text'> <?php the_content(); ?></div>

                    <div class="price-container">

                        <div class='price'>Regular Price: <?php echo $price ?></div>
                        <div class='discount-price'> Discount: <?php echo $discount_price ?></div>
                        <div class='quantity'> Quantity: <?php echo $quantity ?></div>
                    </div>


                </a>
                <button class="add-to-cart" product-id="<?php echo $product_id; ?>" title="<?php echo $product_name; ?>"
                    price="<?php echo $price; ?>" discount="<?php echo $discount_price; ?>"
                    image="<?php echo $product_image; ?>" quantity="<?php echo $quantity; ?>">Add to Cart</button>
            </div>

            <?php
                endwhile;
            endif
            ?>


        </div>

        <div class=" col food-cart">
            <h2>Your Cart</h2>
            <div id="cart-items">
            </div>
            <button id="checkout">Checkout</button>
        </div>
    </div>

</section>