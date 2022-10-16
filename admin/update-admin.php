<?php include("partials/menu.php"); ?> 

<section id="content">

    <h2>Update Admin</h2><br>

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
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name'])  ;
                        $username = mysqli_real_escape_string($conn, $_POST['username'])  ;
                        $password = mysqli_real_escape_string($conn, md5($_POST['password'])) ;

                        $sql2 = "UPDATE tbl_admin SET
                                first_name = '$first_name',
                                last_name = '$last_name',
                                username = '$username',
                                password = '$password'

                                WHERE id = $admin_id;
                        " ;

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
        ?>

    </div>

</section>

<?php include("partials/footer.php"); ?> 