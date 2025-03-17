<!-- ----------Daily Offer----------- -->
<section class='daily_offer_section'>
    <div class="container">
        <div class="title_group">
            <h1>Our Daily Offer</h1>
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
                <img src="<?php echo get_template_directory_uri() . '/assets/images/offer.png'; ?>" alt="">
            </div>
            <!-- <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="offer_cards_container">
                            <?php
                            $offer_card_query = new WP_Query(array(
                                'post_type' => 'daily-offer-post',  // Your custom post type
                                // 'posts_per_page' => 6, // Adjust number of posts to display
                                'order' => 'DESC'
                            ));
                            if ($offer_card_query->have_posts()):
                                while ($offer_card_query->have_posts()):
                                    $offer_card_query->the_post();

                                    // Get ACF fields
                                    $offer_food_image = get_field('food_image');
                                    $offer_food_title = get_field('food_title');
                                    $offer_food_description = get_field('food_description');
                                    $offer_food_price = get_field('price');
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


        </div>
    </div>

</section>