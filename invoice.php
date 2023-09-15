<!DOCTYPE html>
<html lang="en">

<?php 

session_start();

require "PHP/connection.php";

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Invoice | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/invoice.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
</head>

<body>

    <?php  
    // Orders
    $orders = array();  
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 8) == "orderID_") {  
            $orders[$key] = $value;  
        }
    }
    $numOrders = count($orders); 

    // Today Date
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    $year = date('Y', strtotime($date));
    $day = date('d', strtotime($date));
    $month = date('F', strtotime($date));

    // User Details
    $user = $_SESSION['user'];
    $userAddress_rs = Database::search("SELECT * FROM `useraddress` WHERE `user_email`='" . $user['email'] . "'");
    $userAddress_data = $userAddress_rs->fetch_assoc();

    ?>
    
    <div class="row options_row" style="background: #efefef;padding: 5px;">
        <div class="col-12 col-lg-4" style="margin-top: 3px;">
            <ol class="breadcrumb bd" style="margin: 0px;">
                <li class="breadcrumb-item"><a href="home.php"><span>Home</span></a></li>
                <li class="breadcrumb-item"><a href="cart.php"><span>Cart</span></a></li>
                <li class="breadcrumb-item active"><span>Invoice</span></li>
            </ol>
        </div>
        <div class="col-12 col-lg-4 d-flex justify-content-center" style="margin-bottom: 8px;margin-top: 4px;">
            <button class="btn btn-primary" type="button" style="margin-right: 8px;" onclick="printDiv('printableArea')">Print</button>
            <button class="btn btn-primary" type="button">Export As PDF</button>
        </div>
        <div class="col d-flex justify-content-end align-items-center w div_linto_history">
            <h5 onclick="window.location = 'purchasedHistory.php'"
                class="linkto_history" style="color: rgb(0,0,0);padding-right: 10px;font-size: 19px;margin-bottom: 0;font-family: Abel, sans-serif;padding-top: 5px;padding-bottom: 5px;">
                Go to Purchase History&nbsp;
                <i class="fa fa-chevron-right" style="font-size: 15px;"></i>
            </h5>
        </div>
    </div>

    <!-- To Be Printed -->
    <div class="container" id="printableArea" style="width: 100%;margin-top: 40px;">
        <div>
            <div style="margin-bottom: 20px;">
                <div class="row d-flex flex-row justify-content-between">
                    <div class="col-12 col-lg-4 d-flex align-items-center order-last order-lg-first" style="padding: 20px;background: #656565;color: rgb(255,255,255);">
                        <h1>INVOICE</h1>
                    </div>
                    <div class="col-12 col-lg-4 d-flex flex-column align-items-end order-first order-lg-last" style="padding: 20px;background: transparent;">
                        <h1 style="font-family: Aldrich, sans-serif;font-weight: bold;text-align: center;color: rgb(2,123,253);opacity: 0.58;text-shadow: 0px 0px 4px;">CYBERSHOP</h1>
                        <p style="font-size: 14px;">"Effortless shopping, anytime, anywhere with CyberShop"<br><br></p>
                    </div>
                </div>
            </div>
            <div style="margin-bottom: 15px;">
                <div class="row">

                    <div class="col-12 col-md-4" style="margin-top: 20px;">
                        <h4>Invoice Details</h4>
                        <hr style="width: 240px;">
                        <div>
                            <p class="d-inline-block" style="font-weight: bold;">Issued Date :</p>
                            <p class="d-inline-block" style="padding-left: 11px;"><?php echo $month . ', ' . $day . ' ' . $year; ?></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-4" style="margin-top: 20px;">
                        <h4>Invoice To</h4>
                        <hr style="width: 276px;">
                        <h6 style="font-weight: bold;color: var(--bs-blue);"><?php echo $user['fname'] . ' ' . $user['lname']; ?></h6>
                        <h6 style="color: var(--bs-dark);"><?php echo $userAddress_data['line 1'] . ', ' . $userAddress_data['line 2']; ?></h6>
                        <h6 style="color: var(--bs-dark);">Sri lanka</h6>
                        <h6 style="color: var(--bs-dark);">Phone : <?php echo $user['mobile1']; ?></h6>
                        <h6 style="color: var(--bs-dark);">M: <?php echo $user['email']; ?></h6>
                    </div>

                    <div class="col-12 col-md-4" style="margin-top: 20px;">
                        <h4 style="margin-bottom: 17px;">Maradana, Colombo 10<br>Sri Lanka</h4>
                        <div>
                            <h6><i class="fas fa-phone-alt" style="padding-bottom: -12px;color: var(--bs-blue);"></i>&nbsp;+81 xxx xxxx xxxx</h6>
                        </div>
                        <div>
                            <h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" style="padding-bottom: -12px;color: var(--bs-blue);">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" fill="currentColor"></path>
                                </svg>&nbsp; CyberShopOfficial23@gmail.com
                            </h6>
                        </div>
                        <div>
                            <h6><i class="fas fa-globe-americas" style="padding-bottom: -12px;color: var(--bs-blue);"></i>&nbsp;www.cybershop.lk</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <div class="row">
                    <div class="col-1">
                        <h4 style="font-weight: bold;font-size: 22px;">ID</h4>
                    </div>
                    <div class="col-3">
                        <h4 style="font-weight: bold;font-size: 22px;">Product&nbsp;</h4>
                    </div>
                    <div class="col-2">
                        <h4 class="text-center" style="font-weight: bold;font-size: 22px;">Price</h4>
                    </div>
                    <div class="col-2">
                        <h4 class="text-center" style="font-weight: bold;font-size: 22px;">Qty</h4>
                    </div>
                    <div class="col-2">
                        <h4 class="text-center" style="font-weight: bold;font-size: 22px;">Shipping</h4>
                    </div>
                    <div class="col-2">
                        <h4 class="text-center" style="font-weight: bold;font-size: 22px;">Total</h4>
                    </div>
                </div>
                <hr style="background: rgb(0,0,0);height: 2px;opacity: 1;margin-top: 0px;">
                <?php 
                $x = 1;
                $total_cost = 0;
                $sub_total = 0;

                foreach ($orders as $key => $value) {
                    $order_index = $key;
                    $order_id = $value;

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "'");
                    $invoice_data = $invoice_rs->fetch_assoc();

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data['product_id'] . "' ");
                    $product_data = $product_rs->fetch_assoc();
                    
                    $product_price = $product_data['price'];
                    $product_ship = $product_data['cost'];
                    $product_qty = $invoice_data['qty'];
                    $product_total = ($product_price * $product_qty) + $product_ship;
                    
                    $total_cost += $product_total;
                    $sub_total = $total_cost;

                    ?>
                        <div id="oneInvoice">
                            <div class="row" style="padding: 20px 0;">
                                <div class="col-1">
                                    <h4>0<?php echo $x; ?></h4>
                                </div>
                                <div class="col-3">
                                    <h4 style="margin-bottom: 0px;"><?php echo $product_data['title']; ?></h4>
                                    <p style="margin: 0px;font-size: 13px;"><?php echo $order_id; ?></p>
                                </div>
                                <div class="col-2">
                                    <h4 class="text-center">$<?php echo $product_price ?></h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="text-center"><?php echo $product_qty; ?>x</h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="text-center">+$<?php echo $product_ship ?></h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="text-center">$<?php echo $product_total; ?></h4>
                                </div>
                            </div>
                            <hr>
                        </div>
                    <?php

                    $x += 1;
                }
                $total_cost += 5;
                $sub_total = $total_cost;
                ?>
            </div>
            <div style="margin-top: 30px;">
                <div class="row d-flex flex-row justify-content-between">
                    <div class="col-4">
                        <h4 style="color: var(--bs-blue);font-weight: bold;">Payment Method</h4>
                        <hr style="width: 240px;">
                        <div>
                            <p class="d-inline-block" style="font-weight: bold;">Payment Method&nbsp;</p>
                            <p class="d-inline-block" style="padding-left: 11px;">Credit Card</p>
                        </div>
                        <div>
                            <p class="d-inline-block" style="font-weight: bold;">Order No&nbsp;</p>
                            <p class="d-inline-block" style="padding-left: 11px;">#CS_FDSH9sfdsk</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex flex-row justify-content-between">
                            <p class="d-inline-block" style="font-weight: bold;">Sub Total :&nbsp;</p>
                            <p class="d-inline-block">$<?php echo $sub_total; ?>&nbsp;</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between" style="opacity: 0.5;">
                            <p class="d-inline-block" style="font-weight: bold;">Service Charge :&nbsp;</p>
                            <p class="d-inline-block">$5&nbsp;</p>
                        </div>
                        <?php 
                        if (isset($_GET['discount'])) {
                            $promo_percent = $_GET['discount'];

                            $discount = round(($total_cost * $promo_percent) / 100);

                            $total_cost -= $discount;
                            ?>
                                <div class="d-flex flex-row justify-content-between">
                                    <p class="d-inline-block" style="font-weight: bold;">Discount Applied :&nbsp;</p>
                                    <p class="d-inline-block">-$<?php echo $discount; ?>&nbsp;</p>
                                </div>
                            <?php
                        }
                        ?>
                        <hr>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="d-inline-block" style="font-weight: bold;font-size: 23px;color: var(--bs-blue);">Total :&nbsp;</p>
                            <p class="d-inline-block" style="font-size: 23px;color: var(--bs-blue);">$<?php echo $total_cost; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 45px;margin-bottom: 50px;">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center" style="color: var(--bs-blue);">THANK YOU FOR YOUR BUSINESS!</h3>
                        <h6 class="text-center" style="color: var(--bs-gray-500);">TERMS AND CONDITIONS</h6>
                        <h1 class="text-center" style="font-size: 16px;color: var(--bs-gray-400);"><br>Acceptance of terms: By using the Cybershop application, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, do not use the Cybershop application. Modification of terms: We reserve the right to change these terms and conditions at any time. Any changes will be effective immediately upon posting on the Cybershop application. Your continued use of the Cybershop application after any changes have been made will constitute your acceptance of such changes. Privacy: Any information that you provide to us through the Cybershop application will be treated in accordance with our privacy policy. Intellectual property: All content on the Cybershop application, including text, graphics, logos, images, and software, is the property of CyberShop or its licensors and is protected by copyright and trademark laws. You may not use any content on the Cybershop application for any commercial purpose without the express written consent of CyberShop. Disclaimer of warranties: The Cybershop application is provided on an "as is" and "as available" basis. We make no warranties, express or implied, as to the operation of the Cybershop application or the information, content, materials, or products included on the Cybershop application. Limitation of liability: We will not be liable for any damages of any kind arising from the use of the Cybershop application, including but not limited to direct, indirect, incidental, punitive, and consequential damages. Indemnification: You agree to indemnify and hold CyberShop and its affiliates, officers, agents, and employees harmless from any claim or demand, including reasonable attorneys' fees, made by any third party due to or arising out of your use of the Cybershop application, your violation of these terms and conditions, or your violation of any rights of another. Governing law: These terms and conditions will be governed and construed in accordance with the laws of the Sri Lanka and any legal action arising out of or in connection with the Cybershop application will be brought exclusively in the courts of Sri Lanka. Severability: If any part of these terms and conditions is determined to be invalid or unenforceable, the invalid or unenforceable provision will be deemed replaced by a valid, enforceable provision that most closely matches the intent of the original provision, and the remaining terms and conditions will continue in effect. Entire agreement: These terms and conditions constitute the entire agreement between you and CyberShop and govern your use of the Cybershop application, superseding any prior agreements between you and CyberShop (including, but not limited to, any prior versions of the terms and conditions).<br><br></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->


    <!-- Scroll Bt -->
    <button onclick="topFunction()" id="scrollToTop__btn" title="Go to top">
        <svg class="arrow up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="5 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" points="0.375, 35.375 28.375, 0.375 58.67, 35.375 " />
        </svg>
    </button>

    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>