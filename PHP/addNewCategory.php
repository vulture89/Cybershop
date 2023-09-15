<?php

require "connection.php";

$category_name = $_GET['category_name'];

Database::iud("INSERT INTO `category` (`type`) VALUES ('".$category_name."')" );

echo "done";

?>