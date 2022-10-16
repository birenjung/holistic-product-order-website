<?php include("partials/menu.php"); ?> 


 <!-- content section starts -->
 <section id="content">
            <h2>Add Admin</h2><br>
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
                        //echo "clicked" ;
                        // 1. Get all the values from Form
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']) ;
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name'])  ;
                        $username = mysqli_real_escape_string($conn, $_POST['username'])  ;
                        $password = mysqli_real_escape_string($conn, md5($_POST['pwd'])) ;
                        
                        // 2. Sql query
                        $sql = "INSERT INTO tbl_admin SET
                                first_name = '$first_name',
                                last_name = '$last_name',
                                username = '$username',
                                password = '$password'
                        
                        " ;

                        // 3. Run the sql query
                        $res = mysqli_query($conn, $sql) ;
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

                ?>
            </div>
        </section>
        <!-- content section ends -->


<?php include("partials/footer.php"); ?> 