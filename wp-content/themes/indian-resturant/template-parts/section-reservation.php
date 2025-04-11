<?php
    $is_reservation = is_page("reservation");
?>
<section class="reservation_section" <?php echo !$is_reservation ? 'style="background: url(\'' . get_template_directory_uri() . '/assets/images/reservation_bg.png\') center/cover no-repeat;"' : ''; ?>
>
    <div class="container">
        <div class="contents">
            <h1 <?php echo $is_reservation ? 'style="color:black; text-align: center;"' : ''; ?>
            >Online Reservation</h1>
            <div class="reservation_form">
                <?php echo do_shortcode('[contact-form-7 id="a59fd0f" title="Reservation"]'); ?>
            </div>
        </div>
    </div>
</section>