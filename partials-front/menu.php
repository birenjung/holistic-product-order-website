<?php 
    include("config/constants.php") ;    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMP Holistic Enterprise</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ad2db55012.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- for logo -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
</head>
<body id="content">
        <section class="header">              
                <div class="header-links text-center">
                    
                            <a href="<?php echo SITEURL; ?>cart.php">

                                <?php
                                        $product_num = 0 ;
                                        if(isset($_SESSION['cart']))
                                        {
                                            $product_num = count($_SESSION['cart']) ;
                                        }                                        
                                ?>
                                   My Cart <i class="fa-solid fa-cart-shopping"></i> <span id="pnum" class="bg-danger rounded p-1"><?php echo $product_num ;?></span>
                            </a>
                                    
                </div>        
        </section>
        <!-- header link section ends-->
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style=" font-family: 'Oswald', sans-serif; font-size: 1.5rem; letter-spacing: 1px; color:#636e72">
            Herbs <i class="fa-solid fa-leaf"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo SITEURL ; ?>index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL ; ?>aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL ; ?>services.php">Services</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL ; ?>products.php">Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL ; ?>contact.php">Contact Us</a> 
            </li>           
        </ul>        
        </div>
    </div>
    </nav>
            <!-- nav bar ends -->