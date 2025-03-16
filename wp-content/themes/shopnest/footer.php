<?php
wp_footer();

?>
<footer>
    <div class='row'>
        <div class='col-2'>

            <img class='logo' src="<?php echo get_field('footer_logo', 'options') ?>" alt="">
        </div>
        <div class="col-10 justify-content-around footer_list_group">

            <?php if (have_rows('footer_info', 'options')): ?>
            <?php while (have_rows('footer_info', 'options')):
                the_row(); ?>
            <div>
                <ul>
                    <li><strong><?php the_sub_field('head'); ?></strong></li>
                    <?php if (have_rows('footer_list')): ?>
                    <?php while (have_rows('footer_list')):
                        the_row(); ?>
                    <li><?php the_sub_field('list_value'); ?></li>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>

        </div>






</footer>
</body>

</html>
<!-- <div class="col-10 justify-content-around footer_list_group">
            <div>
            <?php if (have_rows('footer_info')): ?>
        <ul>
            <?php while (have_rows('footer_list')):
                the_row(); ?>
            <li><?php the_sub_field('list_value'); ?></li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </div>
    <div>
        <ul>
            <li><strong>Test 1</strong></li>
            <li>Test 1</li>
            <li>Test 1</li>
            <li>Test 1</li>
        </ul>
    </div>
    <div>
        <ul>
            <li><strong>Test 1</strong></li>
            <li>Test 1</li>
            <li>Test 1</li>
            <li>Test 1</li>

        </ul>
    </div>
    </div> -->