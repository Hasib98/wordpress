<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">


<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="30"> -->
    <?php wp_head(); ?>
</head>
<?php

$string = 'login';
if (is_user_logged_in()) {
    $string = 'dashboard';
}

?>

<?php
function get_user_avatar($user_id)
{
    $avatar_url = get_user_meta($user_id, 'custom_avatar', true);

    if ($avatar_url) {
        return $avatar_url;  // Return the avatar URL if available
    }

    // Return a default avatar if no custom avatar is set
    return get_avatar_url($user_id);  // This will return Gravatar or a default image
}

?>

<body>

    <!-- Navigation -->

    <header>

        <!-- <div class="logo"><?php echo get_bloginfo('name'); ?></div> -->
        <img style=" width: 50px " src="<?php echo get_field('logo', 'options') ?>" alt="">

        <?php if (have_rows('menus', 'options')): // Check if the repeater exists ?>
        <nav>
            <ul>
                <?php
                while (have_rows('menus', 'options')):
                    the_row();
                    $menu_link = get_sub_field('menu_link');  // Get the subfield from the repeater

                    if ($menu_link):  // Check if the link field is not empty
                        $url = $menu_link['url'];
                        $title = $menu_link['title'];
                        $target = !empty($menu_link['target']) ? $menu_link['target'] : '_self';
                        ?>
                <li><a href="<?php echo esc_url($url) == '/' ? home_url() : home_url($url); ?>"
                        target="<?php echo esc_attr($target); ?>">
                        <?php echo esc_html($title); ?>
                    </a></li>
                <?php
                    endif;
                endwhile;
                ?>
                <?php
                if (is_user_logged_in()) {
                    echo '<li>' . wp_get_current_user()->display_name . '</li>';
                    echo '<li class="dropdown">
            <img src="' . esc_url(get_user_avatar(get_current_user_id())) . '" alt="">
            <ul class="dropdown_content">';

                    // Check if the repeater field has rows
                    if (have_rows('profile_dropdown', 'options')) {
                        while (have_rows('profile_dropdown', 'options')) {
                            the_row();
                            $dropdown_link = get_sub_field('dropdown_link');  // Assuming the field name inside the repeater is 'link'
                            // var_dump(home_url($dropdown_link['url']));

                            if ($dropdown_link) {
                                echo '<li><a href="'
                                    . esc_url($dropdown_link['url']) == '/' ? home_url() : home_url($url);

                                home_url($dropdown_link['url']) . '" target="' . esc_attr($dropdown_link['target']) . '">'
                                    . esc_html($dropdown_link['title'])
                                    . '</a></li>';
                            }
                        }
                    }

                    echo '
            </ul>
            </li>';
                }
                ?>

            </ul>
        </nav>
        <?php endif; ?>




    </header>