<?php 

session_start();

require "connection.php";

$txt = $_POST['text'];
$select = $_POST['select'];

$query = "SELECT *, category.id AS category_id, product.id AS product_id FROM `product` 
INNER JOIN `model` ON model.id=product.model_id 
INNER JOIN `brand` ON brand.id=model.brand_id
INNER JOIN `category` ON category.id=brand.category_id";

if (!empty($txt) || $select != 0) {

    if (!empty($txt) && $select == 0) {
        $query .= " WHERE `title` LIKE '%".$txt."%'";
    } else if (empty($txt) && $select != 0) {
        $query .= " WHERE `category_id` LIKE '%".$select."%'";
    } else if (!empty($txt) && $select != 0) {
        $query .= " WHERE `title` LIKE '%".$txt."%' AND `category_id` LIKE '%".$select."%'";
    }
    
    ?>

    <div style="margin-top: 80px;width: 100%;">
            <div class="container">
                <?php
                $product_rs = Database::search($query);

                $product_num = $product_rs->num_rows;

                if ($product_num == 0) {
                    ?>
                        <div class="nosearchResults_heading" style="margin-bottom: 25px;">
                            <h1 style="font-family: Poppins, sans-serif;">
                                No Search Results for '<span style="font-style: italic;">
                                <?php
                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$select."' ");
                                    $category_data = $category_rs->fetch_assoc();
                                    if (!empty($txt) && $select == 0) {
                                        echo $txt;
                                    } else if (empty($txt) && $select != 0) {
                                        echo $category_data['type'];
                                    } else if (!empty($txt) && $select != 0) {
                                        echo $txt . ', ' . $category_data['type'];
                                    }
                                ?>
                                </span>'
                            </h1>
                            <div 
                                onclick="window.location.reload()"
                                class="d-inline searchCloseBT" style="padding: 3px; cursor: pointer;"><i class="fa fa-close" style="font-size: 27px;"></i></div>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="searchResults_heading" style="margin-bottom: 25px;">
                            <h1 style="font-family: Poppins, sans-serif;">
                                Search Results for '<span style="font-style: italic;">
                                <?php
                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$select."' ");
                                    $category_data = $category_rs->fetch_assoc();
                                    if (!empty($txt) && $select == 0) {
                                        echo $txt;
                                    } else if (empty($txt) && $select != 0) {
                                        echo $category_data['type'];
                                    } else if (!empty($txt) && $select != 0) {
                                        echo $txt . ', ' . $category_data['type'];
                                    }
                                ?>
                                </span>'
                            </h1>
                            <div 
                                onclick="window.location.reload()"
                                class="d-inline searchCloseBT" style="padding: 3px; cursor: pointer;"><i class="fa fa-close" style="font-size: 27px;"></i></div>
                        </div>
                        <div>
                            <div class="row">
                            <div class="d-flex scrollDiv" style="height: 580px;">
        
                                <?php
        
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
                    <?php
                }

                ?>

            </div>
        </div>

    <?php

} else {

    $query = '';
    echo "no results";

}

?>
