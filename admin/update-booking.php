<?php     
    include('partials/menu.php');
    if($_GET['id'])
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_booking WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            ?>
                <div class="container my-5">
                    <h2>Update Booking</h2><br>
                    <a href="<?php echo SITEURL; ?>admin/manage-booking.php"><button class="btn btn-outline-dark">Back</button></a><br><br>     
                    <div class="table-responsive">
                        <form method="POST">
                            <?php
                                    $row=mysqli_fetch_assoc($res);
                            ?>
                        <table class="table table-borderless" style="width:350px;">
                            <tr>
                                <td>Service:</td>
                                <td><?php echo $row['service']; ?></td>
                            </tr> 
                            <tr>
                                <td>Price:</td>
                                <td><?php echo $row['price']; ?></td>
                            </tr>
                            <tr>
                                <td>Patient Name:</td>
                                <td><?php echo $row['c_name']; ?></td>
                            </tr>                        
                            <tr>
                                <td>Booked Date</td>
                                <td>
                                    <input type="date" class="form-control" name="date" value="<?php echo $row['booked_date']; ?>">
                                </td>
                            </tr> 
                            <tr>
                                <td>Time</td>
                                <td>
                                    <input type="text" class="form-control timepicker" name="time" value="<?php echo $row['given_time']; ?>">
                                </td>
                            </tr>  
                            <tr>
                                <td>Status</td>
                                <td>
                                    <select name="status" class="form-select">
                                        <option value="Booked" <?php if($row['status']=="Booked"){echo "selected";} ?>>Booked</option>
                                        <option value="Complete" <?php if($row['status']=="Complete"){echo "selected";} ?>>Complete</option>
                                        <option value="Cancelled" <?php if($row['status']=="Cancelled"){echo "selected";} ?>>Cancelled</option>                                        
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button name="submit" class="btn btn-secondary">DONE</button>
                                </td>
                            </tr>               
                        </table>
                        </form>
                    </div>  
                </div>
            <?php
                            if(isset($_POST['submit']))
                            {
                                $date = $_POST['date'];
                                $time = $_POST['time'];
                                $status = $_POST['status'];
                                $sql = "UPDATE tbl_booking SET
                                        booked_date ='$date',
                                        given_time ='$time',
                                        status = '$status'

                                        WHERE id = $id
                                        ";
                                $res = mysqli_query($conn, $sql);
                                if($res==TRUE)
                                {
                                    $_SESSION['update'] = "<div class='success'>!! Updated Successfully !!</div>";
                                    header("location:".SITEURL."admin/manage-booking.php");
                                }
                                else
                                {
                                    $_SESSION['update'] = "<div class='error'>!! Failed to update !!</div>";
                                    header("location:".SITEURL."admin/manage-booking.php");
                                }
                            }
        }
        else
        {
            $_SESSION['no_data'] = "<div class='error'>!! No data available !!</div>";
            header("location:".SITEURL."admin/manage-booking.php");

        }
    }
    else
    {
        $_SESSION['unautho'] = "<div class='error'>!! Unauthorized access !!</div>";
        header("location:".SITEURL."admin/manage-booking.php");
    }
    include('partials/footer.php');
?>
