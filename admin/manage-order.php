<?php include("partials/menu.php"); ?> 
        <!-- content section starts -->
<section id="content">
    <h2>Manage Orders</h2>
        <?php
                if(isset($_SESSION['no-user']))
                {
                    echo $_SESSION['no-user'];
                    unset($_SESSION['no-user']);
                }
                if(isset($_SESSION['unautho']))
                {
                    echo $_SESSION['unautho'];
                    unset($_SESSION['unautho']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['no_customer']))
                {
                    echo $_SESSION['no_customer'];
                    unset($_SESSION['no_customer']);
                }
        ?>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered mt-2">
                <thead class="table-light">
                <tr>
                    <th>SN</th>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Paymode</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Grand Total</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    <?php
                            $sql = "SELECT * FROM tbl_order_manager";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res) ;
                            $sn = 1;
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $row['full_name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['phone_num']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['pay_mode']; ?></td>
                                            <td>
                                                <?php 
                                                    $status = $row['status'];
                                                    if($status=="ordered")
                                                    {
                                                        echo "<label>Ordered</label>";
                                                    }
                                                    elseif($status=="On Delivery")
                                                    {
                                                        echo "<label style='color:orange'>On Delivary</label>";
                                                    }
                                                    elseif($status=="Delivered")
                                                    {
                                                        echo "<label style='color:green'>Delivered</label>";
                                                    }
                                                    elseif($status=="Cancelled")
                                                    {
                                                        echo "<label style='color:red'>Cancelled</label>";
                                                    }
                                            
                                                ?>           
                                            </td>
                                            <td>
                                                <?php echo $row['order_date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['grand_total'] ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-customer-details.php?id=<?php echo $row['customer_id']; ?>"><button class="btn btn-sm btn-outline-secondary">UPDATE <i class="fa-sharp fa-solid fa-pen"></i></button></a>                        
                                                <a href="<?php echo SITEURL; ?>admin/view-order.php?id=<?php echo $row['customer_id']; ?>"><button class="btn btn-sm btn-outline-primary">VIEW ORDER</button></a>                        
                                            </td>
                                        
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <td colspan='8' class='error text-center'>There is no any order.</td>
                                <?php
                            }
                    ?> 
                    <tr>               
                </tbody>         
            </table>
        </div>
    </div>
</section>
<!-- content section ends -->

 <?php include("partials/footer.php"); ?> 

       