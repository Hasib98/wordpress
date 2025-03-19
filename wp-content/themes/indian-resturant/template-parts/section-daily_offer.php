<?php
// Get the group field data
$daily_offer_section_group = get_field('daily_offer_section_group');

$daily_offer_section_title = $daily_offer_section_group['daily_offer_section_title'];

$daily_offer_section_image = $daily_offer_section_group['daily_offer_section_image'];  // ACF Image field (array)

$daily_offer_section_image_title = $daily_offer_section_group['daily_offer_section_image_title'];

$daily_offer_section_image_offer = $daily_offer_section_group['daily_offer_section_image_offer'];

$daily_offer_section_image_button = $daily_offer_section_group['daily_offer_section_image_button'];

$daily_offer_image_vector = $daily_offer_section_group['daily_offer_image_vector'];

// Display the section
?>
<!-- ----------Daily Offer----------- -->
<section class='daily_offer_section'>
    <div class="container">
        <div class="title_group">
            <h1><?php
echo $daily_offer_section_title;
?></h1>
            <div class="slider_buttons">
                <div class='slider_button swiper-btn-prev'>
                    <div class="left_slider_button"></div>
                </div>
                <div class='slider_button swiper-btn-next'>
                    <div class="right_slider_button"></div>
                </div>
            </div>
        </div>
        <div class="content_group">
            <div class="image_container">
                <img class="daily_offer_image" src="<?php echo $daily_offer_section_image; ?>" alt="">
                <img class="daily_offer_image_rectangle"
                    src="<?php echo get_template_directory_uri() . '/assets/images/Rectangle.svg'; ?>" alt="">


                <h1 class="daily_offer_image_title"><?php echo $daily_offer_section_image_title; ?></h1>
                <div class="daily_offer_image_offer"><?php echo $daily_offer_section_image_offer; ?></div>
                <a class="btn reservation_button"
                    href="<?php echo esc_url($daily_offer_section_image_button['url']); ?>">
                    <?php echo esc_html($daily_offer_section_image_button['title'] ?? 'Make Reservation'); ?>
                </a>
                <img class="arrow_vector" src="<?php echo $daily_offer_image_vector; ?>" alt="">
            </div>

            <div class="swiper offer_swiper">
                <div class="swiper-wrapper">
                    <?php
                    $offer_card_query = new WP_Query(array(
                        'post_type' => 'daily-offer-post',  // Your custom post type
                        'posts_per_page' => -1,  // Fetch all available posts
                        'order' => 'DESC'
                    ));

                    if ($offer_card_query->have_posts()):
                        $counter = 0;
                        echo '<div class="swiper-slide"><div class="offer_cards_container">';

                        while ($offer_card_query->have_posts()):
                            $offer_card_query->the_post();

                            // Get ACF fields
                            $offer_food_image = get_field('food_image');
                            $offer_food_title = get_field('food_title');
                            $offer_food_description = get_field('food_description');
                            $offer_food_price = get_field('food_price');
                            $offer_post_link = get_permalink();  // Get the post URL
                            ?>

                    <div class="offer_card">
                        <div class="card_image">
                            <img src="<?php echo esc_url($offer_food_image); ?>" alt="">
                        </div>
                        <div class="text_group">
                            <div class="card_title_group">
                                <h1><?php echo esc_html($offer_food_title); ?></h1>
                                <p><?php echo esc_html($offer_food_description); ?></p>
                            </div>
                            <div class="price"><?php echo esc_html($offer_food_price); ?></div>
                        </div>
                    </div>

                    <?php
                            $counter++;
                            // After every 3 items, close the current slide and start a new one
                            if ($counter % 3 == 0) {
                                echo '</div></div>';  // Close current slide
                                if ($offer_card_query->current_post + 1 < $offer_card_query->post_count) {
                                    echo '<div class="swiper-slide"><div class="offer_cards_container">';
                                }
                            }
                        endwhile;

                        // Close any unclosed slide divs
                        // if ($counter % 3 !== 0) {
                        //     echo '</div></div>';
                        // }

                        wp_reset_postdata();
                    else:
                        echo '<p>No food items available.</p>';
                    endif;
                    ?>
                </div>
            </div>


        </div>
    </div>

</section>

<!-- <div class="swiper offer_swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="offer_cards_container">
                <?php
                $offer_card_query = new WP_Query(array(
                    'post_type' => 'daily-offer-post ',  // Your custom post type
                    'posts_per_page' => 3,  // Adjust number of posts to display
                    'order' => 'DESC'
                ));
                if ($offer_card_query->have_posts()):
                    while ($offer_card_query->have_posts()):
                        $offer_card_query->the_post();

                        // Get ACF fields
                        $offer_food_image = get_field('food_image');
                        $offer_food_title = get_field('food_title');
                        $offer_food_description = get_field('food_description');
                        $offer_food_price = get_field('food_price');
                        $offer_post_link = get_permalink();  // Get the post URL
                        ?>
                <div class="offer_card">
                    <div class="card_image">
                        <img src="<?php echo esc_url($offer_food_image); ?>" alt="">
                    </div>
                    <div class="text_group">
                        <div class="card_title_group">
                            <h1><?php echo esc_html($offer_food_title); ?></h1>
                            <p><?php echo esc_html($offer_food_description); ?></p>
                        </div>
                        <div class=" price"><?php echo esc_html($offer_food_price); ?></div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No food items availablee.</p>';
                endif;
                ?>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="offer_cards_container">
                <?php
                $offer_card_query = new WP_Query(array(
                    'post_type' => 'daily-offer-post ',  // Your custom post type
                    'posts_per_page' => 3,  // Adjust number of posts to display
                    'order' => 'DESC'
                ));
                if ($offer_card_query->have_posts()):
                    while ($offer_card_query->have_posts()):
                        $offer_card_query->the_post();

                        // Get ACF fields
                        $offer_food_image = get_field('food_image');
                        $offer_food_title = get_field('food_title');
                        $offer_food_description = get_field('food_description');
                        $offer_food_price = get_field('food_price');
                        $offer_post_link = get_permalink();  // Get the post URL
                        ?>
                <div class="offer_card">
                    <div class="card_image">
                        <img src="<?php echo esc_url($offer_food_image); ?>" alt="">
                    </div>
                    <div class="text_group">
                        <div class="card_title_group">
                            <h1><?php echo esc_html($offer_food_title); ?></h1>
                            <p><?php echo esc_html($offer_food_description); ?></p>
                        </div>
                        <div class=" price"><?php echo esc_html($offer_food_price); ?></div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No food items availablee.</p>';
                endif;
                ?>
            </div>
        </div>

    </div>
</div> -->