<?php include("partials/menu.php") ?> ;


 <!-- content section starts -->
 <section id="content">
            <h2>Add Admin</h2>
            <div class="container">
                <form method="POST">
                    <table class="tbl_30">
                        <tr>
                            <td> First Name :</td>
                            <td>
                                <input type="text" name="first_name" placeholder="Enter first name"> <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name :</td>
                            <td>
                                <input type="text" name="last_name" placeholder="Enter last name">
                            </td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td>
                                <input type="text" name="username" placeholder="Enter username">
                            </td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td>
                                <input type="password" name="pwd" placeholder="Enter password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Admin" class=" btn btn-primary">
                            </td>
                        </tr>

                    </table>             
                     
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


<?php include("partials/footer.php") ?> ;