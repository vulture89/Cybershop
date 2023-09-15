<?php

// This file is used to send a user msg not admin msg 
// 
// Sender email is the person who sent the message (from) $userEmail
// Receiver email is the person who received the message (to) $friendEmail
// 

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$friendEmail = $_GET['friendEmail'];
$message = $_GET['msg'];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

// Check if the Friend is admin 😶
$admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='".$friendEmail."' ");
$admin_num = $admin_rs->num_rows;

if ($admin_num == 1) {
    Database::iud("INSERT INTO `conversations` (`sender_user_email`, `receiver_admin_email`, `message`, `created_at`)
    VALUES ('" . $userEmail . "', '" . $friendEmail . "', '" . $message . "', '" . $date . "')");

    echo "done";

} else {
    Database::iud("INSERT INTO `conversations` (`sender_user_email`, `receiver_user_email`, `message`, `created_at`)
    VALUES ('" . $userEmail . "', '" . $friendEmail . "', '" . $message . "', '" . $date . "')");

    echo "done";
}
?>