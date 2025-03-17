<section class="menu_section">
    <div class="container">
        <div class="list">
            <div class="title_group">
                <p class="pre_title">A Indian Cuisine Restaurant</p>
                <h1 class="title">We are the best in this food town for a decade!</h1>
            </div>

            <?php
            $food_query = new WP_Query(array(
                'post_type' => 'food-item',  // Your custom post type
                // 'posts_per_page' => 6, // Adjust number of posts to display
                'order' => 'DESC'
            ));

            if ($food_query->have_posts()):
                while ($food_query->have_posts()):
                    $food_query->the_post();

                    // Get ACF fields
                    $food_image = get_field('food_image');
                    $food_title = get_field('food_title');
                    $food_description = get_field('food_description');
                    $post_link = get_permalink();  // Get the post URL
                    ?>
            <a href="<?php echo esc_url($post_link); ?>">

                <div class="food_card_container">
                    <img src="<?php echo esc_url($food_image); ?>" alt="<?php echo esc_attr($food_title); ?>">
                    <h1 class="card_title"><?php echo esc_html($food_title); ?></h1>
                    <p class="card_description"><?php echo esc_html($food_description); ?></p>
                </div>
            </a>

            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No food items availablee.</p>';
            endif;
            ?>

        </div>
        <a href="<?php echo esc_url($see_menu_button['url']); ?>" class="btn">
            <?php echo esc_html($see_menu_button['title'] ?? 'See Menu'); ?></a>


    </div>
</section>