<?php include("config/constants.php") ; ?>
<?php include('partials-front/menu.php'); ?>

<?php

            if(isset($_POST['update-qty']))
            {
                $id = $_POST['id'] ;
                $qty = $_POST['qty'];
                

                $sql2 = "UPDATE tbl_cart SET
                        quantity = $qty
                                                                                            
                        WHERE id=$id ";
                $res2 = mysqli_query($conn, $sql2) ;

                if($res2==TRUE)
                {
                   // echo "<script>alert('Product quantity is updated successfully.')</script>";
                     
                }
            }  
            
            
            if(isset($_GET['remove']))
            {
                $id = $_GET['remove'] ;


                $res3 = mysqli_query($conn, "DELETE FROM tbl_cart WHERE id=$id") or die(mysqli_error()) ;

                if($res3==TRUE)
                {
                    echo "<script>alert('Product is removed successfully.')</script>";
                    header("location:".SITEURL."cart.php") ;
                }
            }

            if(isset($_GET['removeAll']))
            {
                mysqli_query($conn, "DELETE FROM tbl_cart") or die(mysqli_error()) ;                
                header("location:".SITEURL."cart.php") ;
            }

        
        ?>





    <section class="search">
    <?php
                        $sql4 = "SELECT * FROM tbl_customer" ;
                        $res4 = mysqli_query($conn, $sql4);
                        $row_count = mysqli_num_rows($res4) ;
                        if($row_count==0)
                        {
                            $customer_id = $row_count + 1 ;
                           
                        }
                        else
                        {
                            $sql3 = "SELECT max(c_id) AS ID FROM tbl_customer";
                            $result = mysqli_query($conn, $sql3) or die(mysqli_error('Query failed!!'));
                            $fetch = mysqli_fetch_assoc($result) ;
                            $customer_id = $fetch['ID'];
                            $customer_id = $customer_id + 1;
                            
                        }
                        echo "Your ID is " .$customer_id;
                        
                       
                ?>
            

        

        

       
    <div class="shopping-cart">
            <div class="continue">
                    <a href="<?php echo SITEURL; ?>products.php" class="btn btn-primary">Continue Shopping</a>
            </div>
       
            <div class="table-responsive-sm">
                <table class="tbl_full">
                    
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <?php                            
                            $sql = "SELECT * FROM tbl_cart" ;
                            $res = mysqli_query($conn, $sql) ;
                            $count = mysqli_num_rows($res) ;
                            $sn = 1;
                            $grand_total = 0 ;
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'] ;
                                    $product_name = $row['title'];
                                    $price = $row['price'] ; 
                                    $qty = $row['quantity'];                               
                                    
                                    $sub_total = $qty * $price ;

                                    
                                    

                                    
                                    
                                    
                                    
                                                    
                                            
                                    ?> <tbody>
                                        <tr>
                                            <td><?php echo $sn++ ; ?></td>
                                            <td>                            
                                                <?php echo $product_name; ?>
                                               
                                            </td>     
                            
                                            <td>
                                                Rs. <?php echo $price; ?>
                                                                   
                                            </td>
                                    
                                            <td>
                                                <form action="" method="POST">
                                                <input type="hidden" name='id' value="<?php echo $id; ?>">                                                          
                                                <input type="number" name="qty" value="<?php echo $qty; ?>">
                                                <input type="submit" name="update-qty" value="Update" class="qty-btn"> 
                                                </form>                                               
                                            </td>
                                   
                                            <td>
                                                Rs. <?php echo number_format($sub_total); ?>          
                                               
                                            </td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>cart.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    <form action="" method="POST">
                                        <input type="hidden" name="product-name" value=<?php echo $product_name ;?>>
                                        <input type="hidden" name="price" value=<?php echo $price ;?>>
                                        <input type="hidden" name="qty" value=<?php echo $qty ;?>>
                                        <input type="hidden" name="sub-total" value=<?php echo $sub_total ;?>>
                                        <input type="hidden" name="customer_id" value=<?php echo $customer_id ;?>>
                                <?php
                                }
                                ?>
                                        <input type="submit" name="confirm-order" value="Confirm Order" class="btn btn-primary">
                                    </form>

                                    <?php
                                            if(isset($_POST['confirm-order']))
                                            {
                                                $product_name = $_POST['product-name'] ;
                                                $price = $_POST['price'] ;
                                                $qty = $_POST['qty'] ;
                                                $sub_total = $_POST['sub-total'] ;
                    
                                                $customer_id = $_POST['customer_id'] ;
                    
                                               
                                                
                                                $sql5 = "INSERT INTO tbl_ordered_products SET
                                                            product_name = '$product_name',
                                                            price = $price,
                                                            quantity = $qty,
                                                            sub_total = $price * $qty,
                                                            customer_id = $customer_id
                                                ";
                    
                                               
                    
                                                if(mysqli_query($conn, $sql5) == TRUE)
                                                {
                                                    echo "<script>alert('Order Placed Successfully!!')</script>";
                                                   
                                                }
                                                else
                                                {
                                                    echo "<script>alert('Error in order placement!!')</script>";
                                                   
                                                }
                    
                                            }
                                    ?>
                                    <?php

                                    
                                    
                                    $grand_total += $sub_total ; 
                                }
                            
                            else
                            {
                                ?>
                                        <tr>
                                            <td colspan="6" class="error text-center">
                                                    No any product has been added to cart yet.
                                            </td>
                                        </tr>
                                <?php
                            }
                            
                    ?>

                               

                    <tr style="background-color:#2ed573">
                            <td colspan="5" class="text-right">                                
                                   <h3>Grand Total = Rs. <?php echo number_format($grand_total) ; ?> </h3>                                   
                            </td>
                            <td>
                                
                                <a href="<?php echo SITEURL;?>cart.php?removeAll" class="btn btn-danger">Remove All</a>
                            </td>
                            
                    </tr>
                    </tbody>
                </table>    
                    <!-- <tr>
                            <td colspan="6" class="text-right">                                
                            <a href="order.php"> <input type="submit" name="order" value="Order Now" class="btn btn-primary"> </a>
                                
                            </td>
                    </tr> -->
                    
                <div class="checkout">
                    
                    <form action="" method="POST" class="order">
                            <fieldset>
                                <legend>Fill the delivery details</legend>  
                                
                                <div class="order-label">Full Name</div>
                                <input type="text" name="fullname" placeholder="E.g. Chamkala Rai" class="input-responsive" required>

                                <div class="order-label">Phone number</div>
                                <input type="text" name="phone" placeholder="E.g. 9842******" class="input-responsive" required>

                                <div class="order-label">Email</div>
                                <input type="email" name="email" placeholder="E.g. chamkalarai@gmail.com" class="input-responsive" required>

                                <div class="order-label">Address</div>
                                <textarea name="address" rows="10" placeholder="E.g. Kharsala Tole, Itahari-20" class="input-responsive" required></textarea>
                                <br><br>

                                


                                <input type="hidden" name="grand-total" value=<?php echo $grand_total ;?>>
                                <input type="submit" name="confirm-order" value="Confirm Order" class="btn btn-primary">
                                
                        </fieldset>
                    </form>
                </div>

                <?php
                        
                ?>

               
        </div>
    </div>
    </section>
    

        <?php include('partials-front/footer.php');?>