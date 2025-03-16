<?php get_header() ?>

<?php

// if (!is_user_logged_in()) {
//     wp_redirect(get_template_directory_uri() . '/login');
//     // wp_redirect(get_template_directory_uri() . '/login');
// }
?>

<section class='form-section'>
    <div class="form-card card">

        <h1> <?php echo get_the_title(); ?></h1>
        <!-- <h1> <?php echo is_user_logged_in() ? 'true' : 'false'; ?></h1> -->

        <form class='form card' id='loginForm'>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email"
                    value='	smhasib@test.com' id="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Password" id="password" value='smhasib'>
            </div>
            <?php
            // wp_nonce_field('hasib');

            // echo wp_create_nonce('hasib');
            ?>

            <button type="submit" class="btn btn-info">Login</button>
        </form>
        <!-- <p>Not registerd? <span><a href="<?php echo get_template_directory_uri() . '/create-account   ' ?>">Create
            an
            account</a></span></p> -->
        <p class="form-check">
            <input class="form-check-input checkbox" type="checkbox" id="rememberme" checked>
            <label class="form-check-label" for="flexCheckChecked">
                Remember me?
            </label>
        </p>
    </div>
</section>
<?php get_footer() ?>