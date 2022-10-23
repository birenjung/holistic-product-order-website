<?php include("partials/menu.php"); ?> 

<section id="content">

    <h2>Update Service</h2>
            <?php

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'] ;
                        unset($_SESSION['upload']) ;
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'] ;
                        unset($_SESSION['remove']) ;
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
    <?php

        if(isset($_GET['id']))
        {
            $service_id = $_GET['id'] ;

            $sql = "SELECT * FROM tbl_service WHERE id = $service_id" ;

            $res = mysqli_query($conn, $sql) ;

            $count = mysqli_num_rows($res) ;

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res) ;

                $title = $row['title'] ;
                $description = $row['description'] ;
                $price = $row['price'] ;
                $category_id = $row['category_id'] ;
                $current_image = $row['image_name'] ;
                $featured = $row['featured'] ;
                $active = $row['active'] ;
                

            }
            else
                    {
                        // Validation
                        $_SESSION['no-data'] = "<div class='error'>!! No Product Available !!</div>" ;
                        header("location:".SITEURL."admin/manage-services.php") ;
                    }
        }
        else
        {
            $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
            header("location:".SITEURL."admin/manage-services.php") ;
        }

    ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <div class="table-responsive">
            <table class="table table-borderless" style="width:450px;">
                <tr>
                    <td>Title:</td>
                    <td>
                        <label class="form-label"><?php echo $title; ?></label>
                        <input type="text" name="title" class="form-control" value = <?php echo $title; ?> required>                        
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" class="form-control" cols="30" rows="10" required><?php echo $description; ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="form-control" value = <?php echo $price; ?> required>
                    </td>
                </tr>

                <tr>
                    <td>Current image:</td>
                    <td>
                            <?php
                                    if($current_image != "")
                                    {
                                        ?>
                                                <img src="../img/services/<?php echo $current_image; ?>" width=100px>
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'>No image available</div>" ;
                                    }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>Upload new image:</td>
                    <td>
                        <input type="file" name="image" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                           <select name="category_id" class="form-select">

                                    <?php
                                            $sql2 = "SELECT * FROM tbl_s_category WHERE active='Yes'" ;

                                            $res2 = mysqli_query($conn, $sql2) ;

                                            while($row2 = mysqli_fetch_assoc($res2))
                                            {
                                                $id = $row2['sc_id'] ;
                                                $title = $row2['sc_title'] ;

                                                ?>
                                                        <option <?php if($category_id == $id) {echo "selected" ;} ?> value="<?php echo $id ; ?>"> <?php echo $title ; ?> </option>
                                                <?php
                                            }
                                    ?>
                           </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" <?php if($featured=='Yes') {echo"checked";} ?> value="Yes"> Yes
                        <input type="radio" name="featured" <?php if($featured=='No') {echo"checked";} ?> value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" <?php if($active=='Yes') {echo"checked";} ?> value="Yes"> Yes
                        <input type="radio" name="active" <?php if($active=='No') {echo"checked";} ?> value="No"> No
                    </td>
                </tr>
                <tr>                    
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="" value="<?php echo $current_image; ?>">
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
                    $title = trim($title);
                    $description = mysqli_escape_string($conn, $_POST['description']) ;
                    $description = trim($description);
                    $price = $_POST['price'] ;
                    $featured = $_POST['featured'] ;
                    $active = $_POST['active'] ;
                    $new_category_id = $_POST['category_id'] ;

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'] ;                        
                        if($_FILES['image']['size'] > 1000000)
                        {
                            $_SESSION['too_large'] = "<div class='error'>!! Sorry, your file is too large !!</div>" ;
                            header("location:".SITEURL."admin/update-service.php?id=$service_id") ;
                            die() ;
                        }
                        else
                        {
                            // Upload                        
                            if($image_name != "")
                            {
                                $ext = end(explode('.',$image_name)) ;
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
                                            header("location:".SITEURL."admin/update-service.php?id=$service_id") ;
                                            die() ;
                                        }
                                        
                                            if($current_image != "")
                                            {
                                                $r_path = "../img/products/".$current_image ;
    
                                                $remove = unlink($r_path) ;
    
                                                if($remove==FALSE)
                                                {
                                                    $_SESSION['remove'] = "<div class='error'>!! Failed to Remove Image !!</div>" ;
                                                    header("location:".SITEURL."admin/update-product.php?id=$service_id") ;
                                                    die() ;
                                                }
                                            }
                                }
                                else
                                {
                                    $_SESSION['format'] = "<div class='error'>!! You can't upload files of this type !!</div>" ;
                                    header("location:".SITEURL."admin/update-service.php?id=$service_id") ;
                                    die() ;
                                }                                
                            }
                            else
                            {
                                $image_name = $current_image ;
                            }
                        }                                       
                    }
                    else
                    {
                        $image_name = $current_image ;
                    }


                    // Update
                    $sql3 = "UPDATE tbl_service SET
                            
                            title = '$title',
                            description = '$description',
                            price = $price,
                            category_id = $new_category_id,
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'

                            WHERE id = $service_id;
                            
                    " ;

                    $res3 = mysqli_query($conn, $sql3) ;

                    if($res3==TRUE)
                    {
                        $_SESSION['update'] = "<div class='success'>!! Service Updated Successfully !!</div>" ;
                        header("location:".SITEURL."admin/manage-services.php") ;
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>!! Failed to Update Service !!</div>" ;
                        header("location:".SITEURL."admin/manage-services.php") ;
                    }
                }

        ?>
        
    </div>
</section>

<?php include("partials/footer.php"); ?> 