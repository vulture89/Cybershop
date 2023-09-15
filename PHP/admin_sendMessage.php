<?php

// This file is used to send a admin msg not user msg 

session_start();

require "connection.php";

$adminEmail = $_SESSION['admin']['admin_email'];
$userEmail = $_GET['userEmail'];
$message = $_GET['msg'];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `conversations` (`sender_admin_email`, `receiver_user_email`, `message`, `created_at`)
VALUES ('" . $adminEmail . "', '" . $userEmail . "', '" . $message . "', '" . $date . "')");

echo "done";

?>



