<?php   wp_footer(  );  ?>
<?php
// Get the group field
$footer_group = get_field('footer_group', 'options');

if ($footer_group) {
    // Get the 'logo' field inside the group
    $logo_text = $footer_group['logo'];
    $footer_description = $footer_group['footer_description'];

    // Get the 'nav_repeater' inside the group
    $footer_nav_repeater = $footer_group['footer_nav_repeater'];
    $get_store_title = $footer_group['get_store_title'];
    $app_store_image = $footer_group['app_store_image'];
    $play_store_image = $footer_group['play_store_image'];
    $copyright_text = $footer_group['copyright_text'];
    $social_links_repeater = $footer_group['social_links_repeater'];
}

?>

<footer>
    <div class="container">
        <div class="footer_top">
            <div class="text_container">
                <h1 class="logo"> <?php echo $logo_text; ?></h1>
                <p> <?php echo $footer_description; ?></p>
                <?php
                    // Get the group field

                    if ($footer_group && !empty($footer_group['footer_nav_repeater'])):
                        ?>
                <ul>
                    <?php
                        foreach ($footer_group['footer_nav_repeater'] as $nav_item):
                            // Check if 'nav_link' exists and is an array
                            if (!empty($nav_item['footer_nav_link']) && is_array($nav_item['footer_nav_link'])):
                                ?>
                    <li><a href="<?php echo esc_url($nav_item['footer_nav_link']['url']); ?>"
                            target="<?php echo esc_attr($nav_item['footer_nav_link']['target'] ?? '_self'); ?>"><?php echo esc_html($nav_item['footer_nav_link']['title']); ?></a>
                    </li>
                    <?php
                            endif;  // End if nav_link exists
                        endforeach;
                        ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="get_app">
                <p>Get the app</p>
                <a href="#">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/app_store_badge.svg'; ?>" alt=""
                        class="app_store">
                </a>
                <a href="#">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/play_store_badge.svg'; ?>"
                        alt="" class="play_store">
                </a>
            </div>
        </div>
        <div class="bottom_line"></div>
        <div class="footer_bottom">
            <div class="copyright">&copy; 2077 Untitled UI. All rights reserved.</div>
            <?php
            if ($footer_group && !empty($footer_group['social_links_repeater'])):
             ?>
            <div class="social_links">
                <?php
                foreach ($footer_group['social_links_repeater'] as $social_item):
                    if (!empty($social_item['social_link']) && is_array($social_item['social_link'])):
                ?>

                <a href="<?php echo esc_url($social_item['social_link']['url']); ?>"><img class="social_icon"
                        src="<?php echo $social_item['social_icon']; ?>" alt=""></a>


                <?php
                    endif;  // End if nav_link exists
                endforeach;
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
</body>

</html>