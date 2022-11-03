<?php include("partials/menu.php"); ?> 

<section id="content">

    <h2>Update order</h2><br>

    <div class="container">
        <a href="<?php echo SITEURL; ?>admin/manage-order.php"><button class="btn btn-outline-dark">Back</button></a><br><br>

        <?php
            if(isset($_GET['id']))
            {
                // declare var id and assign retrived value to it
                $customer_id = $_GET['id'] ;

                $sql = "SELECT * FROM tbl_order_manager WHERE customer_id = $customer_id " ;

                $res = mysqli_query($conn, $sql) or die(mysqli_error());

                $count = mysqli_num_rows($res) ;

                if($count==1)
                {   
                    // if a row is available then fetch data from that row to show later in form inputs in order to update
                    $row = mysqli_fetch_assoc($res) ;

                    $full_name = $row['full_name'] ;
                    $address = $row['address'] ;
                    $phone_num = $row['phone_num'] ;
                    $email = $row['email'] ;
                    $status=$row['status'];
                }
                else
                {
                    // Validation
                    $_SESSION['no-user'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong> No User Available
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>' ;
                    header("location:".SITEURL."admin/manage-order.php") ;
                }

            
            }
            else
            {
                $_SESSION['unautho'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry!</strong> Unauthorized Access
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                header("location:".SITEURL."admin/manage-order.php") ;
            }
        ?>

        <form action="" method="POST">
            <div class="table-responsive">
            <table class="table table-borderless" style="width:400px;">
                <tr>
                    <td>Fisrt Name:</td>
                    <td>
                        <input type="text" name="full_name" class="form-control" value="<?php echo $full_name ; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <textarea type="text" name="address" class="form-control" rows="5"><?php echo $address ; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="text" name="phone_num" class="form-control" value="<?php echo $phone_num ; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" ; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Status:
                    </td>
                    <td>
                        <select name="status" class="form-select">
                            <option <?php if($status=="Ordered") {echo"selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery") {echo"selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered") {echo"selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled") {echo"selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
                        <input type="submit" name="submit" value="DONE" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
            </div>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
               // echo "clicked";
                        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']) ;
                        $full_name = trim($full_name);
                        $address = mysqli_real_escape_string($conn, $_POST['address']) ;
                        $address = trim($address);
                        $phone_num = mysqli_real_escape_string($conn, $_POST['phone_num']) ;
                        $email = mysqli_real_escape_string($conn, $_POST['email']) ;
                        $status = $_POST['status'];

                        $sql2 = "UPDATE tbl_order_manager SET
                                full_name = '$full_name',
                                address = '$address',
                                phone_num = '$phone_num',
                                email = '$email',
                                status = '$status'

                                WHERE customer_id = $customer_id;
                        " ;

                        $res2 = mysqli_query($conn, $sql2) ;

                        if($res==true)
                        {
                            $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                             Admin Updated Successfully
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            header("location:".SITEURL."admin/manage-order.php") ;
                        }
                        else
                        {
                            $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> Failed to Update Admin
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>' ;
                            header("location:".SITEURL."admin/manage-order.php") ;
                        }
            }
        ?>

    </div>

</section>

<?php include("partials/footer.php"); ?> 