<?php
    session_start();
    //session_destroy();
    


    if($_SERVER["REQUEST_METHOD"]=="POST")
    {    
        if(isset($_POST['add_to_cart']))
        {
            $product_id = $_POST['id'];
            $product_title = $_POST['title'];
            $price = $_POST['price'];
            $image_name = $_POST['image_name'];         
     
            if(isset($_SESSION['cart']))
            {
                $products = array_column($_SESSION['cart'], 'product_title') ;
                
               

                if(in_array($product_title, $products))
                {
                    echo "<script>alert('This product is already added to cart'); window.location.href='products.php'</script>";
                    
                }
                else
                {
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = array("product_title" => $product_title, "product_price" => $price, "qty" => 1) ;   
                    echo "<script>alert('Product is added to cart.'); window.location.href='products.php'</script>";           
                }
             
            }
            else
            {
            
                $_SESSION['cart'][0]= array("product_title" => $product_title, "product_price" => $price, "qty" => 1) ;
                echo "<script>alert('Product is added to cart.'); window.location.href='products.php'</script>";
           
            }
            
        }

       if(isset($_POST['remove']))
       {
            foreach($_SESSION['cart'] as $key => $value)
            {
          
                if($value['product_title'] == $_POST['product_title'])
                {
                    unset($_SESSION['cart'][$_POST['id']]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    echo "<script>alert('Product has been removed from cart.'); window.location.href='cart2.php'</script>";
                }
            }
        
       }
    }

?>



  