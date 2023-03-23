<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectUser("SELECT * FROM product_table");

// Empty array
$output = array();

// Loop through Shopping Cart
foreach( $result as $product ){
    $item = $dbcontroller->selectSingleProduct("SELECT * FROM product_table WHERE product_id='$product'");
    $product_array = array(
        'product_id' => $item['product_id'],
        'title' => mb_strimwidth($item['title'], 0, 30, "..."),
        'category' => $item['category'],
        'description' => $item['description'],
        'image' => $item['image'],
        'price' => $item['price']
    );

    // Append each product
    array_push($output, $product_array);
    
}

// Encode to JSON format
echo json_encode($output);

?>
