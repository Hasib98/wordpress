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
    $ad_text_banner = $hero_section_group['ad_text_banner'];
}
?>
<section class='hero_section' style=" background: url('<?php echo $background_image; ?>') center/cover no-repeat;">
    <?php
        if($ad_text_banner){
            
            ?>
    <div class="add_text_banner"><span><?php echo ad_text_banner; ?></span></div>
    <?php      
            }
    ?>


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