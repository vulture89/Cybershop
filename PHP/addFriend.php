<?php

session_start();

require "connection.php";

$userEmail = $_SESSION['user']['email'];
$tagCode = $_GET['tagCode'];

$user_rs = Database::search("SELECT * FROM user WHERE `tagCode`='" . $tagCode . "'");
$user_num = $user_rs->num_rows;

if ($user_num != 0) {
    // User found
    $user_data = $user_rs->fetch_assoc();
    $friendEmail = $user_data['email'];

    $friend_list_rs = Database::search("SELECT * FROM friend_lists WHERE `user_email`='" . $userEmail . "' AND `friend_email`='" . $friendEmail . "'");
    $friend_list_num = $friend_list_rs->num_rows;

    if ($friend_list_num != 1 OR $friend_list_num == 0) {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `friend_lists` (`user_email`, `friend_email`, `created_at`)
            VALUES ('" . $userEmail . "', '" . $friendEmail . "', '" . $date . "')");
            
        Database::iud("INSERT INTO `friend_lists` (`user_email`, `friend_email`, `created_at`)
            VALUES ('" . $friendEmail . "', '" . $userEmail . "', '" . $date . "')");

        $friend_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userEmail . "' ");
        $friend_data = $friend_rs->fetch_assoc();

        Database::iud("INSERT INTO `notifications` (`email`, `context`, `news`, `date`) 
            VALUES ('".$friendEmail."', '".$friend_data['fname'].' '.$friend_data['lname']." added you as a friend', 'good', '".$date."') ");

        echo "done";
    } 

} else {
    // No User found
    echo "No user found";
}
?>