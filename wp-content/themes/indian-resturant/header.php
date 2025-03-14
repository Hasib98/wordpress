<?php
// Get the group field
$header_group = get_field('header_group');

if ($header_group) {
    // Get the 'logo' field inside the group
    $logo_text = $header_group['logo'];

    // Get the 'nav_repeater' inside the group
    $nav_repeater = $header_group['nav_repeater'];

    // Get the 'reserve_table_button' link inside the group
    $reserve_table_button = $header_group['reserve_table_button'];
    // var_dump(get_field('nav_repeater'));
    // Get the 'drop_down_icon' image URL field
    $drop_down_icon = $header_group['drop_down_icon'];
}

?>

<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
    <meta charset="<?php bloginfo('charset') ?> ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="container">

            <!-- Logo Section -->
            <div class="header_content">

                <h1 class=" logo"> <?php echo $logo_text; ?></h1>

                <nav>
                    <?php
                    // Get the group field

                    if ($header_group && !empty($header_group['nav_repeater'])):
                        ?>
                    <ul class="nav_menu">
                        <?php
                        foreach ($header_group['nav_repeater'] as $nav_item):
                            // Check if 'nav_link' exists and is an array
                            if (!empty($nav_item['nav_link']) && is_array($nav_item['nav_link'])):
                                ?>
                        <li>
                            <a href="<?php echo esc_url($nav_item['nav_link']['url']); ?>"
                                target="<?php echo esc_attr($nav_item['nav_link']['target'] ?? '_self'); ?>">
                                <?php echo esc_html($nav_item['nav_link']['title']); ?>
                            </a>
                        </li>
                        <?php
                            endif;  // End if nav_link exists
                        endforeach;
                        ?>
                    </ul>
                    <?php endif; ?>



                    <!-- <ul class="nav_menu">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul> -->
                </nav>

                <div class="header_buttons">
                    <!-- <div class="menu_btn"
                        style="content: url('<?php echo get_template_directory_uri() . '/assets/images/menu_button.svg'; ?>')">
                        ></div> -->
                    <div class="menu_btn"></div>
                    <img src="<?php echo esc_url($drop_down_icon); ?>" alt="Dropdown Icon">
                    <!-- <a class="btn menu_btn">Reserve Table</a> -->
                    <a href="<?php echo esc_url($reserve_table_button['url']); ?>" class="btn reserve_table_btn">
                        <?php echo esc_html($reserve_table_button['title'] ?? 'Reserve Now'); ?></a>
                </div>
            </div>
        </div>
    </header>