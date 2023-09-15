<?php

session_start();

require "connection.php";

require "Mail/SMTP.php";
require "Mail/PHPMailer.php";
require "Mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$userEmail = $_SESSION['user']['email'];

// Get random PROMO code
$promo_rs = Database::search("SELECT * FROM `promo` ORDER BY RAND() LIMIT 1 ");
$promo_data = $promo_rs->fetch_assoc();

$promo_code = $promo_data['code'];
$promo_percent = $promo_data['percent'];

//// MAIL CONTENT /////
$subject = 'Thank you for your purchase! ';
$content = 
    "Dear valued customer,

    We wanted to take a moment to thank you for choosing our CyberShop for your recent purchase. We hope that you are completely satisfied with your purchase and that the items you received meet your expectations.

    As a token of our appreciation, we would like to offer you a special discount code for your next purchase. Please use the code \"'".$promo_code."'\" at checkout to receive ".$promo_percent."% off your next order.

    This offer is only available to our valued customers who have made a purchase on our CyberShop, and it expires in 30 days, so be sure to use it before it's too late.

    Thank you again for your support and we look forward to serving you again in the future.

    Warm regards,
    The CyberShop team.";
////////////////////////////////////////////////////// 

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hackerdummt@gmail.com';
$mail->Password = 'kijkaqbwipcscyie';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('CyberShop', '');
$mail->addReplyTo('noreply@gmail.com', '');
$mail->addAddress($userEmail);
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = nl2br($content);

if (!$mail->send()) {
    echo "Verification Code sending failed !";
} else {
    echo "done";
}
?>