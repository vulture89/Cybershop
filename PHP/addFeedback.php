<?php 

session_start();

require "connection.php";

// Get Values
$userEmail = $_SESSION['user']['email'];
$product_id = $_GET['p_id'];
$review = $_GET['review'];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$review = Database::escapeString($review);

Database::iud("INSERT INTO `feedback` (`user_email`, `product_id`, `review`, `date`)
VALUES ('".$userEmail."', '".$product_id."', '".$review."', '".$date."')");
?>