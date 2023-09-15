<?php

require "connection.php";

$userEmail = $_GET['email'];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userEmail . "'");
$user_data = $user_rs->fetch_assoc();

if ($user_data['blocked_id'] == '0') {
    Database::iud("UPDATE `user` SET `blocked_id`='1' WHERE `email`='" . $userEmail . "'");
    echo "blocked";
} else {
    Database::iud("UPDATE `user` SET `blocked_id`='0' WHERE `email`='" . $userEmail . "'");
    echo "unblocked";
}
?>