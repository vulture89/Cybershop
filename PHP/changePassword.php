<?php 

require "connection.php";

$userVCode = $_POST['userVCode'];
$userEmail = $_POST['email'];
$newPswd = $_POST['newPswd'];
$reTypePswd = $_POST['reType'];


if (empty($userVCode)) {
    echo "Enter Verfication Code <br/>to reset Password";
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$userEmail."' AND `vcode`='".$userVCode."'");
    $n = $rs->num_rows;
    
    if ($n != 1) {
        echo "Invalid Verification code";
    } else {
        if (empty($newPswd)) {
            echo "Type in a new Password";
        } else if (strlen($newPswd) < 5 || strlen($newPswd) > 20) {
            echo "Password Must be between <br/> 5-20 Characters";
        } else if (empty($reTypePswd)) {
            echo "Re-type Your New Password";
        } else if ($newPswd != $reTypePswd) {
            echo "Passwords do not match";
        } else {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $newPswd = md5($newPswd);

            Database::iud("UPDATE `user` SET `password`='".$newPswd."' WHERE `email`='".$userEmail."'");
            Database::iud("INSERT INTO `notifications` (`email`, `context`, `news`, `date`) 
                VALUES ('".$userEmail."', 'Your Password was recently changed', 'warning', '".$date."') ");
                
            echo 'success';
        }
    
    }

} 

?>