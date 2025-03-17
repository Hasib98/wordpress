<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>

<?php
// Get the group field
$hero_section_group = get_field('hero_section_group');

// Debugging: Check if the group field exists
// var_dump($hero_section_group);

if ($hero_section_group) {
    $background_image = $hero_section_group['background_image'];
    $hero_pre_title = $hero_section_group['hero_pre_title'];
    $hero_title = $hero_section_group['hero_title'];
    $hero_description = $hero_section_group['hero_description'];
    $see_menu_button = $hero_section_group['see_menu_button'];
    $search_input = $hero_section_group['search_input'];
    $mouse_icon = $hero_section_group['mouse_icon'];

    // Debugging: Check if specific fields exist
    // var_dump($background_image);
}
?>

<section class='hero_section' style=" background: url('<?php echo $background_image; ?>') center/cover no-repeat;">

    <div class="container">
        <div class="contents">

            <div class="title_group">
                <p class="pre_title"><?php echo $hero_pre_title; ?></p>
                <h1 class="title"><?php echo $hero_title; ?></h1>
                <p class="description"> <?php echo $hero_description; ?></p>
                <div>

                    <!-- <button> See Menu</button> -->
                    <a href="<?php echo esc_url($see_menu_button['url']); ?>" class="btn">
                        <?php echo esc_html($see_menu_button['title'] ?? 'See Menu'); ?></a>
                    <input class="search_input" type=" text" placeholder='<?php echo $search_input; ?>'>
                </div>


            </div>
            <div class="mouse_icon">
                <img src="<?php echo $mouse_icon; ?>" alt="">
            </div>
        </div>
    </div>

</section>
<?php
// Get the group field data
$about_section_group = get_field('about_section_group');

// Extract all fields using the exact ACF field names
$about_section_title = $about_section_group['about_section_title'];
$about_section_description = $about_section_group['about_section_description'];
$about_us_button = $about_section_group['about_us_button'];  // ACF Link field
$review_count = $about_section_group['review_count'];
$count_unit = $about_section_group['count_unit'];
$review_description = $about_section_group['review_description'];
$avatar_image = $about_section_group['avatar_image'];  // Assuming it's a URL
$user_review_description = $about_section_group['user_review_description'];
$about_us_section_image = $about_section_group['about_us_section_image'];  // ACF Image field (array)

// Display the section
?>

<section class="we_are_indian_section">
    <div class="container">
        <div class="contents">
            <div class="title_group">

                <h1 class="title"><?php echo $about_section_title; ?></h1>
                <p class="description"><?php echo $about_section_description; ?></p>

                <button> About Us</button>

            </div>
            <div class="customer_review">
                <div class="review_count">
                    <div class="count">
                        <span> <?php echo $review_count; ?></span><span><?php echo $count_unit; ?></span>
                    </div>
                    <p><?php echo $review_description; ?></p>
                </div>
                <div class="divider"></div>
                <div class="review">
                    <img class="rounded_avatar" src="<?php echo $avatar_image ?>" alt="">
                    <p class="description"><?php echo $user_review_description ?>"</p>
                </div>
            </div>
        </div>
        <div>
            <img class="we_are_indian_image" src="<?php echo $about_us_section_image; ?>" alt="">
        </div>


    </div>
</section>

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

<section class="checkout_menu_section">
    <div class="container">
        <h1>Checkout Our Menu</h1>
        <div class="menu_taxonomy">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'menu-category',  // Correct slug
                'hide_empty' => false,  // Show terms even if they have no posts
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="menu_taxonomy_list">';
                foreach ($terms as $term) {
                    echo '<li><a class="btn" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No categories found.</p>';
            }
            ?>
        </div>
    </div>
    <!-- <div class="swiper xxxxx">
        <div class="swiper-wrapper">
            <div class="swiper-slide">Slide 1</div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div>
        </div>
        <div class="swiper-pagination"></div>
    </div> -->

    <?php
// Get the group field data
$newsletter_section_group = get_field('newsletter_section_group');

// Extract all fields using the exact ACF field names
$newsletter_section_pre_title = $newsletter_section_group['newsletter_section_pre_title'];
$newsletter_section_title = $newsletter_section_group['newsletter_section_title'];
$newsletter_section_description = $newsletter_section_group['newsletter_section_description'];
$newsletter_section_input_field_text = $newsletter_section_group['newsletter_section_input_field_text'];
$newsletter_section_button = $newsletter_section_group['newsletter_section_button'];  // ACF Link field
$newsletter_section_image = $newsletter_section_group['newsletter_section_image'];  // ACF Image field (array)

// Display the section
?>
</section>
<section class="newsletter_seciton">
    <div class="container">
        <div class="title_group">
            <p class="pre_title"><?php echo $newsletter_section_pre_title; ?></p>
            <h1 class="title"><?php echo $newsletter_section_title; ?></h1>
            <p class="description"><?php echo $about_section_description; ?></p>
            <div class="email_register">
                <input type="text" placeholder="<?php  echo $newsletter_section_input_field_text?>">
                <!-- <button> About Us</button> -->
                <a href="<?php echo esc_url($newsletter_section_button['url']); ?>" class="btn subscribe_btn">
                    <?php echo esc_html($reserve_table_button['title'] ?? 'Subscribe'); ?></a>

            </div>
        </div>
        <div>
            <img class="newsletter_cover_image" src="<?php echo $newsletter_section_image; ?>" alt="">
        </div>

    </div>
</section>


<?php
get_footer();

?>



<!-- <div class=" offer_cards_container">
    <div class="offer_card">
        <div class="card_image">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?>" alt="">
        </div>
        <div class="text_group">
            <div class="card_title_group">
                <h1>Spicy Club</h1>
                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used.</p>
            </div>
            <div class=" price">₹ 299</div>
        </div>
    </div>
    <div class="offer_card">
        <div class="card_image">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?>" alt="">
        </div>
        <div class="text_group">
            <div class="card_title_group">
                <h1>Spicy Club</h1>
                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used.</p>
            </div>
            <div class=" price">₹ 299</div>
        </div>
    </div>
    <div class="offer_card">
        <div class="card_image">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?>" alt="">
        </div>
        <div class="text_group">
            <div class="card_title_group">
                <h1>Spicy Club</h1>
                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used.</p>
            </div>
            <div class=" price">₹ 299</div>
        </div>
    </div>
    </div> -->