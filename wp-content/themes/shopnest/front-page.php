<?php get_header(); ?>

<?php

// Get the featured image URL
$hero_image = get_field('hero_image');
$title = get_field('title');
$sub_title = get_field('sub_title');

// Get the button URL from ACF
$cta_button = get_field('cta_button');
?>


<!-- Hero Section -->
<section class="hero row"
    style="background: url('<?php echo esc_url(get_field('hero_image')); ?>') center/cover no-repeat;">
    <div class="hero-content">
        <h1><?php echo get_field('title'); ?></h1>
        <p><?php echo get_field('sub_title'); ?></p>

        <!-- ACF Custom Button with Dynamic URL -->
        <?php if (!empty(get_field('cta_button'))): ?>
        <a href="<?php echo esc_url(get_field('cta_button')); ?>" class="btn">
            Shop Now
        </a>
        <?php else: ?>
        <p style="color: red;">No Shop Now URL Set</p> <!-- Debugging -->
        <?php endif; ?>
    </div>
</section>


<!-- Food Items Section -->
<?php get_template_part('template-parts/content', 'food'); ?>
<?php get_footer(); ?>