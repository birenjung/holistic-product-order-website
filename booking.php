<?php include('partials-front/menu.php') ;?>

    <div class="container">
        <?php
            if(isset($_SESSION['invalid_ph']))
            {
                echo $_SESSION['invalid_ph'];
                unset($_SESSION['invalid_ph']);
            }
        ?>
    </div>

        <br><?php
    

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_service WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            ?>
                    <div class="container-fluid bg-light p-4 mb-5">
                        <div class="container d-flex flex-column align-items-center">
                            <h3 class="mb-4 text-success">Booking for <?php echo $row['title'];  ?></h3>
                            
                            <form style="width:320px;" method="POST" class="booking p-3">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="c_name" placeholder="E.g. Manrani Rai" required>                                
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea cols="30" rows="3" class="form-control" name="address" placeholder="E.g. Kharsala Tole, Itahari-20" required></textarea>                                
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="E.g. 9827*****9" required> 
                                                                
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pick a date</label>
                                    <input type="date" class="form-control" name="booked_date" required> 
                                    <div class="form-text">We will call you to fix a time.</div>                               
                                    <div class="form-text">हामी तपाईंलाई समय तालिका तय गर्न कल गर्नेछौं।</div>                               
                                </div>   
                                <input type="hidden" name="title" value="<?php echo $row['title']?>">  
                                <input type="hidden" name="price" value="<?php echo $row['price']?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    
                                <button name="submit" class="btn btn-outline-primary">Submit</button>
                            </form>
                        </div>
                    </div>
            <?php
            
                                if(isset($_POST['submit'])) 
                                {                                   
                                    $c_name = mysqli_real_escape_string( $conn, $_POST['c_name']);
                                    $c_name = trim($c_name);
                                    $address = mysqli_real_escape_string( $conn, $_POST['address']);
                                    $address = trim($address);
                                    $phone = $_POST['phone'];
                                    $phone = trim($phone);
                                    $booked_date = $_POST['booked_date'];
                                    $title = mysqli_real_escape_string( $conn, $_POST['title']);
                                    $price = $_POST['price'];
                                    $date = date('y-m-d h:i:sa');
                                    $status = 'Booked';
                                    $given_time = 'SET TIME';
                                    $_SESSION['id'] = $id;

                                    
                                        if(preg_match('/^[0-9]{10}+$/', $phone)) 
                                        {   
                                            $sql = "INSERT INTO tbl_booking SET
                                            c_name = '$c_name',
                                            address = '$address',
                                            phone = '$phone',
                                            booked_date = '$booked_date',
                                            given_time = '$given_time',
                                            service = '$title',
                                            price = '$price',
                                            status = '$status',
                                            date = '$date'                 
                                            
                                            ";
                                        
                                            $res = mysqli_query($conn, $sql);

                                            if($res==TRUE)
                                            {                                                   
                                                    $_SESSION['book'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>Thank you!</strong> You have successfully booked a date.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    header('location:'.SITEURL.'services.php');
                                            }
                                            else
                                            {
                                                    $_SESSION['book'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Sorry!</strong> Failed to book a date.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    header('location:'.SITEURL.'services.php');
                                            }             
                                        }
                                        else
                                        {
                                                                                    
                                            $_SESSION['invalid_ph'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Sorry!</strong> Please enter valid phone number and try again.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';                  
                                            header("location:".SITEURL."booking.php?id=".$_SESSION['id']);                                                              
                                            die();
                                        }                              
                                }
        }
        else
        {
            header('location:'.SITEURL);
        }

    }
    else
    {
        header('location:'.SITEURL);
    }


?>  


<?php include('partials-front/footer.php') ; ?>  