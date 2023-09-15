<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Panel | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Architects+Daughter&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Atma&amp;display=swap">
    <link rel="stylesheet" href="assets/css/adminPanel.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="icon" href="assets/img/logo.png">
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body>
    
    <?php

    session_start();

    require "PHP/connection.php";

    if (isset($_SESSION['admin'])) {

    } else {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <div id="loader">
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navBar" class="navbar navbar-light navbar-expand-lg navigation-clean">
        <div class="container">
            <a class="navbar-brand" style="font-family: Aldrich, sans-serif;font-size: 34px;font-weight: bold;text-align: center;color: rgb(2,123,253);opacity: 0.58;text-shadow: 0px 0px 4px;">CYBERSHOP</a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item w d-flex align-items-center">
                        <a class="nav-link" onclick="go_back('dashBoard')">DashBoard</a>
                    </li>
                    <li class="nav-item w d-flex align-items-center">
                        <a class="nav-link" onclick="go_back('manageUsers')">Manage Users</a>
                    </li>
                    <li class="nav-item w d-flex align-items-center">
                        <a class="nav-link" onclick="go_back('manageProducts')">Manage Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link"
                            style="display: flex; align-items: center;"
                            aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <div style="margin-right: 5px;" class="userProfile"><img src="assets/img/default.jpg"></div>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item w text-center" onclick="logOutAdmin()">
                                <i class="fa fa-sign-out"></i>&nbsp;Log Out
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div style="margin-top: 140px;">

        <!-- DashBoard -->
        <div class="container d-none animate__animated animate__faster" id="dashBoard" style="margin-bottom: 30px;">
            <h1 style="margin-bottom: 17px;">DashBoard&nbsp;<i class="fa fa-signal"></i></h1>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Earnings(DAILY)</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>$40,000</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Earnings(annual)</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>$215,000</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>TODADY SELLINGS</span>
                                    </div>
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h5 mb-0 me-3"><span>50%</span></div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    
                    <div class="card shadow border-start-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>TOTAL ENGAGEMENTS</span></div>
                                    <div class="text-dark fw-bold h5 mb-0">
                                        <span>
                                        <?php 
                                        $user_rs = Database::search("SELECT * FROM `user` ");
                                        $user_num = $user_rs->num_rows;
                                        echo $user_num;
                                        ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-2" style="margin-bottom: 10px;">  
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Most Famous Seller&nbsp;</h4>
                            <div class="d-flex flex-column align-items-center" style="margin-top: 30px;">
                                <div class="mostSeller_img"><img src="assets/img/default.jpg">
                                </div>
                                <h2>Cyber Shop Official</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Most sold Product</h4>
                            <div class="d-flex flex-column align-items-center" style="margin-top: 30px;">
                                <div class="mostSeller_img"><img src="assets/img/s-l500 (6).jpg"></div>
                                <h2>IPhone 14 Pro</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Users -->
        <div class="container d-none animate__animated animate__faster" id="manageUsers" style="margin-bottom: 30px;">
            <h1 style="margin-bottom: 17px;">Manage Users&nbsp;<i class="fa fa-users"></i></h1>
            <section class="features-boxed">
                <div class="container">
                    <div class="intro"></div>
                    <div class="row justify-content-center features">
                        <div class="col-sm-6 col-md-5 col-lg-4 item" onclick="go_back('manageUsers_Profiles')">
                            <div class="box manageUser_box"><i class="fa fa-user-circle-o icon"></i>
                                <h3 class="name">Profiles</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item" onclick="go_back('manageUsers_blockUnblock')">
                            <div class="box manageUser_box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" class="icon">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.63604 18.364C9.15076 21.8787 14.8492 21.8787 18.364 18.364C21.8787 14.8492 21.8787 9.15076 18.364 5.63604C14.8492 2.12132 9.15076 2.12132 5.63604 5.63604C2.12132 9.15076 2.12132 14.8492 5.63604 18.364ZM7.80749 17.6067C10.5493 19.6623 14.4562 19.4433 16.9497 16.9497C19.4433 14.4562 19.6623 10.5493 17.6067 7.80749L14.8284 10.5858C14.4379 10.9763 13.8047 10.9763 13.4142 10.5858C13.0237 10.1953 13.0237 9.5621 13.4142 9.17157L16.1925 6.39327C13.4507 4.33767 9.54384 4.55666 7.05025 7.05025C4.55666 9.54384 4.33767 13.4507 6.39327 16.1925L9.17157 13.4142C9.5621 13.0237 10.1953 13.0237 10.5858 13.4142C10.9763 13.8047 10.9763 14.4379 10.5858 14.8284L7.80749 17.6067Z" fill="currentColor"></path>
                                </svg>
                                <h3 class="name">Block / Unblock</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item" onclick="go_back('manageUsers_sellPermissions')">
                            <div class="box manageUser_box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-currency-dollar icon">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z">
                                    </path>
                                </svg>
                                <h3 class="name">Sell Permissions</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item" onclick="go_back('manageUsers_messages')">
                            <div class="box manageUser_box"><i class="fa fa-wechat icon"></i>
                                <h3 class="name">Messages</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item" onclick="go_back('manageUsers_friends')">
                            <div class="box manageUser_box"><i class="fas fa-user-friends icon"></i>
                                <h3 class="name">Friends</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Manage Products -->
        <div class="container d-none animate__animated animate__faster" id="manageProducts" style="margin-bottom: 30px;">
            <h1 style="margin-bottom: 17px;">Manage Products&nbsp;<i class="material-icons" style="font-size: 41px;">card_travel</i></h1>
            <section class="features-boxed">
                <div class="container">
                    <div class="intro"></div>
                    <div class="row justify-content-center features">
                        <div class="col-sm-6 col-md-5 col-lg-3 item" style="margin-bottom: 5px;">
                            <div onclick="go_back('manageProducts_productDelivery')" class="d-flex justify-content-center align-items-center product_box manageUser_box" style="padding: 20px;">
                                <h3 class="name">Product Delivery</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3 item" style="margin-bottom: 5px;">
                            <div data-bs-toggle="modal" data-bs-target="#addNewCategory" class="d-flex justify-content-center align-items-center product_box manageUser_box" style="padding: 20px;">
                                <h3 class="name">Add new Category</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3 item" style="margin-bottom: 5px;">
                            <div data-bs-toggle="modal" data-bs-target="#addNewBrand" class="d-flex justify-content-center align-items-center product_box manageUser_box" style="padding: 20px;">
                                <h3 class="name">Add new Brand</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3 item" style="margin-bottom: 5px;">
                            <div data-bs-toggle="modal" data-bs-target="#addNewModal" class="d-flex justify-content-center align-items-center product_box manageUser_box" style="padding: 20px;">
                                <h3 class="name">Add new Model</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>In Stock</th>
                            <th>Brief Description</th>
                            <th>Description</th>
                            <th>Model</th>
                            <th>Brand</th>
                            <th>Added on</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $product_rs = Database::search("SELECT *, model.name AS model_name, brand.name AS brand_name 
                    FROM `product` 
                    INNER JOIN `model` ON model.id=product.model_id
                    INNER JOIN `brand` ON brand.id=model.brand_id");
                    $product_num = $product_rs->num_rows;

                    for ($d=0; $d < $product_num; $d++) {
                        $product_data = $product_rs->fetch_assoc();
                        ?>
                            <tr>
                                <td><?php echo $d + 1; ?></td>
                                <td><?php echo $product_data['title'] ?></td>
                                <td><?php echo $product_data['user_email'] ?></td>
                                <td><?php echo $product_data['price'] ?></td>
                                <td><?php echo $product_data['qty'] ?></td>
                                <td data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $product_data['small_desc'] ?>"><a style="color: #188ffd;text-decoration: underline;cursor: pointer;">Brief Desc</a></td>
                                <td data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $product_data['desc'] ?>"><a style="color: #188ffd;text-decoration: underline;cursor: pointer;">Description</a></td>
                                <td><?php echo $product_data['model_name'] ?></td>
                                <td><?php echo $product_data['brand_name'] ?></td>
                                <td><?php echo $product_data['dateTime'] ?></td>
                            </tr>
                        <?php
                    }
                    
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage users Profile -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageUsers_Profiles" style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageUsers')" class="w" style="font-size: 21px;color: rgb(142,147,152);">
                <i class="icon ion-ios-arrow-back"></i>
                &nbsp;Go back
            </h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Manage Profiles&nbsp;<i class="fa fa-user-circle-o"></i></h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Mobile Numbers</th>
                            <th>Gender</th>
                            <th>Created at</th>
                            <th>Logged In</th>
                            <th>TagCode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $users_rs = Database::search("SELECT * FROM `user` 
                            INNER JOIN `gender` ON gender.id=user.gender_id");
                            $users_num = $users_rs->num_rows;

                            for ($i=0; $i < $users_num; $i++) {
                                $user_data = $users_rs->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $user_data['fname'] . ' ' . $user_data['lname'] ?></td>
                                        <td><?php echo $user_data['email'] ?></td>
                                        <td><?php echo $user_data['password'] ?></td>
                                        <td><?php echo $user_data['mobile1'] . ' / ' . $user_data['mobile2'] ?></td>
                                        <td><?php echo $user_data['type'] ?></td>
                                        <td><?php echo $user_data['joined_date'] ?></td>
                                        <td><?php echo $user_data['accessed'] ?></td>
                                        <td><?php echo $user_data['tagCode'] ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <section class="team-clean">
                <div class="container">
                    <div class="row people">
                        <?php
                        $users_rs = Database::search("SELECT * FROM `user`");
                        $users_num = $users_rs->num_rows;

                        for ($k = 0; $k < $users_num; $k++) {
                            $user_data = $users_rs->fetch_assoc();
                            $userImg_rs = Database::search("SELECT * FROM `profileImage` WHERE `user_email`='" . $user_data['email'] . "'");
                            $userImg_data = $userImg_rs->fetch_assoc();
                            ?>
                                <div class="col-md-6 col-lg-4 item">
                                    <img class="rounded-circle" src="<?php echo $userImg_data['path'] ?>">
                                    <h3 class="name" style="margin-bottom: 0px;color: rgb(165,168,170);">#<?php echo $k + 1; ?></h3>
                                    <h3 class="name" style="margin-top: 0px;"><?php echo $user_data['fname'] . ' ' . $user_data['lname'] ?></h3>
                                    <p class="title"><?php echo $user_data['tagCode']  ?><br></p>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Block Unblock -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageUsers_blockUnblock" style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageUsers')" class="w" style="font-size: 21px;color: rgb(142,147,152);">
                <i class="icon ion-ios-arrow-back"></i>&nbsp;Go back
            </h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Block / Unblock&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.63604 18.364C9.15076 21.8787 14.8492 21.8787 18.364 18.364C21.8787 14.8492 21.8787 9.15076 18.364 5.63604C14.8492 2.12132 9.15076 2.12132 5.63604 5.63604C2.12132 9.15076 2.12132 14.8492 5.63604 18.364ZM7.80749 17.6067C10.5493 19.6623 14.4562 19.4433 16.9497 16.9497C19.4433 14.4562 19.6623 10.5493 17.6067 7.80749L14.8284 10.5858C14.4379 10.9763 13.8047 10.9763 13.4142 10.5858C13.0237 10.1953 13.0237 9.5621 13.4142 9.17157L16.1925 6.39327C13.4507 4.33767 9.54384 4.55666 7.05025 7.05025C4.55666 9.54384 4.33767 13.4507 6.39327 16.1925L9.17157 13.4142C9.5621 13.0237 10.1953 13.0237 10.5858 13.4142C10.9763 13.8047 10.9763 14.4379 10.5858 14.8284L7.80749 17.6067Z" fill="currentColor"></path>
                </svg>
            </h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logged In</th>
                            <th>Created at</th>
                            <th>BLOCK STATUS</th>
                            <th>BLOCK / UNBLOCK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_rs = Database::search("SELECT * FROM `user` ");
                        $user_num = $user_rs->num_rows;

                        for ($l=0; $l < $user_num; $l++) { 
                            $user_data = $user_rs->fetch_assoc();
                            $txt = $user_data['blocked_id'] == '0' ? "UNBLOCKED" : "BLOCKED";
                            $txt_color = $user_data['blocked_id'] == '0' ? "--bs-teal" : "--bs-danger";
                            $button_txt = $user_data['blocked_id'] == '0' ? "Block" : "Unblock";
                            ?>
                                <tr>
                                    <td style="line-height: 36px;"><?php echo $l + 1; ?></td>
                                    <td style="line-height: 36px;"><?php echo $user_data['fname'].' '.$user_data['lname'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $user_data['email'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $user_data['accessed'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $user_data['joined_date'] ?><br></td>
                                    <td id="block_text_<?php echo $user_data['email'] ?>"
                                        style="line-height: 36px;letter-spacing: 3px;font-weight: bold;color: var(<?php echo $txt_color ?>);">
                                        <?php echo $txt ?>
                                    </td>
                                    <td>
                                        <button id="block_bt_<?php echo $user_data['email'] ?>" 
                                            onclick="change_blockedStatus('<?php echo $user_data['email'] ?>')"    
                                            class="btn btn-primary" type="button">
                                            <?php echo $button_txt ?>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sell Permissions -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageUsers_sellPermissions" style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageUsers')" class="w" style="font-size: 21px;color: rgb(142,147,152);">
                <i class="icon ion-ios-arrow-back"></i>&nbsp;Go back
            </h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Sell Permissions&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-currency-dollar">
                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z">
                    </path>
                </svg>
            </h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>CAN SELL</th>
                            <th>PERMISSIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $user_rs = Database::search("SELECT * FROM `user` ");
                            $user_num = $user_rs->num_rows;

                            for ($j=0; $j < $user_num; $j++) { 
                                $user_data = $user_rs->fetch_assoc();
                                $txt = $user_data['canSell_id'] == '1' ? "YES" : "NO";
                                $txt_color = $user_data['canSell_id'] == '1' ? "--bs-teal" : "--bs-danger";
                                ?>
                                    <tr>
                                        <td style="line-height: 36px;"><?php echo $j + 1; ?></td>
                                        <td style="line-height: 36px;"><?php echo $user_data['fname'].' '.$user_data['lname'] ?><br></td>
                                        <td style="line-height: 36px;"><?php echo $user_data['email'] ?><br></td>
                                        <td style="line-height: 36px;"><?php echo $user_data['joined_date'] ?><br></td>
                                        <td id="sell_txt_<?php echo $user_data['email'] ?>"
                                            style="color: var(<?php echo $txt_color ?>);line-height: 36px;letter-spacing: 3px;font-weight: bold;">
                                            <?php echo $txt ?>
                                        </td>
                                        <td>
                                            <button onclick="toggle_sellPermissions('<?php echo $user_data['email'] ?>')"
                                                class="btn btn-primary" type="button">Toggle</button>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            $sellRes_rs = Database::search("SELECT * FROM `sell_req`");
            $sellReq_num = $sellRes_rs->num_rows;

            for ($h=0; $h < $sellReq_num; $h++) {
                $sellReq_data = $sellRes_rs->fetch_assoc();
                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$sellReq_data['user_email']."' ");
                $user_data = $user_rs->fetch_assoc();

                ?>
                    <div class="col-4" style="border-left: 8px solid red; padding: 20px; background-color: #e5e5ea; position: relative;">
                        <h4><?php echo $user_data['fname'] . ' ' . $user_data['lname'] ?></h4>
                        <p style="margin: 0;"><?php echo $sellReq_data['why'] ?></p>
                        <div style="position: absolute; top: 34px; right: 10px;cursor:pointer;">
                            <style>
                                .icons {font-size: 30px;cursor: pointer;}
                                .fa-check.icons:hover {color: #13f700;}
                                .fa-remove.icons:hover {color: red;}
                            </style>
                            <i class="fa fa-check icons" onclick="sellReq('<?php echo $sellReq_data['user_email'] ?>', 'accept')"></i>
                            <i class="fa fa-remove icons" onclick="sellReq('<?php echo $sellReq_data['user_email'] ?>', 'decline')"></i>
                        </div>
                    </div>
                <?php
            }
            
            ?>
        </div>

        <!-- Messages -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageUsers_messages" style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageUsers')" class="w" style="font-size: 21px;color: rgb(142,147,152);"><i class="icon ion-ios-arrow-back"></i>&nbsp;Go back</h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Messages&nbsp;<i class="fa fa-wechat"></i></h1>
            <div>
                <div class="row" style="height: 100%;">

                    <!-- Chat -->
                    <div class="col-5" style="height: 100%;overflow: hidden;position: relative;">
                        <div class="other" style="margin-top: 15px;">
                            <div class="scrollDiv" style="overflow-x: hidden;overflow-y: scroll;height: 900px;">
                                <?php 
                                $users_rs = Database::search("SELECT * FROM `user` ");
                                $users_num = $users_rs->num_rows;

                                for ($m=0; $m < $users_num; $m++) { 
                                    $users_data = $users_rs->fetch_assoc();
                                    $usersImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='".$users_data['email']."' ");
                                    $usersImg_data = $usersImg_rs->fetch_assoc();
                                    ?>
                                        <div onclick="toggleChatBox('<?php echo $users_data['email'] ?>')" class="d-flex userBox" style="padding: 20px;border: 1px solid rgb(217,217,217);border-radius: 5px;margin-bottom: 5px;">
                                            <div class="profilePic" style="border-radius: 50%;border-style: solid;border-color: #5965db;">
                                                <img src="<?php echo $usersImg_data['path'] ?>">
                                            </div>
                                            <div class="userData" style="width: 100%;padding-left: 14px;">
                                                <h3><?php echo $users_data['fname'].' '.$users_data['lname']; ?></h3>
                                                <p style="margin: 0px;">Paragraph</p>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- ChatBox -->
                    <div id="chatBOX" class="col-lg-7 col-12" style="position: relative;">
                        <!-- No Chat is selected -->
                        <div style="height: 100%; width: 100%;background: url(&quot;assets/img/8c98994518b575bfd8c949e91d20548b.jpg&quot;) center / contain;"></div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Friends -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageUsers_friends" style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageUsers')" class="w" style="font-size: 21px;color: rgb(142,147,152);">
                <i class="icon ion-ios-arrow-back"></i>&nbsp;Go back
            </h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Friends&nbsp;<i class="fas fa-user-friends"></i></h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Friends</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $friends_rs = Database::search("SELECT * FROM `friend_lists` ");
                        $friends_num = $friends_rs->num_rows;

                        for ($g=0; $g < $friends_num; $g++) { 
                            $friends_data = $friends_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?php echo $friends_data['user_email'] ?></td>
                                    <td><?php echo $friends_data['friend_email'] ?><br></td>
                                    <td><?php echo $friends_data['created_at'] ?></td>
                                </tr>
                            <?php
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Product Delivery -->
        <div class="container-xl d-none animate__animated animate__faster" id="manageProducts_productDelivery"  style="margin-bottom: 30px;">
            <h1 onclick="go_back('manageProducts')" class="w" style="font-size: 21px;color: rgb(142,147,152);"><i class="icon ion-ios-arrow-back"></i> Go back</h1>
            <h1 style="margin-bottom: 17px;color: #1485ee;">Manage Product Delivery <i class="fas fa-shipping-fast"></i></h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Id</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Qty</th>
                            <th>Date</th>
                            <th>Delivery Status</th>
                            <th>Change Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                        $invoice_num = $invoice_rs->num_rows;

                        for ($z=0; $z < $invoice_num; $z++) {
                            $invoice_data = $invoice_rs->fetch_assoc();
                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$invoice_data['product_id']."' ");
                            $product_data = $product_rs->fetch_assoc();

                            $status_txt = '';
                            $status_txt_color = '';
                            switch ($invoice_data['status']) {
                                case '1':
                                    $status_txt = 'PACKAGING';
                                    $status_txt_color = '--bs-danger';
                                    break;
                                case '2':
                                    $status_txt = 'SHIPPING';
                                    $status_txt_color = '--bs-warning';
                                    break;
                                case '3':
                                    $status_txt = 'DELIVERED';
                                    $status_txt_color = '--bs-teal';
                                    break;
                            }

                            ?>
                                <tr>
                                    <td style="line-height: 36px;"><?php echo $z + 1; ?></td>
                                    <td style="line-height: 36px;"><?php echo $invoice_data['order_id'] ?></td>
                                    <td style="line-height: 36px;"><?php echo '('. $invoice_data['product_id'].') ◆ ' . $product_data['title'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $invoice_data['user_email'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $invoice_data['qty'] ?></td>
                                    <td style="line-height: 36px;"><?php echo $invoice_data['date'] ?></td>
                                    <td id="status_txt_<?php echo $invoice_data['order_id'] ?>"
                                        style="line-height: 36px;letter-spacing: 3px;font-weight: bold;color: var(<?php echo $status_txt_color ?>);">
                                        <?php echo $status_txt ?>
                                    </td>
                                    <td>
                                        <button id="status_bt_<?php echo $invoice_data['order_id'] ?>" 
                                            onclick="change_deliveryStaus('<?php echo $invoice_data['order_id'] ?>')"
                                            <?php $invoice_data['status'] == '3' ? "disabled" : ""; ?>
                                            class="btn btn-primary" type="button">Change</button>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add new Category Modal -->
    <div id="addNewCategory" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category</h4>
                </div>
                <div class="modal-body">
                    <input id="newCategory_input" type="text" placeholder="Enter a new name for your category" style="padding: 15px;font-size: 18px;width: 100%;border-radius: 12px;border-style: solid;border-color: rgb(205,205,205);" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button onclick="addNewCategory()"
                         class="btn btn-primary" type="button">Add  <i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Brand modal -->
    <div id="addNewBrand" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Brand</h4>
                </div>
                <div class="modal-body">
                    <select id="selected_category_input" style="padding: 15px;width: 100%;margin-bottom: 10px;font-size: 18px;border-radius: 12px;border-style: solid;border-color: rgb(205,205,205);">
                        <option value="0" selected>Select Category</option>
                        <?php
                            $category_rs = Database::search("SELECT * FROM `category` ");
                            $category_num = $category_rs->num_rows;
                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data['id']; ?>">
                                        <?php echo $category_data['type']; ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                    <input id="newBrand_input" type="text" placeholder="Enter a new Model Brand" style="padding: 15px;font-size: 18px;width: 100%;border-radius: 12px;border-style: solid;border-color: rgb(205,205,205);" /></div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button onclick="addNewBrand()" class="btn btn-primary" type="button">Add  <i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add new Model modal -->
    <div id="addNewModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Modal</h4>
                </div>
                <div class="modal-body">
                    <select id="selected_brand_input" style="padding: 15px;width: 100%;margin-bottom: 10px;font-size: 18px;border-radius: 12px;border-style: solid;border-color: rgb(205,205,205);">
                        <option value="0" selected="">Select Brand</option>
                        <?php
                            $brand_rs = Database::search("SELECT * FROM `brand` ");
                            $brand_num = $brand_rs->num_rows;
                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brand_data['id']; ?>">
                                        <?php echo $brand_data['name']; ?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                    <input id="newModel_input" type="text" placeholder="Enter a new category modal" style="padding: 15px;font-size: 18px;width: 100%;border-radius: 12px;border-style: solid;border-color: rgb(205,205,205);" /></div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button onclick="addNewModel()" class="btn btn-primary" type="button">Add  <i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Cateogry Added Modal -->
    <div class="toast fade hide" role="alert" id="newCategoryAdded">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            New Category added. "<p style="display: inline;" id="newCategoryName"></p>"
        </div>
    </div>

    <!-- New Brand Added Modal -->
    <div class="toast fade hide" role="alert" id="newBrandAdded">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            New Brand added. "<p style="display: inline;" id="newBrandName"></p>"
        </div>
    </div>

    <!-- New Model Added Modal -->
    <div class="toast fade hide" role="alert" id="newModelAdded">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            New Model added. "<p style="display: inline;" id="newModelName"></p>"
        </div>
    </div>

    <!-- Scroll Bt -->
    <button onclick="topFunction()" id="scrollToTop__btn" title="Go to top">
        <svg class="arrow up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="5 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" points="0.375, 35.375 28.375, 0.375 58.67, 35.375 " />
        </svg>
    </button>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/adminScript.js"></script>
    <script src="assets/js/scrollToTop.js"></script>

</body>

</html>