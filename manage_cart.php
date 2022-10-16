<?php
    session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {    
        
       if(isset($_POST['remove']))
       {
            foreach($_SESSION['cart'] as $key => $value)
            {
          
                if($value['product_title'] == $_POST['product_title'])
                {
                    unset($_SESSION['cart'][$_POST['id']]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    echo "<script>window.location.href='cart.php'</script>";
                }
            }
        
       }

       if(isset($_POST['modQty']))
       {
            foreach($_SESSION['cart'] as $key => $value)
            {
                if($value['product_title'] == $_POST['product_title'])
                {
                    $_SESSION['cart'][$key]['qty'] = $_POST['modQty'] ;
                    echo "<script>window.location.href='cart.php'</script>";
                }
            }
       }
    }

?>


