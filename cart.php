<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Shopping Cart | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bakbak+One&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "auto"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="overflow-x: hidden;">

    

    <?php
    include "header.php";

    if (isset($_SESSION['user'])) {

        // Logged In user 
        $current_user = $_SESSION['user'];
        $current_userEmail = $current_user['email'];

        // Current User Cart Details
        $cart_rs = Database::search("SELECT * FROM cart WHERE `user_email`='". $current_userEmail ."' ");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == '1' AND isset($_GET['code'])) {
            ?>
                <script>
                    window.location = 'cart.php';
                </script> 
            <?php
        }

    } else {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <div id="loader" >
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <div class="container-lg" style="margin-bottom: 63px;">
        <div style="background: #ffffff;margin-top: 80px;">
            <div class="row">

                <!-- Shopping Items Display -->
                <div class="col-12 <?php if ($cart_num != '0') {echo 'col-xl-8';} ?>" style="padding: 50px;font-family: 'Bakbak One', serif;padding-top: 0px;">
                    <div class="heading" style="font-family: Poppins, sans-serif;font-weight: bold;">
                        <div>
                            <a href="home.php" style="font-family: Actor, sans-serif;font-size: 16px;">Home</a>
                        </div>
                        <div class="d-flex justify-content-between" style="font-family: ABeeZee, sans-serif;">
                            <h2 onclick="copyToClipboard(5307732125531191)"
                                class="d-inline-block" style="margin-right: auto;font-weight: bold;">Shopping Cart</h2>
                            <h2 class="d-inline-block" style="margin-left: auto;font-weight: bold;"><?php echo $cart_num; ?> items</h2>
                        </div>
                        <hr style="background: #dcdcdc;height: 3px;">
                    </div>

                    <!-- Table Headings -->
                    <div>
                        <div class="row d-none d-md-flex" style="margin-bottom: 19px;">
                            <div class="col-6">
                                <h6 style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">PRODUCT DETAILS</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">QUANTITY</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">PRICE</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">TOTAL</h6>
                            </div>
                        </div>


                        <!-- Items Container -->
                        <div class="items">

                            <?php 
                            if ($cart_num != '0') {
                                ?>
                                    <!-- Contains Items -->
                                    <div id="containItems">

                                        <?php

                                        $grand_total = 0;
                                        $grand_shipp_total = 0;
                                        $SERVICE_CHARGE = 5;
                                        $productsObj;

                                        for ($i=0; $i < $cart_num; $i++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            // Corresponding Product
                                            $product_rs = Database::search(
                                            "SELECT *, product.id AS product_id, color.name AS color_name, condition.status AS condition_status 
                                            FROM product 
                                            INNER JOIN `color` ON color.id=product.color_id
                                            INNER JOIN `condition` ON condition.id=product.condition_id
                                            WHERE product.id = '" . $cart_data['product_id'] . "' ");

                                            $product_data = $product_rs->fetch_assoc();

                                            $productImage_rs = Database::search("SELECT * FROM `product_image` 
                                            WHERE `product_id`='" . $cart_data['product_id'] . "' LIMIT 1");

                                            $productImage_data = $productImage_rs->fetch_assoc();


                                            // Corresponding Seller Details
                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data['user_email'] . "' ");
                                            $seller_data = $seller_rs->fetch_assoc();


                                            // Calculations
                                            $oneItem_total = $product_data['price'] * $cart_data['qty'];
                                            $oneItem_shipping = $product_data['cost'];

                                            $grand_total += $oneItem_total;
                                            $grand_shipp_total += $oneItem_shipping;

                                            $total_cost = $grand_total + $grand_shipp_total + $SERVICE_CHARGE;

                                            $before_total_cost = $total_cost;

                                            $productsObj[] = [
                                                'id' => $product_data['product_id'],
                                                'qty' => $cart_data['qty']
                                            ];
                                            $json_productsObj = json_encode($productsObj);

                                            ?>

                                            <!-- One Item -->
                                            <div class="row item" style="border-radius: 8px;">
                                                <div class="col-12 detailsColumn">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 d-flex flex-column flex-sm-row">
                                                            <div onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $product_data['product_id'] ?> "
                                                                class="cartImg mx-auto mx-sm-0 w" style="min-width: 130px;">
                                                                <img src="<?php echo $productImage_data['path'] ?>">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center align-items-center align-items-sm-start" style="padding: 14px;">
                                                                <h5 onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $product_data['product_id'] ?> " 
                                                                style="font-family: Poppins, sans-serif;font-weight: bold;" class="w">
                                                                    <?php echo $product_data['title']; ?>
                                                                </h5>
                                                                <span style="letter-spacing: 1px;" class="badge bg-primary"><?php echo $product_data['condition_status']; ?></span>
                                                                <div style="line-height: 1.6;">
                                                                    <p class="items text-center text-sm-start" style="font-family: Poppins, sans-serif;margin-top: 5px;margin-bottom: 2px;">
                                                                        &nbsp;<?php echo $product_data['color_name']; ?>
                                                                    </p>
                                                                    <p class="items noOverflow" style="font-family: Poppins, sans-serif;"><?php echo $product_data['small_desc']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-2 d-flex align-items-start">
                                                            <div onmouseleave="cartQty_set(<?php echo $product_data['product_id'] ?>)"
                                                                class="input-group input-group-sm mx-auto" style="width: 95px;margin-top: 10px;">
                                                                <button 
                                                                    onclick="cartQty_adj('-', <?php echo $product_data['product_id'] ?>, null)" 
                                                                    class="btn" type="button">-</button>
                                                                
                                                                <input id='qty_elem_<?php echo $product_data['product_id'] ?>'
                                                                       value="<?php echo $cart_data['qty']; ?>" 
                                                                       max="<?php echo $product_data['qty'] ?>"
                                                                       class="form-control text-center" type="text" 
                                                                       style="pointer-events: none;">
                                                                
                                                                <button 
                                                                    onclick="cartQty_adj('+', <?php echo $product_data['product_id'] ?>, <?php echo $product_data['qty'] ?>)" 
                                                                    class="btn" type="button">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-2">
                                                            <h5 class="text-center" style="font-family: Poppins, sans-serif;margin-top: 10px;font-size: 17px;">$<?php echo $product_data['price'] ?></h5>
                                                        </div>
                                                        <div class="col-12 col-sm-2">
                                                            <h1 class="text-center d-block d-sm-none" style="font-size: 17px;font-family: Poppins, sans-serif;font-weight: bold;">&nbsp;-Total -</h1>
                                                            <h5 class="text-center" style="font-family: Poppins, sans-serif;font-size: 17px;margin-top: 10px;color: rgb(255,138,0);">$<?php echo $oneItem_total; ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 d-flex justify-content-center align-items-center justify-content-sm-start">
                                                            <h5 style="font-family: 'Advent Pro', sans-serif;margin-bottom: 0px;">Seller : <?php echo $seller_data['fname'] . ' ' . $seller_data['lname']; ?></h5>
                                                        </div>
                                                        <div class="col-sm-3 d-flex justify-content-center" style="padding: 2px ;">
                                                            <button onclick="payNow_singleItem(<?php echo $product_data['product_id']; ?>)"
                                                                class="btn btn-success d-grid" type="button">Buy Now</button>
                                                        </div>
                                                        <div class="col-sm-3 d-flex justify-content-center" style="padding: 2px;">
                                                            <button onclick="remove_cartItem(<?php echo $product_data['product_id'] ?>)" 
                                                                class="btn btn-danger d-grid" type="button">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                <?php
                            } else {
                                ?>
                                    <!-- No Items Contained -->
                                    <div id="noItems" style="height: 500px;">
                                        <div class="row" style="height: 100%;">
                                            <div class="col d-flex flex-column justify-content-center align-items-center"><i class="fa fa-shopping-bag" style="font-size: 56px;"></i>
                                                <h1>No items</h1>
                                                <p style="font-family: Abel, sans-serif;">You have no items in your shopping cart</p>
                                                <a href="allProducts.php">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div>
                        <div onclick="window.location = 'allProducts.php'" 
                            class="col-12" style="color: #5d50dd;margin-top: 35px;font-weight: bold;">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-left">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                                </svg>
                            </span>
                            <p class="d-inline pa" style="font-family: Poppins, sans-serif;">&nbsp; Continue shopping</p>
                        </div>
                    </div>
                </div>
                
                <?php 
                if ($cart_num != '0') {
                    ?>
                        <!-- Order Summary -->
                        <div class="col-12 col-xl-4" id="order_summary" style="background: #efefef;padding: 50px;border-bottom-color: rgb(239,239,239);">
                            <div>
                                <h1 style="font-family: ABeeZee, sans-serif;font-size: 32px;margin-bottom: 25px;font-weight: bold;">Order Summary</h1>
                                <hr style="background: #dcdcdc;height: 3px;">
                            </div>
                            <div>
                                <div class="row" style="margin-bottom: 19px;">
                                    <div class="col-12 d-flex justify-content-between">
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">ITEMS <?php echo $cart_num; ?></h6>
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">$<?php echo $grand_total; ?></h6>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between" style="margin-top: 30px;">
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">SHIPPING</h6>
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">$<?php echo $grand_shipp_total; ?></h6>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between" style="margin-top: 30px;">
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;font-size: 10px;">ADDITIONAL</h6>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">Service Charge</h6>
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;"><?php echo '$' . $SERVICE_CHARGE; ?></h6>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 36px;margin-top: 30PX;">
                                    <div class="col-12 d-flex justify-content-between" style="margin-bottom: 12px;">
                                        <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">PROMO CODE</h6>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 14px;">
                                        <?php $promo_CODE; ?>
                                        <input <?php if ($cart_num == '1') {echo 'disabled';} ?> 
                                            id="user_promoCode" type="text" class="border-0" style="width: 100%;padding: 10px 15px;" 
                                            placeholder="<?php
                                            if (isset($_GET['code'])) {
                                                $promo_CODE = (string)$_GET['code'];
                                                echo $_GET['code']; 
                                            } else {
                                                $promo_CODE = 'null';
                                                echo "Enter your code";
                                            }
                                            ?>">
                                    </div>
                                    <div class="col">
                                        <button <?php if ($cart_num == '1') {echo 'disabled';} ?> onclick="applyPromo()"  
                                            class="btn btn-primary border-0" type="button" style="background: #fa7474;padding: 9px 15px;font-size: 16px;">Apply</button>
                                        <?php
                                        if (isset($_GET['promo_code'])) {
                                            ?>
                                            <a style='margin-left:5px;font-size: 14px;' href="#" onclick="window.location = 'cart.php'">Clear</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr style="background: #dcdcdc;height: 3px;">
                            </div>
                            <?php 
                            if (isset($_GET['promo_code'])) {
                                $promo_percent = $_GET['promo_code'];

                                $discount = round(($total_cost * $promo_percent) / 100);

                                $total_cost -= $discount;
                                
                                ?>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">COST</h6>
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">
                                                <?php echo '$'.$before_total_cost; ?>
                                            </h6>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">PROMO</h6>
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">
                                                <?php echo $promo_percent.'%'; ?>
                                            </h6>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">DISCOUNT</h6>
                                            <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">
                                                <?php echo '-'.$discount.'$'; ?>
                                            </h6>
                                        </div>
                                    </div>
                                <?php
                            }
                            ?>
                            <div class="row" style="margin-top: 24px;">
                                <div class="col-12 d-flex justify-content-between" style="margin-bottom: 8px;">
                                    <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">TOTAL COST</h6>
                                    <h6 class="d-inline-block" style="color: #949494;font-weight: bold;font-family: 'Bakbak One', serif;">$<?php echo $total_cost; ?></h6>
                                </div>
                                <script>
                                    var urlParams = new URLSearchParams(window.location.search);
                                    const discount = urlParams.has('promo_code') ? Number(urlParams.get('promo_code')) : null;
                                </script>
                                <div class="col">
                                    <button 
                                        onclick='checkOut_multipleItems(<?php echo $json_productsObj ?>, discount, "<?php echo $promo_CODE ?>")'
                                        class="btn btn-primary" type="button" style="width: 100%;background: rgb(93,80,221);">CHECHOUT</button>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div id="no_code_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            The Code you entered is not valid
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


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>