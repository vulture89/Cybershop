<?php

require "connection.php";

$order_id = $_GET['order_id'];

$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$order_id."'");
$invoice_data = $invoice_rs->fetch_assoc();

if ($invoice_data['status'] == '1') {
    Database::iud("UPDATE `invoice` SET `status`='2' WHERE `order_id`='" . $order_id . "'");
    echo "shipping";
} else if ($invoice_data['status'] == '2') {
    Database::iud("UPDATE `invoice` SET `status`='3' WHERE `order_id`='" . $order_id . "'");
    echo "delivered";
}


?>