<?php

session_start();

require "connection.php";

$userEmail = $_SESSION["user"]['email'];

$search = $_POST["search"];
$date = $_POST["date"];
$qty = $_POST["qty"];
$condition = $_POST["condition"];
$status = $_POST["status"];

$query = "SELECT * FROM `product` WHERE `user_email`='" . $userEmail . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != "0") {
    $query .= " AND `condition_id`='" . $condition . "'";
}

if ($status != "0") {
    $query .= " AND `activity_status_id`='" . $status . "'";
}

if ($date != "0") {
    if ($date == "1") {
        $query .= " ORDER BY `dateTime` DESC";
    } else if ($date == "2") {
        $query .= " ORDER BY `dateTime` ASC";
    }
}

if ($date != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($date == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

if ($product_num == '0') {
    ?>
        <div class="d-flex flex-column align-items-center" style="padding: 21px 56px;background: #ffffff;">
            <h3 style="margin-top: 35px;">No search results found.</h3>
            <a href="" onclick="window.location.reload()" style="margin-bottom: 35px;">Try Again</a>
        </div>
    <?php
} else {

    for ($x = 0; $x < $product_num; $x++) {
        $product_data = $product_rs->fetch_assoc();
    ?>

        <!-- Product Item -->
        <div class="card products__itemContainer" style="min-width: 300px;max-width: 300px;height: 470px;margin: 0px 20px;">
            <div class="statusSpan">
                <div class="form-check form-switch">
                    <input 
                        <?php
                        if ($product_data['activity_status_id'] == '1') {
                            ?>checked<?php
                        }
                        ?>
                        onclick="changeStatus(<?php echo $product_data['id'] ?>)"
                        class="form-check-input" type="checkbox" id="formCheck-6">
                    <label class="form-check-label"></label>
                </div>
            </div>
            <div class="products__imgContainer" data-bs-target="#modal-1" data-bs-toggle="modal">
                <?php
                $productImg_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data['id'] . "' ");
                $productImg_data = $productImg_rs->fetch_assoc();
                ?>
                <img class="products__img" src="<?php echo $productImg_data['path'] ?>">
            </div>
            <div class="card-body d-flex flex-column justify-content-start align-items-center products__cardBody" style="border-top-right-radius: 14px;border-top-left-radius: 14px;">
                <h4 class="text-center card-title w" 
                    onclick="//single Product View"
                    title="View More" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                    style="font-family: Poppins, sans-serif;margin: 10px 0px; height: 56px;">
                    <?php echo $product_data['title'] ?>
                </h4>
                <h5 style="font-family: Poppins, sans-serif;margin-bottom: 15px;">
                    $ <?php echo $product_data['price'] ?>
                </h5>
                <h6 style="font-family: Poppins, sans-serif;margin-bottom: 15px;color: #9997cd;">
                    <?php
                    if ($product_data['qty'] == '1') {
                                ?>1 Item Left<?php
                    } else {
                        echo $product_data['qty'] ?> Items Left<?php
                    }
                    ?>
                </h6>
                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                    <button class="product__addBt" type="button">Update Info</button>
                    <div onclick="openDeleteModal('<?php echo $product_data['title']; ?>', <?php echo $product_data['id'] ?>)"><i class="far fa-trash-alt deleteBt"></i></div>
                </div>
            </div>
        </div>
    <?php
    }
}

?>
 