<?php

require "connection.php";

$userEmail = $_GET['email'];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userEmail . "'");
$user_data = $user_rs->fetch_assoc();

if ($user_data['canSell_id'] == '1') {
    Database::iud("UPDATE `user` SET `canSell_id`='2' WHERE `email`='" . $userEmail . "'");
    echo "no_permission";
} else if ($user_data['canSell_id'] == '2') {
    Database::iud("UPDATE `user` SET `canSell_id`='1' WHERE `email`='" . $userEmail . "'");
    echo "yes_permission";
}
?>