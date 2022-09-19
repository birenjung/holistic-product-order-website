<?php include("partials/menu.php") ?> ;

        <!-- content section starts -->
        <section id="content">

            <h2>Add Category</h2>
            <br>

            <?php

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'] ;
                    unset($_SESSION['upload']) ;
                }
            ?>
            <br>

            <div class="container">
                
            <form method="POST" enctype="multipart/form-data">

                <table class="tbl_30">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Enter category title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                if(isset($_POST['submit']))
                {
                    $title = $_POST['title'] ;        
                    

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

                    if(isset($_FILES['image']))  // If upload button is clicked
                    {
                        $image_name = $_FILES['image']['name'] ;

                        if($image_name != "")
                        {
                       
                            // Rename
                            
                            $ext = end(explode('.',$image_name)) ;                        

                            $date = time() ;

                            

                            $image_name="category_".$date.'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'] ;

                           
                            $destination_path = "../img/product-category/".$image_name ; //http://localhost/amp-holistic/img/product-category/

                            $upload = move_uploaded_file($source_path, $destination_path) ;

                            if($upload==FALSE)
                            {
                                $_SESSION['upload'] = "<div class='error'>!! Failed to Upload Image !!</div>" ;
                                header("location:".SITEURL."admin/add-category.php") ;
                                die() ;
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
                            $_SESSION['add'] = "<div class='success'>!! Category Added Successfully !!</div>" ;
                            header("location:".SITEURL."admin/manage-category.php") ;
                        }
                        else
                        {
                            $_SESSION['add'] = "<div class='error'>!! Failed to Add Category !!</div>" ;
                            header("location:".SITEURL."admin/manage-category.php") ;
                     
                        }
                    
                }

                
            ?>
            </div>

        </section>
        <!-- content section ends -->


 <?php include("partials/footer.php") ?> ;

       