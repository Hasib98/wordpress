<?php
$to = "smhasib@1999@gmail.com";
$subject = "Test Email";
$message = "Hello, this is a test email from XAMPP.";
$headers = "From: test@localhost";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Replace with your email
    $mail->Password = 'your-email-password'; // Use App Password if 2FA is enabled
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('your-email@gmail.com', 'Your Name');
    $mail->addAddress('recipient-email@example.com');

    $mail->Subject = 'Test Email from XAMPP';
    $mail->Body    = 'Hello, this is a test email using PHPMailer.';

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Email failed: {$mail->ErrorInfo}";
}
?>
