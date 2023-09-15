<?php

session_start();

require "connection.php";

class Product {
    public $code;
    public $id;
    public $name;
    public $price;
    public $qty;
    public $cost;
  
    public function __construct($code, $id, $name, $price, $qty, $cost) {
      $this->code = $code;
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->qty = $qty;
      $this->cost = $cost;
    }
}

// foreach ($products as $product) {echo "Code: " . $product->code . ", ID: " . $product->id . ", Name: " . $product->name . ", Price: " . $product->price . ", Qty: " . $product->qty . "\n";}

  

if (isset($_GET['productsObj'])) {

    $productsObj = json_decode($_GET['productsObj']);

    // Values
    $userEmail = $_SESSION['user']['email'];
    $product_ids = array();
    $product_qtys = array();
    $product_codes = array();
    // var_dump($product_ids);var_dump($product_qtys);var_dump($product_codes);
    
    // Order id 
    $prefix = 'CS_';
    
    for ($i = 0; $i < count($productsObj); $i++) {
        $product_ids[] = $productsObj[$i]->id;
        $product_qtys[] = $productsObj[$i]->qty;

        $code = "CS_" . mt_rand(0, 1000000) . microtime(true);
        $code = hash("sha256", $code);
        $code = substr($code, 0, 8);
        $product_codes[] = $prefix . $code;
    }


    
    // Get User Address Details
    $userAddress_rs = Database::search("SELECT * FROM `useraddress` WHERE `user_email`='" . $userEmail . "'");
    $userAddress_data = $userAddress_rs->fetch_assoc();

    // Get user District Name
    $district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $userAddress_data['district_id'] . "'");
    $district_data = $district_rs->fetch_assoc();


    if ($userAddress_data['line 1'] != '--' AND $userAddress_data['line 2'] != '--' AND $userAddress_data['postal code'] != 0)  {
      
      $district_name = $district_data['name'];
      $exact_address = $userAddress_data['line 1'] . ', ' . $userAddress_data['line 2'];
      
      // Get Product Data
      $ids_string = '';

      for ($i = 0; $i < count($product_ids); $i++) {
          $ids_string .= "'$product_ids[$i]',";
      }
      $ids_string = rtrim($ids_string, ',');
      
  
      // echo "IDs: $ids_string \n\n";
  
      $i = 0;
      $product_rs = Database::search("SELECT * FROM `product` WHERE `id` IN ($ids_string) ORDER BY FIELD(id, $ids_string)");
      
      while ($row = $product_rs->fetch_assoc()) {
          $id = $row['id'];
          $name = $row['title'];
          
          $price = $row['price'];
          $cost = $row['cost'];
  
          $get_qty = $product_qtys[$i];
          $get_code = $product_codes[$i];
  
          // echo "Code: $get_code, ID: $id, Name: $name, Price: $price, Qty: $get_qty \n";
  
          $product = new Product($get_code, $id, $name, $price, $get_qty, $cost);
          $products[] = $product;
          
          $i++;
      }

      echo json_encode($products);
        
    } else {
        echo "Address Not Found";
    }
    
    
}
?>