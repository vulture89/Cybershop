<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "auto"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="background: rgb(248,248,248);">

    <?php   
    include "header.php";

    if (isset($_SESSION['user'])) {
        $currentUser = $_SESSION['user'];
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $currentUser['email'] . "' ");
        $user_data = $user_rs->fetch_assoc();
    }
    ?>

    <!-- Search Section -->
    <div style="font-family: Poppins, sans-serif;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-1 d-none d-sm-none d-lg-block">
                    <picture>
                        <img class="logo" src="assets/img/logo.png" style="margin: 8px 0px;margin-top: 3px;">
                    </picture>
                </div>
                <div class="col-12 d-block d-sm-block d-lg-none">
                    <h1 style="font-family: Aldrich, sans-serif;font-size: 25px;font-weight: bold;text-align: center;color: rgb(2,123,253);opacity: 0.58;text-shadow: 0px 0px 4px;margin-top: 8px;">CYBERSHOP</h1>
                </div>
                <div class="col-md-9 d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center search" style="width: 100%;margin: auto;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fa fa-search search-icon" style="font-size: 23px;"></i></span>
                            <input id="homeSearch_input" class="form-control form-control-sm" type="text" style="border-radius: 0px;">
                        </div>
                        <select id='homeSearch_selector' style="padding-left: 5px;border-style: solid;border-color: rgb(206,212,218);border-top-right-radius: 5px;border-bottom-right-radius: 5px;color: rgb(114,119,123);">
                            <option value="0">Select</option>
                            <?php 
                            $category_rs = Database::search("SELECT * FROM `category` ");
                            $category_num = $category_rs->num_rows;

                            for ($k = 0; $k < $category_num; $k++) {
                                $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data['id'] ?>"><?php echo $category_data['type'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center" style="width: 100%;height: auto;margin-top: 16px;">
                        <button 
                            onclick="homeSearch()"
                            class="btn btn-primary btn-sm" type="button" style="width: 90%;">Search</button>
                    </div>
                    <p onclick="window.location = 'allProducts.php'"
                        class="text-center w" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" style="font-size: 14px;text-decoration:  underline;" title="Show Advanced Search">Advanced</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Clear for Search -->
    <div id="clearForSearch">

    <!--  -->

        <!-- Welcome Section -->
        <?php
        
        if (((isset($_SESSION['user'])) AND (int)($user_data['accessed']) <= 1) OR !isset($_SESSION['user']))  {
            ?>
                <div class="container " style="margin-top: 80px;margin-bottom: 80px;">
                    <div class="p-5 mb-4 round-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius: 14px;background: #dee3f7;">
                        <div class="container-fluid py-5">
                            <div class="row g-5">
                                <div class="col-12 col-lg-6">
                                    <p style="font-size: 18px;font-family: Poppins, sans-serif;">Hi, <?php if (isset($_SESSION['user'])) {echo $currentUser['fname']; } else {echo 'User';} ?>  🖐</p>
                                    <h1 class="display-5 fw-bold" style="font-family: Aldrich, sans-serif;">Welcome to&nbsp;<br><span class="titleCyberShop" style="color: rgb(2,123,253);">CYBER SHOP</span><br></h1>
                                    <p class="col-md-8 fs-5">Cyber Shop is a Sri Lankan <br>E-Commerce Technology Company selling multiple quality technological products from all over the world.&nbsp;</p><a href="#productsDIv" class="btn btn-primary" role="button">Start Shopping</a>
                                </div>
                                <div class="col-12 col-lg-6 d-flex align-items-center">
                                    <div class="jumbo_side_img" style="width: 100%;height: 300px;transform: scale(1.20);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
        ?>

        <!-- Carousel -->
        <div class="carousel slide carousel-dark carousel-fade" data-bs-ride="true" data-bs-pause="false" id="carousel-1" style="height: 700px;margin-bottom: 40px;margin-top: 22px;">
            <div class="carousel-inner">
                <div class="carousel-item active ad1"><span class="fs-3 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;">LAPTOPS</span></div>
                <div class="carousel-item ad2"><span class="fs-2 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;"><strong>MOBILE PHONES</strong></span></div>
                <div class="carousel-item ad3"><span class="fs-2 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;"><strong>COMPUTERS</strong></span></div>
                <div class="carousel-item ad4"><span class="fs-2 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;"><strong>HEADPHONES</strong></span></div>
                <div class="carousel-item ad5"><span class="fs-2 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;"><strong>PRINTERS</strong></span></div>
                <div class="carousel-item ad6"><span class="fs-2 centerSpan" style="letter-spacing: 10px;font-weight: bold;color: var(--bs-gray-dark);padding: 20px;background: #ffffff;border-radius: 67px;"><strong>MONITORS</strong></span></div>
            </div>
            <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
            <ol class="carousel-indicators">
                <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="5"></li>
            </ol>
        </div>


        <div id="productsDIv" style="width: 100%;margin-top: 50px;background: #f7f7f7;">
            <div class="row">
                <div class="col-12" style="padding: 20px;">
                    <h1 class="text-center">Products</h1>
                </div>
            </div>

            <!-- Product Items Container -->
            <div class="container">
                <?php
                $category_rs = Database::search("SELECT * FROM `category` ");
                $category_num = $category_rs->num_rows;
                
                for ($x = 0; $x < $category_num; $x++) {
                    $category_data = $category_rs->fetch_assoc();
                    ?>
                        <!-- ROW -->
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-12 d-flex flex-column w" onclick="hideItems('<?php echo $category_data['id'] ?>')">
                                <h1 class="cTitle"><?php echo $category_data['type']; ?></h1>
                                <hr>
                            </div>
                            <div id="itemsRow<?php echo $category_data['id'] ?>">
                                <div class="col itemx_Container">
                                    
                                    <div class="d-flex scrollDiv" style="height: 580px;">

                                        <?php

                                        $product_rs = Database::search("SELECT *, product.id AS product_id FROM `product`
                                        INNER JOIN `model` ON model.id=product.model_id
                                        INNER JOIN `brand` ON brand.id=model.brand_id
                                        INNER JOIN `category` ON category.id=brand.category_id
                                        WHERE category.id='".$category_data['id']."' AND `activity_status_id`='1' AND `qty`!='0' ORDER BY RAND()");

                                        $product_num = $product_rs->num_rows;
                                        
                                        // <!-- One Items Design -->
                                        for ($j = 0; $j < $product_num; $j++) {

                                            $product_data = $product_rs->fetch_assoc();

                                            ?>
                                                <div class="card products__itemContainer" style="min-width: 300px;margin: 0px 20px;max-width: 300px;height: 570px;border-radius: 10px;">
      
                                                    <!-- Watchlist Icon -->
                                                    <span class="fav_icon">
                                                        <?php
                                                        if (isset($_SESSION['user'])) {
                                                            $wishList_rs = Database::search("SELECT * FROM `wishList` 
                                                                WHERE `product_id`='" . $product_data['product_id'] . "'
                                                                AND `user_email`='" . $currentUser['email'] . "' ");
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

                                                    <!-- Product Image -->
                                                    <div class="products__imgContainer">
                                                        <?php
                                                        $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data['product_id'] . "' LIMIT 1 ");
                                                        $productImg_data = $productImg_rs->fetch_assoc();
                                                        ?>
                                                        <img class="products__img" src="<?php echo $productImg_data['path'] ?>">
                                                    </div>

                                                    <!-- Product Details -->
                                                    <div class="card-body d-flex flex-column justify-content-start align-items-center products__cardBody" style="border-top-right-radius: 14px;border-top-left-radius: 14px;">
                                                        <h4 class="text-center card-title w" 
                                                            data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" title="View More"
                                                            style="font-family: Poppins, sans-serif;margin: 10px 0px; height: 56px; overflow:hidden;">
                                                            <?php echo $product_data['title']; ?>
                                                        </h4>

                                                        <h5 style="font-family: Poppins, sans-serif;margin-bottom: 15px;">$ <?php echo $product_data['price']; ?></h5>

                                                        <p class="text-center" style="height: 68px;  overflow:hidden;"><?php echo $product_data['small_desc']; ?></p>

                                                        <!-- Product Option Buttons -->
                                                        <button 
                                                            onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $product_data['product_id'] ?> "
                                                            class="product__addBt" type="button" style="background: var(--bs-primary);color: rgb(255,255,255);border-style: solid;border-color: rgb(255,255,255);">DETAILS</button>
                                                        <button 
                                                            <?php 
                                                                if ($product_data['qty'] == '0') {echo 'disabled';}
                                                                
                                                                if (isset($_SESSION['user'])) {
                                                                    ?> onclick="add_cartItem(<?php echo $product_data['product_id']; ?>, 1)" <?php
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
                    <?php
                }
                
                ?>
            </div>
        </div>

        
    <!--  -->

    </div>
    
    <div class="container">
        <div class="row shopBT" style="margin-top: 35px;">
            <div class="col">
                <h2>New Deals&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                    </svg></h2>
                <p>Recommended for you&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-start overflow-hidden iphone14Hero" style="width: 100%;background: #000000;">
        <div class="row" style="width: 600px;background: transparent;padding-top: 67px;">
            <div class="col-12 z" style="background: transparent;color: rgb(255,255,255);">
                <h1 class="text-center" style="font-family: 'Noto Sans Tamil Supplement', sans-serif;font-weight: bold;font-size: 51px;">iPhone 14 Pro</h1>
            </div>
            <div class="col-12 z" style="background: transparent;color: rgb(255,255,255);">
                <h4 class="text-center" style="font-family: 'Noto Sans Tamil Supplement', sans-serif;">Pro Beyond.</h4>
            </div>
            <div class="col-12 z" style="background: transparent;color: rgb(255,255,255);margin-top: 10px;">
                <div class="row">
                    <div class="offset-2 col-6">
                        <h4 onclick="window.location = 'singleProductView.php?product_id=31'"
                            class="text-end w" style="font-family: 'Noto Sans Tamil Supplement', sans-serif;color: #06c;">Learn More &gt;&nbsp;</h4>
                    </div>
                </div>
            </div>
            <div class="col-12" style="background: transparent;color: rgb(255,255,255);"><img class="iphoneHero" src="assets/img/iphoen14_hero.jpg" style="margin-top: -3px;max-width: 600px;min-width: 400px;"></div>
        </div>
    </div>
    <div onclick="window.location = 'singleProductView.php?product_id=37'" class="lap" style="width: 100%;height: 600px;cursor: pointer;"></div>
    <div class="row g-2" style="padding: 0px 10px;">
        <div class="col-12 col-lg-6" style="background: #fbfbfd;">
            <div class="module" style="font-family: 'Noto Sans Tamil Supplement', sans-serif;">
                <div class="topText" style="margin-top: 73px;">
                    <h2 class="text-center" style="font-weight: bold;"><i class="fa fa-apple"></i>WATCH<span class="d-block watchSpan" style="font-size: 12.8px;color: rgb(254,111,28);">ULTRA</span></h2>
                    <h5 class="text-center">Adventure awaits.<br></h5>
                </div>
                <div class="d-flex justify-content-center cta_links"><a class="watchLinks" href="#" style="margin-left: auto;margin-right: 8px;">Learn More &gt;</a><a class="watchLinks" href="#" style="margin-right: auto;margin-left: 8px;">Buy &gt;</a></div>
            </div>
            <div class="imageWatch"><img src="assets/img/asPApllelarge.jpg"></div>
        </div>
        <div class="col-12 col-lg-6" style="background: #000000;">
            <div class="module" style="font-family: 'Noto Sans Tamil Supplement', sans-serif;">
                <div class="topText" style="margin-top: 73px;">
                    <h2 class="text-center" style="font-weight: bold;color: rgb(255,255,255);"><i class="fa fa-apple"></i>WATCH<span class="d-block watchSpan" style="font-size: 12.8px;color: rgb(254,28,28);">SERIES 8</span></h2>
                    <h5 class="text-center" style="color: rgb(255,255,255);">A healthy leap awaits.</h5>
                </div>
                <div class="d-flex justify-content-center cta_links"><a class="watchLinks" href="#" style="margin-left: auto;margin-right: 8px;">Learn More &gt;</a><a class="watchLinks" href="#" style="margin-right: auto;margin-left: 8px;">Buy &gt;</a></div>
            </div>
            <div class="imageWatch"><img src="assets/img/promo_apple_watch_series_8__ch7rexplmihe_large.jpg"></div>
        </div>
    </div>
    <div class="row" style="padding: 15px 20px;background: #f7f7f7;border-radius: 25px;margin: 15px 0px;">
        <div class="col-12 col-lg-7 d-flex justify-content-center"><img class="samsungTab" src="assets/img/02-Q4-burgundy-DT-720x540.jpg"></div>
        <div class="col-12 col-lg-5">
            <div style="font-family: 'Noto Sans Tamil Supplement', sans-serif;">
                <h1><br><strong>Galaxy Z Fold4</strong><br></h1>
                <h5 style="font-size: 19px;">Lighter. <br>More durable And now with the<br>most powerful processor.<br></h5>
                <h5 style="font-size: 19px;"><br>Save up to an extra&nbsp;<span class="d-inline-block" style="font-size: 30px;color: rgb(23,131,239);"><br>$86.00<br></span>&nbsp;with Our newest Offer Programs<br><br></h5>
                <div class="col"><button class="btn btn-primary" type="button" style="background: rgb(0,0,0);border-radius: 26px;padding: 8px 20px;font-size: 19px;">Buy</button></div>
                <div class="col">
                    <p style="font-size: 15px;"><br>Fingerprint (side-mounted), accelerometer, gyro, proximity, compass, barometer<strong>&nbsp;</strong>ANT+<br>Bixby natural language commands and dictation<br>Samsung DeX (desktop experience support)<br>Samsung Pay (Visa, MasterCard certified)<br><br></p>
                </div>
            </div>
        </div>
    </div>
    <div class="lap2" style="width: 100%;"></div>

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