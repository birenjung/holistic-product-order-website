<?php include("partials/menu.php") ?> ;



        <!-- content section starts -->
        <section id="content">
            <h2>Manage Admin</h2>

                <br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'] ;
                        unset($_SESSION['add']) ;
                    }
                    if(isset( $_SESSION['unautho']))
                    {
                        echo  $_SESSION['unautho'] ;
                        unset( $_SESSION['unautho']) ;
                    }
                    if(isset( $_SESSION['no-user']))
                    {
                        echo  $_SESSION['no-user'] ;
                        unset( $_SESSION['no-user']) ;
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo   $_SESSION['update'] ;
                        unset( $_SESSION['update']) ;
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo   $_SESSION['delete'] ;
                        unset( $_SESSION['delete']) ;
                    }
                    if(isset($_SESSION['login']))
                    {
                        echo   $_SESSION['login'] ;
                        unset( $_SESSION['login']) ;
                    }
                    
                ?>
                <br>

            <div class="container">
                <a href="<?php echo SITEURL ; ?>admin/add-admin.php"><button class="btn-primary">Add Admin</button></a> 
                    <table class="tbl_full text-left">
                        <tr>
                            <th>SN</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>

                        <?php
                                // Get data from Databse
                                $sql = "SELECT * FROM tbl_admin" ;

                                $res = mysqli_query($conn, $sql) ;

                                if($res==true)
                                {
                                    // check whether we have data
                                    $count = mysqli_num_rows($res) ;

                                    $sn = 1 ;

                                    if($count>0)
                                    {
                                        while($row = mysqli_fetch_assoc($res))                                        
                                        {
                                            $id = $row['id'] ;
                                            $first_name = $row['first_name'] ;
                                            $last_name = $row['last_name'] ;
                                            $username = $row['username'] ;
                                        

                                        ?>
                                            <tr>
                                                <td><?php echo $sn++ ; ?></td>
                                                <td><?php echo $first_name ; ?></td>
                                                <td><?php echo $last_name ; ?></td>
                                                <td><?php echo $username ; ?></td>
                                                <td>
                                                    <a href="<?php echo SITEURL ;?>admin/update-admin.php?id=<?php echo $id; ?>"><button class="btn-secondary">Update</button></a>
                                                    <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id; ?>"><button class="btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }

                                        
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="5" class="error text-center">!! No Admin Added Yet !!</td>
                                            </tr>
                                        <?php
                                    }
                                }

                                
                        ?>
  
                    </table>
            </div>
        </section>
        <!-- content section ends -->


 <?php include("partials/footer.php") ?> ;

       