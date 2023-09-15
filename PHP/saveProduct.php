<?php

session_start();
require "connection.php";

$userEmail = $_SESSION["user"]["email"];

$title = $_POST["title"];
$price = $_POST["price"];
$condition = $_POST["condition"];
$category = $_POST["category"];
$brand = $_POST["brand"];
$model = $_POST["model"];
$qty = $_POST["qty"];
$color = $_POST["color"];
$cost = $_POST["cost"];
$small_desc = $_POST["small_desc"];
$desc = $_POST["desc"];

$no_of_images = sizeof($_FILES);

if (empty($title)) {
    echo "Enter a Title for your product";
} else if (strlen($title) > 25) {
    echo "Enter a Title not above 25 characters";
} else if (empty($price)) {
    echo "Enter a Price for your product";
} else if (!is_numeric($price)) {
    echo "Price should be a numeric value";
} else if ($condition == '0') {
    echo "Choose your product condition";
} else if ($category == '0') {
    echo "Choose your product Category";
} else if ($model == '0') {
    echo "Choose your product Model";
} else if ($brand == '0') {
    echo "Choose your product Brand";
} else if ($qty >= '50') {
    echo "Cannot sell more than 50 items at a time";
} else if ($color == '0') {
    echo "Choose your product color";
} else if (empty($cost)) {
    echo "Enter Delivery Cost for this product";
} else if (empty($small_desc)) {
    echo "Describe Your product Briefly";
} else if (empty($desc)) {
    echo "Describe Your product in detail";
} else if ($no_of_images == 0) {
    echo "One or More image/s required";
} else {

    // Success

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $title = Database::escapeString($title);
    $small_desc = Database::escapeString($small_desc);
    $desc = Database::escapeString($desc);

    // Add Product Details
    Database::iud("INSERT INTO `product` 
    (`user_email`, `title`, `price`, `qty`, `cost`, `small_desc`, `desc`, `color_id`, `model_id`, `condition_id`, `activity_status_id`, `dateTime`)
    VALUES
    ('".$userEmail."', '".$title."', '".$price."', '".$qty."', '".$cost."', '".$small_desc."', '".$desc."', '".$color."', '".$model."', '".$condition."', '1', '".$date."') ");

    // Get new added products id
    $product_id = Database::$connection->insert_id;

    if($no_of_images <= 3 && $no_of_images > 0){

        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0; $x < $no_of_images;$x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention, $allowed_img_extentions)){

                    $new_img_extention;

                    if($file_extention == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $code = uniqid();

                    $moveFromThisFile = '../assets/img/Products/' . $title . '_' . $code . $new_img_extention;
                    $file_name = 'assets/img/Products/' . $title . '_' . $code . $new_img_extention;

                    move_uploaded_file($img_file["tmp_name"], $moveFromThisFile);

                    Database::iud("INSERT INTO `product_image` (`path`,`product_id`) VALUES ('".$file_name."','".$product_id."')");

                }else{
                    echo ("Invalid Image type");
                }
            }
        }

        Database::iud("INSERT INTO `notifications` (`email`, `context`, `news`, `date`) 
        VALUES ('".$userEmail."', 'Your Product was Added <br/> ".$title." ', 'good', '".$date."') ");

        echo "Success";        

    }else{
        echo ("Only 3 images are applicable");
    }


}


?>