<?php

session_start();

require "connection.php";

$product_id = $_GET['id'];

Database::iud("DELETE FROM `product_image` WHERE `product_id`='".$product_id."' ");
Database::iud("DELETE FROM `product` WHERE `id`='".$product_id."' ");

echo "success";

?>