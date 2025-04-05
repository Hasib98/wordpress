<section>
    <div class="container">


        <a id="watermarked-link" data-fancybox="gallery" href="javascript:void(0);">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test.jpg" width="200" height="150" alt="Delicious Food" />
        </a>




        <a data-fancybox="gallery" data-src="<?php echo $img_src = get_template_directory_uri() . '/assets/images/test.jpg'; ?>">
            <div class="image-container">
                <img src="<?php echo $img_src; ?>" width="200" height="150" alt="Delicious Food" />
            </div>
        </a>


        <a data-fancybox="gallery"
            data-src="https://lipsum.app/id/3/1600x1200">
            <img src="https://lipsum.app/id/3/200x150" width="200" height="150" alt="" />
        </a>

        <a data-fancybox="gallery"
            data-src="<?php echo get_template_directory_uri() . '/assets/images/food_1.png' ?>">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/food_1.png' ?>" width="200" height="150" alt="" />
        </a>
    </div>
</section>