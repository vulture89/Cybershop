<?php

session_start();

require "connection.php";



$userEmail = $_SESSION['user']['email'];
$userFname = $_SESSION['user']['fname'];

$details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id=user.gender_id WHERE `email`='" . $userEmail . "' ");
$details_data = $details_rs->fetch_assoc();

$address_rs = Database::search("SELECT *, district.name AS dname, province.name AS pname FROM `useraddress` 
INNER JOIN `district` ON useraddress.district_id=district.id
INNER JOIN `province` ON district.province_id=province.id
WHERE `user_email`='" . $userEmail . "' ");
$address_data = $address_rs->fetch_assoc();

$profileImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='".$userEmail."'");
$profileImg_data = $profileImg_rs->fetch_assoc();



// Set Values
$fname = $details_data['fname'];
if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
}
$lname = $details_data['lname'];
if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
}
$mobile1 = $details_data['mobile1'];
if (isset($_POST['mobile'])) {
    $mobile1 = $_POST['mobile'];
}
$mobile2 = $details_data['mobile2'];
if (isset($_POST['mobile2'])) {
    $mobile2 = $_POST['mobile2'];
}
$postalCode = $address_data['postal code'];
if (isset($_POST['postalCode'])) {
    $postalCode = $_POST['postalCode'];
}
$line1 = $address_data['line 1'];
if (isset($_POST['line1'])) {
    $line1 = $_POST['line1'];
}
$line2 = $address_data['line 2'];
if (isset($_POST['line2'])) {
    $line2 = $_POST['line2'];
}

$provice = $_POST['province'];
$district = $_POST['district'];

Database::iud("UPDATE `user` 
 SET `fname`='" . $fname . "', 
     `lname`='" . $lname . "', 
     `mobile1`='" . $mobile1 . "',
     `mobile2`='" . $mobile2 . "'
 WHERE `email`='" . $userEmail . "'");

Database::iud("UPDATE `useraddress` SET `district_id`='".$district."' WHERE `user_email`='".$userEmail."' ");
Database::iud("UPDATE `useraddress` SET `line 1`='".$line1."' WHERE `user_email`='".$userEmail."' ");
Database::iud("UPDATE `useraddress` SET `line 2`='".$line2."' WHERE `user_email`='".$userEmail."' ");
Database::iud("UPDATE `useraddress` SET `postal code`='".$postalCode."' WHERE `user_email`='".$userEmail."' ");



$image = $profileImg_data['path'];
if (!isset($_FILES['image'])) {

    Database::iud("UPDATE `profileimage` SET `path`='".$image."' WHERE `user_email`='".$userEmail."'  ");
    echo "success";

} else {
    
    $image = $_FILES['image'];
    $file_ex = $image['type'];

    $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (!in_array($file_ex, $allowed_img_extensions)) {
        echo ("Image Type is not Valid.");
    } else {

        $new_file_extension;

        if ($file_ex == 'image/jpg') {
            $new_file_extension = '.jpg';
        } else if ($file_ex == 'image/jpeg') {
            $new_file_extension = '.jpeg';
        } else if ($file_ex == 'image/png') {
            $new_file_extension = '.png';
        } else if ($file_ex == 'image/svg+xml') {
            $new_file_extension = '.svg';
        }

        $code = uniqid();

        $moveFromThisFile = '../assets/img/Profiles/' . $userFname . '_' . $code . $new_file_extension;
        $file_name = 'assets/img/Profiles/' . $userFname . '_' . $code . $new_file_extension;

        move_uploaded_file($image['tmp_name'], $moveFromThisFile);

        Database::iud("UPDATE `profileimage` SET `path`='".$file_name."' WHERE `user_email`='".$userEmail."'  ");
        echo "success";
    }

}


?>