<?php

require "connection.php";

$userEmail = $_GET['email'];
$offer = $_GET['offer'];

Database::iud("DELETE FROM `sell_req` WHERE `user_email`='".$userEmail."'");

if ($offer == 'accept') {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `notifications` (`email`, `context`, `news`, `date`) 
    VALUES ('".$userEmail."', 'You can now sell Products on CyberShop', 'good', '".$date."') ");

} 

echo "done";
?>