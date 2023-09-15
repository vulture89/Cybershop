<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];

$product_id = $_POST['id'];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "' ");
$product_data = $product_rs->fetch_assoc();



$title = $product_data['title'];
if (isset($_POST['title'])) {
    $title = $_POST['title'];
}

$cost = $product_data['cost'];
if (isset($_POST['cost'])) {
    $cost = $_POST['cost'];
}

$small_desc = $product_data['small_desc'];
if (isset($_POST['small_desc'])) {
    $small_desc = $_POST['small_desc'];
}

$desc = $product_data['desc'];
if (isset($_POST['desc'])) {
    $desc = $_POST['desc'];
}

$qty = $_POST['qty'];


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("UPDATE `product` 
SET `title`='" . $title . "',     
    `qty`='" . $qty . "', 
    `cost`='" . $cost . "',
    `small_desc`='" . $small_desc . "',
    `desc`='" . $desc . "'
WHERE `id`='" . $product_id . "' ");

Database::iud("INSERT INTO `notifications` (`email`, `context`, `news`, `date`) 
     VALUES ('".$userEmail."', 'Your Product data was changed <br/> ".$title." ', 'good', '".$date."') ");

echo "success"; 

?>