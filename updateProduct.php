<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Update Product Data | Cybershop</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/addProduct.css">
    <link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/loader.css">
    <script>
        history.scrollRestoration = "manual"
    </script>
    <style>::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background-color: var(--bs-light);}::-webkit-scrollbar-thumb {background-color: var(--bs-gray-400);}</style>
</head>

<body style="font-family: Poppins, sans-serif;">

    <?php
    
    include "header.php";

    if (!isset($_SESSION['user'])) {
        ?>
            <script>
                window.location = 'login.php';
            </script>
        <?php
    } else if (!isset($_SESSION['product'])) {
        ?>
            <script>
                window.location = 'myProducts.php';
            </script>
        <?php
    } else {
        $product_data = $_SESSION['product'];
    }

    ?>

    <div id="loader" >
        <div class="lds-default">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
    </div>

    <span id="product_id" class='invisible'><?php echo $product_data['id']; ?></span>

    <div class="container" style="margin-top: 20px;">
        <ol class="breadcrumb bd" style="padding: 10px 15px;">
            <li class="breadcrumb-item"><a href="home.php"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="myProducts.php"><span>My Products</span></a></li>
            <li class="breadcrumb-item active"><span>Update Product</span></li>
        </ol>
        <div style="background: #ffffff;">
            <div class="row">
                <div class="col" style="padding: 30px 30px 0px 30px;">
                    <h1 class="text-center"><?php echo $product_data['title'] ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12  d-flex justify-content-center" style="padding: 15px;">
                    <p style="color: red; padding: 10px 25px; background-color: #ffeeee; text-align: center;" id="errorMsg" class="d-none">None</p>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col-12 col-lg-6 order-2 order-lg-1" style="padding: 20px;">

                    <?php 
                    $img = array();

                    $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data['id'] . "' ");
                    $productImg_num = $productImg_rs->num_rows;
                    for($x = 0; $x < $productImg_num; $x++) {
                        $productImg_data = $productImg_rs->fetch_assoc();
                        $img[$x] = $productImg_data['path'];
                    }
                    ?>

                    <input disabled type="file" class="d-none" id="update_ImageUploader" multiple>
                    <label for="update_ImageUploader" class="col-12" onclick="update_ChangeImg()">
                
                        <!-- Main Img -->
                        <div class="d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" style="height: 400px;border-style: dotted;" title="Cannot Update">
                            <div class="d-none justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-images" style="font-size: 121px;">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"></path>
                                </svg>
                            </div>
                            <div class="imgContainer">
                                <img src="<?php echo $img[0] ?>" id="i0">
                            </div>
                        </div>
    
                        <!-- Sub Imgs -->
                        <div class="d-flex flex-row" style="margin-top: 20px;height: 90px;">
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Cannot Update">
                                <div class="<?php if ($img[1] == '') {echo 'd-flex'; } else {echo 'd-none'; }  ?> justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                                <div class="imgContainer <?php if ($img[1] == '') {echo 'd-none'; } ?>">
                                    <img src="<?php if ($img[1] != '') {echo $img[1]; }?>" id="i1">
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Cannot Update">
                                <div class="<?php if ($img[2] == '') {echo 'd-flex'; } else {echo 'd-none'; }  ?> justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                                <div class="imgContainer <?php if ($img[2] == '') {echo 'd-none'; } ?>">
                                    <img src="<?php if ($img[2] != '') {echo $img[2]; }?>" id="i2">
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w" data-bs-toggle="tooltip" data-bss-tooltip="" title="Cannot Update">
                                <div class="d-flex justify-content-center align-items-center noImg" style="width: 100%;height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-image" style="font-size: 75px;">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center w">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 60px;" title="Cannot Update">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                                </svg>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="col-12 col-lg-6 order-1 order-lg-2" style="padding: 20px;">
                    <div class="row">
                        <div class="col-12">
                            <input id='title' type="text" class="inputText text-center w" style="font-size: 20px;font-weight: bold;" placeholder="<?php echo $product_data['title'] ?>">
                        </div>
                        <div class="col-12" style="margin-top: 10px;">
                            <input type="number" disabled class="inputText text-center w" style="font-size: 20px;font-weight: bold;" placeholder="$ <?php echo $product_data['price'] ?>">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select disabled id="condition" class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                <option value="0" selected="">
                                    <?php
                                    $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data['condition_id'] . "' ");
                                    $condition_data = $condition_rs->fetch_assoc();
                                    echo $condition_data['status'];                                    
                                    ?>
                                </option>
                            </select>
                        </div>
                        <?php
                            $p_type = Database::search("SELECT *, model.name AS model_name, brand.name AS brand_name, category.type AS category_name FROM `product`
                            INNER JOIN `model` ON model.id=product.model_id
                            INNER JOIN `brand` ON brand.id=model.brand_id
                            INNER JOIN `category` ON category.id=brand.category_id
                            WHERE product.id='".$product_data['id']."' ");
                            $p_data = $p_type->fetch_assoc();
                        ?>
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select disabled class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                <option value="0" selected="">
                                    <?php echo $p_data['category_name']; ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select disabled class="selectOpt" style="width: 100%;padding: 10px 15px;margin-bottom: 10px;">
                                <option value="0" selected="">
                                    <?php echo $p_data['brand_name']; ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-bottom: 10px;">
                            <select disabled class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                <option value="0" selected="">
                                    <?php echo $p_data['model_name']; ?>
                                </option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-6">
                                    <h6>Quantity</h6>
                                    <div class="input-group">
                                        <button onclick="changeQty('-')" class="btn btn-dark" type="button">-</button>
                                        <input id="qty" class="form-control text-center" type="text" value="<?php echo $product_data['qty'] ?>">
                                        <button onclick="changeQty('+')" class="btn btn-dark" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h6>Choose Colour</h6>
                                    <select disabled class="selectOpt" style="width: 100%;padding: 10px 15px;">
                                        <option value="0" selected="">
                                        <?php
                                        $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='".$product_data['color_id']."' ");
                                        $color_data = $color_rs->fetch_assoc();
                                        echo $color_data['name']; 
                                        ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 25px;">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h6>Delivery Cost&nbsp;</h6>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input id="cost" class="form-control" type="text" placeholder="<?php echo $product_data['cost']; ?>">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 20px;">
                <div class="col" style="padding: 20px;">
                    <h3>Describe Your Product Briefly</h3>
                    <textarea rows="2" id="small_desc" class="form-control" placeholder="<?php echo $product_data['small_desc'] ?>"></textarea>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col" style="padding: 20px;">
                    <h3>Add Product Description</h3>
                    <textarea rows="5" id="desc" class="form-control" placeholder="<?php echo $product_data['desc'] ?>"></textarea>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <div class="col d-flex flex-column justify-content-around align-items-center flex-lg-row" style="padding: 0px 20px 20px 20px;">
                <button class="btn btBottom reset" type="button" data-bs-toggle="modal" data-bs-target="#confirmationtoReset">Clear All&nbsp;<i class="fa fa-undo"></i>&nbsp;</button>
                <button class="btn btBottom save" onclick="updateProduct()" type="button">Update my Product&nbsp;<i class="fas fa-save"></i></button>
            </div>
            </div>
        </div>
    </div>

    <!-- Successful -->
    <div class="toast fade hide" role="alert" id="productUpdated">
        <div class="toast-header"><img class="me-2" src="assets/img/logo.png" style="width: 29px;"><strong class="me-auto">Cyber Shop</strong><button class="btn-close ms-2 mb-1 close" data-bs-dismiss="toast"></button></div>
        <div class="toast-body" role="alert">
            <p>Your Product was successfuly updated.</p>
        </div>
    </div>

    <!-- Form Reset Confirmation -->
    <div class="modal fade" role="dialog" tabindex="-1" id="confirmationtoReset">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 38px;">
                    <p style="font-size: 23px;">Are You Sure you want to clear all the data ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button 
                        onclick='clearPage()'
                        class="btn btn-primary" type="button">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>