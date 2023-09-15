<?php

session_start();

require "connection.php";


if (isset($_SESSION['user'])) {

    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $userEmail = $_POST['userEmail'];
    $amount = $_POST['amount'];
    $qty = $_POST['qty'];

    // Product Data
    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "' ");
    $product_data = $product_rs->fetch_assoc();

    $curr_qty = $product_data['qty'];
    $new_qty = $curr_qty - $qty;

    Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $product_id . "' ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`, `product_id`, `user_email`, `qty`,  `date`, `status`)
    VALUES ('".$order_id."', '".$product_id."', '".$userEmail."',  '".$qty."', '".$date."', '1') ");

    echo 'done';

}

?>