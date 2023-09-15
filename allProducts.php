<!DOCTYPE html>
<html lang="en">

<?php session_start() ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Search All Products | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/allProducts.css">
    <link rel="stylesheet" href="assets/css/scrollToTop__btn.css">
    <link rel="icon" href="assets/img/logo.png">
    <script>
        history.scrollRestoration = "auto"
    </script>
</head>

<body style="background: rgb(255,255,255);">

    <div style="margin: 0px;width: 100%; padding-left: calc(100vw - 100%);">

        <div class="row d-flex justify-content-center" style="width: 100%;">
            <div class="col-11 col-lg-7" style="padding-top: 20px;">
                <p 
                    onclick="window.location = 'home.php'"
                    class="backLink"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;<span>Home</span></p>
            </div>
        </div>

        <div style="background: #ffffff;padding: 10px;padding-bottom: 40px;">
            <div class="row">
                <div class="col" style="width: 100%;">
                    <h1 class="text-center" style="padding: 30px;">Search All Products</h1>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="row g-0 row-cols-1 d-flex justify-content-center g-0 g-lg-2" style="padding: 10px 15px;width: 100%;">
                <div class="col-11 col-lg-7">
                    <input id="search" type="search" class="search" style="width: 100%;padding: 10px 15px;" placeholder="Type Keyword to Search">
                </div>
                <div class="col-11 col-lg-7 d-flex justify-content-between align-items-center" style="margin-top: 15px;">
                    <button class="btn btn-primary" type="button" style="background: rgb(248,249,250);color: rgb(0,0,0);"
                            onclick="hideFilters()">
                        Filters&nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.70834 15.4397C5.92663 16.2928 7.3222 16.7038 8.70461 16.7063C9.17977 18.0045 10.0433 19.1753 11.2616 20.0284C14.4284 22.2458 18.7932 21.4762 21.0107 18.3093C23.2281 15.1425 22.4585 10.7777 19.2916 8.56024C18.0734 7.70719 16.6778 7.29621 15.2954 7.29371C14.8202 5.99552 13.9567 4.82467 12.7384 3.97161C9.57158 1.75417 5.20676 2.52381 2.98931 5.69064C0.771871 8.85748 1.54151 13.2223 4.70834 15.4397ZM5.8555 13.8014C6.6016 14.3239 7.44081 14.6142 8.28736 14.6875C8.20112 13.1725 8.60464 11.6187 9.54254 10.2793C10.4804 8.9398 11.8025 8.0292 13.2556 7.59209C12.8972 6.82166 12.3374 6.13235 11.5913 5.60992C9.32924 4.02603 6.21151 4.57577 4.62762 6.8378C3.04373 9.09982 3.59347 12.2176 5.8555 13.8014ZM18.1445 10.1985C17.3984 9.67611 16.5592 9.38581 15.7126 9.31251C15.7989 10.8275 15.3953 12.3813 14.4574 13.7207C13.5195 15.0602 12.1975 15.9708 10.7444 16.4079C11.1028 17.1783 11.6626 17.8676 12.4087 18.3901C14.6707 19.9739 17.7885 19.4242 19.3724 17.1622C20.9562 14.9002 20.4065 11.7824 18.1445 10.1985Z" fill="currentColor"></path>
                        </svg>
                    </button>
                    <a onclick="window.location.reload()"
                        href="#">Clear Filters</a>
                </div>

                <!-- Filters -->
                <?php require "PHP/connection.php" ?>
                <div class="col-11 col-lg-7">
                    <div id="filterContainer" style="display: none;">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4 col-lg-4 d-flex justify-content-center align-items-center" style="margin-top: 15px;">
                                    <select id="category" 
                                            onchange="loadBrand()"
                                            class="bg-light shadow-sm noBorder form-control text-center" style="padding: 10px 15px;border-radius: 7px;">
                                        <option value="0" selected="">Category</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category` ");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data['id'] ?>">
                                                    <?php echo $category_data['type'] ?>
                                                </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4 col-lg-4 d-flex justify-content-center align-items-center" style="margin-top: 15px;">
                                    <select id="brand" 
                                            onchange="loadModel()"
                                            class="bg-light shadow-sm noBorder form-control text-center" style="padding: 10px 15px;border-radius: 7px;">
                                        <option value="0" selected="">Brand</option>
                                    </select>
                                </div>
                                <div class="col-4 col-lg-4 d-flex justify-content-center align-items-center" style="margin-top: 15px;">
                                    <select id="model" 
                                            class="bg-light shadow-sm noBorder form-control text-center" style="padding: 10px 15px;border-radius: 7px;">
                                        <option value="0" selected="">Model</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-6">
                                    <select id="condition" 
                                            class="bg-light shadow-sm noBorder form-control text-center" style="padding: 10px 15px;border-radius: 7px;">
                                        <option value="0" selected="">Condition</option>
                                        <?php
                                        $condition_rs = Database::search("SELECT * FROM `condition` ");
                                        $condition_num = $condition_rs->num_rows;

                                        for ($k = 0; $k < $condition_num; $k++) {
                                            $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data['id'] ?>">
                                                    <?php echo $condition_data['status'] ?>
                                                </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select id="color" 
                                            class="bg-light shadow-sm noBorder form-control text-center" style="padding: 10px 15px;border-radius: 7px;">
                                        <option value="0" selected="">Colour</option>
                                        <?php
                                        $color_rs = Database::search("SELECT * FROM `color` ");
                                        $color_num = $color_rs->num_rows;

                                        for ($k = 0; $k < $color_num; $k++) {
                                            $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data['id'] ?>">
                                                    <?php echo $color_data['name'] ?>
                                                </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 15px;">
                            <h6>Price Range</h6>
                            <div class="row">
                                <div class="col-6">
                                    <input id="priceFrom"
                                        class="bg-light shadow noBorder text-center" type="text" placeholder="from $0" style="padding: 10px 15px;border-radius: 7px;width: 100%;">
                                </div>
                                <div class="col-6">
                                    <input id="priceTo"
                                        class="bg-light shadow noBorder text-center" type="text" placeholder="to $100000" style="padding: 10px 15px;border-radius: 7px;width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7 d-flex justify-content-end" style="margin-top: 15px;">
                    
                    <button 
                        onclick="advanced_search()"
                        class="btn btn-primary" type="button">Search</button>
                    
                    <select id="sort_by" class="border-primary shadow-sm" style="padding: 10px 15px;border-radius: 7px;margin-left: 25px;">
                        <option value="0" selected="">SORT BY</option>
                        <option value="1">Price: High to Low</option>
                        <option value="2">Price: Low to High</option>
                        <option value="3">Quantity: High to Low</option>
                        <option value="4">Quantity: Low to High</option>
                    </select>
                </div>
            </div>
        </div>


        <!-- Products container -->
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h6 class="text-center" style="font-size: 13px;margin: 0px 0px 30px 0px;">Do a quick search to sort products</h6>
                </div>
            </div>

            <!-- Clear For Search -->
            <div id="clearForSearch" style="margin-bottom: 120px;">

            <!--  -->

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
                
            <!--  -->

            </div>

            

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
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scrollToTop.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>