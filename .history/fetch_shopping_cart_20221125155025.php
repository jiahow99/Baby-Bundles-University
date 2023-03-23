<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectUser("SELECT * FROM shopping_cart_table");
$product_array = $result['product'];

$item_array = explode(',', $product_array);

// print_r($item_array);

// Empty array
$output = array();

// Loop through Shopping Cart
foreach( $item_array as $product ){
    $item = $dbcontroller->selectUser("SELECT * FROM product_table WHERE productid='$product'");
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
