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
        'contact' => $user['contact']
    );

    // Append each product
    array_push($output, $user_array);
    
}

// Encode to JSON format
echo json_encode($output);



?>

<div class="row bg-transparent rounded py-2 mb-2 user-row align-items-center">
    <div class="col-2 user">ID</div>
    <div class="col-2 user">Name</div>
    <div class="col-4 user">Contact No</div>
    <div class="col-4 user">
        <a href="#" class="btn btn-primary">EDIT</a>
        <a href="#" class="btn btn-primary">DELETE</a>
    </div>
</div>