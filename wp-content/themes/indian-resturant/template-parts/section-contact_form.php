<?php

    $contact_information_section_group = get_field('contact_information_section_group');

    $contact_information_title = $contact_information_section_group['contact_information_title'];

    $contact_information_description = $contact_information_section_group['contact_information_description'];

    $contact_repeater = $contact_information_section_group['contact_repeater'];

?>
<section class="contact_section">
    <div class="container">
        <div class="contact_info">
            <h1><?php
                echo $contact_information_title;
            ?></h1>
            <p class="contact_description"><?php
                echo $contact_information_description;
            ?></p>
            <?php
                if($contact_information_section_group && !empty($contact_repeater)):
                    foreach($contact_repeater as $contact):
                        if(!empty($contact['icon']) &&  !empty($contact['label']) && !empty($contact['value']) ):
            ?>
            <div class="contact_single_info">
                <div class="icon_bg">
                    <img class="icon" src="<?php echo $contact['icon']; ?>" alt="">
                </div>
                <div class="contact_data">
                    <p class="contat_label"><?php echo $contact['label']; ?></p>
                    <p class="contact_value"><?php echo $contact['value']; ?></p>
                </div>
            </div>
            <?php
                endif;
            endforeach;
        endif;
            ?>
        </div>
        <div class="contact_form">
            <?php
            //  echo do_shortcode('[contact-form-7 id="c7835e4" title="Contact"]'); 
             echo do_shortcode('[contact-form-7 id="e9e7453" title="Contact"]'); 

             ?>

        </div>
    </div>


</section>