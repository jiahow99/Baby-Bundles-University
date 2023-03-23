<?php
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
	$result = $dbcontroller->insertQuery()($query);
	
	// display form submission
	if(!$result){
		die('Error '.mysqli_error());
		$_SESSION['form_fail'] = True;
		header("location:contact-form-success.php");
	}else{
		// set session variables
		$_SESSION['name'] = $_SESSION['name'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['reason'] = $_POST['reason'];
		// get the contact_id 
		$_SESSION['contact_id']  = $pdo->lastInsertId();
		$_SESSION['form_success'] = True;
		// navigate to contact-form-success.php
		header("location:contact-form-success.php");

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
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/contact-style.css">
		<link rel="stylesheet" href="css/style.default.css">
		<link rel="stylesheet" href="css/header-style.css">

	</head>

	<!-- Header -->
	<?php require 'header.php' ?>

	<body>
		<div class="wrapperr" id="contact-form">
			<div class="inner">
				<!-- Form -->
				<form method="post" >
					<h3 class="h3">Contact Us</h3>
					<p>Our team will reach you ASAP to solve your particular problem. Please wait patiently.</p>
					<label class="form-group">
						<input type="text" name="name" class="form-controll" required>
						<span>Your Name</span>
						<span class="border"></span>
					</label>
					<label class="form-group">
						<input type="text" name="email" class="form-controll"  required>
						<span for="">Your Mail</span>
						<span class="border"></span>
					</label>
					<label class="form-group" >
						<textarea name="message" id="" class="form-controll textarea" rows=20 required></textarea>
						<span for="">Your Message</span>
						<span class="border"></span>
					</label>
					<label class="form-group">
						<select class="form-controll" name="reason" required aria-label="Default select example">
							<option selected>Select Reasons</option>
							<option value="Reason 1">Reason 1</option>
							<option value="Reason 2">Reason 2</option>
							<option value="Reason 3">Reason 3</option>
						</select>
						
					</label>
					<button type="submit" class="buttonn">Submit 
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
				<!-- Form end -->
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
	
	<!-- Footer -->
	<?php require 'footer.html' ?>
	<script src="js/navbar-transition.js"></script>
</html>