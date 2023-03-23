<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectProduct("SELECT * FROM login_table WHERE is_admin=''");

// Empty array
$output = array();

// Loop through Shopping Cart
foreach( $result as $user ){
    $user_array = array(
        'product_id' => $user['product_id'],
        'title' => mb_strimwidth($user['title'], 0, 30, "..."),
        'category' => $user['category'],
        'description' => $user['description'],
        'image' => $user['image'],
        'price' => $user['price']
    );

    // Append each product
    array_push($output, $user_array);
    
}

// Encode to JSON format
echo json_encode($output);



?>

