<?php include ("../config/constants.php");?> 

<?php include("partials/login-check.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMP Holistic Web Management</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- timepicker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
  <div class="container-fluid p-2">
    <a class="navbar-brand" href="#">CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href='<?php echo SITEURL ; ?>admin/index.php'>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/manage-admin.php'>Admin</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href='<?php echo SITEURL ; ?>admin/manage-category.php'>Product category</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href='<?php echo SITEURL ; ?>admin/manage-s-category.php'>Service category</a></li>         
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/manage-products.php'>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/manage-services.php'>Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/manage-order.php'>Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/manage-booking.php'>Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo SITEURL ; ?>admin/logout.php'>Log out</a>
        </li>
      </ul>      
    </div>
  </div>
</nav>