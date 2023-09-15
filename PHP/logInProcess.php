<?php

session_start();

require "connection.php";

$email = $_POST['email'];
$pswd = $_POST['pswd'];
$rMe = $_POST['rMe'];

$pswd = md5($pswd);

if (empty($email)) {
    echo ("Email field cannot be empty !");
} else if (strlen($email) >= 100) {
    echo ("Email should less than 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($pswd)) {
    echo ("Password field cannot be empty !");
} else {
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='".$email."' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {
        $admin_data = $admin_rs->fetch_assoc();

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        if ($pswd == $admin_data['password']) {
            $_SESSION['admin'] = $admin_data;
            echo "Admin Success";
        } else {
            echo "Admin Pswd Is Incorrect";
        }

    } else {
        $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$pswd."' ");
        $n = $rs->num_rows;

        if ($n == 1)  {
            $d = $rs->fetch_assoc();

            if (isset($_SESSION['admin'])) {
                unset($_SESSION['admin']);
            }

            if ($d['blocked_id'] == '0') {
                $_SESSION['user'] = $d;
    
                if ($rMe == 1) {
                    setcookie("email", $email, time()+(60*60*24*365), '/');
                    setcookie('rMe', $rMe, time()+(60*60*24*365), '/');
                } else {
                    setcookie("email", "", -1, '/');
                    setcookie("rMe", "", -1, '/');
                }

                $accessed = (int)$d['accessed'];
                $accessed += 1;
                $new_accessed = strval($accessed);

                Database::search("UPDATE `user` SET `accessed`='".$new_accessed."' WHERE `email`='".$email."'  ");
    
                echo ("User Success");
            } else {
                echo ("User is blocked");
            }

        } else {
            echo ("Invalid Email or password.");
        }

    }

}

?>