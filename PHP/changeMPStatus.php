<?php

require "connection.php";

$product_id = $_GET['id'];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$product_id."'");
$product_num = $product_rs->num_rows;

$product_data = $product_rs->fetch_assoc();

$status = $product_data['activity_status_id'];

if ($status == 1) {
    Database::iud("UPDATE `product` SET `activity_status_id`='2' WHERE `id`='".$product_id."' ");
    echo "Deactivated";

} else {
    Database::iud("UPDATE `product` SET `activity_status_id`='1' WHERE `id`='".$product_id."' ");
    echo "Activated";

}

?>