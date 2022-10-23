<?php include("partials/menu.php"); ?> 

<section id="content">

    <h2>Update Admin</h2>
    
        <?php
                if(isset($_SESSION['invalid_pwd']))
                {
                    echo $_SESSION['invalid_pwd'];
                    unset($_SESSION['invalid_pwd']);
                }
                if(isset($_SESSION['username_taken']))
                {
                    echo $_SESSION['username_taken'];
                    unset($_SESSION['username_taken']);
                }
        ?>
    
    <br>

    <div class="container">
        <a href="<?php echo SITEURL; ?>admin/manage-admin.php"><button class="btn btn-outline-dark">Back</button></a><br><br>

        <?php
            if(isset($_GET['id']))
            {
                // declare var id and assign retrived value to it
                $admin_id = $_GET['id'] ;

                $sql = "SELECT * FROM tbl_admin WHERE id = $admin_id " ;

                $res = mysqli_query($conn, $sql) or die(mysqli_error());

                $count = mysqli_num_rows($res) ;

                if($count==1)
                {   
                    // if a row is available then fetch data from that row to show later in form inputs in order to update
                    $row = mysqli_fetch_assoc($res) ;

                    $first_name = $row['first_name'] ;
                    $last_name = $row['last_name'] ;
                    $username = $row['username'] ;
                    $password = $row['password'] ;
                }
                else
                {
                    // Validation
                    $_SESSION['no-user'] = "<div class='error'>!! No User Available !!</div>" ;
                    header("location:".SITEURL."admin/manage-admin.php") ;
                }

            
            }
            else
            {
                $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
                header("location:".SITEURL."admin/manage-admin.php") ;
            }
        ?>

        <form action="" method="POST">
            <div class="table-responsive">
            <table class="table table-borderless" style="width:400px;">
                <tr>
                    <td>Fisrt Name:</td>
                    <td>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name ; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name ; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" class="form-control" value="<?php echo $username ; ?>">
                        <div class="form-text">When updated, username must be changed.</div>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" class="form-control" value="" ; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
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
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']) ;
                        $first_name = trim($first_name);
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name'])  ;
                        $last_name = trim($last_name);
                        $username = mysqli_real_escape_string($conn, $_POST['username'])  ;
                        $username = trim($username);
                        $password = $_POST['password'];

                        // Validate password strength
                        $uppercase = preg_match('@[A-Z]@', $password);
                        $lowercase = preg_match('@[a-z]@', $password);
                        $number    = preg_match('@[0-9]@', $password);
                        $specialChars = preg_match('@[^\w]@', $password);


                        $sql = "SELECT username FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);
                        /* associative array */
                        $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
                        
                        foreach($row as $key => $value)
                        {
                            $username_list = array_column($row, 'username');
                           
                        }                        
                        if(in_array($username, $username_list))
                        {
                            $_SESSION['username_taken'] = "<div class='error'>!! Username is taken. Try with another one. !!</div>";
                            header("location:".SITEURL."admin/update-admin.php?id=$admin_id");
                            die();
                           
                        }
                        else
                        {
                            if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                                $_SESSION['invalid_pwd'] = "<div class='error'> Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</div>";
                                header("location:".SITEURL."admin/update-admin.php?id=$admin_id");
                                die();
                            }
                            else
                            {
                                $new_pwd = password_hash("$password", PASSWORD_DEFAULT);   
                                $sql2 = "UPDATE tbl_admin SET
                                    first_name = '$first_name',
                                    last_name = '$last_name',
                                    username = '$username',
                                    password = '$new_pwd'
    
                                    WHERE id = $admin_id;
                            " ;
                            }                        
    
                            $res2 = mysqli_query($conn, $sql2) ;
    
                            if($res==true)
                            {
                                $_SESSION['update'] = "<div class='success'>!! Admin Updated Successfully !!</div>" ;
                                header("location:".SITEURL."admin/manage-admin.php") ;
                            }
                            else
                            {
                                $_SESSION['update'] = "<div class='error'>!! Failed to Update Admin !!</div>" ;
                                header("location:".SITEURL."admin/manage-admin.php") ;
                            }
                        }                
            }
        ?>

    </div>

</section>

<?php include("partials/footer.php"); ?> 