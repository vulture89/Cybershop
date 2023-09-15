<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$product_id = $_GET['id'];

Database::iud("DELETE FROM `wishList` WHERE `product_id`='".$product_id."' AND `user_email`='".$userEmail."' ");

echo "success";

?>