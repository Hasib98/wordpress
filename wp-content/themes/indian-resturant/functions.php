<?php

/*
 * My Theme Function
 */

// All Default theme function here
include_once ('inc/default.php');

// Theme CSS  and jQuery File  calling
include_once ('inc/enqueue.php');

function add_svg_to_upload_mimes($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'add_svg_to_upload_mimes');

$pass = 'aoyjscictdfrtala';
$email_id = 'phoenixoffire1998@gmail.com';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require get_template_directory() . '/PHPMailer/src/Exception.php';
require get_template_directory() . '/PHPMailer/src/PHPMailer.php';
require get_template_directory() . '/PHPMailer/src/SMTP.php';

function reservation_form_submission()
{
    // Check if the request is coming from an AJAX call
    if (!isset($_POST['action']) || $_POST['action'] !== 'reservation_form_submission') {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    // Sanitize input data
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $persons = intval($_POST['persons']);
    $date = sanitize_text_field($_POST['date']);
    $time = sanitize_text_field($_POST['time']);

    // PHPMailer SMTP Configuration
    $mail = new PHPMailer(true);
    // $pass = 'testpass';  // ❌ Replace this with an App Password (NOT your real password)
    $email_id = 'phoenixoffire1998@gmail.com';

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $GLOBALS['email_id'];  // Your email
        $mail->Password = $GLOBALS['pass'];;  // Use an App Password (not your real password)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email_id, 'Reservation System');  // Sender
        $mail->addAddress('smhasib1999@gmail.com');  // Receiver

        $mail->isHTML(true);
        $mail->Subject = 'New Reservation Request';
        /* $mail->Body = "
            <h3>New Reservation Request</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Persons:</strong> $persons</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Time:</strong> $time</p>
        "; */
        $mail->Body = "<div style=\"background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px; width: 80%; max-width: 600px; text-align: center; font-family: Arial, sans-serif; margin: 0 auto; color: #34495e;\"><h3 style=\"color: #2c3e50; font-size: 24px; margin-bottom: 20px;\">New Reservation Request</h3><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Name:</span> <span style=\"color: #2ecc71;\">$name</span></p><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Email:</span> <span style=\"color: #2ecc71;\">$email</span></p><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Phone:</span> <span style=\"color: #2ecc71;\">$phone</span></p><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Persons:</span> <span style=\"color: #2ecc71;\">$persons</span></p><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Date:</span> <span style=\"color: #2ecc71;\">$date</span></p><p style=\"font-size: 16px; margin: 10px 0;\"><span style=\"font-weight: bold; color: #2980b9;\">Time:</span> <span style=\"color: #2ecc71;\">$time</span></p><div style=\"border-top: 2px solid #ecf0f1; margin: 20px 0;\"></div><p style=\"font-size: 14px; color: #95a5a6;\">Thank you for your reservation!</p></div>";

        $mail->send();

        wp_send_json_success([
            'message' => 'Reservation received successfully!',
            'data' => compact('name', 'phone', 'email', 'persons', 'date', 'time')
        ]);
    } catch (Exception $e) {
        wp_send_json_error([
            'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
        ]);
    }

    wp_die();
}

// Handle AJAX requests for logged-in and non-logged-in users
add_action('wp_ajax_reservation_form_submission', 'reservation_form_submission');
add_action('wp_ajax_nopriv_reservation_form_submission', 'reservation_form_submission');

function get_menu_post_by_category()
{
    // Check if category_id is set in the request
    if (isset($_POST['category_id'])) {
        $category_id = intval($_POST['category_id']);

        // Set up the WP_Query arguments to fetch posts from the selected category
        $args = array(
            'post_type' => 'menu-item',  // Your custom post type
            'tax_query' => array(
                array(
                    'taxonomy' => 'menu-category',  // The taxonomy
                    'field' => 'id',
                    'terms' => $category_id,  // The selected category ID
                ),
            ),
            'posts_per_page' => -1,  // Get all posts in the selected category
        );

        // Run the query
        $query = new WP_Query($args);

        // Check if there are posts
        if ($query->have_posts()) {
            $posts_array = array();  // Initialize an empty array to store post data

            while ($query->have_posts()):
                $query->the_post();
                // Get the ACF custom field 'menu_food_image'
                $image_url = get_field('menu_food_image');
                $title = get_field('menu_food_title');
                $description = get_field('menu_food_description');
                $price = get_field('menu_food_price');

                // Add post data to the array
                $posts_array[] = array(
                    'id' => get_the_ID(),
                    'title' => $title,
                    'description' => $description,
                    'excerpt' => get_the_excerpt(),
                    'image' => $image_url ? esc_url($image_url) : '',
                    'price' => $price,
                    'permalink' => get_permalink()
                );
            endwhile;

            wp_reset_postdata();

            // Send the posts data back as JSON response
            wp_send_json_success(array('posts' => $posts_array));
        } else {
            wp_send_json_error(array('message' => 'No posts found for this category.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Invalid category.'));
    }

    // Always call 'die()' to terminate AJAX requests
    die();
}

add_action('wp_ajax_get_menu_post_by_category', 'get_menu_post_by_category');
add_action('wp_ajax_nopriv_get_menu_post_by_category', 'get_menu_post_by_category');

?>