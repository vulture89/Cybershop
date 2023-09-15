<?php

session_start();

require "connection.php";

$pid = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$product_data = $product_rs->fetch_assoc();

$_SESSION["product"] = $product_data;

echo ("success");

?>