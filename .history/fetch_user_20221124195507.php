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
        'userid' => $user['userid'],
        'username' => $user['username'],
        'email' => $user['email']
    );

    // Append each product
    array_push($output, $user_array);
    
}

// Encode to JSON format
echo json_encode($output);



?>

