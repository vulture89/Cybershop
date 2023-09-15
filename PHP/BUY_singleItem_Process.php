<?php

session_start();

require "connection.php";

// Values
$userEmail = $_SESSION['user']['email'];
$product_id = $_GET['p_id'];
$product_qty = $_GET['p_qty'];

// To store data
$data_array;

// Order id 
$prefix = 'CS_';
$uniqid = uniqid();
$short_uniqid = substr($uniqid, 0, 8);
$order_id = $prefix . $short_uniqid;


// Get Product Data
$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product_id . "' ");
$product_data = $product_rs->fetch_assoc();

// Get User Address Details
$userAddress_rs = Database::search("SELECT * FROM `useraddress` WHERE `user_email`='" . $userEmail . "'");
$userAddress_data = $userAddress_rs->fetch_assoc();

// Get user District Name
$district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $userAddress_data['district_id'] . "'");
$district_data = $district_rs->fetch_assoc();

// Check If Address is there
if ($userAddress_data['line 1'] != '--' AND $userAddress_data['line 2'] != '--' AND $userAddress_data['postal code'] != 0) {

    $district_name = $district_data['name'];
    $exact_address = $userAddress_data['line 1'] . ', ' . $userAddress_data['line 2'];

    $SERVICE_CHARGE = 5;
    $amount = ((int) $product_data['price'] * (int) $product_qty) + $product_data['cost'] + $SERVICE_CHARGE;
    
    $hash = strtoupper(
        md5(
            '1221855' . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            'USD' .  
            strtoupper(md5('MjA3NjQwMTM1OTE3NTE3MTk1ODgyOTQxMzQ2ODAyMzUzNzQ5MjE4OA==')) 
        ) 
    );

    // Details Array
    $details_data['order_id'] = $order_id;
    $details_data['userEmail'] = $userEmail;
    $details_data['product'] = $product_data['title'];
    $details_data['amount'] = $amount;
    $details_data['fname'] = $_SESSION['user']['fname'];
    $details_data['lname'] = $_SESSION['user']['lname'];
    $details_data['mobile'] = $_SESSION['user']['mobile1'];
    $details_data['district'] = $district_name;
    $details_data['address'] = $exact_address;
    $details_data['hash'] = $hash;

    echo json_encode($details_data);

} else {
    echo "Address Not Found";
}

?>