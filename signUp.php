<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SignUp | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mochiy+Pop+P+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&amp;display=swap">
    <link rel="stylesheet" href="assets/css/signUp.css">
    <link rel="icon" href="assets/img/logo.png">
</head>

<body style="font-family: Poppins, sans-serif;">
    <div style="height: 100vh;">

        <div class="row" style="height: 100%;">
            <div class="col d-lg-flex justify-content-lg-center align-items-lg-center img-card">
                <div class="card">
                    <img class="card-img-top w-100 d-block" src="assets/img/sign-up-side.jpg">
                </div>
            </div>
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <header style="margin-bottom: 15px;">
                        <h1 class="text-center" style="font-weight: bold;font-size: 50px;">Sign Up</h1>
                        <h1 class="text-center name" style="color: rgb(2,123,253);font-weight: bold;font-family: Aldrich, sans-serif;">CYBER SHOP</h1>
                    </header>
                    <div class="row d-flex justify-content-center" style="margin-top: 21px;">
                        <div class="col-sm-12 col-lg-10">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 input" style="margin-bottom: 12px;">
                                    <label class="form-label" style="border-color: rgba(33,37,41,0.92);">First Name</label>
                                    <input type="text" id="fname" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);"></div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 input" style="margin-bottom: 12px;">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" id="lname" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);"></div>
                                <div class="col-12 input" style="margin-bottom: 12px;">
                                    <label class="form-label d-block">Email</label>
                                    <input type="text" id="email" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);"></div>
                                <div class="col-12 input" style="margin-bottom: 12px;">
                                    <label class="form-label d-block">Password</label>
                                    <input type="text" id="pswd" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);"></div>
                                <div class="col-6 input" style="margin-bottom: 12px;">
                                    <label class="form-label d-block">Mobile</label>
                                    <input type="text" id="mobile" style="font-size: 19px;padding: 10px 2px;padding-left: 15px;width: 100%;border-radius: 35px;border-style: solid;border-color: rgba(207,204,204,0.82);"></div>
                                <div class="col-6 input" style="margin-bottom: 12px;">
                                    <label class="form-label d-block">Gender</label>
                                    <select class="shadow-sm" id="gender" style="width: 100%;padding: 10px 2px;font-size: 19px;padding-left: 10px;border-style: solid;border-color: rgba(207,204,204,0.82);border-radius: 35px;">
                                        <option value="1" selected>Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center" style="margin-top: 30px;">
                            <button class="btn btn-primary d-block" 
                                onclick="registerUser()"
                                type="button" 
                                style="padding: 9px 12px;padding-right: 26px;padding-left: 26px;font-size: 20px;width: 50%;border-radius: 70px;padding-top: 12px;padding-bottom: 12px;">
                                Sign Up
                            </button>
                        </div>
                        <div class="col d-flex justify-content-center" style="margin-top: 5px;">
                            <h6>Already have an account ?&nbsp;<a href="login.php">Log In</a></h6>
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

        <div class="toast fade msgSignUp hide" role="alert" data-bs-delay="2000" id="accCreatedMsg">
            <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 30px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
            <div class="toast-body" role="alert">
                <p>You Account Was Successfully Created.</p>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>