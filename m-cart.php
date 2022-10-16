<?php
    session_start();
    if(isset($_POST['id']))
    {
        $product_id = $_POST['id'] ;
        $product_title = $_POST['title'] ;
        $price = $_POST['price'] ;

        if(isset($_SESSION['cart']))
            {
               $products = array_column($_SESSION['cart'], 'product_title') ;
               if(in_array($product_title, $products))
               {
                    echo "<div class='text-danger' style='font-size:0.9rem;'>This is already added to cart!</div>"; 
               }
               else
               {
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count]= array("product_title" => $product_title, "product_price" => $price, "qty" => 1) ;
                    echo "<div class='text-success' style='font-size:0.9rem;'>Added to cart.  Number of products in cart now = ".count($_SESSION['cart'])."</div>";
    
               }              
             
            }
            else
            {
            
                $_SESSION['cart'][0]= array("product_title" => $product_title, "product_price" => $price, "qty" => 1) ;
                echo "<div class='text-success' style='font-size:0.9rem;'>Added to cart.  Number of products in cart now = ".count($_SESSION['cart'])."</div>";
           
            }
    }   

    if(isset($_GET['p_number']) && isset($_GET['p_number']) == "p_number")
    {
        $count = 0;
        if(isset($_SESSION['cart']))
        {
            $count = count($_SESSION['cart']) ;
            echo $count;
        }
    }

?>