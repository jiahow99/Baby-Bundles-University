<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectProduct("SELECT * FROM login_table WHERE is_admin='0'");

// Empty array
$output = array();

// Loop through Shopping Cart
foreach( $result as $product ){
    $product_array = array(
        'product_id' => $product['product_id'],
        'title' => mb_strimwidth($product['title'], 0, 30, "..."),
        'category' => $product['category'],
        'description' => $product['description'],
        'image' => $product['image'],
        'price' => $product['price']
    );

    // Append each product
    array_push($output, $product_array);
    
}

// Encode to JSON format
echo json_encode($output);



?>

