<?php
    include("config/constants.php");  

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['formData']))
        {
            $formData = $_POST['formData'];     
            $cName = $formData['cName'];
            $cAddress = $formData['cAddress'];
            $cPhone = $formData['cPhone'];
            $cEmail = $formData['cEmail'];
            $payMode = $formData['payMode'];
            $status = "Ordered";  
            $grand_total = $formData['gTotal'];
            $order_date = date("y-m-d h:i:sa");   
            
            function validating($cPhone){
                if(preg_match('/^[0-9]{10}+$/', $cPhone)) 
                {                
                }
                else
                {
                    echo "<div class='error'>!! Please enter valid phone number and try again !!</div>";
                    die();
                }
            }
            validating($cPhone);
            
            $sql = "INSERT INTO tbl_order_manager SET
            full_name = '$cName',
            phone_num = '$cPhone',
            email = '$cEmail',
            address = '$cAddress',
            pay_mode = '$payMode',
            status = '$status',
            grand_total = $grand_total,
            order_date = '$order_date'
            ";

            $res = mysqli_query($conn,$sql) ;
            if($res == TRUE)
            {
                $customer_id = mysqli_insert_id($conn) ;

                $sql2 = "INSERT INTO user_order SET
                        customer_id = ?,
                        product_name = ?,
                        price = ?,
                        quantity = ?,
                        total = ?,
                        pay_mode =?,
                        status = ?
                        ";            
                
                $stmt = mysqli_prepare($conn, $sql2) ;

                if($stmt == true)            
                {
                    mysqli_stmt_bind_param($stmt, "isdiiss", $customer_id, $p_name, $p_price, $p_quantity, $total, $payMode, $status) ;
                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $p_name = $value['product_title'] ;
                        $p_price = $value['product_price'] ;
                        $p_quantity = $value['qty'] ;
                        $total = $p_price * $p_quantity;
                        mysqli_stmt_execute($stmt) ;
                    }               
                    
                    unset($_SESSION['cart']);
                    echo "Dear ", $cName, ", ", "Thank you for the shopping!" ;   
                }                
            }  
            else
            {
                echo "Connection error!!" ;
            }     
        }
    }
    else
    {
        echo"Connection error!";
    }
?>