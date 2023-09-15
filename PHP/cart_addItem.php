<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$product_id = $_GET['id'];
$qty = $_GET['qty'];

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $userEmail . "' AND `product_id`='".$product_id."' ");
$cart_num = $cart_rs->num_rows;

if ($cart_num == '0') {

    Database::iud("INSERT INTO `cart` (`user_email`, `product_id`, `qty`)
    VALUES ('" . $userEmail . "', '" . $product_id . "', '1') ");

    echo "done";

} else if ($cart_num == '1') {

    echo 'done';
    
}

?>