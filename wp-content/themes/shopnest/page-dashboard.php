<?php get_header() ?>

<?php
$current_user = wp_get_current_user();
//  var_dump($current_user);

?>
<section class='dashboard-info'>


    <h1> <?php echo esc_html($current_user->display_name) ?> </h1>
    <h1> <?php echo esc_html($current_user->user_email); ?> </h1>
    <h1> <?php echo esc_html($current_user->roles[0]); ?> </h1>
    <!-- <h1> <?php echo esc_html(var_dump($current_user->roles)); ?> </h1> -->
    <!-- <h1> <?php echo esc_html(var_dump($current_user->caps)); ?> </h1> -->


    <?php
    if ($current_user->roles[0] == 'administrator') {
        echo '<a href="' . home_url('/create-account') . '" class="btn btn-info add-food">Add New
    User</a>';
    }
    ?>

    <button class='btn btn-info add-food' id='add-food'>Add Food</button>


</section>
<?php

if ($current_user->roles[0] == 'author' || 'administrator') {
    get_template_part('template-parts/food', 'add');
}

get_template_part('template-parts/post', 'food');

?>




<?php get_footer() ?>