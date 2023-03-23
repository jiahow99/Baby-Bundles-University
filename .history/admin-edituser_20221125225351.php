<?php 
require_once 'admin_auth.php';

if(!isset($_SESSION)){
    session_start();
}

// Edit User
if(isset($_GET['userid'])){

    $edit_id = $_GET['userid']; 
    $insert = "SELECT * FROM login_table WHERE userid='$edit_id'";
    $result = $dbcontroller->selectUser($insert);


    if(isset($_POST['submit'])){

        $username = $dbcontroller->sanitise($_POST['username']);
        $email = $dbcontroller->sanitise($_POST['email']);
        $contact = $dbcontroller->sanitise($_POST['contact']);
        $location = $dbcontroller->sanitise($_POST['location']);
        $gender =$dbcontroller->sanitise($_POST['gender']);

        // pattern
        $username_pattern = "/^[0-9a-zA-Z-'_ ]{4,10}$/";
        $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; 
        $phone_pattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,10}$/"; 


        // username validate
        $username_err = array();
        $username = trim($username);
        $username = $dbcontroller->sanitise($username);


        if(!preg_match( $username_pattern, $username )){
            $username_err = array_push($username_err, "Only letters and digits are allowed and ATLEAST 4 MAX 10 characters");
            $errormsg['username'] = $username_err;
        }

        // email validate
        $email_err = array();
        $email = $dbcontroller->sanitise($email);
        
        $same_email = $dbcontroller->numRows("SELECT email from login_table WHERE is_admin='0'");

        // email taken
        if( $same_email > 0 ){
            array_push( $email_err, 'This email is already registered');
            $_SESSION['email_err'] = $errormsg['email'] = $email_err;
        // email pattern validate 
        }elseif(!filter_var( $email, FILTER_VALIDATE_EMAIL )){
            array_push($email_err, "Please enter a valid email");
            $_SESSION['email_err'] = $errormsg['email'] = $email_err;
        }

        // contact validate
        if(!preg_match( $phone_pattern, $contact )){
            $_SESSION['contact_err'] = $errormsg['contact'] = "Please enter valid phone number";
        }

        if(empty($errormsg)){
            $insert = "UPDATE login_table SET username='$username', email='$email', contact='$contact', location='$location', gender='$gender' WHERE userid='$userid'";
            $result = $dbcontroller->insertQuery($insert);
            if($result){
                die(header("Location: admin-viewuser.php"));
            }
        }
    }
}

        

      


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin-User</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin.style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>


</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require 'admin-sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content" style="background-color:#F2F2F2">
            <?php require 'admin-topnavbar.php' ?>

            <form class="container glass" id="edit-product" method="post">
                <div class="row justify-content-center mt-4 mb-3">
                   <h1 style="color:#da3333">Edit user</h1> 
                </div>

                <!-- Username -->
                <div class="row mt-5">
                    <label for="" class="name text-uppercase col-12">Username</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="username" value = "<?php echo $result['username']; ?>"  required autofocus>
                </div>
                <!-- Email -->
                <div class="row mb-4">
                    <label for="" class="name text-uppercase col-12">Email</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="email" value = "<?php echo $result['email']; ?>"  required autofocus>
                </div>
                <!-- Gender -->
                <div class="row" >
                    <label for="" class="name text-uppercase col-12">Gender</label>
                    <select class="ml-3 px-3" name="gender" id="gender">
                    <option value="male" <?php if($result['gender']=='male'){echo 'selected';} ?>>male</option>
                    <option value="female" <?php if($result['gender']=='female'){echo 'selected';} ?>>female</option>
                    <option value="other">other</option>
                    </select>
                </div>
                <!-- Contact -->
                <div class="row mb-4">
                    <label for="" class="name text-uppercase col-12">Contact</label>
                    <input class="input--style-6 col-10 ml-3" type="text" name="contact" value = "<?php echo $result['contact']; ?>" required autofocus>
                </div>
                <!-- Location -->
                <div class="row ">
                    <label for="" class="name text-uppercase col-12">Location</label>
                    <input type="text" name="location" id="location" class="input--style-6 col-10 ml-3" value= "<?php echo $result['location']; ?>"  required>
                </div>
                <!-- Admin Assign -->
                <div class="row ">
                    <label for="" class="name text-uppercase col-12">Is Admin</label>
                    <input type="radio" name="is_admin" id="is_admin" value='1'>Admin
                    <input type="radio" name="is_admin" id="is_admin" value='1'>Normal User
                </div>
                
                <hr>

                <!-- Upload Button -->
                <div class="row justify-content-center my-5 ">
                    <button class="btn btn-primary px-5 py-3 mr-5" type="submit" name="submit">Upload</button>
                </div>
            </form>
    </div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#dashboardlabel').toggleClass('d-none');
                $('#userlabel').toggleClass('d-none');
                $('#productlabel').toggleClass('d-none');
                $('#orderlabel').toggleClass('d-none');
                $('#accountlabel').toggleClass('d-none');
                $('#logoutlabel').toggleClass('d-none');
            });
        });
    </script>
</body>

</html>