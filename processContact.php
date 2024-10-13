<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure to adjust the path as necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'deepaksuyal310@gmail.com';               
            $mail->Password   = '24680qmzp';                
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                   // TCP port to connect to

            //Recipients
            $mail->setFrom('deepaksuyal310@gmail.com', 'Deepak Suyal');
            $mail->addAddress($email);                                // Add a recipient

            // Content
            $mail->isHTML(true);                                      // Set email format to HTML
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = "Name: $name<br>Email: $email<br><br>Message:<br>$message";

            $mail->send();
            header("Location: thankYou.php");
            exit();
        } catch (Exception $e) {
            echo "Error sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Please fill in all fields correctly.";
    }
}