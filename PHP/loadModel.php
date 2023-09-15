<?php

require "connection.php";

$brand_id = $_GET["brand"];

$model_rs = Database::search("SELECT * FROM `model` WHERE `brand_id` = '" . $brand_id . "'");
$model_num = $model_rs->num_rows;

if ($model_num > 0) {
    ?>
        <option value="0">Select Model</option>
    <?php
    for ($x = 0; $x < $model_num; $x++) {
        $model_data = $model_rs->fetch_assoc();
        ?>
            <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
        <?php
    }
} else {
    ?>
        <option value="0">Select Model</option>
    <?php
}


?>