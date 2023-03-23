<?php

// Admin authentication
require_once('admin_auth.php');

if(!isset($_SESSION)){
    session_start();
}

// SweetAlert popup for UPDATE Successful
if(isset($_SESSION['update_successful'])){
    unset($_SESSION['update_successful']);
    echo "
    <script>
    window.onload = function () {
        document.getElementById('update').click();
        };
    </script>
    ";
}

// SweetAlert popup for DELETE Successful
if(isset($_SESSION['delete_successful'])){
    unset($_SESSION['delete_successful']);
    echo "
    <script>
    window.onload = function () {
        document.getElementById('delete').click();
        };
    </script>
    ";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin-Product</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin.style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- SweetAlert plugin -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AJAX display all products -->
    <script>
            $(document).ready(function(){
                $.ajax({
                    url: "fetch_product.php",
                    type: "get",
                    dataType: "JSON",
                    success:function(product)
                    {
                        var len = product.length;
                        for(i=0 ; i<len; i++){
                            var str = '<div class="col-3 mb-5"><a href="admin-editproduct.php?productid=' + product[i].product_id + '" class="card" ><img class="card-img-top" src="' + product[i].image +'" style="width:268px;height:270px;"><div class="card-body">' +
                            '<div class="row"><div class="col-9"><h6>' + product[i].title + '</h6><p>RM ' + product[i].price + '</p></div>' +
                            '<div class="col-3" style="font-size:20px;"><i class="bi bi-pencil-square"></i></div></div></div></a></div>';

                            $('#product').append(str);
                        }
                    }
                });
            });

    </script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php require 'admin-sidebar.php' ?>

        <!-- Page Content  -->
        <div id="content">
            <!-- Top Nav Bar -->
            <?php require 'admin-topnavbar.php' ?>

            <!-- Product card -->
            <div class="row mx-3" id="product"></div>
            <button id="update" hidden></button>
            <button id="delete" hidden></button>

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

        // Buttons
        var update = document.getElementById('update');
        var delete_button = document.getElementById('delete');

        // Item Added Successfully
        update.addEventListener('click',function(){
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Product has been updated',
                showConfirmButton: false,
                timer: 1300,
            })
        });

        // Item Delete Successfully
        delete_button.addEventListener('click',function(){
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Product has been deleted',
                showConfirmButton: false,
                timer: 1300,
            })
        });
    </script>
</body>

</html>