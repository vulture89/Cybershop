<?php

require "connection.php";

$category = $_GET['category'];
$newBrand = $_GET['newBrand'];

Database::iud("INSERT INTO `brand` (`name`, `category_id`) VALUES ('".$newBrand."', '".$category."')" );

echo "done";

?>