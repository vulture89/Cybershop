<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$product_id = $_GET['id'];


Database::iud("INSERT INTO `wishList` (`product_id`, `user_email`) VALUES ('".$product_id."', '".$userEmail."') ");

echo "success";
?>