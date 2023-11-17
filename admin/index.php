<?php
session_start();

if (!$_SESSION['admin_logged']){
    header('location: admin_registr.php');
}

echo 'Admin with email:' .$_SESSION['admin_email'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Car rental Project</title>
  <link rel="stylesheet" href="../assets/admins/css/style.min.css">
</head>
<body>
    

        <div class="page-breadcrumb bg-white">

            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Blank Page</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <div class="d-md-flex">
                        <ol class="breadcrumb ms-auto">
                            <li><a href="#" class="fw-normal">Dashboard</a></li>
                        </ol>
                        <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                            to Pro</a>
                        </div>
                        <a  href="logout.php">                      Logout</a>
                </div>
                <!-- <a style="display: block; text-align: right;" href="logout.php">Logout</a> -->
            </div>

        </div>
        <div class="container-fluid">
   
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">Blank Page</h3>
                    </div>
                </div>
            </div>

        </div>
        </body>
        </html>
 <?php include('../includes/footer.php') ?>