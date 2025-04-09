<?php if(!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html lang="<?php  language_attributes( ); ?> ">

<head>
    <meta charset=" <?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(  )?>
</head>

<body>
    <header>
        <div class=logo>
            <img src="<?php echo  get_template_directory_uri(  ).'/assets/images/logo.png' ?>" alt="">
        </div>
        <ul class='nav_item inter_display_basic'>
            <li>Services</li>
            <li>Contact us</li>
            <li>About us</li>
        </ul>
        <button class='get_started_btn poppins'>Get Started</button>
    </header>



    <section class="section_hero gradient_background">
        <div class="container">
            <div class="hero_contents">
                <div class="green_chip inter_display_basic">Offshore web and software development company</div>
                <div class="title_section title">Hire skilled developers
                    to build your Website & Apps</div>
                <p class="grey_paragraph hero_paragraph">Webermelon is a Website and Software Development Company. We
                    help startups and businesses set up remote teams and build their web or mobile application and
                    websites.</p>
                <div class="hero_butttons">
                    <button>Portfolio</button>
                    <button>Start your project -></button>
                </div>
            </div>

            <div class="swiper hero_swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_left.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_middle.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_right.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_right.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_right.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_right.png'?>  " alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/img_right.png'?>  " alt="">
                    </div>

                </div>
            </div>


        </div>
    </section>


    <section class="section_ceo">
        <div class="counter">
            <div class="count">
                <h1>200<span>+</span> </h1>
                <p class="grey_paragraph">Projects Completed</p>
            </div>
            <div class="count">
                <h1>200<span>+</span> </h1>
                <p class="grey_paragraph">Projects Completed</p>
            </div>
            <div class="count">
                <h1>200<span>+</span> </h1>
                <p class="grey_paragraph">Projects Completed</p>
            </div>
        </div>
        <div class="ceo_quotes">
            <div class="quote">“This is the best place to get your <span>website, software or mobile apps developed. Or
                    hiring skilled developers</span> as a team or individual.” </div>
        </div>
        <img src="<?php echo get_template_directory_uri(  ).'/assets/images/quotes.svg'?>  " alt="">
        <div class="ceo_name">Tanjil Ahmed Fahim</div>
        <p class="ceo_position">CEO - Webermelon</p>

        <div class="sister_concerns">
            <img src="<?php echo get_template_directory_uri(  ).'/assets/images/cg.svg'?>" alt="">
            <img src="<?php echo get_template_directory_uri(  ).'/assets/images/byteeat.svg'?>" alt="">
            <img src="<?php echo get_template_directory_uri(  ).'/assets/images/droboai.svg'?>" alt="">
            <img src="<?php echo get_template_directory_uri(  ).'/assets/images/tent.svg'?>" alt="">
            <img src="<?php echo get_template_directory_uri(  ).'/assets/images/coople.svg'?>" alt="">
        </div>


    </section>

    <section class="section_our_services">
        <div class="container">
            <div class="service_details">
                <h1>Our Services</h1>
                <p>From designs to marketing, Webermelon serves all digital services your business
                    needs to start and be succeeded</p>
                <button>Learn more</button>
            </div>

            <div class="service_card">
                <h1>Web & Mobile Apps Development</h1>
                <p>Webermelon is a Website and Software Development Company. We help startups and businesses set up
                    remote teams and build their SaaS, PaaS, apps, and websites.</p>
                <img src="<?php echo get_template_directory_uri(  ).'/assets/images/ezway.jpeg'?>" alt="">
            </div>
            <div class="service_card">
                <h1>Web & Mobile Apps Development</h1>
                <p>Webermelon is a Website and Software Development Company. We help startups and businesses set up
                    remote teams and build their SaaS, PaaS, apps, and websites.</p>
                <img src="<?php echo get_template_directory_uri(  ).'/assets/images/adsketcher.jpeg'?>" alt="">
            </div>

        </div>
    </section>


    <section class='section_case_studies'>
        <div class="container">
            <div class="case_card">
                <img src="<?php echo get_template_directory_uri(  ).'/assets/images/case_1.png'?>" alt="">
                <div>
                    <div>Website</div>
                    <div>Wordpress</div>
                </div>
                <div>Web Application Development</div>
            </div>

        </div>
    </section>


    <?php wp_footer(  );?>

</body>

</html>