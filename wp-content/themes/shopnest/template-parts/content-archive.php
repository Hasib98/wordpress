<div class="container">

    <div class="post mb-5">
        <div class="media">
            <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php
the_post_thumbnail_url('thumbnail');
// echo 'http://localhost/wordpress/wp-content/uploads/2025/02/1.jpg'
?>" alt="image">
            <div class="media-body">
                <h3 class="title mb-1"><?php the_title(); ?></h3>
                <div class=" meta mb-1"><span class="date"><?php the_date(); ?></span><span class="time">5 min
                        read</span><span class="comment"><a href="#"><?php comments_number(); ?></a></span>
                </div>
                <div class="intro"> <?php the_excerpt(); ?></div>
                <a class="more-link" href="<?php the_permalink(); ?>">Read more &rarr;</a>
            </div>
            <!--//media-body-->
        </div>
        <!--//media-->
    </div>

    <?php
    echo get_the_post_thumbnail_url('post-thumbnail');
    // http://localhost/wordpress/wp-content/uploads/2025/02/logo-1.png
    ?>






</div>