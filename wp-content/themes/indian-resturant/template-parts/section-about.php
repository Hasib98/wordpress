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

                <a href="<?php echo esc_url($about_us_button['url']); ?>" class="btn">
                    <?php echo esc_html($about_us_button['title'] ?? 'See Menu'); ?></a>

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