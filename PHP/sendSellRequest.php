<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$reason = $_GET['reason'];

if (empty($reason)) {
    echo "Tell us what type of products you wish to sell on CyberShop";
} else {
    Database::iud("INSERT INTO `sell_req` (`user_email`, `why`) VALUES ('" . $userEmail . "', '" . $reason . "') ");
    echo "success";
}


?>