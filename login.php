<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/logIn.css">
    <link rel="icon" href="assets/img/logo.png">
</head>

<body style="font-family: Poppins, sans-serif;">

    <?php 
    $rMe = 'checked'; $email = '';
    if (isset($_COOKIE['email'])) {$email = $_COOKIE['email'];}
    if (!isset($_COOKIE['rMe'])) {$rMe = '';}
    ?>

    <div style="height: 100vh;">
        <div class="row" style="height: 100%;">
            <div class="col d-lg-flex justify-content-lg-center align-items-lg-center img-card">
                <div class="card">
                    <img class="card-img-top w-100 d-block" src="assets/img/log-in-side.jpg" style="margin-left: 20px;">
                </div>
            </div>
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <div class="container" style="margin-right: 10px;margin-left: 10px;">
                    <header style="margin-bottom: 46px;">
                        <h1 class="text-center" style="font-size: 50px;font-weight: bold;">LOG IN</h1>
                        <h1 class="text-center name" style="color: rgb(2,123,253);font-weight: bold;font-family: Aldrich, sans-serif;">CYBER SHOP</h1>
                        <p class="text-center">Don't have an account ?&nbsp;<a href="signUp.php">Sign Up</a></p>
                    </header>
                    <div class="row d-lg-flex justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-7" style="margin-bottom: 16px;">
                            <label class="form-label d-block">Email</label>
                            <input type="text" 
                                id="email"
                                value="<?php echo $email; ?>" 
                                style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-7" style="margin-bottom: 16px;">
                            <label class="form-label d-block">Password</label>
                            <input type="password" id="pswd" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-7" style="margin-bottom: 16px;">
                            <div class="form-check form-switch">
                                <input id="rMe" class="form-check-input" <?php echo $rMe; ?> type="checkbox">
                                <label class="form-check-label" for="rMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary d-block" type="button" 
                                onclick="logIn()"
                                style="padding: 9px 12px;padding-right: 26px;padding-left: 26px;font-size: 20px;width: 50%;border-radius: 70px;padding-top: 12px;padding-bottom: 12px;">
                                Log In
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-center" style="margin-top: 12px;">
                            <a style="text-decoration: underline; color: var(--bs-blue); cursor: pointer;" onclick="forgotPswd()">Forgot Password ?</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="padding: 15px;">
                        <p style="color: red; padding: 10px 25px; background-color: #ffeeee;" id="errorMsg" class="d-none"></p>
                    </div>
                </div>
                <div class="row bottom-fix" style="width: 100%;">
                    <div class="col-12">
                        <p class="text-center" style="font-size: 14px;">© 2022 CyberShop.lk || All rights reserved<br></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Blocked Modal -->
    <div class="modal fade bounce animated" role="dialog" tabindex="-1" id="userBlockedModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="d-flex flex-column justify-content-center align-items-center" style="padding: 29px;border-bottom-style: solid;border-bottom-color: var(--bs-gray-400);"><i class="fas fa-user-lock" style="font-size: 31px;"></i>
                    <h1>User Blocked</h1>
                    <p class="text-center">You currently have no access to this web page. Request Access from admin to recover account.<br></p>
                </div>
                <div class="d-flex" style="padding: 20px;">
                    <button 
                        onclick=""
                        class="btn btn-primary btn-sm" type="button" style="margin: 10px;">Continue As a Guest</button>
                    <button 
                        onclick="unblockReq()"
                        class="btn btn-primary btn-sm" type="button" style="margin: 10px;">Request Access From Admin</button>
                    <button 
                        onclick="window.location = 'signUp.php'"
                        class="btn btn-primary btn-sm" type="button" style="margin: 10px;">Create New Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Request To Admin Modal -->
    <div class="toast fade hide" role="alert" id="reqToAdmin">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            <p>Request has been sent to admin</p>
        </div>
    </div>

    <!-- Verification Modal -->
    <div class="toast fade hide" role="alert" id="vcodeSending">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            <p>Sending Verification code to your email...</p>
        </div>
    </div>

    <!-- Verification Modal -->
    <div class="toast fade hide" role="alert" id="pswdChanged">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            <p>Your Password was changed. Try Logging in Now</p>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade bounce animated" role="dialog" tabindex="-1" id="resetPswd">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="d-flex flex-column justify-content-center modal-header">
                    <img class="resetPswd-icon" src="assets/img/16205-200.png">
                    <h1>Reset Password</h1>
                    <p class="d-block" style="color: rgb(1,62,127);">A verification code has been sent to your&nbsp;<a href="https://mail.google.com/mail/u/0/#inbox" target="_blank">email&nbsp;<i class="fa fa-external-link"></i></a>&nbsp;</p>
                </div>
                <div class="modal-body">
                    <div>
                        <input id="userVCode" class="d-block" type="text" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 80%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);margin: auto;" placeholder="Verification Code">
                    </div>
                    <div style="margin-top: 19px;">
                        <p style="padding-right: 5px;padding-left: 17px;margin: auto;margin-bottom: 2px;width: 80%;">Type in a New Password for your account</p>
                        <input id="newPswd" class="d-block" type="text" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 80%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);margin: auto;margin-bottom: 8px;" placeholder="New Password">
                        <input id="reTypePswd" class="d-block" type="text" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 80%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);margin: auto;" placeholder="Re-Type New Password">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button 
                        onclick="changePswd()"
                        class="btn btn-primary border rounded-pill" type="button" style="padding: 10px 23px;">
                        Change
                    </button>
                    <div class="col-12" style="padding: 15px;">
                        <p style="text-align:center; color: red; padding: 10px 25px; background-color: #ffeeee;" 
                            id="errorMsgVbox" class="d-none"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>