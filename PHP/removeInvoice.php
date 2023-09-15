<?php

session_start();

require "connection.php";

$userEmail = $_GET['email'];
$product = $_GET['product'];
$date = $_GET['date'];

if ($product != 'all' AND $date != null) {
    
    Database::iud("DELETE FROM `invoice` WHERE `product_id`='" . $product . "' AND `date`='" . $date . "' AND `user_email`='" . $userEmail . "'");
    echo "done";

} else {

    Database::iud("DELETE FROM `invoice` WHERE `user_email`='" . $userEmail . "'");
    echo "done";

}
?>