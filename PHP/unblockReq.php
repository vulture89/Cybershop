<?php 

require "connection.php";

$email = $_GET['email'];

$rs = Database::search("SELECT * FROM `unblock_req` WHERE `user_email`='".$email."' ");

if ($rs->num_rows == 1) {
    // Do nothing
} else {
    Database::iud("INSERT INTO `unblock_req` (`user_email`) VALUES ('".$email."') ");
}

echo "Added";

?>