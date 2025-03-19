<?php

$newsletter_section_group = get_field('newsletter_section_group');

// Extract all fields using the exact ACF field names
$newsletter_section_pre_title = $newsletter_section_group['newsletter_section_pre_title'];
$newsletter_section_title = $newsletter_section_group['newsletter_section_title'];
$newsletter_section_description = $newsletter_section_group['newsletter_section_description'];
$newsletter_section_input_field_text = $newsletter_section_group['newsletter_section_input_field_text'];
$newsletter_section_button = $newsletter_section_group['newsletter_section_button'];  // ACF Link field
$newsletter_section_image = $newsletter_section_group['newsletter_section_image'];  // ACF Image field (array)
?>

<section class="newsletter_seciton">
    <div class="container">
        <div class="title_group">
            <p class="pre_title"><?php echo $newsletter_section_pre_title; ?></p>
            <h1 class="title"><?php echo $newsletter_section_title; ?></h1>
            <p class="description"><?php echo $newsletter_section_description; ?></p>
            <div class="email_register">
                <input type="text" placeholder="<?php echo $newsletter_section_input_field_text ?>">
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