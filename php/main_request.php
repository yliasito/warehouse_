<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $budget = $_POST['budget'];
    $message = $_POST['message'];
    $amount = $_POST['amount'];

    // Validate email (you might want to add more validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $mail = new PHPMailer(true);
    $appPassword = "hmbuikfnuqrcolnm";

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Set this to 2 for detailed debugging information
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yliasfranckgadie@gmail.com';
        $mail->Password = $appPassword;  // Use your Gmail App Password here
        $mail->SMTPSecure = 'tls';  // Use 'tls' or 'ssl'
        $mail->Port = 587;  // Use 587 for TLS, 465 for SSL

        // Recipient
        $mail->setFrom($email);
        $mail->addAddress('yliasfranckgadie@gmail.com');  // Change this to the actual email address where you want to receive the message

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Nouvelle demande pour warehouse de la part de: $name";
        $mail->Body = "Name: $name<br>Email: $email<br>Service: $service<br>Budget: $budget<br>Quantité: $amount<br>Message:<br>$message";

        $mail->send();

        // Clear any previous output
        ob_clean();

        header("Location: ../success_page.php");
        exit;
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
        exit; // Make sure to exit after echoing the error message
    }
} else {
    echo "Invalid request method";
    exit; // Make sure to exit after echoing the error message
}
?>
