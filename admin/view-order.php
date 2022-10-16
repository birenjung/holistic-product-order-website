<?php include("partials/menu.php"); ?>  


<!-- content section starts -->
<section id="content">
    <?php
        if(isset($_GET['id'])) {
            $customer_id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order_manager WHERE customer_id = $customer_id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $c_name = $row['full_name'];
    ?>
    <h2 class="mb-2">Order of '<?php echo $c_name;  ?>'</h2>
    <p class="mb-2 text-danger"><?php echo $row['order_date']; ?></p>
    
    <div class="container">
        <a href="<?php echo SITEURL; ?>admin/manage-order.php"><button class="btn btn-outline-dark">Back</button></a><br><br>
        
        <div class="table-responsive">
            <table class="table table-responsive" style="width:500px;">
                <thead class="table-success">
                    <th>SN</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </thead>
                <tbody>
                <?php             
                    
                    $sql = "SELECT * FROM user_order WHERE customer_id=$customer_id";
                    $res = mysqli_query($conn, $sql) ;
                    $sn = 1;
                    $gt=0;                        
                        if(mysqli_num_rows($res)>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {   
                                $price = $row['price'];
                                $qty = $row['quantity'];
                                ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $row['product_name']; ?></td>
                                        
                                            <td><?php echo $row['price']; ?></td>
                                        
                                            <td><?php echo $row['quantity']; ?></td>
                                        
                                            <td>
                                                <?php $subtotal = $row['total']; $gt += $subtotal; echo $subtotal; ?>
                                            </td>
                                        
                                <?php
                            }
                        }
                        else
                        {
                            $_SESSION['no_customer'] = "<div class='error'>!! Invalid Id !!</div>" ;
                            header("location:".SITEURL."admin/manage-order.php") ;
                        }
                ?>   
                </tr>
                <tr>
                    <td colspan="5"><button class="btn btn-success">Grand Total = " Rs <?php echo $gt; ?> "</button></td>
                </tr>                        
                </tbody>
           
                <?php

                }
                else
                {
                $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
                header("location:".SITEURL."admin/manage-order.php") ;
                }    
                ?>
            </table>
        </div>
    </div>
</section>
<!-- content section ends -->
<?php include("partials/footer.php"); ?> 