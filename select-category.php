<?php
        include("config/constants.php") ;

        $k = $_POST['id'] ;

        if($k != "")
        {
            $sql = "SELECT * FROM tbl_product WHERE category_id = '{$k}' AND active = 'Yes' ";

            $res = mysqli_query($conn, $sql) ;

            $count = mysqli_num_rows($res);

            if ($count>0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'] ;
                    $title = $row['title'] ;
                    $description = $row['description'] ;
                    $price = $row['price'] ;
                    $image_name = $row['image_name'] ;
                    
                    ?>
                        <div class="product-flex col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="thumbnail">
                                <a href="<?php echo SITEURL ; ?>description.php?id=<?php echo $id ; ?>">
                                    <?php
                                            if($image_name != '')
                                            {
                                                ?>
                                                        <img src="img/products/<?php echo $image_name ?>">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class='error text-center'>No image available</div>" ;
                                            }
                                    ?>
                                </a>
                                
                                <div class="caption text-center">
                                    <h5 class="product-name"><?php echo $title ; ?></h5>
                                    <div class="price text-center">
                                        Rs. <?php echo $price ;?>
                                    </div>   
                                    
                                        <form class="cart-form">
                                            <input type="hidden" id="pid" value=<?php echo $id ;?>>
                                            <label id="title" hidden><?php echo $title; ?></label>
                                            <input type="hidden" id="price" value=<?php echo $price ;?>>
                                            <input type="hidden" value=<?php echo $image_name ;?>>
                                            <button type="submit" class="btn btn-success text-center addToCartBtn mt-1">Add <i class="fa-solid fa-cart-plus"></i></button>   
                                        </form> 
                                    <div class="message"></div>                                               
                                </div>                      
                            </div>
                        </div>       

                    <?php                    
                }
            }
            else
            {
                echo "<div class='error'>Sorry, there are no any products in this category.</div>" ;
            }

        }

        if($k == "")
        {
             
                            $sql2 = "SELECT * FROM tbl_product WHERE active='Yes' " ;

                            $res2 = mysqli_query($conn, $sql2) ;

                            $count2= mysqli_num_rows($res2);

                            if($count2>0)
                            {
                                while($row2 = mysqli_fetch_assoc($res2))
                                {
                                    $id = $row2['id'] ;
                                    $title = $row2['title'] ;
                                    $description = $row2['description'] ;
                                    $price = $row2['price'] ;
                                    $image_name = $row2['image_name'] ;
                                    
                                    ?>
                                        <div class="product-flex col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="thumbnail">
                                                <a href="<?php echo SITEURL ; ?>description.php?id=<?php echo $id ; ?>">
                                                    <?php
                                                            if($image_name != '')
                                                            {
                                                                ?>
                                                                        <img src="img/products/<?php echo $image_name ?>">
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                echo "<div class='error text-center'>No image available</div>" ;
                                                            }
                                                    ?>
                                                </a>
                                                
                                                <div class="caption text-center">
                                                    <h5 class="product-name"><?php echo $title ; ?></h5>
                                                    <div class="price text-center">
                                                        Rs. <?php echo $price ;?>
                                                    </div>   
                                                    
                                                        <form class="cart-form">
                                                            <input type="hidden" id="pid" value=<?php echo $id ;?>>
                                                            <label id="title" hidden><?php echo $title; ?></label>
                                                            <input type="hidden" id="price" value=<?php echo $price ;?>>
                                                            <input type="hidden" value=<?php echo $image_name ;?>>
                                                            <button type="submit" class="btn btn-success text-center addToCartBtn mt-1">Add <i class="fa-solid fa-cart-plus"></i></button>   
                                                        </form> 
                                                    <div class="message"></div>                                               
                                                </div>                      
                                            </div>
                                        </div>       

                                    <?php                               
                                    
                                }
                            }
                            else
                            {
                                echo "<div class='error'>Sorry, no products are added yet.</div>";
                            }
        } 
             
?>