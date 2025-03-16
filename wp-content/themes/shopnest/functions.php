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
    wp_enqueue_script('jquery');
    // wp_enqueue_script('shopnest-cart', get_template_directory_uri() . '/assets/js/cart.js', array(), '1.0.0', true);

    wp_localize_script('shopnest-main', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('hasib_checkout')]);
    wp_localize_script('shopnest-main', 'my_ajax_nonce', wp_create_nonce('my_cart_nonce'));
    // wp_localize_script('shopnest-main', 'my_ajax_nonce', wp_create_nonce('ajax-login-nonce'));
    // wp_localize_script('shopnest-main', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-login-nonce')]);
    // Localize script to pass AJAX URL and nonce
    wp_localize_script('custom-login-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),  // Pass the AJAX URL
        'nonce' => wp_create_nonce('custom_login_nonce'),  // Generate a security nonce
    ));
}

add_action('wp_enqueue_scripts', 'smhasib_register_scripts');

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
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => 'products'),
            'taxonomies' => array(
                'category',
                'post_tag',
            )
        ));
    add_theme_support('post-thumbnails');
}

add_action('init', 'custom_products_post_type');

// Add a meta box for product details
function add_product_meta_boxes()
{
    add_meta_box(
        'product_meta_box',  // Unique ID
        'Product Details',  // Box title
        'display_product_meta_box',  // Callback function
        'product',  // Post type
        'normal',  // Context
        'high'  // Priority
    );
}

add_action('add_meta_boxes', 'add_product_meta_boxes');

// Display the fields in the meta box
function display_product_meta_box($post)
{
    // print $post;
    // Retrieve existing values
    $price = get_post_meta($post->ID, '_product_price', true);
    $discount_price = get_post_meta($post->ID, '_product_discount_price', true);
    $quantity = get_post_meta($post->ID, '_product_quantity', true);
    $postedby = get_post_meta($post->ID, '_product_posted_by', true);  // postedby added

    wp_nonce_field(basename(__FILE__), 'product_meta_nonce');  // Security nonce
?>
<p>
    <label for="product_price"><strong>Price:</strong></label>
    <input type="number" name="product_price" id="product_price" value="<?php echo esc_attr($price); ?>" step="0.01"
        min="0" style="width:100%;">
</p>
<p>
    <label for="product_discount_price"><strong>Discount Price:</strong></label>
    <input type="number" name="product_discount_price" id="product_discount_price"
        value="<?php echo esc_attr($discount_price); ?>" step="0.01" min="0" style="width:100%;">
</p>
<p>
    <label for="product_quantity"><strong>Quantity:</strong></label>
    <input type="number" name="product_quantity" id="product_quantity" value="<?php echo esc_attr($quantity); ?>"
        min="0" style="width:100%;">
</p>
<label for="product_posted_by"><strong>Posted By:</strong></label>
<input type="text" name="product_posted_by" id="product_posted_by" value="<?php echo esc_attr($postedby); ?>"
    style="width:100%;">
</p>
<?php
}

// Save the custom field values
function save_product_meta($post_id)
{
    if (!isset($_POST['product_meta_nonce']) || !wp_verify_nonce($_POST['product_meta_nonce'], basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Price
    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }

    // Save Discount Price
    if (isset($_POST['product_discount_price'])) {
        update_post_meta($post_id, '_product_discount_price', sanitize_text_field($_POST['product_discount_price']));
    }

    // Save Quantity
    if (isset($_POST['product_quantity'])) {
        update_post_meta($post_id, '_product_quantity', sanitize_text_field($_POST['product_quantity']));
    }

    // Save Posted By
    if (isset($_POST['product_posted_by'])) {
        update_post_meta($post_id, '_product_posted_by', sanitize_text_field($_POST['product_posted_by']));
    }
}

add_action('save_post', 'save_product_meta');

// The Db connection of the thing starts from here----------------------------------

function shopnest_create_database_order_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'shopnest_orders';  // Custom table name
    $charset_collate = $wpdb->get_charset_collate();  // Get proper charset & collation

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        user_name VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        quantity INT(10) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// Hook to ensure it runs when the theme initializes
add_action('init', 'shopnest_create_database_order_table');

function shopnest_add_admin_menu()
{
    add_menu_page(
        'ShopNest Orders',  // Page Title
        'ShopNest Orders',  // Menu Title
        'manage_options',  // Capability (Admin Only)
        'shopnest-orders',  // Menu Slug
        'shopnest_orders_page',  // Callback function to display the page content
        'dashicons-cart',  // Icon
        25  // Position (optional)
    );
}

add_action('admin_menu', 'shopnest_add_admin_menu');

function shopnest_orders_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'shopnest_orders';

    // Fetch orders from the database
    $orders = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at ASC", ARRAY_A);

    // var_dump($orders);

    // Display the orders table in the admin panel
    echo '<div class="wrap">';
    echo '<h1>ShopNest Orders</h1>';

    if (!empty($orders)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead>
                <tr>
                    <th>Order Id</th>
                    <th>User Id</th>
                    <th>Customer Name</th>
                    <th>Foods</th>
                    <th>Total Items</th>
                    <th> Total Price</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
              </thead>';
        echo '<tbody>';

        foreach ($orders as $order) {
            echo '<tr>';
            echo '<td>' . esc_html($order['id']) . '</td>';
            echo '<td>' . esc_html($order['user_id']) . '</td>';
            echo '<td>' . esc_html($order['user_name']) . '</td>';
            echo '<td>' . esc_html($order['title']) . '</td>';
            echo '<td>' . esc_html($order['quantity']) . '</td>';
            echo '<td>$' . esc_html($order['price']) . '</td>';
            echo '<td>' . esc_html($order['created_at']) . '</td>';
            echo '<td>
                    <a href="?page=shopnest-orders&delete=' . esc_attr($order['id']) . '" class="button button-small">Delete</a>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No orders found.</p>';
    }

    echo '</div>';
}

function shopnest_delete_order_admin()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'shopnest_orders';

    if (isset($_GET['delete'])) {
        $order_id = intval($_GET['delete']);
        $wpdb->delete($table_name, array('id' => $order_id), array('%d'));

        // Redirect to refresh the page after deletion
        wp_redirect(admin_url('admin.php?page=shopnest-orders'));
        exit;
    }
}

add_action('admin_init', 'shopnest_delete_order_admin');

function my_function()
{
    // check_ajax_referer('hasib_checkout', 'nonce');
    if ($_POST['nonce'] !== wp_create_nonce('hasib_checkout'))
        die;
    $arraycart = [];  // Initialize the array

    $cartfull = $_POST['data'];
    // $cartDb = $cartfull['cartData'];
    // $cartfull = $cartfull['cartjson'];

    // $cartfull[0]['id'];
    foreach ($cartfull['cartjson'] as $item) {
        // Use array_push() or [] to append the 'id'
        $arraycart[] = $item['id'];  // This is a shorthand for array_push
    }

    foreach ($cartfull['cartjson'] as $item) {
        update_post_meta(
            (int) $item['id'],
            '_product_quantity',
            get_post_meta((int) $item['id'], '_product_quantity', true) - (int) $item['quantity']
        );
    }

    // $json_cart = json_decode($cartData['datacart']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'shopnest_orders';

    $wpdb->insert(
        $table_name,
        array(
            'user_id' => get_current_user_id(),
            'user_name' => wp_get_current_user()->display_name,
            'title' => sanitize_text_field($cartfull['cartData']['foods']),  // Use the processed foods list
            'quantity' => $cartfull['cartData']['quantity'],
            'price' => $cartfull['cartData']['price']
        ),
    );

    // wp_send_json_success($json_cart);
    wp_send_json_success($cartfull);
    die;
}

add_action('wp_ajax_my_action', 'my_function');
// add_action('wp_ajax_nopriv_my_action', 'my_function');

function custom_login_ajax()
{
    // check_ajax_referer('ajax-login-nonce', 'security');

    $loginData = $_POST['data'];

    $creds = array(
        'user_login' => sanitize_text_field($loginData['email']),
        'user_password' => $loginData['password'],
        // 'remember' => true
        'remember' => (bool) $loginData['rememberme']
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        // wp_send_json(['success' => false, 'message' => $user->get_error_message()]);
        wp_send_json(['success' => false, 'message' => 'The Password or Email ID that you have entered is incorrect']);
    } else {
        wp_send_json(['success' => true, 'redirect' => home_url('/dashboard/')]);
    }

    // wp_send_json_success($loginData);

    // die;
}

add_action('wp_ajax_custom_login', 'custom_login_ajax');
add_action('wp_ajax_nopriv_custom_login', 'custom_login_ajax');

function login_redirect()
{
    if (is_page('login') && is_user_logged_in()) {
        wp_redirect(home_url('/dashboard/'));  // Redirect to dashboard
        exit;
    }
}

add_action('template_redirect', 'login_redirect');

function dashboard_redirect()
{
    if (is_page('dashboard') && !is_user_logged_in()) {
        wp_redirect(home_url('/login/'));  // Redirect to dashboard
        exit;
    }
}

add_action('template_redirect', 'dashboard_redirect');

function handle_custom_food_post()
{
    // Check if the request is coming from an AJAX call
    if (!isset($_POST['action']) || $_POST['action'] !== 'testfnc') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    // Validate required fields
    $required_fields = ['title', 'description', 'price', 'discount', 'quantity'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst($field) . ' is required.']);
            wp_die();
        }
    }

    // Handle image upload and set as featured image
    if (!empty($_FILES['image'])) {
        $uploaded_file = $_FILES['image'];

        if ($uploaded_file['error'] !== 0) {
            wp_send_json_error(['message' => 'Image upload failed.']);
            wp_die();
        }

        // Include WordPress file handling functions
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        // Upload the image to the media library
        $attachment_id = media_handle_upload('image', 0);

        if (is_wp_error($attachment_id)) {
            wp_send_json_error(['message' => 'Media upload error: ' . $attachment_id->get_error_message()]);
            wp_die();
        }

        // Get the image URL
        $image_url = wp_get_attachment_url($attachment_id);
    } else {
        wp_send_json_error(['message' => 'No image uploaded.']);
        wp_die();
    }

    // Insert post into database (if required)

    $post_data = [
        'post_title' => sanitize_text_field($_POST['title']),
        'post_content' => sanitize_textarea_field($_POST['description']),
        'post_status' => 'publish',
        'post_type' => 'product',  // Change this to your custom post type if needed
        'post_author' => get_current_user_id(),  // post_author added
    ];

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'Failed to create post.']);
        wp_die();
    }

    // Set uploaded image as the featured image (post thumbnail)
    set_post_thumbnail($post_id, $attachment_id);

    // Save meta fields

    update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['price']));
    update_post_meta($post_id, '_product_discount_price', sanitize_text_field($_POST['discount']));
    update_post_meta($post_id, '_product_quantity', sanitize_text_field($_POST['quantity']));
    update_post_meta($post_id, '_product_posted_by', wp_get_current_user()->display_name);
    // update_post_meta($post_id, 'image_url', esc_url($image_url));

    // Return success response
    wp_send_json_success(['message' => 'Food item added successfully!', 'url' => $image_url]);

    wp_die();
}

// Register the AJAX function
add_action('wp_ajax_testfnc', 'handle_custom_food_post');
add_action('wp_ajax_nopriv_testfnc', 'handle_custom_food_post');  // For non-logged-in users

function update_custom_food_post()
{
    // Check if the request is coming from an AJAX call
    if (!isset($_POST['action']) || $_POST['action'] !== 'updatefnc') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    // Validate required fields
    $required_fields = ['title', 'description', 'price', 'discount', 'quantity', 'post_id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst($field) . ' is required.']);
            wp_die();
        }
    }

    // Ensure post ID is provided and valid
    $post_id = intval($_POST['post_id']);
    if (!$post_id || get_post_status($post_id) === false) {
        wp_send_json_error(['message' => 'Invalid post ID.']);
        wp_die();
    }

    // Prepare post data for updating
    $post_data = [
        'ID' => $post_id,
        'post_title' => sanitize_text_field($_POST['title']),
        'post_content' => sanitize_textarea_field($_POST['description']),
        'post_status' => 'publish',
        'post_type' => 'product',
    ];

    $updated_post_id = wp_update_post($post_data);

    if (is_wp_error($updated_post_id)) {
        wp_send_json_error(['message' => 'Failed to update post.']);
        wp_die();
    }

    $image_url = '';

    // Handle image upload and set as featured image
    if (!empty($_FILES['image']['name'])) {
        $uploaded_file = $_FILES['image'];

        if ($uploaded_file['error'] !== 0) {
            wp_send_json_error(['message' => 'Image upload failed.']);
            wp_die();
        }

        // Include WordPress file handling functions
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        // Upload the image to the media library
        $attachment_id = media_handle_upload('image', $post_id);

        if (is_wp_error($attachment_id)) {
            wp_send_json_error(['message' => 'Media upload error: ' . $attachment_id->get_error_message()]);
            wp_die();
        }

        // Set the uploaded image as the post's featured image
        set_post_thumbnail($post_id, $attachment_id);

        // Get the image URL
        $image_url = wp_get_attachment_url($attachment_id);
    }

    // Update meta fields
    update_post_meta($post_id, '_product_price', intval($_POST['price']));
    update_post_meta($post_id, '_product_discount_price', intval($_POST['discount']));
    update_post_meta($post_id, '_product_quantity', intval($_POST['quantity']));

    // Return success response
    wp_send_json_success([
        'message' => 'Food item updated successfully!',
        'postid' => $updated_post_id,
        'url' => [$image_url],
    ]);

    wp_die();
}

// Register the AJAX function
add_action('wp_ajax_updatefnc', 'update_custom_food_post');
add_action('wp_ajax_nopriv_updatefnc', 'update_custom_food_post');  // For non-logged-in users

function delete_custom_food_post()
{
    // Check if the request is coming from an AJAX call
    if (!isset($_POST['action']) || $_POST['action'] !== 'deletefnc') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    if (!empty($_POST['post_id'])) {
        $deleted_id = $_POST['post_id'];
        wp_delete_post($deleted_id, true);  // Deletes the post permanently
    }

    // Return success response
    wp_send_json_success([
        'message' => 'Food item deleted successfully!',
        'postid' => $deleted_id,
    ]);

    wp_die();
}

// Register the AJAX function
add_action('wp_ajax_deletefnc', 'delete_custom_food_post');
add_action('wp_ajax_nopriv_deletefnc', 'delete_custom_food_post');  // For non-logged-in users

// /////////////////////////////////////
// ///////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////

// wp user custom registration
function upload_user_avatar($user_id, $file)
{
    if (!function_exists('wp_handle_upload')) {
        require_once (ABSPATH . 'wp-admin/includes/file.php');
    }

    // Upload overrides
    $upload_overrides = array('test_form' => false);
    $uploaded_file = wp_handle_upload($file, $upload_overrides);

    if (!isset($uploaded_file['file'])) {
        return false;  // Upload failed
    }

    $filename = $uploaded_file['file'];

    // Prepare attachment for Media Library
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    // Insert into Media Library
    $attach_id = wp_insert_attachment($attachment, $filename);
    require_once (ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
    wp_update_attachment_metadata($attach_id, $attach_data);

    // Get uploaded image URL
    return wp_get_attachment_url($attach_id);
}

function custom_registration_ajax()
{
    // Check if the request is coming from an AJAX call
    if (!isset($_POST['action']) || $_POST['action'] !== 'custom_registration') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }
    // $regData = $_POST['data'];

    // Create user data array
    $user_data = array(
        'user_login' => sanitize_text_field($_POST['username']),
        'user_pass' => $_POST['password'],  // Password (hashed automatically)
        'user_email' => sanitize_email($_POST['email']),
        'first_name' => sanitize_text_field($_POST['firstName']),
        'last_name' => sanitize_text_field($_POST['lastName']),
        // 'role' => sanitize_text_field($_POST['role'])  // Assigns a role
        'role' => 'author'  // Assigns a role
    );

    $user_id = wp_insert_user($user_data);

    if (is_wp_error($user_id)) {
        wp_send_json(['success' => false, 'message' => $user_id->get_error_message()]);
    }

    // Handle Avatar Upload (if provided)
    if (!empty($_FILES['image'])) {
        $avatar_url = upload_user_avatar($user_id, $_FILES['image']);
        if ($avatar_url) {
            update_user_meta($user_id, 'custom_avatar', $avatar_url);
        }
    }

    wp_send_json(['success' => true, 'message' => 'User created successfully.', 'user_id' => $user_data, 'image' => $_FILES['image'], 'avatar' => $avatar_url]);
}

add_action('wp_ajax_custom_registration', 'custom_registration_ajax');
add_action('wp_ajax_nopriv_custom_registration', 'custom_registration_ajax');

// function custom_avatar_url($url, $id_or_email, $args)
// {
//     // Define your custom avatar URL
//     $custom_avatar_url = 'http://localhost/wordpress/wp-content/uploads/2025/03/41602766-5.jpg';  // Replace with your actual avatar URL

//     // $custom_avatar_url = get_user_meta(
//     //     get_current_user_id(),
//     //     'custom_avatar', true
//     // );

//     // Ensure it applies only to logged-in users (optional)
//     if (is_numeric($id_or_email)) {
//         return $custom_avatar_url;
//     }

//     return $url;  // Return the default if not a user ID
// }

// // Apply the filter
// add_filter('get_avatar_url', 'custom_avatar_url', 10, 3);

function custom_update_user_ajax()
{
    // Ensure it's an AJAX request
    if (!isset($_POST['action']) || $_POST['action'] !== 'custom_update_user') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    // Get the current user ID
    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'User not logged in.']);
        wp_die();
    }

    // Prepare updated user data
    $user_data = ['ID' => $user_id];

    // Update first & last name
    if (!empty($_POST['firstName'])) {
        $user_data['first_name'] = sanitize_text_field($_POST['firstName']);
    }
    if (!empty($_POST['lastName'])) {
        $user_data['last_name'] = sanitize_text_field($_POST['lastName']);
    }

    // Update email (if provided and valid)
    if (!empty($_POST['email']) && is_email($_POST['email'])) {
        $user_data['user_email'] = sanitize_email($_POST['email']);
    }
    $user_data['display_name'] = sanitize_text_field($_POST['firstName']) . ' ' . sanitize_text_field($_POST['lastName']);

    // Update user in database
    $update_result = wp_update_user($user_data);

    if (is_wp_error($update_result)) {
        wp_send_json_error(['message' => $update_result->get_error_message()]);
        wp_die();
    }

    // Handle avatar upload (if provided)
    $avatar_url = get_user_meta($user_id, 'custom_avatar', true);
    if (!empty($_FILES['image']) && isset($_FILES['image']['tmp_name'])) {
        $uploaded_avatar = upload_user_avatar($user_id, $_FILES['image']);
        if ($uploaded_avatar) {
            update_user_meta($user_id, 'custom_avatar', esc_url($uploaded_avatar));
            $avatar_url = $uploaded_avatar;
        }
    }

    // Return success response
    wp_send_json_success([
        'message' => 'User updated successfully.',
        'avatar' => $avatar_url,
    ]);
    wp_die();
}

// Register AJAX action for logged-in users
add_action('wp_ajax_custom_update_user', 'custom_update_user_ajax');

?>