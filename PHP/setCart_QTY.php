<?php

session_start();

require "connection.php";

$product_id = $_GET['id'];
$new_qty = $_GET['qty'];

Database::iud("UPDATE `cart` SET `qty`='" . $new_qty . "' WHERE `product_id`='" . $product_id . "'");

echo "done";

?>