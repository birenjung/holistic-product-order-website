<?php include ("../config/constants.php") ?> ;

<?php include("partials/login-check.php")  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMP Holistic Web Management</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
        <!-- nav section starts -->

        <nav>
                <ul class="nav-links">
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/index.php">

                           Home
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-admin.php">Admin</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-category.php">Product Categories</a>
                    </li>                    
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-products.php">Products</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-s-category.php">Service Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-services.php">Services</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-order.php">Order</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/manage-booking.php">Booking</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL ; ?>admin/logout.php">Log out</a>
                    </li>
                    
                </ul>
        </nav>
        <!-- nav section ends -->
