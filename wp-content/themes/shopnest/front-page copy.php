<?php get_header() ?>
<!-- Hero Section -->
<section class="hero row">
    <div class="hero-content ">
        <h1>Delicious Food Delivered to You</h1>
        <p>Order your favorite meals online with just a click!</p>
        <a href="#" class="btn">Shop Now</a>
    </div>

</section>

<!-- Food Items Section -->
<section class="food-items ">
    <h2>Our Special Menu</h2>

    <div class="row ">
        <div class="food-grid col-9">
            <?php
            // query_posts('post_type=product&post_status=publish&order=ASC&paged=' . get_query_var('post'));
            query_posts('post_type=product&post_status=publish&posts_per_page=15&order=ASC&paged=' . get_query_var('post'));
            if (have_posts()):
                while (have_posts()):
                    the_post();

                    // Retrieve the custom meta values

                    $product_id = get_the_ID();
                    $product_name = get_the_title();
                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
                    $quantity = get_post_meta(get_the_ID(), '_product_quantity', true);
                    $product_image = get_the_post_thumbnail_url();
                    ?>
            <div class="food-card">
                <?php echo the_post_thumbnail('product') ?>
                <h3> <?php
                    ucwords(the_title());
                    ?></h3>
                <p> <?php the_content(); ?></p>
                <p class='price'>Regular Price: <?php echo $price ?></p>
                <p class='discount-price'> Discount: <?php echo $discount_price ?></p>
                <p> Quantity: <?php echo $quantity ?></p>

                <div>

                    <a href="<?php echo get_post_permalink(); ?>">link</a>
                </div>
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
            <h2>Your Cart JS</h2>
            <div id="cart-items">
            </div>
            <button id="checkout" disabled>Checkout</button>
        </div>
    </div>

</section>

<!-- Food Items Section -->





<!-- <section class="food-items">
    <h2>Our Special Menu</h2>
    <div class="row">
        <div class="food-grid col-9">
            <?php
            query_posts('post_type=product&post_status=publish&posts_per_page=15&order=ASC&paged=' . get_query_var('post'));
            if (have_posts()):
                while (have_posts()):
                    the_post();

                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
                    $quantity = get_post_meta(get_the_ID(), '_product_quantity', true);
                    $product_id = get_the_ID();
                    $product_name = get_the_title();
                    $product_image = get_the_post_thumbnail_url();
                    ?>
            <div class="food-card">
                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                <h3><?php echo ucwords(the_title()); ?></h3>
                <p class='price'>Regular Price:<?php echo $price ?></p>
                <p class='discount-price'> Discount: <?php echo $discount_price ?></p>
                <p>Stock: <?php echo $quantity; ?></p>
                <button class="add-to-cart" data-product-id="<?php echo $product_id; ?>"
                    data-product-name="<?php echo $product_name; ?>" data-product-price="<?php echo $price; ?>"
                    data-product-image="<?php echo $product_image; ?>">Add to Cart</button>
            </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>


        <div class="col food-cart">
            <h2>Your Cart JS</h2>
            <div id="cart-items">
            </div>
            <button id="checkout" disabled>Checkout</button>
        </div>
    </div>
</section> -->



<!-- Food Items Section -->
<!-- <section class="food-items">
    <h2>Our Special Menu</h2>
    <div class="row">
        <div class="food-grid col-9">
            <?php
            query_posts('post_type=product&post_status=publish&posts_per_page=15&order=ASC&paged=' . get_query_var('post'));
            if (have_posts()):
                while (have_posts()):
                    the_post();

                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $discount_price = get_post_meta(get_the_ID(), '_product_discount_price', true);
                    $quantity = get_post_meta(get_the_ID(), '_product_quantity', true);
                    $product_id = get_the_ID();
                    $product_name = get_the_title();
                    $product_image = get_the_post_thumbnail_url();

                    ?>
            <div class="food-card">
                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                <h3><?php echo ucwords(the_title()); ?></h3>
                <p><?php echo $discount_price ? '$' . $discount_price : '$' . $price; ?></p>
                <p>Stock: <?php echo $quantity; ?></p>
                <button class="add-to-cart" data-product-id="<?php echo $product_id; ?>"
                    data-product-name="<?php echo $product_name; ?>" data-product-price="<?php echo $price; ?>"
                    data-product-image="<?php echo $product_image; ?>">Add to Cart</button>
            </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>

        <!-- Cart Section -->
<div class="col food-cart">
    <h2>Your Cart</h2>
    <div id="cart-items">
        <!-- Cart items will be displayed here -->
    </div>
    <button id="checkout" disabled>Checkout</button>
</div>
</div>
</section> -->



<?php get_footer() ?>