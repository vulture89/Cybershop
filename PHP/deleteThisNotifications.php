<?php 

require "connection.php";

$notification_id = $_GET['id'];

Database::iud("DELETE FROM `notifications` WHERE `id`='".$notification_id."' ");

echo "done";
?>