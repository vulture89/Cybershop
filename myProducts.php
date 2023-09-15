<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>My Products | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/myProducts.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body>

    <div id="loader" >
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <?php

    session_start();

    require "PHP/connection.php";

    if (!isset($_SESSION['user'])) {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    } else {
        $userEmail = $_SESSION['user']['email'];
    }


    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userEmail . "' ");
    $user_data = $user_rs->fetch_assoc();

    if ($user_data['canSell_id'] != '1') {
        ?>

            <!-- User Cannot Sell Any Items -->
            <div id="cannotSell" style="width: 100%;height: auto;padding: 30px;">
                <div class="row">
                    <div class="col-8 col-lg-4">
                        <ol class="breadcrumb bd">
                            <li class="breadcrumb-item">
                                <a href="home.php">
                                <span>Home</span>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <span>My Products</span>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-12 d-flex justify-content-center"><img src="assets/img/27-272007_transparent-product-icon-png-product-vector-icon-png-removebg-preview.png" style="width: 260px;"></div>
                    <div class="col-12 d-flex flex-column align-items-center">
                        <h1 class="text-center" style="margin-top: 25px;">You Currently cannot&nbsp;<br>sell any items&nbsp;</h1>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-lg-6">
                                <p class="text-center" style="margin-top: 19px;">You currently have no permission to sell any items on CyberShop. After getting approved you can manage all your products and sell any items as you wish.</p>
                            </div>
                        </div>
                        <p class="text-center" style="width: 600px;margin-top: 19px;">How Can I Start selling items on Cyber Shop?</p><a href="" data-bs-toggle="modal" data-bs-target="#reqPermissionToSell">Request Permissions From Admin</a>
                    </div>
                </div>
            </div>
            
            <!-- Permission To Sell Modal -->
            <div class="modal fade" role="dialog" tabindex="-1" id="reqPermissionToSell">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Request to Sell Items</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tell us what type of products do you wish to sell on CyberShop?</p>
                            <input id="reason" type="text" style="width: 100%;padding: 10px 15px;" placeholder="Type Something...">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Dismiss</button>
                            <button 
                                onclick="sendSellRequest()" 
                                class="btn btn-primary" type="button">Request</button></div>
                    </div>
                </div>
            </div>

            <!-- Request Successful -->
            <div class="toast fade hide" role="alert" id="sellReq">
                <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
                <div class="toast-body" role="alert">
                    <p>Your Request was sent. Admin will consider your request soon.</p>
                </div>
            </div>
        
        <?php
    } else {
        ?>

            <!-- User Can Sell Items -->
            <div id="canSell" style="width: 100%;">
                <div style="background: #ffffff;">
                    <div class="row d-flex justify-content-center">
                        <div
                            onclick="window.location = 'home.php'" 
                            class="col-11 col-lg-7" style="padding-top: 20px;">
                            <p class="backLink">
                                <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;
                                <span>Home</span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h1 class="text-center" style="padding: 30px;padding-top: 0px;">My Products</h1>
                        </div>
                    </div>

                    <!-- Search and Filtes -->
                    <div class="row row-cols-1 d-flex justify-content-center" style="margin-bottom: 20px;">
                        <div class="col-11 col-lg-6 s" style="margin-top: 5px;">
                            <input id="search" type="search" class="search" style="width: 100%;padding: 10px 15px;" placeholder="Search...">
                        </div>
                        <div class="col-12 col-lg-1 d-flex justify-content-center align-items-center" style="margin-top: 5px;">
                            <div class="d-inline filterBt" onclick="toggleFilters()">
                                <h5 class="d-inline" style="font-family: 'Alegreya Sans', sans-serif;font-size: 17px;line-height: 24px;">FILTERS&nbsp;</h5>
                                <i class="fas fa-filter d-none d-lg-inline" style="line-height: 24px;"></i>
                            </div>
                        </div>
                    </div>

                    <div id="filters" class="row d-none justify-content-center" style="margin-top: 25px;">
                        <div class="col-11 col-lg-7">
                            <div class="row filters" style="margin-bottom: 20px;">

                                <div class="col-3" style="margin-top: 8px;">
                                    <h5 style="color: #888;">Date Added</h5>
                                    <div class="row" style="margin-left: 7px;">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="date-latest" name="d1">
                                                <label class="form-check-label" for="date-latest">Latest Products</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="date-oldest" name="d1">
                                                <label class="form-check-label" for="date-oldest">Oldest Products</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3" style="margin-top: 8px;">
                                    <h5 style="color: #888;">Quantity</h5>
                                    <div class="row" style="margin-left: 7px;">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="qty-high" name="q1">
                                                <label class="form-check-label" for="qty-high">Highest Quantities</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="qty-low" name="q1">
                                                <label class="form-check-label" for="qty-low">Lowest Quantities</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3" style="margin-top: 8px;">
                                    <h5 style="color: #888;">Condition</h5>
                                    <div class="row" style="margin-left: 7px;">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="condition-1" name="c1">
                                                <label class="form-check-label" for="condition-1">Brand New</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="condition-2" name="c1">
                                                <label class="form-check-label" for="condition-2">New Open Box</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="condition-3" name="c1">
                                                <label class="form-check-label" for="condition-3">Used</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="condition-4" name="c1">
                                                <label class="form-check-label" for="condition-4">Used-Poor Condition</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3" style="margin-top: 8px;">
                                    <h5 style="color: #888;">Status</h5>
                                    <div class="row" style="margin-left: 7px;">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="status-active" name="s1">
                                                <label class="form-check-label" for="status-active">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="status-deactive" name="s1">
                                                <label class="form-check-label" for="status-deactive">Deactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-11 col-lg-7 d-flex justify-content-evenly" style="margin-bottom: 30px;">
                            <button 
                                onclick="window.location.reload()"
                                class="btn btn-primary" type="button">Clear Search / Filters</button>
                            <button 
                                onclick="sortMyProducts()"
                                class="btn btn-primary" type="button">Search / Sort Items</button>
                            <button 
                                onclick="window.location = 'addProduct.php'"
                                class="btn btn-primary" type="button">Sell New Product</button>
                        </div>
                    </div>
                </div>

                <!-- Product Items Container -->
                <div class="container">
                    <div class="containerr" id="itemContainer">
                        <?php

                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $userEmail . "' ");
                        $product_num = $product_rs->num_rows;

                        if ($product_num == '0') {
                            ?>
                                <div class="d-flex flex-column align-items-center" style="padding: 21px 56px;background: #ffffff;">
                                    <h3 style="margin-top: 35px;">You have no Products yet.</h3>
                                    <a href="addProduct.php" style="margin-bottom: 35px;">Sell a New Product</a>
                                </div>
                            <?php
                        } else {

                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();
                                ?>

                                    <!-- Product Item -->
                                    <div class="card products__itemContainer" style="min-width: 300px;max-width: 300px;height: 470px;margin: 0px 20px;">
                                        <div class="statusSpan">
                                            <div class="form-check form-switch">
                                                <input 
                                                    <?php
                                                        if ($product_data['activity_status_id'] == '1') {
                                                            ?>checked<?php
                                                        }
                                                    ?>
                                                    onclick="changeStatus(<?php echo $product_data['id'] ?>)"
                                                    class="form-check-input" type="checkbox" id="formCheck-6">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </div>
                                        <div class="products__imgContainer" data-bs-target="#modal-1" data-bs-toggle="modal">
                                            <?php
                                            $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data['id'] . "' ");
                                            $productImg_data = $productImg_rs->fetch_assoc();
                                            ?>
                                            <img class="products__img" src="<?php echo $productImg_data['path'] ?>">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-start align-items-center products__cardBody" style="border-top-right-radius: 14px;border-top-left-radius: 14px;">
                                            <h4 class="text-center card-title w" 
                                                onclick="//single Product View"
                                                title="View More" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                                style="font-family: Poppins, sans-serif;margin: 10px 0px; height: 56px;">
                                                <?php echo $product_data['title'] ?>
                                            </h4>
                                            <h5 style="font-family: Poppins, sans-serif;margin-bottom: 15px;">
                                                $ <?php echo $product_data['price'] ?>
                                            </h5>
                                            <h6 style="font-family: Poppins, sans-serif;margin-bottom: 15px;color: #9997cd;">
                                                <?php 
                                                    if ($product_data['qty'] == '1') {
                                                        ?>1 Item Left<?php
                                                    } else {
                                                        echo $product_data['qty'] ?> Items Left<?php 
                                                    }
                                                ?>
                                            </h6>
                                            <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                                <button 
                                                    onclick="idToUpdate(<?php echo $product_data['id'] ?>)" 
                                                    class="product__addBt" type="button">Update Info</button>
                                                <div 
                                                    onclick="openDeleteModal('<?php echo $product_data['title']; ?>', <?php echo $product_data['id'] ?>)">
                                                    <i class="far fa-trash-alt deleteBt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }

                        }
                        ?>
                    </div>
                </div>
            </div>
     
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" role="dialog" tabindex="-1" id="deleteConfirm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Are You sure you want to remove<br>
                                '<span id="productName"></span>' ?<span id="productId" class="invisible"></spanid>&nbsp;
                            </h4>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Dismiss</button>
                            <button 
                                onclick="deleteProduct()"
                                class="btn btn-primary" type="button">Yes</button></div>
                    </div>
                </div>
            </div>

            <!-- Verification Modal -->
            <div class="toast fade hide" role="alert" id="statusChanged">
                <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
                <div class="toast-body" role="alert">
                    <p id="status_toast"></p>
                </div>
            </div>

        <?php
    }
    
    ?>

    <!-- Scroll Bt -->
    <button onclick="topFunction()" id="scrollToTop__btn" title="Go to top">
        <svg class="arrow up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="5 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" points="0.375, 35.375 28.375, 0.375 58.67, 35.375 " />
        </svg>
    </button>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>