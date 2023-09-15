<?php

require "connection.php";

$newColour = $_GET['color'];

Database::iud("INSERT INTO `color` (`name`) VALUES ('".$newColour."')" );

echo "done";
?>