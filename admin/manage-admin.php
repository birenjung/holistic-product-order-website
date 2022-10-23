<?php include("partials/menu.php"); ?> 

<!-- content section starts -->
<section id="content">
    <h2>Manage Admin</h2>
        
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

    <div class="container-fluid">
        <div class="add_button">
            <a href="<?php echo SITEURL ; ?>admin/add-admin.php"><button class="btn btn-outline-primary">ADD ADMIN</button></a> 
        </div>
        <div class="jq-filter">
            <input type="text" id="jq-filter" class="form-control" placeholder="Search">
        </div>
        <div class="clear-fix"></div>
        
        <div class="table-responsive">
            <table class="table table-responsive table-bordered mt-2" id="a_table">
                <thead class="table-light rounded">
                <tr>
                    <th>SN</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                </thead>

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
                                

                                ?>  <tbody>
                                    <tr>
                                        <td><?php echo $sn++ ; ?></td>
                                        <td><?php echo $first_name ; ?></td>
                                        <td><?php echo $last_name ; ?></td>
                                        <td><?php echo $username ; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL ;?>admin/update-admin.php?id=<?php echo $id; ?>"><button class="btn btn-sm btn-outline-secondary">UPDATE <i class="fa-sharp fa-solid fa-pen"></i></button></a>                                                   
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#a<?php echo $id; ?>">DELETE <i class="fa-solid fa-trash"></i></button>                                                                  
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="a<?php echo $id; ?>" tabindex="-1" aria-labelledby="a<?php echo $id; ?>Label" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            Delete
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span >
                                                                                Are you sure to delete <?php echo $first_name; ?> ?
                                                                            </span>                                                                                    
                                                                        </div> 
                                                                        <div class="modal-footer">                                                                                
                                                                            <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id; ?>"><button class="btn btn-sm btn-outline-danger">CONFIRM</i></button></a>
                                                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        </div>                                                                          
                                                                    </div>
                                                                </div>
                                                            </div> 
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
                                </tbody>
                                <?php
                            }
                        }

                        
                ?>  
            </table>
        </div>
    </div>
</section>
<!-- content section ends -->


 <?php include("partials/footer.php"); ?> 

       