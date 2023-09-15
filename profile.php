<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body>

    <?php

    include "header.php";   

if (isset($_SESSION['user'])) {

    $userEmail = $_SESSION['user']['email'];

    $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id=user.gender_id WHERE `email`='" . $userEmail . "' ");
    $details_data = $details_rs->fetch_assoc();

    $address_rs = Database::search("SELECT *, district.name AS dname, province.name AS pname FROM `useraddress` 
    INNER JOIN `district` ON useraddress.district_id=district.id
    INNER JOIN `province` ON district.province_id=province.id
    WHERE `user_email`='" . $userEmail . "' ");
    $address_data = $address_rs->fetch_assoc();

    $profileImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='".$userEmail."'");
    $profileImg_data = $profileImg_rs->fetch_assoc();

} else {
    ?>
        <script>
            window.location = 'login.php';
        </script>
    <?php
}

?>

<div class="container" style="min-height: 100vh;">
    <ol class="breadcrumb bd" style="padding: 10px 15px;">
        <li class="breadcrumb-item">
            <a href="home.php">
                <span>Home</span>
            </a>
        </li>
        <li class="breadcrumb-item active">
            <span>User Profile</span>
        </li>
    </ol>
    <div class="row" style="height: auto;margin-top: -40px;">
        <div class="col-12 col-lg-5 d-flex align-items-center" style="height: 100vh;">
            <div class="d-flex flex-column justify-content-center align-items-center profileImage__container">
                <input type="file" id="userImgUploader" class="d-none">
                <label for="userImgUploader" onclick="changeUserImg()">
                    <div class="imgContainer" style="margin-bottom: 30px;">
                        <img id="userImg" class="profile w" src="<?php echo $profileImg_data['path'] ?>">
                    </div>
                </label>
                <div class="imgBody">
                    <h1 class="text-center" style="font-family: Aldrich, sans-serif;font-weight: bold; text-transform: uppercase;">
                        <?php echo $details_data['fname'] . ' ' . $details_data['lname'] ?>
                    </h1>
                    <?php
                    $date = $details_data['joined_date'];
                    $year = date('Y', strtotime($date));
                    $day = date('d', strtotime($date));
                    $month = date('F', strtotime($date));
                    ?>
                    <p class="text-center" style="font-size: 17px;font-style: italic;"><?php echo $details_data['email'] ?></p>
                    <p class="text-center" style="font-size: 13px;">Since <?php echo $day; ?>, <?php echo $month; ?> <?php echo $year; ?></p>
                    <p class="text-center" 
                        style="cursor:pointer;font-size: 17px;font-weight:bold;margin:0;padding:0;"
                        onclick="copyTagCode('<?php echo $details_data['tagCode'] ?>')">
                        <?php echo $details_data['tagCode'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center">
            <div class="userDetails" style="padding: 40px 20px;">
                <div style="margin-bottom: 20px;">
                    <h1 class="text-center" style="font-family: Aldrich, sans-serif;">Your Profile</h1>
                </div>
                <div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">First Name</label>
                                <input id="fname" type="text" placeholder="<?php echo $details_data['fname']; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Last Name</label>
                                <input id="lname" type="text" placeholder="<?php echo $details_data['lname']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Email</label>
                                <input type="text" placeholder="<?php echo $details_data['email']; ?>" disabled="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Password</label>
                                <input type="password" value="<?php echo $details_data['password']; ?>" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Mobile</label>
                                <input id="mobile1" type="text" placeholder="<?php echo $details_data['mobile1']; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Registered Date &amp; Time</label>
                                <input type="text" value="<?php echo $details_data['joined_date']; ?>" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Mobile 2</label>
                                <input id="mobile2" type="text" placeholder="<?php echo $details_data['mobile2']; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Postal Code</label>
                                <input id="postalCode" type="text" placeholder="<?php echo $address_data['postal code']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Province</label>
                                <select id="province" onchange="load_district('<?php echo $address_data['dname']; ?>')">
                                    <?php
                                    $province_rs = Database::search("SELECT * FROM `province` ");
                                    $province_num = $province_rs->num_rows;
                                    for ($x=0; $x<$province_num; $x++) {
                                        $province_data = $province_rs->fetch_assoc();
                                        ?>
                                            <option 
                                                <?php
                                                if ($address_data['pname'] == $province_data['name']) {
                                                    ?>selected<?php
                                                }
                                                ?>
                                                value="<?php echo $province_data['id'] ?>">
                                                <?php echo $province_data['name']; ?>
                                            </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">District</label>
                                <select id="district">
                                    <option value="0"><?php echo $address_data['dname']; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Address Line 1&nbsp;</label>
                                <input id="line1" type="text" placeholder="<?php echo $address_data['line 1'] ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="profile__input">
                                <label class="form-label">Address Line 2</label>
                                <input id="line2" type="text" placeholder="<?php echo $address_data['line 2'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col d-flex justify-content-center align-items-center">
                            <button 
                                onclick="saveProfile()"
                                class="profile__saveBt" type="button" data-bs-toggle="modal" data-bs-target="modal-1">
                                Save Profile
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding: 15px;">
                            <p style="color: red; padding: 10px 25px; background-color: #ffeeee;text-align:center;" id="errorMsg" class="d-none"></p>
                        </div>
                    </div>
                </div>
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