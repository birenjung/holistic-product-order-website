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
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<body id="content">

        <section class="header">              
                <div class="header-links text-right">
                    <ul>
                        <li>
                            <a href="#">Register</a>
                        </li>
                        
                        <li>
                            <a href="#">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>cart.php">

                                <?php
                                        $res = mysqli_query($conn, 'SELECT * FROM tbl_cart') ;
                                        $count = mysqli_num_rows($res) ;
                                        if($count>0)
                                        {
                                            $count = $count ;
                                        }
                                        else
                                        {
                                            $count = 0 ;
                                        }
                                        
                                ?>
                                    Cart[<?php echo $count ; ?>]
                            </a>
                        </li>
                    </ul>                
                </div>        
        </section>
        <!-- header link section ends-->

        <section class="nav-bar">
           
                <nav>
                    <a href="">
                        <div class="logo">
                            <img src="img/logo.amp.png" alt="">
                        </div>
                    </a> 
                    
                    <div class="burger">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="line3"></div>
                    </div>
                       <ul class="nav-links">
                            <li>
                                <a href="<?php echo SITEURL ; ?>index.php">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo SITEURL ; ?>aboutus.php">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo SITEURL ; ?>services.php">Services</a>
                            </li>
                            <li>
                                <a href="<?php echo SITEURL ; ?>products.php">Products</a>
                            </li>                        
                            <li>
                                <a href="<?php echo SITEURL ; ?>contact.php">Contact</a>
                            </li>
                        </ul>                      
                    
                    </nav>
                           
          
            

        

        </section>
        <!-- nav bar ends -->