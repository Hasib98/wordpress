<section class="checkout_menu_section">
    <div class="container">
        <h1>Checkout Our Menu</h1>
        <div class="menu_taxonomy">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'menu-category',  // Correct slug
                'hide_empty' => false,  // Show terms even if they have no posts
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<ul class="menu_taxonomy_list">';
                foreach ($terms as $term) {
                    echo '<li><a class="btn" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No categories found.</p>';
            }
            ?>
        </div>
    </div>
    <!-- <div class="swiper xxxxx">
        <div class="swiper-wrapper">
            <div class="swiper-slide">Slide 1</div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div>
        </div>
        <div class="swiper-pagination"></div>
    </div> -->
</section>