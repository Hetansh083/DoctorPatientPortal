<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to your PHPMailer autoload.php

function send_Verification_Email($email, $verificationLink) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com'; // Your Gmail email
        $mail->Password   = 'your_password'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and recipient settings
        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress($email);
        $mail->addReplyTo('your_email@gmail.com', 'Your Name');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = "Click the link below to verify your email:<br><a href='$verificationLink'>Verify Email</a>";

        $mail->send();
        echo 'Verification email sent successfully.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your necessary meta tags, title, and CSS links -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <center>
    <div class="container">
        <h2>Verify Your Email</h2>
        <form action="verification.php" method="POST">
            <label for="verificationCode">Enter the verification code received in your email:</label><br>
            <input type="text" id="verificationCode" name="verificationCode" required><br>
            <input type="submit" value="Verify" class="login-btn btn-primary btn">
        </form>
        <?php echo isset($error) ? $error : ''; ?>
    </div>
    </center>
</body>
</html>
