<?php include("partials/menu.php") ?> ;



        <!-- content section starts -->
        <section id="content">
            <h2>Manage Product Category</h2>
            <br>

            <?php
               
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'] ;
                    unset($_SESSION['add']) ;
                }
                if(isset($_SESSION['unautho']))
                {
                    echo $_SESSION['unautho'] ;
                    unset($_SESSION['unautho']) ;
                }
                if(isset($_SESSION['no-data']))
                {
                    echo $_SESSION['no-data'] ;
                    unset($_SESSION['no-data']) ;
                }                
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'] ;
                    unset($_SESSION['update']) ;
                }                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'] ;
                    unset($_SESSION['delete']) ;
                }
               

            ?>
            <br>
            <div class="container">
                <a href="<?php echo SITEURL; ?>admin/add-category.php"><button class="btn-primary">Add Product Category</button></a> 
               
                    <table class="tbl_full text-left">
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                        
                        <?php

                            $sql = "SELECT * FROM tbl_category" ;

                            $res = mysqli_query($conn, $sql) or die(mysqli_error()) ;

                            if($res==TRUE)
                            {
                                $count = mysqli_num_rows($res) ;

                                $sn = 1 ;                               

                                if($count>0) 
                                {
                                                                       

                                    while($row = mysqli_fetch_assoc($res))
                                    {                                      
                                        $id = $row['id'] ;
                                        $title = $row['title'] ;
                                        $image_name = $row['image_name'] ;
                                        $featured = $row['featured'] ;
                                        $active = $row['active'] ;

                                        ?>

                                            <tr>
                                                <td><?php echo $sn++ ; ?></td>
                                                <td><?php echo $title ; ?></td>
                                                <td>
                                                    
                                                    <?php 
                                                    
                                                    if($image_name == "")
                                                    {
                                                        echo "<div class='error'>No Image Added</div>" ;
                                                    } 
                                                    else
                                                    {
                                                        ?>
                                                        <img src="../img/product-category/<?php echo $image_name;?>" alt="category-image" width=100px;>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $featured ; ?></td>
                                                <td><?php echo $active ; ?></td>
                                                
                                                <td>
                                                    <a href="<?php echo SITEURL ;?>admin/update-category.php?id=<?php echo $id; ?>"><button class="btn-secondary">Update</button></a>
                                                    <a href="<?php echo SITEURL ;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><button class="btn-danger">Delete</button></a>
                                                </td>
                                                
                                            </tr>

                                        <?php

                                    }
                                }
                                else
                                {
                                    ?>
                                            <tr>
                                                <td  colspan="6" class="error text-center">
                                                !! No Categories Available !!
                                                </td>
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

       