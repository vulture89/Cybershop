<!DOCTYPE html>
<html lang="en">

<?php

    include "header.php";
    // Session included
    // Connection taken

    if (isset($_GET['product_id'])) {

        $product_id = $_GET['product_id'];

        $product_rs = Database::search("SELECT *, category.id AS category_id, product.id AS product_id, color.name AS color_name FROM `product`
        INNER JOIN `model` ON model.id=product.model_id
        INNER JOIN `brand` ON brand.id=model.brand_id
        INNER JOIN `category` ON category.id=brand.category_id
        INNER JOIN `color` ON color.id=product.color_id
        INNER JOIN `condition` ON condition.id=product.condition_id
        WHERE product.id='".$product_id."'");

        $product_data = $product_rs->fetch_assoc();

    } else {
        ?>
            <script>
                history.back();
            </script>
        <?php
    }

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $product_data['title'] ?> | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/singleProductView.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="overflow-x: hidden;">
    <div style="width: 100%;padding: 20px;margin-top: 20px;">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-6"></div>
                <div class="col-12 col-lg-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><span>Home</span></a></li>
                        <li class="breadcrumb-item"><a href="home.php#productsDIv"><span>Products</span></a></li>
                        <li class="breadcrumb-item active"
                            onclick="copyToClipboard(5307732125531191)"><span><?php echo htmlspecialchars($product_data['title']) ?></span></li>
                    </ol>
                </div>
            </div>


            <!-- Product Display -->
            <div class="row" style="margin: 20px 0px;">

                <!-- Product Images -->
                <div class="col-12 col-lg-6" style="margin-bottom: 10px;">
                    <?php  
                    $productImage_rs = Database::search("SELECT * FROM product_image WHERE `product_id`='".$product_data['product_id']."'");
                    $productImage_num = $productImage_rs->num_rows;

                    $product_paths = array();
                    $product_paths[0] = '';
                    $product_paths[1] = ''; 
                    $product_paths[2] = '';

                    for ($i=0; $i < $productImage_num; $i++) { 
                        $productImg_data = $productImage_rs->fetch_assoc();

                        $product_paths[$i] = $productImg_data['path'];
                    }
                    
                    ?>                    
                    <div class="row">

                        <!-- Main Img -->
                        <div class="col-12">
                            <div class="imgBx mainImg">
                                <img id="main_img" src="<?php echo $product_paths[0] ?>">
                            </div>
                        </div>

                        <!-- Sub Images -->
                        <div class="col" style="margin-top: 7px;">
                            <div class="row">
                                <div class="col-4">
                                    <div 
                                        onclick="setThisImage('<?php echo $product_paths[0] ?>')"
                                        class="imgBx subImg">
                                        <img src="<?php echo $product_paths[0] ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <?php 
                                        if ($product_paths[1] == '') {
                                            ?>
                                                <div id="noImg" class="imgBx subImg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                                    </svg>
                                                </div>
                                            <?php
                                        } else {
                                            ?>
                                                <div 
                                                    onclick="setThisImage('<?php echo $product_paths[1] ?>')"
                                                    id="containImg" class="imgBx subImg">
                                                    <img src="<?php echo $product_paths[1] ?>">
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-4">
                                    <?php 
                                        if ($product_paths[2] == '') {
                                            ?>
                                                <div id="noImg" class="imgBx subImg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                                    </svg>
                                                </div>
                                            <?php
                                        } else {
                                            ?>
                                                <div 
                                                    onclick="setThisImage('<?php echo $product_paths[2] ?>')"
                                                    id="containImg" class="imgBx subImg">
                                                    <img src="<?php echo $product_paths[2] ?>">
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <!-- Product Details -->
                <div class="col-12 col-lg-6" style="margin-bottom: 10px;">
                    <div>
                        <div class="d-flex justify-content-start align-items-center">
                            <h1 class="d-inline-block">
                                <?php echo $product_data['title'] ?>
                            </h1>
                            <span class="badge bg-primary" style="font-size: 16px;box-shadow: 0px 0px 5px rgb(13,110,253);margin-left: 20px;background: rgb(13, 110, 253);">
                                <?php echo $product_data['status'] ?>
                            </span>
                        </div>

                        <?php
                        $price = $product_data["price"];
                        $adding_price = ($price / 100) * 5;
                        $new_price = $price + $adding_price;
                        $difference = $new_price - $price;
                        $percentage = ($difference / $price) * 100;
                        ?>

                        <h3 style="display:inline;color: rgb(255,138,0);">$<?php echo $price; ?></h3>
                        <h3 style="display:inline;color: #dbdbdb;padding-left: 10px;">
                            <span style="text-decoration: line-through;">
                                <?php echo $new_price; ?>
                            </span> Save $ <?php echo $difference; ?> .00 (<?php echo $percentage; ?>%)
                        </h3>
                        <br><br>
                        <h3 style="display:inline;color: #005c79;"><?php echo $product_data['color_name'] ?></h3>
                        
                        <div class="row" style="font-size: 14px;">
                            <div class="col-12 my-2">
                                <span class="text-primary" style="font-size: 14px;"><b>Warrenty : </b>6 Months Warrenty</span><br>
                                <span class="text-primary" style="font-size: 14px;"><b>Return Policy : </b>1 Month Return Policy</span><br>
                                <span class="<?php if ($product_data['qty'] != '0') {echo 'text-primary';} else {echo 'text-danger';}?>" style="font-size: 14px;">
                                    <b>In Stock : </b><?php echo $product_data['qty']; ?> Items Available
                                </span><br>
                                <span class="text-primary" style="font-size: 14px;"><b>Delivery Cost : </b>$<?php echo $product_data['cost']; ?></span><br>
                            </div>
                        </div>

                        <p style="height: 143px; overflow: hidden;"><br><?php echo $product_data['small_desc'] ?></p>

                        <div id="options" >

                            <div class="col d-flex" style="margin-top: 10px;">
                                <div class="input-group" style="width: 125px;">
                                    <button <?php if ($product_data['qty'] == '0') {echo 'disabled';}?>
                                            onclick="changeQty('-', null)" 
                                            class="btn btn-dark" type="button">-</button>

                                    <input <?php if ($product_data['qty'] == '0') {echo 'disabled';}?> 
                                        id="qty" class="form-control text-center" type="text" style="pointer-events: none;"
                                        value="<?php if ($product_data['qty'] == '0') {echo '0';} else {echo '1';}?>">

                                    <button <?php if ($product_data['qty'] == '0') {echo 'disabled';}?>
                                            onclick="changeQty('+', <?php echo $product_data['qty']; ?>)" 
                                            class="btn btn-dark" type="button">+</button>
                                </div>
                                
                                <!-- Watchlist Icon -->
                                <span <?php if ($product_data['qty'] == '0') {echo "style='pointer-events:none;'";}?> class='singleProductView_fav_icon'>
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        $wishList_rs = Database::search("SELECT * FROM `wishList` 
                                            WHERE `product_id`='" . $product_data['product_id'] . "'
                                            AND `user_email`='" . $_SESSION['user']['email'] . "' ");
                                        $wishList_num = $wishList_rs->num_rows;
    
                                        if ($wishList_num == '0') {
                                            // A Favourite
                                            ?>
                                                <i onclick="add_wishList('<?php echo $product_data['product_id'] ?>')"
                                                    class="fa-regular fa-heart" style="font-size: 23px;"></i>
                                            <?php
                                        } else {
                                            // Not Favourite
                                            ?>
                                                <i onclick="remove_wishList('<?php echo $product_data['product_id'] ?>')"
                                                    class="fa-solid fa-heart" style="color: #ff6e67;font-size: 23px;"></i>
                                            <?php
                                        }
                                    } else {
                                        // No User
                                        ?>
                                        <i onclick="window.location = 'login.php'"
                                            class="fa-regular fa-heart" style="font-size: 23px;"></i>
                                        <?php
                                    }
                                    ?>
                                </span>
                            </div>
    
                            <div class="col-12 d-flex justify-content-around align-items-center" style="margin-top: 13px;">
                                <button 
                                    <?php 
                                        if ($product_data['qty'] == '0') {echo 'disabled';}
                                        
                                        if (isset($_SESSION['user'])) {
                                            ?> onclick="payNow_singleItem(<?php echo $product_data['product_id']; ?>)" <?php
                                        } else {
                                            ?> onclick="window.location = 'login.php'" <?php
                                        }
                                    ?>
                                    class="btn btn-dark" type="button" style="font-size: 18px;width: 75%;">Buy Now&nbsp;&nbsp;<i class="fa fa-diamond"></i></button>
                                
                                <button     
                                    <?php 
                                        if ($product_data['qty'] == '0') {echo 'disabled';}
                                        
                                        if (isset($_SESSION['user'])) {
                                            ?> onclick="add_cartItem(<?php echo $product_data['product_id']; ?>, 1)" <?php
                                        } else {
                                            ?> onclick="window.location = 'login.php'" <?php
                                        }
                                    ?>
                                    class="btn btn-dark" type="button" style="font-size: 18px;width: 75%;margin-left: 4px;">Add to cart&nbsp;<i class="fa fa-cart-plus"></i></button>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12">
                    
                    <p class="text-center" style="overflow-x:hidden;margin-top: 40px;"><?php echo nl2br($product_data['desc']) ?></p>

                    <div class="row" style="padding: 20px;">
                        <div class="col-12 col-lg-6" style="margin-top: 5px;">
                            <h1 style="text-decoration: underline;margin-bottom: 26px;">About Seller</h1>
                            <div style="padding: 15px;background: #f1f1f1;border-radius: 7px;">
                                <?php
                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data['user_email'] . "'");
                                $sellerImg_rs = Database::search("SELECT * FROM `profileimage` WHERE `user_email`='" . $product_data['user_email'] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                $sellerImg_data = $sellerImg_rs->fetch_assoc();
                                ?>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="imgBx sellerImg"><img src="<?php echo $sellerImg_data['path'] ?>"></div>
                                    </div>
                                    <div class="col-8" style="padding-top: 10px;">
                                        <div style="width: 100%;">
                                            <h3><?php echo $seller_data['fname'] . ' ' . $seller_data['lname'] ?></h3>
                                            <h6>+94 <?php echo $seller_data['mobile1'] ?></h6>
                                            <h6><?php echo $seller_data['email'] ?></h6>
                                        </div>
                                        <?php
                                        $date = $seller_data['joined_date'];
                                        $year = date('Y', strtotime($date));
                                        $day = date('d', strtotime($date));
                                        $month = date('F', strtotime($date));
                                        ?>
                                        <p style="margin: 0;">Since <?php echo $day; ?>, <?php echo $month; ?> <?php echo $year; ?></p>
                                        <p style="margin: 5px 0px;color:blue;cursor:pointer;" 
                                            onclick="copyTagCode('<?php echo $seller_data['tagCode'] ?>')">
                                            <span style="color: black;">Chat with seller </span> <?php echo $seller_data['tagCode'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="col-12 col-lg-6" style="margin-top: 5px;">
                            <h1 style="text-decoration: underline;margin-bottom: 26px;">Reviews</h1>
                            <?php 
                            $feedBack_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='".$product_data['product_id']."'");
                            $feedBack_num = $feedBack_rs->num_rows;

                            if ($feedBack_num == 0) {
                                ?>
                                    <div>
                                        <p>No Reviews yet.</p>
                                    </div>
                                <?php
                            } else {

                                for ($k=0; $k < $feedBack_num; $k++) { 
                                    $feedBack_data = $feedBack_rs->fetch_assoc();
    
                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$feedBack_data['user_email']."' ");
                                    $user_data = $user_rs->fetch_assoc();
    
                                    $full_name = $user_data['fname'] . ' ' . $user_data['lname'];
    
                                    if (isset($_SESSION['user'])) {
                                        if ($feedBack_data['user_email'] == $_SESSION['user']['email']) {
                                            $full_name = 'You';
                                        }
                                    }
    
                                    $date = $feedBack_data['date'];
                                    $year = date('Y', strtotime($date));
                                    $day = date('d', strtotime($date));
                                    $month = date('m', strtotime($date));
    
                                    ?>
                                        <div>
                                            <div class="row" style="height: 281px; overflow-x: hidden; overflow-y: scroll;">
                                                <div class="col-12" style="padding: 12px;background: #f7f7f7;border-left: 4.8px solid rgb(37,120,204);margin-bottom: 7px;height: 99px;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="d-inline" style="margin: 0px;font-size: 15px;font-weight: bold;"><?php echo $full_name; ?></p>
                                                        <p class="d-inline" style="margin: 0px;font-size: 11px;">
                                                            <?php echo "$year.$month.$day" ?>
                                                        </p>
                                                    </div>
                                                    <p style="margin-top: 16px;margin-bottom: 0px;"><?php echo $feedBack_data['review'] ?>&nbsp;</p>
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
            </div>
            <div class="row row-cols-5" style="margin-top: 49px;">
                <div class="col-12" style="margin-bottom: 20px;">
                    <h1>Related Products</h1>
                </div>
                <div class="col-12">
                    <div class="d-flex scrollDiv" style="height: 580px;">

                    <?php

                    $Related_product_rs = Database::search("SELECT *, product.id AS product_id FROM `product`
                    INNER JOIN `model` ON model.id=product.model_id
                    INNER JOIN `brand` ON brand.id=model.brand_id
                    INNER JOIN `category` ON category.id=brand.category_id
                    WHERE category.id='".$product_data['category_id']."' AND NOT product.id='".$product_data['product_id']."'  ORDER BY RAND() ");

                    $Related_product_num = $Related_product_rs->num_rows;

                    // <!-- One Items Design -->
                    for ($j = 0; $j < $Related_product_num; $j++) {

                        $Related_product_data = $Related_product_rs->fetch_assoc();

                        ?>
                            <div class="card products__itemContainer" style="min-width: 300px;margin: 0px 20px;max-width: 300px;height: 570px;border-radius: 10px;">
                                
                                 <!-- Watchlist Icon -->
                                 <span class="fav_icon">
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        $wishList_rs = Database::search("SELECT * FROM `wishList` 
                                            WHERE `product_id`='" . $Related_product_data['product_id'] . "'
                                            AND `user_email`='" . $_SESSION['user']['email'] . "' ");
                                        $wishList_num = $wishList_rs->num_rows;

                                        if ($wishList_num == '0') {
                                            // A Favourite
                                            ?>
                                                <i onclick="add_wishList('<?php echo $Related_product_data['product_id'] ?>')"
                                                    class="fa-regular fa-heart" style="font-size: 23px;"></i>
                                            <?php
                                        } else {
                                            // Not Favourite
                                            ?>
                                                <i onclick="remove_wishList('<?php echo $Related_product_data['product_id'] ?>')"
                                                    class="fa-solid fa-heart" style="color: #ff6e67;font-size: 23px;"></i>
                                            <?php
                                        }
                                    } else {
                                        // No User
                                        ?>
                                        <i onclick="window.location = 'login.php'"
                                            class="fa-regular fa-heart" style="font-size: 23px;"></i>
                                        <?php
                                    }
                                    ?>
                                </span>

                                <!-- Product Image -->
                                <div class="products__imgContainer">
                                    <?php
                                    $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $Related_product_data['product_id'] . "' LIMIT 1 ");
                                    $productImg_data = $productImg_rs->fetch_assoc();
                                    ?>
                                    <img class="products__img" src="<?php echo $productImg_data['path'] ?>">
                                </div>

                                <!-- Product Details -->
                                <div class="card-body d-flex flex-column justify-content-start align-items-center products__cardBody" style="border-top-right-radius: 14px;border-top-left-radius: 14px;">
                                    <h4 class="text-center card-title w" 
                                        data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" title="View More"
                                        style="font-family: Poppins, sans-serif;margin: 10px 0px; height: 56px; overflow:hidden;">
                                        <?php echo $Related_product_data['title']; ?>
                                    </h4>

                                    <h5 style="font-family: Poppins, sans-serif;margin-bottom: 15px;">$ <?php echo $Related_product_data['price']; ?></h5>

                                    <p class="text-center" style="height: 68px;  overflow:hidden;"><?php echo $Related_product_data['small_desc']; ?></p>

                                    <!-- Product Option Buttons -->
                                    <button 
                                        onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $Related_product_data['product_id'] ?> "
                                        class="product__addBt" type="button" style="background: var(--bs-primary);color: rgb(255,255,255);border-style: solid;border-color: rgb(255,255,255);">DETAILS</button>
                                    <button
                                        <?php 
                                            if ($Related_product_data['qty'] == '0') {echo 'disabled';}
                                            
                                            if (isset($_SESSION['user'])) {
                                                ?> onclick="add_cartItem(<?php echo $Related_product_data['product_id']; ?>, 1)" <?php
                                            } else {
                                                ?> onclick="window.location = 'login.php'" <?php
                                            }
                                        ?>
                                        class="product__addBt" type="button">ADD TO CART</button>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Copied toast -->
    <div class="toast fade hide" role="alert" id="codeCopied">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            Code copied to Clipboard 📝
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
</body>

</html>