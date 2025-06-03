<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // if using Composer
// require 'PHPMailer/src/PHPMailer.php'; // if using manually
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $email   = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!$email) {
        die("Invalid email format.");
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'manthanmahadkar7@gmail.com';      // Your Gmail address
        $mail->Password   = 'uodr zxwv olgk lswl';        // Use App Password, not your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('manthanmahadkar7@gmail.com');       // Your Gmail again (receiver)

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
