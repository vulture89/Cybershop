<?php
    session_start();
    require "PHP/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" href="assets/img/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body >

    <?php
    $name = "User";
    if (isset($_SESSION['user'])) {
        $userData = $_SESSION['user'];
        $name = $userData['fname'];
    }
    ?>

    <div id="loader">
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <div>
        <div class="row d-flex" style="font-family: Abel, sans-serif;">
            <div class="col-6 col-lg-4 d-flex justify-content-center align-items-center f" style="height: 40px;">
                <p class="text-center nlink-elem" style="margin-top: 12px;padding: 0px 15px;font-weight: bold;padding-right: 0px;padding-left: 5px;font-size: 14px;">
                    Welcome <?php echo $name; ?> <span class="d-none d-sm-inline">|</span>
                </p>
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                        <p 
                            onclick="logOutUser()"
                            class="text-center link-elem" style="margin-top: 12px;padding: 0px 15px;font-weight: bold;padding-right: 0px;padding-left: 5px;font-size: 14px;">
                            Sign Out&nbsp;<i class="fa fa-sign-out"></i>&nbsp;
                        </p>
                    <?php
                } else {
                    ?>
                        <p 
                            onclick="window.location = 'login.php'"
                            class="text-center link-elem" style="margin-top: 12px;padding: 0px 15px;font-weight: bold;padding-right: 0px;padding-left: 5px;font-size: 14px;">
                            Sign In&nbsp;<i class="fa fa-sign-in"></i>&nbsp;
                        </p>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-center align-items-center justify-content-sm-center justify-content-md-center justify-content-lg-center">
                <h1 onclick="window.location = 'home.php'"
                    class="d-none d-lg-block" style="cursor:pointer;font-family: Aldrich, sans-serif;font-size: 18px;font-weight: bold;text-align: center;color: rgb(2,123,253);opacity: 0.58;text-shadow: 0px 0px 4px;margin-top: 8px;">CYBERSHOP</h1>
            </div>
            <div class="col-6 col-lg-4 d-flex justify-content-center align-items-center f" style="height: 40px;">
                <i class="fa fa-bell link-elem" style="padding: 10px;" data-bs-target="#notifications" data-bs-toggle="modal"></i>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle dropdown_nav" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="margin: 0px 19px;background: #f4f6f8;color: rgb(0,0,0);padding: 4px 13px;font-size: 14px;">My CyberShop</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <a class="dropdown-item" href="myProducts.php">My Products</a>
                        <a class="dropdown-item" href="wishList.php">Wishlist</a>
                        <a class="dropdown-item" href="purchasedHistory.php">Purchase History</a>
                        <a class="dropdown-item" href="messages.php">Messages</a>
                    </div>
                </div>
                <i onclick="window.location = 'cart.php'"
                    class="fa fa-shopping-cart link-elem" style="margin-right: 11px;font-size: 21px;padding: 10px;"></i>
            </div>
        </div>
    </div>

    <!-- Notifications Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="notifications" style="font-family: Abel, sans-serif;">
        <?php
        if (!isset($_SESSION['user'])) {
            ?>
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content ">
                        <div class="border-radius: 3px;">
                            <h4 class="modal-title" style="font-family: sans-serif; padding: 20px; text-align: center;">
                                Log In to see Notifications  <br>
                                <p 
                                    onclick="window.location = 'login.php'"
                                    style="padding: 10px; font-size: 18px; color: var(--bs-blue); cursor: pointer;">Log In  <i class="fa fa-sign-in"></i>
                                </p>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            ?>
                <div class="modal-dialog" role="document" id="notification_Modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="font-family: Aldrich, sans-serif;">Notifications</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="notificationBox">
                            <?php

                            $notifications_rs = Database::search("SELECT * FROM `notifications` WHERE `email`='".$userData['email']."' ORDER BY `date` DESC ");
                            $notifications_num = $notifications_rs->num_rows;

                            if ($notifications_num == 0) {
                                ?>
                                    <div id="noNotifications">
                                        <div class="notificationImg">
                                            <img class="d-block mx-auto" src="assets/img/no_notification_yiran.webp">
                                        </div>
                                        <h5 class="text-center" style="padding: 20px;font-family: Poppins, sans-serif;">No Notifications Right Now</h5>
                                    </div>
                                <?php
                            } else {
                                ?>
                                    <div id="yesNotifications" style="padding: 20px; height: auto; min-height: 100px; max-height: 300px; overflow-y: scroll;">
                                        <?php
                                            for ($x = 0; $x < $notifications_num; $x++) {
                                                $notification_data = $notifications_rs->fetch_assoc();
            
                                                $type = $notification_data['news'];
            
                                                if ($type == 'good') {
                                                    ?>
                                                        <div class="d-flex flex-row align-items-center notificationMsg" id="noti<?php echo $notification_data['id'] ?>" style="background: #00bd9d;">
                                                            <i class="far fa-check-circle" style="padding: 5px;color: rgb(255,255,255);font-size: 19px;"></i>
                                                            <p style="color: rgb(255,255,255);font-size: 20px;margin-bottom: 0;margin-left: 8px;"><?php echo $notification_data['context']; ?></p>
                                                            <p class="dateNotifications"><?php echo $notification_data['date']; ?></p>
                                                            <div class="deleteNotification"
                                                                onclick="deleteThisNotification('<?php echo $notification_data['id'] ?>')"></div>
                                                        </div>
                                                    <?php
                                                } else if ($type == 'bad') {
                                                    ?>
                                                        <div class="d-flex flex-row align-items-center notificationMsg" id="noti<?php echo $notification_data['id'] ?>" style="background: #f45f63;">
                                                            <i class="far fa-times-circle" style="padding: 5px;color: rgb(255,255,255);font-size: 19px;"></i>
                                                            <p style="color: rgb(255,255,255);font-size: 20px;margin-bottom: 0;margin-left: 8px;"><?php echo $notification_data['context']; ?></p>
                                                            <p class="dateNotifications"><?php echo $notification_data['date']; ?></p>
                                                            <div class="deleteNotification"
                                                                onclick="deleteThisNotification('<?php echo $notification_data['id'] ?>')"></div>
                                                        </div>
                                                    <?php
                                                } else if ($type == 'warning') {
                                                    ?>
                                                        <div class="d-flex flex-row align-items-center notificationMsg" id="noti<?php echo $notification_data['id'] ?>" style="background: #f1c339;">
                                                            <i class="far fa-question-circle" style="padding: 5px;color: rgb(255,255,255);font-size: 19px;"></i>
                                                            <p style="color: rgb(255,255,255);font-size: 20px;margin-bottom: 0;margin-left: 8px;"><?php echo $notification_data['context']; ?></p>
                                                            <p class="dateNotifications"><?php echo $notification_data['date']; ?></p>
                                                            <div class="deleteNotification"
                                                                onclick="deleteThisNotification('<?php echo $notification_data['id'] ?>')"></div>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        }
        ?>
    </div>