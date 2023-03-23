<?php

// Admin authentication
require_once('admin_auth.php');

// Start session
if(!isset($_SESSION)){
    session_start();
}

// Userid
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
    $active_user = $_COOKIE['userid'];
}

// If button is pressed (edit/remove)
if(isset($_GET['action'])){

    switch ($_GET['action']) {
        // Edit User
        case 'edit':
            # Edit user goes here ...
            break;
        
        // Remove User
        case 'remove':
            // User cannot remove himself
            if(isset($userid) and $active_user!=$userid ){
                $insert = "DELETE FROM login_table WHERE userid='$userid'";
                $result = $dbcontroller->deleteQuery($insert);
            }
            break;
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

    <!-- AJAX display all users -->
    <script>
            $(document).ready(function(){
                $.ajax({
                    url: "fetch_user.php",
                    type: "get",
                    dataType: "JSON",
                    success:function(user)
                    {
                        var len = user.length;
                        for(i=0 ; i<len; i++){
                            var str = '<div class="row bg-transparent rounded py-2 mb-2 user-row align-items-center">' +
                            '<div class="ml-4 user">' + user[i].userid + '</div>' +
                            '<div class="col-1 user">' + user[i].username + '</div>' +
                            '<div class="col-3 user">' + user[i].email + '</div>' +
                            '<div class="col-2 user">+' + user[i].contact + '</div>' +
                            '<div class="col-1 user">' + user[i].gender + '</div>' +
                            '<div class="col-3 user">' + user[i].location + '</div>' +
                            '<div class="col-1 user">' +
                            '<a href="admin-viewuser.php?action=edit&userid=' + user[i].userid + '" class="btn btn-primary">EDIT</a>' +
                            '<a href="admin-viewuser.php?action=remove&userid=' + user[i].userid + '" class="btn btn-primary">DELETE</a>' +
                            '</div></div>';

                            $('#users').append(str);
                        }
                    }
                });
            });

    </script>


</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        <?php require 'admin-sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content" style="background-color:#F2F2F2">

            <!-- Navbar -->
            <?php require 'admin-topnavbar.php' ?>

            <!-- Users Container -->
            <div class="container" id="users">
                <!-- Header -->
                <div class="row bg-secondary rounded py-3 mb-3">
                    <div class="ml-4 text-white">ID</div>
                    <div class="col-1 text-white">Name</div>
                    <div class="col-3 text-white">Email</div>
                    <div class="col-2 text-white">Contact No</div>
                    <div class="col-1 text-white">Gender</div>
                    <div class="col-3 text-white">Location</div>
                    <div class="col-1 text-white">Action</div>
                </div>

                <!-- Users Goes here (AJAX) ..... -->
                
            </div>
            
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