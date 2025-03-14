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


<!-- <section class="menu_section">
    <div class="container">
        <div class="list">
            <div class="title_group">
                <p class="pre_title">A Indian Cuisine Restaurant</p>
                <h1 class="title">We are the best in this food town for a decade!</h1>
            </div>
            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/hero_image.png'; ?>" alt="">
                <h1 class="card_title">Spicy Club</h1>
                <p class="card_description">In publishing and graphic design, Lorem ipsum is a placeholder text
                    commonly used Lorem
                    ipsum
                    text
                    only.
                </p>
            </div>
            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/test.jpg'; ?>" alt="">
                <h1 class="card_title">Spicy Club</h1>
                <p class="card_description">cIn publishing and graphic design, Lorem ipsum is a placeholder text
                    commonly used Lorem
                    ipsum
                    text
                    only.
                </p>
            </div>
            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/test_2.jpg'; ?>" alt="">
                <h1 class="card_title">Spicy Club</h1>
                <p class="card_description">cIn publishing and graphic design, Lorem ipsum is a placeholder text
                    commonly used Lorem
                    ipsum
                    text
                    only.
                </p>
            </div>

            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/food_2.png'; ?>" alt="">
                <h1 class="card_title">Spicy Club</h1>
                <p class="card_description">cIn publishing and graphic design, Lorem ipsum is a placeholder text
                    commonly used Lorem
                    ipsum
                    text
                    only.
                </p>
            </div>

            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/food_2.png'; ?>" alt="">
                <h1 class="card_title">yoo suppp</h1>
                <p class="card_description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                    consequat massa quis enim.</p>
            </div>
            <div class="food_card_container">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/indian_food_cook.png'; ?>" alt="">
                <h1 class="card_title">Hehe boiI!!!</h1>
                <p class="card_description">The European languages are members of the same family. Their separate
                    existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary.</p>
            </div>




        </div>

    </div>

</section> -->
<section class="menu_section">
    <div class="container">
        <div class="list">
            <div class="title_group">
                <p class="pre_title">A Indian Cuisine Restaurant</p>
                <h1 class="title">We are the best in this food town for a decade!</h1>
            </div>

            <?php
            $food_query = new WP_Query(array(
                'post_type'      => 'food-item', // Your custom post type
                // 'posts_per_page' => 6, // Adjust number of posts to display
                'order'          => 'DESC'
            ));

            if ($food_query->have_posts()) :
                while ($food_query->have_posts()) : $food_query->the_post();

                    // Get ACF fields
                    $food_image = get_field('food_image');
                    $food_title = get_field('food_title');
                    $food_description = get_field('food_description');
                    ?>

            <div class="food_card_container">
                <img src="<?php echo esc_url($food_image); ?>" alt="<?php echo esc_attr($food_title); ?>">
                <h1 class="card_title"><?php echo esc_html($food_title); ?></h1>
                <p class="card_description"><?php echo esc_html($food_description); ?></p>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo "<p>No food items availablee.</p>";
            endif;
            ?>

        </div>
    </div>
</section>



<?php
get_footer();

?>





<!-- <?php
$images = [
    get_template_directory_uri() . '/assets/images/hero_image.png',
    get_template_directory_uri() . '/assets/images/test_2.jpg',
    get_template_directory_uri() . '/assets/images/food_2.png',
    get_template_directory_uri() . '/assets/images/food_1.png',
    get_template_directory_uri() . '/assets/images/indian_food_cook.png'
];

for ($i = 0; $i < 15; $i++) {
    $randomImage = $images[array_rand($images)];
    ?>
<div class="food_card_container">
    <img src="<?php echo $randomImage; ?>" alt="">
    <h1 class="card_title">Spicy Club</h1>
    <p class="card_description">In publishing and graphic design, Lorem ipsum is a placeholder text
        commonly used Lorem ipsum text only.</p>
</div>
<?php
}
?> -->