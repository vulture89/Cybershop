<?php 

require "connection.php";

require "Mail/SMTP.php";
require "Mail/PHPMailer.php";
require "Mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET['email'];

if (empty($email)) {
    echo "Enter Your Email to Recover";
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' ");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        echo "user";
        
        // Generating And Adding Vcode to Db
        $code = uniqid();

        Database::iud("UPDATE `user` SET `vcode`='".$code."' WHERE `email`='".$email."' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hackerdummt@gmail.com';
        $mail->Password = 'kijkaqbwipcscyie';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('cybershopofficial23@gmail.com', 'Reset Password');
        $mail->addReplyTo('cybershopofficial23@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Cyber Shop Forgot Password Verification Code';
        $bodyContent = '<h1 style="colour:green;">Your verification code is : '.$code.' </h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Verification Code sending failed !";
        }

    } else {
        echo "Invalid user";
    }

}

?>