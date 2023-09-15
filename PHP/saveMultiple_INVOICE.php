<?php

session_start();

require "connection.php";


if (isset($_SESSION['user'])) {

    $userEmail = $_SESSION['user']['email'];
    $productArray = json_decode($_GET['productArray']);
    $discount_code = $_GET['discount'];

    for ($i = 0; $i < count($productArray); $i++) {
        $product = $productArray[$i];
        $product_code = $product->code;
        $product_id = $product->id;
        $product_name = $product->name;
        $product_qty = $product->qty;

        // Product Data
        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "' ");
        $product_data = $product_rs->fetch_assoc();

        $curr_qty = $product_data['qty'];
        $new_qty = $curr_qty - $product_qty;

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $product_id . "' ");

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `invoice` (`order_id`, `product_id`, `user_email`, `qty`,  `date`, `status`)
        VALUES ('".$product_code."', '".$product_id."', '".$userEmail."',  '".$product_qty."', '".$date."', '1') ");

    }

    if ($discount_code != null) {
        Database::iud("DELETE FROM `promo` WHERE `code`='" . $discount_code . "'");
    }

    echo 'done';

}

?>