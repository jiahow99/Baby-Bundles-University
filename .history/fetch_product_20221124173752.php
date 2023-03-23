<?php

require_once('dbcontroller.php');

$dbcontroller = new DBController();

// Get all product
$result = $dbcontroller->selectProduct("SELECT * FROM product_table");

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

<div class="col-3">
<!-- Product card -->
<a href="#" class="card" >
    <img class="card-img-top" src="img/top/top01.jpg" >
    <div class="card-body">
        <div class="row">
            <!-- Title and Price -->
            <div class="col-9">
                <h6>Short Sleeved Top</h6>
                <p>RM 32.00</p>
            </div>
            <!-- Edit icon -->
            <div class="col-3" style="font-size:20px;"><i class="bi bi-pencil-square"></i></div>
        </div>
    </div>
</a>
</div>
