<?php include("partials/menu.php"); ?> 

        <!-- content section starts -->
        <section id="content">
            <h2>Manage Bookings</h2>
                <?php
                    if(isset($_SESSION['no_data']))
                    {
                        echo $_SESSION['no_data'];
                        unset($_SESSION['no_data']);
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
                ?>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                            <th>SN</th>
                            <th>Patient Name</th>
                            <th>Address</th>
                            <th>Phone</th>                            
                            <th>Service</th>
                            <th>Price</th>
                            <th>Booked Date</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM tbl_booking";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $sn = 1;
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $row['c_name'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td><?php echo $row['phone'];?></td>
                                        <td><?php echo $row['service'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td><?php echo $row['booked_date'];?></td>
                                        <td><?php 
                                                    if($row['given_time']=="SET TIME")
                                                    { echo "<label style='color:red;'>SET TIME</label>";}
                                                    else
                                                    {
                                                        echo $row['given_time'];
                                                    }
                                            ?>
                                        </td>
                                        <td><?php echo $row['date'];?></td>
                                        <td>
                                            <?php 
                                                if($row['status'] == "Complete")
                                                {
                                                    echo "<label style='color:green;'>Completed</label>";
                                                }
                                                elseif($row['status'] == "Cancelled")
                                                {
                                                    echo "<label style='color:red;'>Cancelled</label>";
                                                }
                                                else
                                                {
                                                    echo $row['status'];
                                                }
                                                
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-outline-secondary">UPDATE <i class="fa-sharp fa-solid fa-pen"></i></button></a>
                                        </td>
                                    <?php
                                }                             

                            }
                            else
                            {
                                ?>
                                    <td colspan='11' class="text-center text-danger">
                                        No any bookings yet!                                        
                                    </td>
                                <?php
                            }
                        ?>
                        
                            </tr>
                        </tbody>

                                          
                        
                        
                    </table>
            </div>
        </section>
        <!-- content section ends -->


 <?php include("partials/footer.php"); ?> 

       