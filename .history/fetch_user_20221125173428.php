<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectProduct("SELECT * FROM login_table");

// Empty array
$output = array();

// Loop through Shopping Cart
foreach( $result as $user ){
    $user_array = array(
        'userid' => $user['userid'],
        'username' => $user['username'],
        'contact' => $user['contact'],
        'gender' => $user['gender'],
        'location' => $user['location'],
        'email' => $user['email']
    );

    // Append each product
    array_push($output, $user_array);
    
}

// Encode to JSON format
echo json_encode($output);



?>
