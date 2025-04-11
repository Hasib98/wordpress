<section class="checkout_menu_section">
    <div class="container">
        <h1>Checkout Our Menu</h1>
        <div class="menu_taxonomy">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'menu-category',  // Correct slug
                'hide_empty' => true,  // Show terms even if they have no posts
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="menu_taxonomy_list">';
                foreach ($terms as $term) {
                    echo '<li><button class="btn category_btn" data-category-id="' . $term->term_id . '">' . esc_html($term->name) . '</button></li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No categories found.</p>';
            }
            ?>
        </div>

        <!-- This div will be used to display posts -->
        <div class="swiper menu_swiper">
            <div class="swiper-wrapper  menu_swiper_wrapper">
                <!-- <div class="swiper-slide">Slide 1</div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
                <div class="swiper-slide">Slide 4</div>
                <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div> -->
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>