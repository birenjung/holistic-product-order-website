<?php include("partials/menu.php"); ?> 

<section id="content">

    <h2>Add Service</h2>
    
            <?php

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
        <a href="<?php echo SITEURL; ?>admin/manage-services.php"><button class="btn btn-outline-dark">Back</button></a><br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        <div class="table-responsive">
            <table class="table table-responsive table-borderless" style="width:450px;">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" class="form-control" placeholder="Enter product title" required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                          <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Enter product description" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="form-control" placeholder="Enter product price" required>
                    </td>
                </tr>
                <tr>
                    <td>Upload image:</td>
                    <td>
                        <input type="file" name="image" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td> 
                    
                    <td>
                        <select name="category_id" class="form-select">
                            <?php

                                $sql = "SELECT * FROM tbl_s_category WHERE active='Yes' " ;

                                $res = mysqli_query($conn, $sql) ;

                                $count = mysqli_num_rows($res) ;

                                if($count>0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_id = $row['sc_id'] ;
                                        $category_title = $row['sc_title'] ;

                                        ?>
                                            <option value="<?php echo $category_id ; ?>"><?php echo $category_title ; ?></option>   
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <option value="0" class='error'>!! No Active Categories !!</option> 
                                    <?php
                                }
                            ?>
                        </select>
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
                $title = mysqli_escape_string($conn, $_POST['title']) ;
                $description = mysqli_escape_string($conn, $_POST['description']) ;
                $price = $_POST['price'] ;
                $category_id = $_POST['category_id'] ;

                if(!isset($_POST['featured']))
                {
                    $featured = "No" ; // Default Value
                }
                else
                {
                    $featured = $_POST['featured'] ;
                }

                if(!isset($_POST['active']))
                {
                    $active = "No" ; // Default Value
                }
                else
                {
                    $active = $_POST['active'] ;
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'] ;
                    if($_FILES['image']['size'] > 1000000)
                        {
                            $_SESSION['too_large'] = "<div class='error'>!! Sorry, your file is too large !!</div>" ;
                            header("location:".SITEURL."admin/add-service.php") ;
                            die() ;
                        }
                        else
                        {
                            if($image_name!="")
                            {
                                $ext = end(explode('.', $image_name)) ;
                                $allowed_ext = array("jpg", "png", "jpeg") ;
                                if(in_array($ext, $allowed_ext))
                                {
                                    $date = time() ;
            
                                    $image_name = "Service-".$date.".".$ext ;
                
                                    $s_path = $_FILES['image']['tmp_name'] ;
                
                                    $d_path = "../img/services/".$image_name ;
                
                                    $upload = move_uploaded_file($s_path, $d_path) ;
                
                                    if($upload==FALSE)
                                    {
                                        $_SESSION['upload'] = "<div class='error'>!! Failed to Upload Image !!</div>" ;
                                        header("location:".SITEURL."admin/add-service.php") ;
                                        die() ;
                                    }
                                }
                                else
                                {
                                    $_SESSION['format'] = "<div class='error'>!! You can't upload files of this type !!</div>" ;
                                    header("location:".SITEURL."admin/add-service.php") ;
                                    die() ;
                                }
                                
                            }
                        }                                       
                }
                else
                {
                    $image_name = '' ;
                }       
                
                
                
                
                $sql2 = " INSERT INTO tbl_service SET
                            title = '$title',
                            description = '$description',
                            price = $price,
                            image_name = '$image_name',
                            category_id = $category_id,
                            featured = '$featured',
                            active = '$active'
                 " ;

                 $res2 = mysqli_query($conn, $sql2) ;

                    if($res2==TRUE)
                    {
                        $_SESSION['add'] = "<div class='success'>!! Service Added Successfully !!</div>" ;
                        header("location:".SITEURL."admin/manage-services.php") ;
                    }                        
                    else
                    {
                        $_SESSION['add'] = "<div class='error'>!! Failed to Add Service !!</div>" ;
                        header("location:".SITEURL."admin/manage-services.php") ;
                        
                    }
                 

            }
        ?>
        
    </div>
</section>

<?php include("partials/footer.php"); ?> 