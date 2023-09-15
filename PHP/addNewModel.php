<?php

require "connection.php";

$brand = $_GET['brand'];
$newModel = $_GET['newModel'];

Database::iud("INSERT INTO `model` (`name`, `brand_id`) VALUES ('".$newModel."', '".$brand."')" );

echo "done";
?>