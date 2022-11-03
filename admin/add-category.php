<?php include("partials/menu.php"); ?> 

        <!-- content section starts -->
        <section id="content">

            <h2>Add Product Category</h2>

            <?php

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'] ;
                    unset($_SESSION['upload']) ;
                }
                if(isset($_SESSION['format']))
                {
                    echo $_SESSION['format'] ;
                    unset($_SESSION['format']) ;
                }
                if(isset($_SESSION['too_large']))
                {
                    echo $_SESSION['too_large'] ;
                    unset($_SESSION['too_large']) ;
                }
            ?>  
            <br>         

            <div class="container">
                <a href="<?php echo SITEURL; ?>admin/manage-category.php"><button class="btn btn-outline-dark">Back</button></a><br><br>              
                <form method="POST" enctype="multipart/form-data">

                <div class="table-responsive">
                    <table class="table table-responsive table-borderless" style="width:450px;"> 
                        <tr>
                            <td>Title:</td>
                            <td>
                                <input type="text" name="title" class="form-control" placeholder="Enter category title" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Upload image:</td>
                            <td>
                                <input type="file" class="form-control" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes"> Yes
                                <input type="radio" name="featured" value="No"> No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes"> Yes
                                <input type="radio" name="active" value="No"> No
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="DONE" class="btn btn-primary">
                            </td>
                        </tr>
                    </table>
                </div>
                </form>

                <?php

                    if(isset($_POST['submit']))
                    {
                        $title = mysqli_real_escape_string($conn, $_POST['title']) ; 
                        $title = trim($title);                

                        if(isset($_POST['featured']))
                        {
                            $featured = $_POST['featured'] ;
                        }
                        else
                        {
                            $featured = "No" ;
                        }
                        
                        if(isset($_POST['active']))
                        {
                            $active = $_POST['active'] ;
                        }
                        else
                        {
                            $active = "No" ;
                        }

                        if(isset($_FILES['image']['name']))  // If upload button is clicked
                        {
                            $image_name = $_FILES['image']['name'] ;
                            if($_FILES['image']['size'] > 1000000)
                            {
                                $_SESSION['too_large'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong> Your file is too large.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>' ;
                                header("location:".SITEURL."admin/add-category.php") ;
                                die() ;
                            }
                            else
                            {
                                if($image_name != "")
                                {                       
                                    // Rename                            
                                    $ext = end(explode('.',$image_name)) ; 
                                    $allowed_ext = array("jpg", "png", "jpeg") ;
                                    if(in_array($ext, $allowed_ext))
                                    {
                                        $date = time() ; 
                                        $image_name="category_".$date.'.'.$ext;    
                                        $source_path = $_FILES['image']['tmp_name'] ;                               
                                        $destination_path = "../img/product-category/".$image_name ;    
                                        $upload = move_uploaded_file($source_path, $destination_path) ;    
                                        if($upload==FALSE)
                                        {                                        
                                            $_SESSION['upload'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Sorry!</strong> Failed to Upload Image.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>' ;
                                            header("location:".SITEURL."admin/add-category.php") ;
                                            die() ;
                                        }
                                    }
                                    else
                                    {
                                        $_SESSION['format'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong> You cannot upload files of this type.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>' ;
                                        header("location:".SITEURL."admin/add-category.php") ;
                                        die() ;
                                    }                            
                                }                            
                            }                        
                        }
                        else
                        {     // If upload buttion is not clicked; if any image is not selected
                            // Don't upload the image. Set its value blank
                            $image_name = "" ;
                        }                    

                            // SQL Query
                            $sql = "INSERT INTO tbl_category SET
                            
                                    title = '$title',
                                    image_name = '$image_name',
                                    featured = '$featured',
                                    active = '$active'
                            ";

                            $res = mysqli_query($conn, $sql) ;

                            if($res==TRUE)
                            {
                                $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Category Added Successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>' ;
                                header("location:".SITEURL."admin/manage-category.php") ;
                            }
                            else
                            {
                                $_SESSION['add'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong>  Failed to Add Category.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>' ;
                                header("location:".SITEURL."admin/manage-category.php") ;
                        
                            }
                        
                    }

                    
                ?>
            </div>
        </section>
        <!-- content section ends -->

 <?php include("partials/footer.php"); ?> 

       