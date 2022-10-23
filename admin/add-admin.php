<?php include("partials/menu.php"); ?> 


 <!-- content section starts -->
 <section id="content">
            <h2>Add Admin</h2>
            <?php
                    if(isset( $_SESSION['invalid_pwd']))
                    {
                        echo  $_SESSION['invalid_pwd'];
                        unset( $_SESSION['invalid_pwd']);
                    }
                    if(isset( $_SESSION['username_taken']))
                    {
                        echo  $_SESSION['username_taken'];
                        unset( $_SESSION['username_taken']);
                    }
            ?>            
            <br>
            <div class="container">
                <a href="<?php echo SITEURL; ?>admin/manage-admin.php"><button class="btn btn-outline-dark">Back</button></a><br><br>
                <form method="POST">
                    <div class="table-responsive">
                        <table class="table table-borderless" style="width:400px;">
                            <tr>
                                <td>First Name:</td>
                                <td>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Username:</td>
                                <td>
                                    <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                                    <div class="form-text">Username must be unique.</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="pwd" class="form-control" placeholder="Enter password" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="DONE" class=" btn btn-primary">
                                </td>
                            </tr>
                        </table> 
                    </div>               
                </form>

                <?php
                    if(isset($_POST['submit']))
                    {
                        echo "clicked" ;
                        // 1. Get all the values from Form
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']) ;
                        $first_name = trim($first_name);
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name'])  ;
                        $last_name = trim($last_name);
                        $username = mysqli_real_escape_string($conn, $_POST['username'])  ;
                        $username = trim($username);
                        $password = mysqli_real_escape_string($conn, $_POST['pwd']) ;
                        
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
                            header("location:".SITEURL."admin/add-admin.php");
                            die();
                           
                        }
                        else
                        {
                            if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                                $_SESSION['invalid_pwd'] = "<div class='error'> Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</div>";
                                header("location:".SITEURL."admin/add-admin.php");
                                die();
                            }
                            else
                            {                          
                                $new_pwd = password_hash("$password", PASSWORD_DEFAULT);   
                                // 2. Sql query
                                $sql = "INSERT INTO tbl_admin SET
                                        first_name = '$first_name',
                                        last_name = '$last_name',
                                        username = '$username',
                                        password = '$new_pwd'
                                
                                " ;
                            }
    
                                // 3. Run the sql query
                                $res = mysqli_query($conn, $sql);   
                                if($res==TRUE)
                                {
                                    $_SESSION['add'] = "<div class='success'>!! Admin Added Successfully !!</div>" ;
                                    header("location:".SITEURL."admin/manage-admin.php") ;
                                }
                                else
                                {
                                    $_SESSION['add'] = "<div class='error'>!! Failed to Add Admin !!</div>" ;
                                    header("location:".SITEURL."admin/manage-admin.php") ;
                                }                            
                        }                    
                        
                    }

                ?>
            </div>
        </section>
        <!-- content section ends -->


<?php include("partials/footer.php"); ?> 