<?php
session_start();

require_once 'dbcontroller.php';

$db_controller = new DBController();

$_SESSION['login'] = 'false';


// go back to homepage if logged in
if( isset($_SESSION['login'])){
  header("Location:index.php");
  exit();
}


// sanitise()
function sanitise($string){
  $string = htmlentities($string);
  return $string;
}




// Sign in
if(isset($_POST['signin'])){

  $_SESSION['login'] = 'true';

  // Inputs
  $email = sanitise($_POST['email_signin']);
  $password = sanitise($_POST['password_signin']);

  // Queries
  $query = "SELECT * FROM login_table WHERE email='$email'";
  $result = $db_controller->selectUser($query);

  // User not found
  if(!$result){
    $_SESSION['user_not_found'] = "Couldn't find your account";
  }else{
    $_SESSION['email'] = $result['email'];
  }

  // Verify user
  $password_tmp = $result['password'] ?? 'default';


  // Password verify
  if(password_verify($password, $password_tmp)){

    // Set remember me (COOKIE) 1 week
    if(isset($_POST['remember'])){
      setcookie('rememberme','true', time()+604800);
    }else{
      setcookie('rememberme','false');
    }

    // Set Username and Id (COOKIE) 1 week
    setcookie('username', $result['username'], time()+604800);
    setcookie('userid', $result['userid'], time()+604800);
    setcookie('is_admin', $result['is_admin'], time()+604800);
    setcookie('login', 'true' , time()+604800);

    $userid = $result['userid'];
    $cart = $db_controller->selectUser("SELECT * FROM shopping_cart_table WHERE userid='$userid'");

    // Set cart items
    $_SESSION['products'] = explode(',', $cart['product']);

    // Set session variables
    $_SESSION['username'] = htmlspecialchars($result['username']);
    $_SESSION['contact'] = $result['contact'];
    $_SESSION['email'] = htmlspecialchars($result['email']);
    die(header("Location:index.php"));

  }

  // Wrong password
  if(!password_verify($password, $password_tmp) && isset($_SESSION['email'])){
    $_SESSION['password_not_match'] = "Wrong Password";
  }

}



// Sign up
if(isset($_POST['signup'])){

  unset($errormsg);

  // inputs
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $contact = $_POST['contact'];
  $country_code = $_POST['country_code'];
  $password = $_POST['password'];


  // pattern
  $username_pattern = "/^[0-9a-zA-Z-'_ ]{4,10}$/";
  $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; 
  $phone_pattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,6}$/";
  $country_code_pattern = "/^(\d{1}\-)?(\d{1,3})$/";


  // username validate
  $username_err = array();
  $username = trim($username);
  $username = sanitise($username);
  $same_username = $db_controller->numRows("SELECT username from login_table WHERE username='$username'");


  // username taken
  if( $same_username > 0 ){
    array_push( $username_err, 'Username is taken');
    $_SESSION['username_err'] = $errormsg['username'] = $username_err;

  }elseif(!preg_match( $username_pattern, $username )){
    $username_err = array_push($username_err, "Only letters and digits are allowed and ATLEAST 4 MAX 10 characters");
    $errormsg['username'] = $username_err;
  }


  // email validate
  $email_err = array();
  $email = sanitise($email);
  
  $same_email = $db_controller->numRows("SELECT email from login_table WHERE email='$email'");


  // email taken
  if( $same_email > 0 ){
    array_push( $email_err, 'This email is already registered');
    $_SESSION['email_err'] = $errormsg['email'] = $email_err;


  // email pattern validate 
  }elseif(!filter_var( $email, FILTER_VALIDATE_EMAIL )){
    array_push($email_err, "Please enter a valid email");
    $_SESSION['email_err'] = $errormsg['email'] = $email_err;
  }


  // password validate 
  // (Minimum eight characters, at least one letter and one number:)
  $password_validation = true;

  if(!preg_match( $password_pattern, $password )){
    $_SESSION['password_err'] = $password_error = "Minimum eight characters, at least one letter and one number";
    $errormsg['password'] = $password_error;
    $password_validation = false;
  }
  if( $password != $confirm_password ){
    $_SESSION['confirm_password_err'] = $confirm_password_error = "Password does not match";
    $errormsg['confirm_password'] = $confirm_password_error;
    $password_validation = false;
  }
  if( $password_validation ){
    $password = sanitise($password);
    $password = password_hash( $password, PASSWORD_DEFAULT );
  }


  // contact validate
  $contact_validation = true;

  if(!preg_match( $phone_pattern, $contact )){
    $_SESSION['contact_err'] = $errormsg['contact'] = "Please enter valid phone number";
    $contact_validation = false;
  }
  if(!preg_match( $country_code_pattern, $country_code ) || strpos( $country_code, '+' )){
    $_SESSION['country_code_err'] = $errormsg['country_code'] = array("Only digits and - are allowed", "Omit '+' for country code if have");
    $contact_validation = false;
  }
  if( $contact_validation ){
    $contact = sanitise($country_code.$contact);
  }


  // If no errors, insert data into Database
  if( empty($errormsg) ){

    $insert = "INSERT INTO login_table(username,email,password,contact) VALUES('$username','$email','$password','$contact')";
  
    $result = $db_controller->insertQuery($insert);
    $new_user = $db_controller->selectUser("SELECT * FROM login_table WHERE username='$username'");
    $userid = $new_user['userid'];

    if(!$result){
      die('Error'.mysqli_error());
    }else{
      $_SESSION['username'] = htmlspecialchars($username);
      
      // Get shopping cart
      // $cart = $db_controller->selectUser("SELECT * FROM shopping_cart_table WHERE userid='$userid'");

    
      // Set cart items
      // if(!empty($cart['product'])){
      //   $_SESSION['products'] = explode(',', $cart['product']);
      // }else{
      //   $_SESSION['products'] = array();
      // }


      $_SESSION['products'] = array();
      
      // Set Username and Id (COOKIE) 1 week
      setcookie('username', $username, time()+604800);
      setcookie('userid', $userid , time()+604800);
      setcookie('is_admin', '0', time()+604800);


      // Set session variables
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['login'] = "true";

      die(header("Location:index.php"));
    }
  }else{
    $_SESSION['temp_username'] = $_POST['username'];
    $_SESSION['temp_email'] = $_POST['email'];
    $_SESSION['temp_countryCode'] = $_POST['country_code'];
    $_SESSION['temp_contact'] = $_POST['contact'];
    
    echo "<script>
    window.onload = function () {
      document.getElementById('m-up').click();
  };
    </script>";
  }  

}

?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="css/header-style.css">
  <link rel="stylesheet" href="css/style.default.css">
  <link rel="stylesheet" href="css/login.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</head>
<body>
  <?php require 'header.php' ?>
  
<!-- partial:index.partial.html -->
  <div class="cont height" style="margin-top:100px;" id="container">

    <!-- Sign in form -->
    <form class="form sign-in" method="post">
      <h2>Welcome back,</h2>
      <label>
        <span>Email</span>
        <input type="email" name="email_signin" autofocus value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];unset($_SESSION['email']);} ?>"/>
        <!-- Error message -->
        <?php 
        if(isset($_SESSION['user_not_found'])){
          $error_msg = $_SESSION['user_not_found'];
          echo "<p class='text-danger pt-2 text-sm'>$error_msg</p>";
          unset($_SESSION['user_not_found']);
          } ?>
      </label>
      <label>
        <span>Password</span>
        <input type="password" name="password_signin" />
        <!-- Error message -->
        <?php if(isset($_SESSION['password_not_match'])){
            $error_msg = $_SESSION['password_not_match'];
            echo "<p class='text-danger pt-2 text-sm'>$error_msg</p>";
            unset($_SESSION['password_not_match']);
          } ?>
      </label>
      <p class="forgot-pass">Forgot password?</p>
      <div class="d-flex justify-content-center align-items-center gap-2">
        <input class="m-0 p-0" style="width:16px; height:16px;" type="checkbox" name="remember">
        <label class="m-0 p-0 text-muted" style="width:auto;font-size:15px;" for=""> Remember me</label>
      </div>
      <button type="submit" class="submit" name="signin">Sign In</button>
      <button type="button" class="fb-btn">Connect with <span>facebook</span></button>
    </form>

    <!-- Change view to Sign Up -->
    <div class="sub-cont">
      <div class="img">
        <div class="img__text m--up">
          <h2>New here?</h2>
          <p>Sign up and discover great amount of new opportunities!</p>
        </div>
        <div class="img__text m--in">
          <h2>One of us?</h2>
          <p>If you already has an account, just sign in. We've missed you!</p>
        </div>
        <div class="img__btn" id="change-button">
          <span class="m--up" id="m-up">Sign Up</span>
          <span class="m--in" id="m-in">Sign In</span>
        </div>
      </div>

      <!-- Sign up form -->
      <form class="form sign-up" method="post">
        <h2 id="title">Time to feel like home,</h2>

        <label>
          <!-- username -->
          <span >Username</span>
          <input type="text" name="username" value="<?php if(isset($_SESSION['temp_username'])){echo $_SESSION['temp_username'];unset($_SESSION['temp_username']);} ?>" required autofocus>
          <!-- error message  -->
          <?php if(isset($_SESSION['username_err'])){
            $error_msg = $_SESSION['username_err'];
            foreach($error_msg as $msg){
              echo "<p class='text-danger text-sm' style='margin:0;'>*** $msg</p>";
            }
            unset($_SESSION['username_err']);
          } ?>        
        </label>

        <label>
          <!-- email -->
          <span>Email</span>
          <input type="email" name="email" value="<?php if(isset($_SESSION['temp_email'])){echo $_SESSION['temp_email'];unset($_SESSION['temp_email']);} ?>" required>
          <!-- error message -->
          <?php if(isset($_SESSION['email_err'])){
            $error_msg = $_SESSION['email_err'];
            foreach($error_msg as $msg){
              echo "<p class='text-danger text-sm' style='margin:0;'>*** $msg</p>";
            }
            unset($_SESSION['email_err']);
          } ?> 
        </label>

        <label>
          <!-- password -->
          <span>Password</span>
          <input type="password" name="password" required>
          <!-- error message -->
          <?php if(isset($_SESSION['password_err'])){
            $error_msg = $_SESSION['password_err'];
            echo "<p class='text-danger pt-2 text-sm'>*** $error_msg</p>";
            unset($_SESSION['password_err']);
          } ?> 
        </label>

        <label>
          <!-- confirm password -->
          <span>Confirm Password</span>
          <input type="password" name="confirm_password" required>
          <!-- error message -->
          <?php 
          if(isset($_SESSION['confirm_password_err'])){
            $error_msg = $_SESSION['confirm_password_err'];
            echo "<p class='text-danger pt-2 text-sm'>*** $error_msg</p>";
            unset($_SESSION['confirm_password_err']);
          } ?> 
        </label>

        <label>
          <!-- contact -->
          <span>Contact</span>
          <div class="d-flex">
            <input type="text" name="country_code" class="col-3 bg-secondary bg-opacity-50" style="border-radius:30px;" placeholder="60" value="<?php if(isset($_SESSION['temp_countryCode'])){echo $_SESSION['temp_countryCode'];unset($_SESSION['temp_countryCode']);} ?>">
            <input type="text" name="contact" placeholder="187754338" value="<?php if(isset($_SESSION['temp_contact'])){echo $_SESSION['temp_contact'];unset($_SESSION['temp_contact']);} ?>">
          </div>
          <!-- error message -->
          <?php 
          if(isset($_SESSION['contact_err'])){
            $error_msg = $_SESSION['contact_err'];
            echo "<p class='text-danger pt-2 text-sm'>*** $error_msg</p>";
            unset($_SESSION['contact_err']);
          } 
          if(isset($_SESSION['country_code_err'])){
            $error_msg = $_SESSION['country_code_err'];
            foreach($error_msg as $msg){
              echo "<p class='text-danger text-sm' style='margin:0;'>*** $msg</p>";
            }
            unset($_SESSION['country_code_err']);
          } 

          ?> 
        </label>
        <button type="submit" class="submit" name="signup">Sign Up</button>
        <button type="button" class="fb-btn">Join with <span>facebook</span></button>
      </form>
    </form>
  </div>


  <!-- partial -->
  <script  src="js/login-script.js"></script>
  <script>
    function addHeight(){
      document.getElementById('container').style.height = "800px";
    }

    document.getElementById('change-button').onclick = function(){
      addHeight();
    }
  </script>
  <script src="js/navbar-transition.js"></script>

</body>

</html>
