<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Messages | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Architects+Daughter&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Atma&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/messages.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="font-family: ABeeZee, sans-serif;">

    <?php

    include "header.php";
    
    if (isset($_SESSION['user'])) {

        $userEmail = $_SESSION['user']['email'];

    } else {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <!-- Main Container -->
    <div class="container" style="padding: 10px;min-height: 100vh;">
        <div class="row" style="height: 100%;">

            <!-- Users Display -->
            <div class="col-lg-5 col-12" style="height: 100%;overflow: hidden;position: relative;">
                <hr style="margin: 0px;">

                <!-- Users top -->
                <div class="d-flex flex-row justify-content-between align-items-center" style="padding: 20px;">
                    <h4 style="margin-bottom: 0px;">All Conversations</h4>
                    <div id="newMsgs">
                        <p style="padding: 10px 15px;color: #7b85e3;background: #ebeefb;border-radius: 7px;margin-bottom: 0px;font-size: 14px;font-weight: bold;letter-spacing: 1px;">NEW MESSAGES</p>
                    </div>
                </div>
                <hr style="margin: 0px;">

                <!-- Admin -->
                <div class="admin" style="margin-top: 15px;">
                    <p style="font-weight: bold;color: rgb(204,204,204);margin: 0px;margin-bottom: 4px;">Admin</p>
                    <div onclick="toggleChatBox('cybershopAdmin@gmail.com')"
                     class="d-flex userBox" style="padding: 20px;border: 1px solid rgb(217,217,217);border-radius: 5px;">
                        <div class="profilePic" style="border-radius: 50%;border-style: solid;border-color: #5965db;">
                            <img src="assets/img/default.jpg">
                        </div>
                        <div class="userData" style="width: 100%;padding-left: 14px;">
                            <h3>Admin</h3>
                            <?php 
                            $conversations_rs_adminUser = Database::search("
                                (SELECT * FROM `conversations` 
                                WHERE 
                                    `sender_admin_email`='cybershopAdmin@gmail.com' AND 
                                    `receiver_user_email`='" . $userEmail . "')
                                UNION
                                (SELECT * FROM `conversations` 
                                WHERE 
                                    `sender_user_email`='" . $userEmail . "' AND 
                                    `receiver_admin_email`='cybershopAdmin@gmail.com')
                                ORDER BY `created_at` DESC
                                LIMIT 1
                            ");
                            $conversations_num_adminUser = $conversations_rs_adminUser->num_rows;

                            if ($conversations_num_adminUser == 1) {
                                $conversation_data_adminUser = $conversations_rs_adminUser->fetch_assoc();
                                ?>
                                    <p style="margin: 0px;">
                                        <?php echo $conversation_data_adminUser['message'] ?> ▪ <?php echo $conversation_data_adminUser['created_at']; ?>
                                    </p>
                                <?php
                            } else {
                                ?>
                                    <p style="margin: 0px;">
                                        -Chat with Admin-
                                    </p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Other chats -->
                <div class="other" style="margin-top: 15px;">
                    <p style="font-weight: bold;color: rgb(204,204,204);margin: 0px;margin-bottom: 4px;">Other</p>
                    <div class="scrollDiv" style="height: 500px;overflow-x: hidden;overflow-y: scroll;">
                        <?php
                        $friend_list_rs = Database::search("SELECT * FROM `friend_lists` WHERE `user_email`='" . $userEmail . "'");
                        $friend_list_num = $friend_list_rs->num_rows;

                        if ($friend_list_num > 0) {
                            
                            for ($i=0; $i < $friend_list_num; $i++) { 
                                $friend_list_data = $friend_list_rs->fetch_assoc();

                                $friend_rs = Database::search("SELECT * FROM `user` where `email`='" . $friend_list_data['friend_email'] . "' ");
                                $friend_data = $friend_rs->fetch_assoc();

                                $friendImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='" . $friend_list_data['friend_email'] . "'");
                                $friendImg_data = $friendImg_rs->fetch_assoc();

                                ?>
                                    <!-- A single User Box -->
                                    <div onclick="toggleChatBox('<?php echo $friend_list_data['friend_email'] ?>')"
                                        class="d-flex userBox" style="padding: 20px;border: 1px solid rgb(217,217,217);border-radius: 5px;margin-bottom: 5px;">
                                        <div class="profilePic">
                                            <img src="<?php echo $friendImg_data['path'] ?>">
                                        </div>
                                        <div class="userData" style="width: 100%;padding-left: 14px;">
                                            <h3><?php echo $friend_data['fname'].' '.$friend_data['lname'] ?></h3>
                                            <?php 
                                            $conversations_rs_userUser = Database::search("
                                                (SELECT * FROM `conversations` 
                                                WHERE 
                                                    `sender_user_email`='" . $friend_list_data['friend_email'] . "' AND 
                                                    `receiver_user_email`='" . $userEmail . "')
                                                UNION
                                                (SELECT * FROM `conversations` 
                                                WHERE 
                                                    `sender_user_email`='" . $userEmail . "' AND 
                                                    `receiver_user_email`='" . $friend_list_data['friend_email'] . "')
                                                ORDER BY `created_at` DESC
                                                LIMIT 1
                                            ");
                                            $conversations_num_userUser = $conversations_rs_userUser->num_rows;

                                            if ($conversations_num_userUser == 1) {
                                                $conversation_data_userUser = $conversations_rs_userUser->fetch_assoc();
                                                ?>
                                                    <p style="margin: 0px;">
                                                        <?php echo $conversation_data_userUser['message'] ?> ▪ <?php echo $conversation_data_userUser['created_at']; ?>
                                                    </p>
                                                <?php
                                            } else {
                                                ?>
                                                    <p style="margin: 0px;">
                                                        -Chat with <?php echo $friend_data['fname'] ?>-
                                                    </p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            }

                        }
                        ?>
                    </div>
                </div>

                <!-- Add new Friend Button -->
                <div>
                    <h4 class="text-center addfriendBt" style="padding: 20px;border-radius: 42px;" data-bs-toggle="modal" data-bs-target="#newFriendModal">
                        Add Friend&nbsp;<i class="fa fa-user-plus"></i>
                    </h4>
                </div>
            </div>
            
            <!-- Chat -->
            <div id="chatBOX" class="col-lg-7 col-12" style="position: relative;">

                <!-- No Chat is selected -->
                <div style="height: 100%; width: 100%;background: url(&quot;assets/img/8c98994518b575bfd8c949e91d20548b.jpg&quot;) center / contain;"></div>

            </div>
        </div>
    </div>

    <!-- Add new user Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="newFriendModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Friend 😀</h4>
                </div>
                <div class="modal-body">
                    <input id="friend_code" 
                        type="text" style="width: 100%;background: rgb(235,235,235);padding: 15px;border-radius: 29px;border-style: none;margin-bottom: 18px;" placeholder="#000000 Enter Tag">
                    <div class="col-12 d-flex justify-content-center">
                        <p style="color: red; padding: 10px 25px; background-color: #ffeeee;text-align:center;" id="errorMsg" class="d-none">test</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addNewFriend()"
                        class="btn btn-primary" type="button">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>

    <!-- Scroll Bt -->
    <button onclick="topFunction()" id="scrollToTop__btn" title="Go to top">
        <svg class="arrow up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="5 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" points="0.375, 35.375 28.375, 0.375 58.67, 35.375 " />
        </svg>
    </button>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" crossorigin="anonymous"></script>
</body>

</html>