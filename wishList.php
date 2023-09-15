<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Your Wishlist | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/wishList.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="overflow-x: hidden;">

    <?php
    include "header.php";

    if (isset($_SESSION['user'])) {

        $wishList_rs = Database::search("SELECT * FROM `wishList` WHERE `user_email`='" . $_SESSION['user']['email'] . "' ");

    } else {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    }

    ?>

    <div class="container" style="margin-bottom: 60px;">
        
        <ol class="breadcrumb" style="padding: 10px 15px;background-color: #f7f7f7;border-radius: 10px;margin-top: 20px;">
            <li class="breadcrumb-item"><a href="home.php"><span>Home</span></a></li>
            <li class="breadcrumb-item active"><span>Watchlist</span></li>
        </ol>

        <div style="background: #ffffff;padding: 50px;">
            <div class="row">
                <div class="col">

                    <div class="heading" style="font-family: ABeeZee, sans-serif;font-weight: bold;margin-bottom: 20px;">
                        <div class="d-flex justify-content-between" style="font-family: ABeeZee, sans-serif;">
                            <h2 class="d-inline-block" style="margin-right: auto;font-weight: bold;">Wish List</h2>
                            <?php
                            $wishList_num = $wishList_rs->num_rows;
                            ?>
                            <h2 class="d-inline-block" style="margin-left: auto;font-weight: bold;"><?php echo $wishList_num ?> items</h2>
                        </div>
                        <hr style="background: #dcdcdc;height: 3px;">
                    </div>

                    <?php 
                    if ($wishList_num != '0') {
                        ?>
                        <!-- Contain Items Div -->
                        <div class="row d-flex flex-column" id="ContainItems">

                            <div class="col d-flex justify-content-end">
                                <p onclick="removeALL_wishList()"
                                    class="d-inline w" style="color: var(--bs-blue);text-decoration:  underline;">Remove All</p>
                            </div>

                            <div class="col">
                                <div class="shadowo" style="background: #ffffff;padding: 30px;border-radius: 8px;margin-bottom: 20px;">

                                    <?php 
                                    for ($i=0; $i < $wishList_num; $i++) {
                                        $wishList_data = $wishList_rs->fetch_assoc();
                                        
                                        $product_rs = Database::search("SELECT *, condition.status AS condition_name FROM `product` 
                                        INNER JOIN `condition` ON condition.id=product.condition_id
                                        WHERE product.id='".$wishList_data['product_id']."' ");
                                        $product_data = $product_rs->fetch_assoc();

                                        ?>
                                        <!-- Wish List Item -->
                                        <div class="row" style="margin-bottom: 30px;">
                                            <div class="col-lg-2">
                                                <?php
                                                $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $wishList_data['product_id'] . "' LIMIT 1  ");
                                                $productImg_data = $productImg_rs->fetch_assoc();
                                                ?>
                                                <div class="imgBx mx-auto mx-lg-0">
                                                    <img src="<?php echo $productImg_data['path'] ?>" style="width: 100%;height: auto;">
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-xl-7">
                                                <div class="d-flex flex-column justify-content-center align-items-center align-items-lg-start" style="padding: 14px;">
                                                    <h5 style="font-family: Poppins, sans-serif;font-weight: bold;">
                                                        <?php echo $product_data['title'] ?>
                                                    </h5>
                                                    <span class="badge bg-primary">
                                                        <?php echo $product_data['condition_name'] ?>
                                                    </span>
                                                    <div style="line-height: 1.6;">
                                                        <p class="items" style="font-family: Poppins, sans-serif;margin-top: 5px;">
                                                            <?php echo $product_data['small_desc'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <button 
                                                        onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $wishList_data['product_id'] ?> "
                                                        class="btn btn-success" type="button" style="width: 100%;">View More</button>
                                                    <button class="btn btn-info" type="button" style="width: 100%;margin-top: 10px;">Add to Cart&nbsp;<i class="fas fa-shopping-cart"></i></button>
                                                    <button 
                                                        onclick="remove_wishList('<?php echo $wishList_data['product_id'] ?>')"
                                                        class="btn btn-danger" type="button" style="width: 100%;margin-top: 10px;">Remove&nbsp;<i class="fa fa-remove"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <?php

                    } else {
                        ?>
                        <!-- No items on wish list -->
                        <div id="ContainNoItems" style="padding: 35px;margin-top: 61px;">
                            <div class="row">
                                <div class="col d-flex flex-column justify-content-center align-items-center" style="padding: 20px;">
                                    <i class="far fa-heart" style="font-size: 86px;margin-bottom: 32px;"></i>
                                    <h2 class="text-center">You Have no items in your Wishlist</h2>
                                    <a href="allProducts.php">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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