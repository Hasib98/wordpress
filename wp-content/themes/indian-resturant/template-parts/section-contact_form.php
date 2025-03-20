<?php
    $contact_information_section_group = get_field('contact_information_section_group');
    // var_dump($contact_information_section_group);


    $contact_information_title = $contact_information_section_group['contact_information_title'];

    
    $contact_information_description = $contact_information_section_group['contact_information_description'];

    $contact_repeater = $contact_information_section_group['contact_repeater'];






?>
<section class="contact_section">
    <div class="container">
        <div class="contact_info">
            <h1>Contact Infomation</h1>
            <p class="contact_description">Reference site about Lorem Ipsum, giving information on its origins, as well as</p>
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
            <?php echo do_shortcode('[contact-form-7 id="ddf106c" title="Contact"]'); ?>
        </div>
    </div>

    
</section>