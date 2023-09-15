<?php

session_start();
 
if (isset($_SESSION['user'])) {
    
    $_SESSION['user'] = null;
    session_destroy();

    setcookie("email", "", -1, '/');
    setcookie("rMe", "", -1, '/');
    
    echo('success');
}


?>