<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Purchased History | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bakbak+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/purchasedHistory.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "auto"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body>

    <?php
    include "header.php";

    if (isset($_SESSION['user'])) {

        $userEmail = $_SESSION['user']['email'];

        // Transaction History is calculated through the invoice
        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $userEmail . "' ORDER BY `status` DESC");
        $invoice_num = $invoice_rs->num_rows;

    } else {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <div class="container" style="margin-bottom: 63px;">

        <div style="background: #ffffff;">
            <div class="row overflow-hidden">

                <div class="col-12" style="padding: 50px;">
                    <h1 class="text-center" style="font-family: ABeeZee, sans-serif;font-weight: bold;">Transaction History&nbsp;</h1>
                </div>

                <div class="col-12" style="padding: 50px;">
                    <?php 
                        if ($invoice_num != '0') {
                            
                            ?>
                            <!-- Table Headings -->
                            <div>
                                <div class="row d-none d-lg-flex" style="margin-bottom: 19px;">
                                    <div class="col-1 d-flex justify-content-center">
                                        <h6 style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">#&nbsp;</h6>
                                    </div>
                                    <div class="col-5">
                                        <h6 style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">PRODUCT DETAILS</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">QUANTITY</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">Total</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6 class="text-center" style="color: #b8b9b9;font-weight: bold;font-family: 'Bakbak One', serif;">PURCHASED DATE</h6>
                                    </div>
                                </div>
                            </div>
                            <?php

                            for ($i = 0; $i < $invoice_num; $i++) {
                                $num = str_pad($i+1, 4, "0", STR_PAD_LEFT);
                                $invoice_data = $invoice_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT *, 
                                condition.status AS condition_status, product.id AS product_id, color.name AS color_name 
                                FROM `product`
                                INNER JOIN `color` ON color.id=product.color_id
                                INNER JOIN `condition` ON condition.id=product.condition_id
                                WHERE product.id='".$invoice_data['product_id']."'");
                                $product_data = $product_rs->fetch_assoc();

                                $productImage_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $invoice_data['product_id'] . "' LIMIT 1 ");
                                $productImage_data = $productImage_rs->fetch_assoc();

                                ?>
                                    <!-- One Item -->
                                    <div class="box" style="font-family: ABeeZee, sans-serif;padding: 20px;border-radius: 8px;margin-bottom: 20px;">
                                        <div class="row">
                                            <div class="col-12 col-lg-1 d-flex justify-content-center align-items-center">
                                                <h6 style="font-weight: bold;">
                                                    <span class="d-inline d-lg-none" style="color: rgb(184,185,185);">#</span>
                                                    <?php echo $num; ?>
                                                </h6>
                                            </div>
                                            <div class="col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center flex-lg-row justify-content-lg-start align-items-lg-start">
                                                <div class="d-flex justify-content-center cartImg">
                                                    <img src="<?php echo $productImage_data['path']; ?>">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center align-items-center align-items-lg-start" style="padding: 14px;">
                                                    <h5 style="font-family: Poppins, sans-serif;font-weight: bold;">
                                                        <?php echo $product_data['title']; ?>
                                                    </h5>
                                                    <span class="badge bg-primary">
                                                        <?php echo $product_data['condition_status']; ?>
                                                    </span>
                                                    <div style="line-height: 1.6;">
                                                        <p class="items noOverflow" style="font-family: Poppins, sans-serif;"><?php echo $product_data['small_desc']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-lg-2 d-flex justify-content-center align-items-center">
                                                <h6 style="font-weight: bold;">
                                                    <?php echo $invoice_data['qty'] ?>
                                                    <span class="d-inline d-lg-none">&nbsp;Items</span>
                                                </h6>
                                            </div>
                                            <div class="col-4 col-lg-2 d-flex justify-content-center align-items-center">
                                                <h6 style="font-weight: bold;">
                                                    <span class="d-inline d-lg-none">Total Value :&nbsp;</span>
                                                    $<?php echo round($product_data['price'] * $invoice_data['qty']) ?>
                                                </h6>
                                            </div>
                                            <div class="col-4 col-lg-2 d-flex justify-content-center align-items-center">
                                                <h6 style="font-weight: bold;">
                                                    <span class="d-inline d-lg-none">Purchased&nbsp;</span>
                                                    <?php
                                                    $date = $invoice_data['date'];
                                                    $year = date('Y', strtotime($date));
                                                    $day = date('d', strtotime($date));
                                                    $month = date('F', strtotime($date));
                                                    echo "$day, $month $year"; 
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-end" style="margin-top: 10px;">
                                            <div class="col">

                                                <!-- FeedBack and status -->
                                                <div class="row d-flex flex-row justify-content-center align-items-center">
                                                    <?php 
                                                    if ($invoice_data['status'] == '3') {
                                                        ?>
                                                            <div class="col-12 col-lg-2 d-flex justify-content-center" style="margin-top: 3px;">
                                                                <button onclick="open_feedbackModal('<?php echo $invoice_data['product_id'] ?>')"
                                                                 class="btn btn-secondary historyBt" type="button">Add Feedback</button>
                                                            </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="col-12 col-lg-4 d-flex flex-row justify-content-center align-items-center">
                                                        <?php  
                                                        $selectedInvoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='".$invoice_data['id']."' ");
                                                        $selectedInvoice_data = $selectedInvoice_rs->fetch_assoc();
                            
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
                                                        <p class="text-center" 
                                                            style="font-weight: 700;letter-spacing: 1px;margin:0;
                                                                color:var(<?php echo $status_txt_color ?>)">
                                                            <?php echo $status_txt ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4 col-lg-2 d-flex justify-content-center" style="margin-top: 3px;">
                                                <button 
                                                    onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $product_data['product_id'] ?> "
                                                    class="btn btn-primary historyBt" type="button">View More&nbsp;<i class="fa fa-info-circle"></i></button>
                                            </div>
                                            <div class="col-4 col-lg-2 d-flex justify-content-center" style="margin-top: 3px;">
                                                <button 
                                                    onclick="remove_Invoice('<?php echo $userEmail ?>', '<?php echo $product_data['product_id'] ?>', '<?php echo $invoice_data['date'] ?>')"
                                                    class="btn btn-danger historyBt" type="button">Delete Record&nbsp;<i class="fas fa-undo"></i></button>
                                            </div>
                                            <div class="col-4 col-lg-2 d-flex justify-content-center" style="margin-top: 3px;">
                                                <button 
                                                    onclick="add_cartItem(<?php echo $product_data['product_id']; ?>, 1)"
                                                    class="btn btn-success historyBt" type="button">Add to cart&nbsp;<i class="fa fa-shopping-cart"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            
                            ?>
                                <!-- Clear All Bt -->
                                <div class="col d-flex justify-content-center justify-content-lg-end" style="padding: 0px 50px 50px 50px;">
                                    <button 
                                        onclick="remove_Invoice('<?php echo $userEmail ?>', 'all', null)"
                                        class="btn btn-danger historyBt" type="button">Clear All Records&nbsp;<i class="far fa-trash-alt"></i></button>
                                </div>
                            <?php

                        } else {
                            ?>
                                <!-- No Items -->
                                <div class="col-12 d-flex flex-column justify-content-center align-items-center" style="padding: 32px; margin-bottom: 70px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cart-x" style="font-size: 75px;margin-bottom: 22px;">
                                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"></path>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                    </svg>
                                    <h2 class="text-center">You have no Purchased Items</h2>
                                    <a href="allProducts.php">Shop Now</a>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add FeedBack Modal -->
    <div style="font-family: ABeeZee, sans-serif;" class="modal fade" role="dialog" tabindex="-1" id="feedBackModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 29px;">
                    <div>
                        <h4 style="font-weight: 600;">Provide your feedback</h4>
                    </div>
                    <hr>
                    <div style="padding: 15px 0px;">
                        <p style="font-size: 18px;">→ Write a review</p>
                        <p style="display: none;" id="feedBack_productId"></p>
                        <textarea idreview="" type="text" rows="4" style="width: 100%;padding: 10px 15px;" placeholder="Your feedback"></textarea>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button 
                            data-bs-dismiss="modal"
                            class="btn btn-light" type="button">Dismiss</button>
                        <button 
                            onclick="submitFeedback()"
                            class="btn btn-primary" type="button" style="margin-left: 11px;">
                            Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Bt -->
    <button onclick="topFunction()" id="scrollToTop__btn" title="Go to top">
        <svg class="arrow up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="5 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" points="0.375, 35.375 28.375, 0.375 58.67, 35.375 " />
        </svg>
    </button>
    
    <?php
    include "footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>