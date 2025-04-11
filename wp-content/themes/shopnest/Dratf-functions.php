<?php
add_theme_support('title-tag');
add_image_size('post-thumbnails', array('page', 'post', 'product'));
add_image_size('product', 400, 200, true);

function shopnest_register_style()
{
    $shopnest_custom_css = get_template_directory_uri() . '/assets/css/shopnest-custom.css';

    wp_enqueue_style(
        'shopnest-style',
        $shopnest_custom_css,
        array('bootstrap-style'),
        filemtime(get_template_directory() . '/assets/css/shopnest-custom.css'),
        'all'
    );

    $shopnest_bootstrap_css = get_template_directory_uri() . '/assets/css/bootstrap.css';
    wp_enqueue_style(
        'bootstrap-style',
        $shopnest_bootstrap_css,
        array(),
        '5.3.3',
        'all'
    );
}

add_action('wp_enqueue_scripts', 'shopnest_register_style');

function smhasib_register_scripts()
{
    wp_enqueue_script('shopnest-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'smhasib_register_scripts');

// function custom_products_post_type()
// {
//     register_post_type('custom_product',
//         array(
//             'labels' => array(
//                 'name' => __('Products'),
//                 'singular_name' => __('Product'),
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
//             'menu_icon' => 'dashicons-embed-post',  // Icon for Job Posts
//         ));
// }

// add_action('init', 'custom_products_post_type');

/*
 * function create_job_post_type()
 * {
 *     $labels = array(
 *         'name' => 'Job Posts',
 *         'singular_name' => 'Job Post',
 *         'menu_name' => 'Job Posts',
 *         'name_admin_bar' => 'Job Post',
 *         'add_new' => 'Add New',
 *         'add_new_item' => 'Add New Job Post',
 *         'new_item' => 'New Job Post',
 *         'edit_item' => 'Edit Job Post',
 *         'view_item' => 'View Job Post',
 *         'all_items' => 'All Job Posts',
 *         'search_items' => 'Search Job Posts',
 *         'not_found' => 'No job posts found',
 *         'not_found_in_trash' => 'No job posts found in Trash',
 *         'parent_item_colon' => '',
 *         'all_items' => 'All Job Posts',
 *         'archives' => 'Job Post Archives',
 *         'attributes' => 'Job Post Attributes',
 *     );
 *
 *     $args = array(
 *         'labels' => $labels,
 *         'public' => true,
 *         'publicly_queryable' => true,
 *         'show_ui' => true,
 *         'show_in_menu' => true,
 *         'query_var' => true,
 *         'rewrite' => array('slug' => 'job-post'),
 *         'capability_type' => 'post',
 *         'has_archive' => true,
 *         'hierarchical' => false,
 *         'menu_position' => 5,
 *         'menu_icon' => 'dashicons-businessperson',  // Icon for Job Posts
 *         'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),  // Add fields you want
 *         'taxonomies' => array('category', 'post_tag'),  // Optional, if you want categories/tags
 *     );
 *
 *     register_post_type('job_post', $args);
 * }
 *
 * add_action('init', 'create_job_post_type');
 */

function custom_products_post_type()
{
    register_post_type('product',
        array(
            'labels' => array(
                'name' => __('Products'),
                'singular_name' => __('Product'),
                'add_new' => __('Add New Product'),
                'add_new_item' => __('Add New Product'),
                'edit_item' => __('Edit Product'),
                'new_item' => __('New Product'),
                'view_item' => __('View Product'),
                'search_items' => __('Search Products'),
                'not_found' => __('No products found'),
                'not_found_in_trash' => __('No products found in trash')
            ),
            'show_in_menu' => true,
            'menu_position' => null,
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-cart',  // Product icon in the dashboard
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'rewrite' => array('slug' => 'products'),
            'taxonomies' => array(
                'category',
                'post_tag',
            )
        ));
    add_theme_support('post-thumbnails');
}

add_action('init', 'custom_products_post_type');

function create_food_post_type()
{
    register_post_type('food_item',
        array(
            'labels' => array(
                'name' => __('Food Items', 'my-textdomain'),
                'singular_name' => __('Food Item', 'my-textdomain'),
                'add_new' => __('Add New Food', 'my-textdomain'),
                'edit_item' => __('Edit Food', 'my-textdomain'),
                'new_item' => __('New Food Item', 'my-textdomain'),
                'view_item' => __('View Food Item', 'my-textdomain'),
                'search_items' => __('Search Food Items', 'my-textdomain'),
                'not_found' => __('No food items found', 'my-textdomain'),
                'not_found_in_trash' => __('No food items found in trash', 'my-textdomain')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-carrot',  // Food-related icon
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => 'food'),
        ));
}

add_action('init', 'create_food_post_type');

function add_food_meta_boxes()
{
    add_meta_box('food_details', 'Food Details', 'food_meta_box_callback', 'food_item', 'normal', 'high');
}

add_action('add_meta_boxes', 'add_food_meta_boxes');

function food_meta_box_callback($post)
{
    $price = get_post_meta($post->ID, 'price', true);
    $discount_price = get_post_meta($post->ID, 'discount_price', true);
    $quantity = get_post_meta($post->ID, 'quantity', true);
    $details = get_post_meta($post->ID, 'details', true);
?>
<p><label>Price: </label>
    <input type="number" name="price" value="<?php echo esc_attr($price); ?>">
</p>

<p><label>Discount Price: </label>
    <input type="number" name="discount_price" value="<?php echo esc_attr($discount_price); ?>">
</p>

<p><label>Quantity: </label>
    <input type="number" name="quantity" value="<?php echo esc_attr($quantity); ?>">
</p>

<p><label>Details: </label>
    <textarea name="details"><?php echo esc_textarea($details); ?></textarea>
</p>
<?php
}

function save_food_meta($post_id)
{
    if (isset($_POST['price'])) {
        update_post_meta($post_id, 'price', sanitize_text_field($_POST['price']));
    }
    if (isset($_POST['discount_price'])) {
        update_post_meta($post_id, 'discount_price', sanitize_text_field($_POST['discount_price']));
    }
    if (isset($_POST['quantity'])) {
        update_post_meta($post_id, 'quantity', sanitize_text_field($_POST['quantity']));
    }
    if (isset($_POST['details'])) {
        update_post_meta($post_id, 'details', sanitize_textarea_field($_POST['details']));
    }
}

add_action('save_post', 'save_food_meta');

function create_food_category_taxonomy()
{
    register_taxonomy(
        'food_category',
        'food_item',
        array(
            'label' => __('Food Categories', 'my-textdomain'),
            'rewrite' => array('slug' => 'food-category'),
            'hierarchical' => true,
        )
    );
}

add_action('init', 'create_food_category_taxonomy');

?>