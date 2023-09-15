<?php

session_start();

require "connection.php";

$search = $_POST["search"];
$category = $_POST["category"];
$brand = $_POST["brand"];
$model = $_POST["model"];
$condition = $_POST["condition"];
$color = $_POST["color"];
$priceFrom = $_POST["priceFrom"];
$priceTo = $_POST["priceTo"];
$sort_by = $_POST["sort_by"];

if (!empty($search) || $category != 0 || $condition != 0 || $color != 0 || !empty($priceFrom) || !empty($priceTo) || $sort_by != 0) {

    $query = "SELECT *, 
    category.id AS category_id, 
    brand.id AS brand_id, 
    model.id AS model_id, 
    product.id AS product_id 
    FROM `product` 
    INNER JOIN `model` ON model.id=product.model_id 
    INNER JOIN `brand` ON brand.id=model.brand_id
    INNER JOIN `category` ON category.id=brand.category_id";

    $status = 0;

    // ADVANCED SORT
    if (!empty($search)) {
        $query .= " WHERE `title` LIKE '%" . $search . "%'";
        $status = 1;
    }

    if ($status == 0 && $category != 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    if ($brand != 0) {
        if ($status == 0 && $brand != 0) {
            $query .= " WHERE `brand_id`='" . $brand . "'";
            $status = 1;
        } else if ($status != 0 && $category != 0) {
            $query .= " AND `brand_id`='" . $brand . "'";
        }
    }

    if ($status == 0 && $model != 0) {
        $query .= " WHERE `model_id`='" . $model . "'";
        $status = 1;
    } else if ($status != 0 && $model != 0) {
        $query .= " AND `model_id`='" . $model . "'";
    }

    if ($status == 0 && $condition != 0) {
        $query .= " WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($status != 0 && $condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($status == 0 && $color != 0) {
        $query .= " WHERE `color_id`='" . $color . "'";
        $status = 1;
    } else if ($status != 0 && $color != 0) {
        $query .= " AND `color_id`='" . $color . "'";
    }

    if (!empty($priceFrom) && empty($priceTo)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $priceFrom . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $priceFrom . "'";
        }
    } else if (empty($priceFrom) && !empty($priceTo)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $priceTo . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $priceTo . "'";
        }
    } else if (!empty($priceFrom) && !empty($priceTo)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $priceFrom . "' AND '" . $priceTo . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $priceFrom . "' AND '" . $priceTo . "'";
        }
    }

    if ($sort_by == 0) {
        $query .= "";
    } else if ($sort_by == 1) {
        $query .= " ORDER BY `price` DESC";
    } else if ($sort_by == 2) {
        $query .= " ORDER BY `price` ASC";
    } else if ($sort_by == 3) {
        $query .= " ORDER BY `qty` DESC";
    } else if ($sort_by == 4) {
        $query .= " ORDER BY `qty` ASC";
    }

    // Display Search Results
    ?>
        <!-- Search Container -->
        <div class="row g-4">
            
            <?php

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            if ($product_num != 0) {

                for ($x = 0; $x < $product_num; $x++) {
                    $product_data = $product_rs->fetch_assoc();
            
                    // One Item
                    ?>
                        <div class="col-12 col-lg-6 item" style="padding: 20px;border-radius: 22px;border-style: dotted;border-color: rgb(239,239,239);">
                            <div class="row">
            
                                <!-- Product Image -->
                                <div class="col-6">
                                    <div class="search__imgContainer">
                                        <?php
                                        $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data['product_id'] . "' LIMIT 1 ");
                                        $productImg_data = $productImg_rs->fetch_assoc();
                                        ?>
                                        <img class="search__img" src="<?php echo $productImg_data['path'] ?>">
                                    </div>
                                </div>
            
                                <!-- Product Details -->
                                <div class="col-6" style="padding: 20px 0px;">
                                    <h4 class="search__itemTitle" style="height: 61px;font-weight: bold;text-decoration:  underline;">
                                        <?php echo $product_data['title'] ?>
                                    </h4>
                                    <h4>$ <?php echo $product_data['price'] ?></h4>
                                    <p class="noOverflow" style="margin: 0px;height: 100px;">
                                        <?php echo $product_data['small_desc'] ?>
                                    </p>
                                </div>
                            </div>
            
                            <!-- Product Options -->
                            <div class="row">
                                <div class="col-6 d-flex justify-content-center align-items-center">
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
                                <div class="col-6">
                                    <button 
                                            onclick="window.location = 'singleProductView.php?product_id=' + <?php echo $product_data['product_id'] ?> "
                                            class="product__addBt" type="button" style="background: var(--bs-primary);color: rgb(255,255,255);border-style: solid;border-color: rgb(255,255,255);">
                                        DETAILS
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
            
                }
            
            } else {

                ?>
                    <div class="d-flex flex-column align-items-center" style="padding: 21px 56px;background: #ffffff;">
                        <h3 style="margin-top: 35px;">No search results found.</h3>
                        <a href="" onclick="window.location.reload()" style="margin-bottom: 35px;">Try Again</a>
                    </div>
                <?php

            }


            ?>

        </div>
    <?php


} else {
    
    echo "no filters";

}

?>

