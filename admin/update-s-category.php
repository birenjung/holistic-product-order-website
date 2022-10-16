<?php include("partials/menu.php"); ?> 

        <!-- content section starts -->
    <section id="content">
            <h2>Update Service Category</h2>
                    <?php
                            if(isset($_SESSION['remove']))
                            {
                                echo $_SESSION['remove'] ;
                                unset($_SESSION['remove']) ;
                            }
                            if(isset($_SESSION['upload']))
                            {
                                echo $_SESSION['upload'] ;
                                unset($_SESSION['upload']) ;
                            }
                            if(isset($_SESSION['too_large']))
                            {
                                echo $_SESSION['too_large'] ;
                                unset($_SESSION['too_large']) ;
                            }
                            if(isset($_SESSION['format']))
                            {
                                echo $_SESSION['format'] ;
                                unset($_SESSION['format']) ;
                            }
                    ?> 
                    <br>           
            
        <div class="container">
            <a href="<?php echo SITEURL; ?>admin/manage-s-category.php"><button class="btn btn-outline-dark">Back</button></a><br><br>
                
            <?php

                if(isset($_GET['id']))
                {
                    $id = $_GET['id'] ;

                    $sql = "SELECT * FROM tbl_s_category WHERE sc_id=$id" ;

                    $res = mysqli_query($conn, $sql) ;

                    $count = mysqli_num_rows($res) ;

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res) ;

                        $id = $row['sc_id'] ;

                        $title = $row['sc_title'] ;

                        $current_image = $row['image_name'] ;

                        $featured = $row['featured'] ;

                        $active = $row['active'] ;
                    }
                    else
                    {
                        // Validation
                        $_SESSION['no-data'] = "<div class='error'>!! No Category Available !!</div>" ;
                        header("location:".SITEURL."admin/manage-s-category.php") ;
                    }
                }
                else
                {
                    $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
                    header("location:".SITEURL."admin/manage-s-category.php") ;
                }

                $sql = "SELECT * FROM tbl_s_category" ;

                $res
            ?>
                   <form action="" method="POST" enctype="multipart/form-data">
                   <div class="table-responsive">
                        <table class="table table-borderless" style="width:450px;">
                            <tr>
                                <td>Title:</td>
                                <td>
                                    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Current image:</td>
                                <td>
                                    <?php
                                            if($current_image != "")
                                            {
                                                ?>
                                                    <img src="<?php echo SITEURL ; ?>img/service-category/<?php echo $current_image;?>" width=90px;>
                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class = 'error'>No image available</div>" ;
                                            }
                                    ?>
                                      
                                </td>
                            </tr>
                            <tr>                                
                                <td>
                                    Upload new image:
                                </td>
                                <td>
                                    <input type="file" name="image" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>Featured:</td>
                                <td>
                                    <input type="radio" name="featured" <?php if($featured=='Yes') {echo 'checked' ;} ?> value="Yes">Yes
                                    <input type="radio" name="featured" <?php if($featured=='No') {echo 'checked' ;} ?> value="No">No
                                </td>
                            </tr>                          
                            <tr>
                                <td>Active:</td>
                                <td>
                                    <input type="radio" name="active" <?php if($active=='Yes') {echo 'checked' ;} ?> value="Yes">Yes
                                    <input type="radio" name="active" <?php if($active=='No') {echo 'checked' ;} ?> value="No">No
                                </td>
                            </tr>  
                            
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="id" value=<?php echo $id; ?>>
                                    <input type="hidden" name="" value=<?php echo $current_image; ?>>
                                    <input type="submit" name="submit" value="DONE" class="btn btn-secondary">
                                </td>
                            </tr>
                        </table>
                    </div>
                   </form>

                   <?php
                        if(isset($_POST['submit']))                        
                        {
                            $title = mysqli_escape_string($conn, $_POST['title']) ;
                            $featured = $_POST['featured'] ;
                            $active = $_POST['active'] ;
                        

                            // Upload image
                            if(isset($_FILES['image']['name']))
                            {
                                $image_name = $_FILES['image']['name'] ;                                
                                if($_FILES['image']['size'] > 1000000)
                                {
                                    $_SESSION['too_large'] = "<div class='error'>!! Sorry, your file is too large !!</div>" ;
                                    header("location:".SITEURL."admin/update-s-category.php?id=$id") ;
                                    die() ;
                                }
                                else
                                {
                                    if($image_name != "")
                                    {
                                        $ext = end(explode('.', $image_name)) ;
                                        $allowed_ext = array('jpg','jpeg','png');
                                        if(in_array($ext, $allowed_ext))
                                        {
                                            $date = time() ;
    
                                            $image_name = "s_category_".$date.'.'.$ext;
                                            
                                            $source_path = $_FILES['image']['tmp_name'] ;
        
                                            $destination_path = "../img/service-category/".$image_name ;                                
                                        
                                            $upload = move_uploaded_file($source_path, $destination_path) ;
        
                                            if($upload==FALSE)
                                            {
                                                $_SESSION['upload'] = "<div class='error'>!! Failed to Upload Image !!</div>" ;
                                                header("location:".SITEURL."admin/update-s-category.php?id=$id") ;
                                                die() ;
                                            }
        
                                                $remove_path = "../img/service-category/".$current_image ;
            
                                                if($current_image != "")
                                                {
                                                    $remove = unlink($remove_path) ;
            
                                                    if($remove==FALSE)
                                                    {
                                                        $_SESSION['remove'] = "<div class='error'>!! Failed to Remove Image !!</div>" ;
                                                        header("location:".SITEURL."admin/update-s-category.php?id=$id") ;
                                                        die() ;
                                                    }
                                                }
                                        } 
                                        else
                                        {
                                            $_SESSION['format'] = "<div class='error'>!! You can't upload files of this type !!</div>" ;
                                            header("location:".SITEURL."admin/update-s-category.php?id=$id") ;
                                            die() ;
                                        }                           
                                    }  
                                    else
                                    {
                                        //if there is no any image to upload, 
                                        $image_name = $current_image ;
                                    }                        
    
                                }                                                                
                            }
                            else
                            {
                                // If image is not selected to upload
                                $image_name = $current_image;
                            }
                           
                            // Create a sql query to update
                            $sql2 = "UPDATE tbl_s_category SET

                                    sc_title = '$title',
                                    image_name = '$image_name',
                                    featured = '$featured',
                                    active = '$active'
                                    
                            WHERE sc_id = $id
                            " ;

                            $res2 = mysqli_query($conn, $sql2) ;

                            if($res2==TRUE)
                            {
                                $_SESSION['update'] = "<div class='success'>!! Category Updated Successfully !!</div>" ;
                                header("location:".SITEURL."admin/manage-s-category.php") ;
                            }
                            else
                            {
                                $_SESSION['update'] = "<div class='error'>!! Failed to Update Category !!</div>" ;
                                header("location:".SITEURL."admin/manage-s-category.php") ;
                            }
                        }
                        
                   ?>
        </div>
    </section>
        <!-- content section ends -->

 <?php include("partials/footer.php"); ?> 

       
