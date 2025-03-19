<?php

$location_section_group = get_field('location_section_group');

// /----------------------------------------------
// /----------------------------------------------

$daily_hours_group = $location_section_group['daily_hours_group'];

$daily_hours_icon = $daily_hours_group['icon'];
$business_hours_title = $daily_hours_group['business_hours_title'];
$day_time_range_repeater = $daily_hours_group['day_time_range_repeater'];
// /----------------------------------------------

$locations_group = $location_section_group['locations_group'];

$location_icon = $locations_group['icon'];
$location_title = $locations_group['location_title'];
$locations_address = $locations_group['address'];
// /----------------------------------------------

$contact_group = $location_section_group['contact_group'];

$contact_icon = $contact_group['icon'];
$contact_title = $contact_group['contact_title'];
$contact_info_repeater = $contact_group['contact_info_repeater'];
$location_cover_image = $location_section_group['location_cover_image'];

?>

<section class="location_section">
    <div class=" container">
        <div class="contact_location_info_group">
            <div class="info_card">
                <div class="image_container">
                    <img src="<?php echo $daily_hours_icon; ?>" alt="">
                </div>
                <div>
                    <h1><?php echo $business_hours_title; ?></h1>
                    <?php
                    if ($daily_hours_group && !empty($daily_hours_group['day_time_range_repeater'])):
                        foreach ($daily_hours_group['day_time_range_repeater'] as $daily_time_range):
                            // Check if 'nav_link' exists and is an array
                            if (!empty($daily_time_range['day_from']) && !empty($daily_time_range['day_to']) && !empty($daily_time_range['time_from']) && !empty($daily_time_range['time_to'])):
                                ?>

                    <p>
                        <span class="bold"><?php
                                echo $daily_time_range['day_from']
                                ?> - <?php
                                echo $daily_time_range['day_to']
                                ?>:</span><span><?php
                                echo $daily_time_range['time_from']
                                ?> - <?php
                                echo $daily_time_range['time_to']
                                ?></span>
                    </p>
                    <?php
                            endif;  // End if nav_link exists
                        endforeach;
                    endif;
                    ?>

                </div>
            </div>
            <div class="info_card">
                <div class="image_container">
                    <img src="<?php echo $location_icon; ?>" alt="">
                </div>
                <div>
                    <h1><?php echo $location_title; ?></h1>
                    <p><?php echo $locations_address; ?></p>
                </div>
            </div>
            <div class="info_card">
                <div class="image_container">
                    <img src="<?php echo $contact_icon; ?>" alt="">
                </div>
                <div>
                    <h1>Contact</h1>
                    <?php
                    if ($contact_group && !empty($contact_group['contact_info_repeater'])):
                        foreach ($contact_group['contact_info_repeater'] as $contact):
                            // Check if 'nav_link' exists and is an array
                            if (!empty($contact['contact_label']) && !empty($contact['contact_data'])):
                                ?>
                    <p><span
                            class="bold"><?php echo $contact['contact_label']; ?>:</span><span><?php echo $contact['contact_data']; ?></span>
                    </p>
                    <?php
                            endif;  // End if nav_link exists
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

        </div>
        <div>
            <div class="embed_map_fixed">
                <div class="embed_map_container"><iframe class="embed_map_frame" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?q=19.075983,72.877655&hl=en;z=14&amp;output=embed"></iframe>
                </div>
            </div>
            <!-- <img class="location_cover_image" src="<?php echo $location_cover_image; ?>" alt=""> -->
        </div>
    </div>
</section>