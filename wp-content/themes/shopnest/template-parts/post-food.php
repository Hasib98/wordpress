<section class="food-items ">
    <h2>Our Special Menu</h2>
    <div class="row ">
        <div class="food-grid">
            <?php
            // query_posts('post_type=product&post_status=publish&order=ASC&paged=' . get_query_var('post'));
            query_posts('post_type=product&post_status=publish&posts_per_page=15&order=DESC&paged=' . get_query_var('post'));
            $user_id = get_current_user_id();
            $args = array(
                'author' => $user_id,  // Fetch posts only from this author
                'post_type' => 'product',  // Ensure it retrieves blog posts
            );

            $query = new WP_Query($args);

            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();

                    // Retrieve the custom meta values

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
            <div class="food-card">
                <?php echo the_post_thumbnail('product') ?>
                <p> Added By: <?php echo $posted_by . ' ' . $author_id ?></p>
                <h3> <?php
                    ucwords(the_title());
                    ?></h3>
                <p> <?php the_content(); ?></p>
                <p class='price'>Regular Price: <?php echo $price ?></p>
                <p class='discount-price'> Discount: <?php echo $discount_price ?></p>
                <p> Quantity: <?php echo $quantity ?></p>

                <!-- <div>

                    <a href="<?php echo get_post_permalink(); ?>">link</a>
                </div> -->
                <!-- <button type='submit' class="edit-food" product-id="<?php echo $product_id; ?>"
                    title="<?php echo $product_name; ?>" price="<?php echo $price; ?>"
                    discount="<?php echo $discount_price; ?>" image="<?php echo $product_image; ?>"
                    description="<?php echo $description; ?>"="<?php echo $quantity; ?>">Edit</button> -->
                <!-- <a class='btn btn-info' href="<?php echo get_edit_post_link($product_id) ?>">Edit</a> -->
                <a class='btn btn-info'
                    href="<?php echo home_url('/dashboard/edit') . '?id=' . $product_id . '&action=edit'; ?>">Edit</a>
                <!-- <a class='btn btn-danger'
                    href="<?php echo home_url('/dashboard/edit') . '?id=' . $product_id . '&action=delete'; ?>">Delete</a> -->
                <button class="delete-post-btn" data-post-id="<?php echo $product_id ?>">Delete</button>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();  // Reset query data to avoid conflicts
            endif
            ?>


        </div>


    </div>

</section>