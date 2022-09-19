<?php include("partials/menu.php") ?> ;

<section id="content">

    <h2>Add Service</h2>
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

        <form action="" method="POST" enctype="multipart/form-data">

            <table class = "tbl_30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter product title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                          <textarea name="description" id="" cols="30" rows="10" placeholder="Enter product description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Enter product price">
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td> 
                    
                    <td>
                        <select name="category_id">
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
                        <input type="submit" name="submit" value="Add Service" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'] ;
                $description = $_POST['description'] ;
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

                    if($image_name!="")
                    {
                        $ext = end(explode('.', $image_name)) ;

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

<?php include("partials/footer.php") ?> ;