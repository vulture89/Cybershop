<?php

require "connection.php";

$category_id = $_GET["cat"];

$brands_rs = Database::search("SELECT * FROM `brand` WHERE `category_id` = '" . $category_id . "'");
$brands_num = $brands_rs->num_rows;

if ($brands_num > 0) {
    ?>
        <option value="0">Select Brand</option>
    <?php
    for ($x = 0; $x < $brands_num; $x++) {
        $brands_data = $brands_rs->fetch_assoc();
        ?>
            <option value="<?php echo $brands_data["id"]; ?>"><?php echo $brands_data["name"]; ?></option>
        <?php
    }
} else {
    ?>
        <option value="0">Select Brand</option>
    <?php
}


?>