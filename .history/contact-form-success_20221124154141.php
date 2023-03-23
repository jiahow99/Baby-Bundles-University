<?php

// Start session
if(isset($_SESSION)){
	session_start();
}

if(isset($_POST['email']) && isset($_POST['message'])){

	// establish connection
	require_once 'dbcontroller.php';

	$dbcontroller = new DBController();

	// convert html entities & quote
	function sanitise($str){
		$str = htmlentities($str);
		return $str;
	}

	// sanitise input
	$name = sanitise($_POST['name']);
	$email = sanitise($_POST['email']);
	$message = sanitise($_POST['message']);
	$reason = sanitise($_POST['reason']);

	// perform query INSERT
	$query = "INSERT INTO contact_table(name, email, reason, message) VALUES('$name', '$email', '$message', '$reason')";
	$result = $dbcontroller->insertQuery($query);
	
	// display form submission
	if(!$result){
		die('Error '.mysqli_error());
		// Form submit fail
		$form_submitted = false;
	}else{
		// Get the form id
		$contact_form_id = $dbcontroller->conn->lastInsertId();
		// Form successfully submitted
		$form_submitted = True;
	}

}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Contact Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/contact-style.css">
		<link rel="stylesheet" href="css/style.default.css">
		<link rel="stylesheet" href="css/header-style.css">

	</head>

	<!-- Header -->
	<?php require 'header.php' ?>

	<body>


		<div class="wrapperr">
			<div class="inner">
                <?php 
                
                if(isset($_SESSION['form_success'])){
                    echo "<h3 class=\"h3\">Form Submit successfully</h3>";
                }  ?>
				<p>Our team will reach you ASAP to solve your particular problem. Please wait patiently.</p>
                <p class="text-black">Ticket : <?php echo $_SESSION['contact_id'] ?></p>
                <p class="text-black">Name : <?php echo $_SESSION['name'] ?></p>
                <p class="text-black">E-mail : <?php echo $_SESSION['email'] ?></p>
                <p class="text-black">Reason : <?php echo $_SESSION['reason'] ?></p>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
	
	<!-- Footer -->
	<?php require 'footer.html' ?>
	<script src="js/navbar-transition.js"></script>

</html>