<?php

require "connection.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pswd = $_POST['pswd'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];

if (empty($fname)) {
    echo ('Please enter your First Name !');
} else if (strlen($fname) > 50) {
    echo ('First name must have less than 50 characters.');
} else if (empty($lname)) {
    echo ('Please enter your last name !');
} else if (strlen($lname) > 50) {
    echo ('Last name must have less than 50 characters.');
} else if (empty($email)) {
    echo ("Please enter your email !");
} else if (strlen($email) >= 100) {
    echo ("Email must contain less than 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !"); 
} else if (empty($pswd)) {
    echo ("Please enter your password !");
}  else if (empty($mobile)) {
    echo ("Please enter your mobile !");
} else if (strlen($mobile) != 10) {
    echo ("Mobile must contain 10 numbers");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Mobile !");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;
    if ($n > 0) {
        echo ("User already exists !");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $prefix = '#';
        $uniqid = uniqid();
        $short_uniqid = substr($uniqid, 0, 8);
        $tag_code = $prefix . $short_uniqid;

        $pswd = md5($pswd);

        Database::iud("INSERT INTO `user` (`email`, `password`, `fname`, `lname`, `mobile1`, `mobile2`,  `blocked_id`, `gender_id`, `joined_date`, `accessed`, `canSell_id`, `tagCode`) 
         VALUES ('".$email."', '".$pswd."', '".$fname."', '".$lname."', '".$mobile."', '--', '0', '".$gender."', '".$date."', '0', '2', '".$tag_code."') ");

        Database::iud("INSERT INTO `useraddress` (`user_email`, `district_id`, `line 1`, `line 2`, `postal code`)
         VALUES ('".$email."', '1', '--', '--', '0') ");

        Database::iud("INSERT INTO `profileimage` (`user_email`, `path`)
         VALUES ('".$email."', 'assets/img/Profiles/default.jpg') ");

        echo "Success";
    }
}

?>