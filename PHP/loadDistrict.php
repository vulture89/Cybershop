<?php

require "connection.php";

$province = $_GET['province'];

$district_rs = Database::search("SELECT * FROM `district` WHERE `province_id`='" . $province . "' ");
$district_num = $district_rs->num_rows;

if ($district_num > 0) {

    for ($x = 0; $x < $district_num; $x++) {
        $district_data = $district_rs->fetch_assoc();

        ?>
            <option
                value="<?php echo $district_data['id'] ?>">
                <?php echo $district_data['name']; ?>
            </option>
        <?php

    }

}

?>