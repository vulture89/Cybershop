<?php

require "connection.php";

$user_code = $_GET['code'];

$promo_rs = Database::search("SELECT * FROM `promo` WHERE `code`='" . $user_code . "'");
$promo_num = $promo_rs->num_rows;

if ($promo_num != '0') {
    $promo_data = $promo_rs->fetch_assoc();

    echo "Percent: " . $promo_data['percent'];
    
} else {
    echo "No code found";

}

?>