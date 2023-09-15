<?php 

session_start();

require "connection.php";

$adminEmail = $_SESSION['admin']['admin_email'];
$userEmail = $_GET['userEmail'];

$user_rs = Database::search("SELECT * FROM `user` where `email`='" . $userEmail . "' ");
$user_data = $user_rs->fetch_assoc();

$userImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='" . $userEmail . "'");
$userImg_data = $userImg_rs->fetch_assoc();

?>
<!-- Show on Selected User Chat -->
<div style="height: 100%; width: 100%;">

    <hr style="margin: 0px;">

    <!-- Corresponding User Details -->
    <div class="d-flex flex-row" style="width: 100%;padding: 8px;padding-left: 10px;">
        <div style="width: 65px;height: 65px;overflow: hidden;border-radius: 50%;border-style: solid;border-color: #5965db;">
            <img style="width: 100%;height: 100%;" src="<?php echo $userImg_data['path'] ?>">
        </div>
        <div class="d-flex justify-content-center align-items-center" style="margin-left: 14px;">
            <h3><?php echo $user_data['fname'].' '.$user_data['lname'] ?></h3>
        </div>
    </div>

    <hr style="margin: 0px;">

    <!-- CHAT BOX -->
    <div id="chatBOXX" class="d-flex flex-column chatBOXX" style="height: 700px;border-style: solid;margin-top: 15px;background: url(&quot;assets/img/ts7vuoswhwf41.jpg&quot;) center / contain;width: 100%;padding-top: 7px;overflow-y:scroll;">

        <?php 
    
        $conversations_rs = Database::search("
            (SELECT * FROM `conversations` 
            WHERE 
                `sender_user_email`='".$userEmail."' AND 
                `receiver_admin_email`='".$adminEmail."')
            UNION
            (SELECT * FROM `conversations` 
            WHERE 
                `sender_admin_email`='".$adminEmail."' AND 
                `receiver_user_email`='".$userEmail."')
            ORDER BY `created_at` ASC
        ");
        $conversation_num = $conversations_rs->num_rows;

        for ($i=0; $i < $conversation_num; $i++) {
            $conversation_data = $conversations_rs->fetch_assoc();

            $time = date("H:i", strtotime($conversation_data['created_at']));

            // A Received Msg
            if ($conversation_data['sender_user_email'] == $userEmail AND $conversation_data['receiver_admin_email'] == $adminEmail) {
                ?>
                    <div class="d-flex flex-row justify-content-start receivedMsg" style="margin-bottom: 7px;">
                        <p class="d-inline-block" style="color: rgb(0,0,0);margin: 0px;padding: 10px;background: #e5e5ea;font-size: 17px;border-radius: 18px;margin-left: 8px;">
                            <?php echo $conversation_data['message']; ?>
                        </p>
                    </div>
                    <p style="display: inline;color: white;font-size: 10px;margin-left: 17px;margin-top: -7px;">
                        <?php echo $time ?>
                    </p>
                <?php
            } 
            
            // A Sent Msg
            else if ($conversation_data['sender_admin_email'] == $adminEmail AND $conversation_data['receiver_user_email'] == $userEmail) {
                ?>
                    <div style="position: relative;">
                        <div class="d-flex flex-row justify-content-end sentMsg" style="margin-bottom: 16px;">
                            <p class="d-inline-block" style="color: rgb(255,255,255);margin: 0px;padding: 10px;background: #188ffd;font-size: 17px;border-radius: 18px;margin-right: 8px;">
                                <?php echo $conversation_data['message']; ?>
                            </p>
                        </div>
                        <p style="display: inline;color: white;font-size: 10px;margin-left: 17px;margin-top: -7px;    position: absolute;top: 54px;right: 18px;">
                            <?php echo $time ?>
                        </p>
                    </div>
                <?php
            }
        }
        ?>
    </div>

    <!-- Send Messages Bts -->
    <div style="position:absolute; bottom: 50px; left: 10px; right:10px;">
        <input id="msg_input"
            type="text" class="msgInput" style="width: 90%;font-family: Atma, serif;font-size: 18px;font-weight: bold;letter-spacing: 3px;padding: 10px 2px;margin-right: 7px;border-radius: 13px;border-style: solid;border-color: rgb(123,133,227);padding-left: 9px;">
        <button onclick="sendMessage('<?php echo $userEmail ?>')" 
            class="btn btn-primary" type="button" style="background: rgb(123,133,227);padding: 15px;">
            <i class="fa fa-send" style="font-size: 24px;"></i>
        </button>
    </div>
</div>