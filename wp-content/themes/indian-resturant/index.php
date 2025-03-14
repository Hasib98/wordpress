<?php get_header(); ?>

<?php
// Get the group field
$hero_section_group = get_field('hero_section_group');

// Debugging: Check if the group field exists
var_dump($hero_section_group);

if ($hero_section_group) {
    $background_image = $hero_section_group['background_image'];
    $hero_pre_title = $hero_section_group['hero_pre_title'];
    $hero_title = $hero_section_group['hero_title'];
    $hero_description = $hero_section_group['hero_description'];
    $see_menu_button = $hero_section_group['see_menu_button'];
    $search_input = $hero_section_group['search_input'];
    $mouse_icon = $hero_section_group['mouse_icon'];

    // Debugging: Check if specific fields exist
    // var_dump($hero_pre_title);
}
?>

<section class='hero_section'
    style=" background: url('<?php echo get_template_directory_uri() . '/assets/images/hero_image.png'; ?>') center/cover no-repeat;">

    <div class="container">
        <div class="contents">

            <div class="title_group">
                <p class="pre_title"><?php echo $hero_pre_title; ?></p>
                <!-- <p class="pre_title">A Indian Cuisine Restaurant</p> -->
                <h1 class="title">Healthy And Fresh Food In One Place</h1>
                <p class="description">In publishing and graphic design, Lorem ipsum is a placeholder text commonly
                    used
                    to
                    demonstrate the
                    visual form of a document.</p>
                <div>

                    <button> See Menu</button>
                    <input class="search_input" type=" text" placeholder='Search'>
                </div>


            </div>

            <div class="mouse_icon">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/mouse.svg'; ?>" alt="">
            </div>
        </div>
    </div>

</section>

<section class="we_are_indian_section">
    <div class="container">
        <div class="contents">
            <div class="title_group">

                <h1 class="title">We Are A Indian Restaurant make Delicious Recipe For Foodie people.</h1>
                <p class="description">In publishing and graphic design, Lorem ipsum is a place holder text commonly
                    used to demonstrate the visual form of a document.</p>

                <button> About Us</button>

            </div>
            <div class="customer_review">
                <div class="review_count">
                    <div class="count">
                        <span>4.5</span><span>K+</span>
                    </div>
                    <p class="review_text">Reviews of Customer</p>
                </div>
                <div class="divider"></div>
                <div class="review">
                    <img class="rounded_avatar"
                        src="https://cdn.vectorstock.com/i/1000x1000/38/27/male-face-avatar-logo-template-pictograph-vector-11333827.webp"
                        alt="">
                    <p class="description">demonstrate the visual form of a document.</p>
                </div>
            </div>
        </div>
        <div>
            <img class="we_are_indian_image"
                src="<?php echo get_template_directory_uri() . '/assets/images/indian_food_cook.png'; ?>" alt="">
        </div>


    </div>
</section>


<section class="menu_section">
    <div class="container">
        <div class="title_group">
            <p class="pre_title">A Indian Cuisine Restaurant</p>
            <h1 class="title">We are the best in this food town for a decade!</h1>
        </div>
        <div class="food_card_container">
            <div>
                <img class="we_are_indian_image"
                    src="<?php echo get_template_directory_uri() . '/assets/images/indian_food_cook.png'; ?>" alt="">
            </div>
            <div class="card_text">
                <h1 class="card_title">Spicy Club</h1>
                <p class="card_description">cIn publishing and graphic design, Lorem ipsum is a placeholder text
                    commonly used Lorem
                    ipsum
                    text
                    only.
                </p>
            </div>

        </div>

    </div>
</section>

<?php
get_footer();
?>