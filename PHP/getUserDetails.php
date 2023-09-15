<?php

session_start();

require "connection.php";

$user = $_SESSION['user'];

$details_user;

// Collect Data
$userEmail = $user['email'];
$userFname = $user['fname'];
$userLname = $user['lname'];
$userMobile = $user['mobile1'];

$userAddress_rs = Database::search("SELECT * FROM `useraddress` WHERE `user_email`='" . $userEmail . "'");
$userAddress_data = $userAddress_rs->fetch_assoc();

$district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $userAddress_data['district_id'] . "'");
$district_data = $district_rs->fetch_assoc();

$district_name = $district_data['name'];
$exact_address = $userAddress_data['line 1'] . ', ' . $userAddress_data['line 2'];


$details_user['email'] = $userEmail;
$details_user['fname'] = $userFname;
$details_user['lname'] = $userLname;
$details_user['mobile'] = $userMobile;
$details_user['district'] = $district_name;
$details_user['address'] = $exact_address;

echo json_encode($details_user);
?>