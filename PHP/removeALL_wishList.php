<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];

Database::iud("DELETE FROM `wishList` WHERE `user_email`='".$userEmail."' ");

echo "success";

?>