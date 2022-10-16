<?php include('partials-front/menu.php') ; ?>  
       <!-- Search section starts -->
        <section class="search text-center">
           <div class="container-fluid" >         
                <form class="d-flex justify-content-center flex-wrap" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search for services and products" aria-label="Search">
                    <button class="btn btn-primary responsive-search-btn" type="submit" name="search">Search</button>
                </form>       
           </div>

        </section>
        <!-- Search section ends -->        
        

        <!-- Services section starts -->
        <section class="services mt-5 border-bottom">
        <h2 class="text-center">Services</h2>
            <div class="container">
                <div class="row">

                <?php
                        $sql = "SELECT * FROM tbl_service WHERE active ='Yes' AND featured = 'Yes' LIMIT 3 " ;

                        $res = mysqli_query($conn, $sql) ;

                        $count = mysqli_num_rows($res) ;

                        if($count>0)
                        {
                            while($row = mysqli_fetch_assoc($res))                            
                            {
                                $id = $row['id'] ;
                                $title = htmlspecialchars($row['title']) ;
                                $price = $row['price'] ;
                                $description = $row['description'] ;
                                $image_name = $row['image_name'] ;
                                ?>
                                    <div class="product-flex col-lg-4 col-md-6 col-sm-12">
                                            <div class="thumbnail">
                                                <a href="<?php echo SITEURL ; ?>description.php?id=<?php echo $id ; ?>">
                                                    <?php
                                                            if($image_name != '')
                                                            {
                                                                ?>
                                                                        <img src="img/services/<?php echo $image_name ?>">
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                echo "<div class='error text-center'>No image available</div>" ;
                                                            }
                                                    ?>
                                                </a>
                                                
                                                <div class="caption text-center mt-2">
                                                    <h5 class="product-name"><?php echo $title ; ?></h5>
                                                    <div class="text-center">
                                                        Rs. <?php echo $price ;?>
                                                    </div>                                                
                                                    <a href="<?php echo SITEURL; ?>booking.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-success text-center mt-1">Book</button></a>                                                                                               
                                                </div>                      
                                            </div>
                                    </div>                                              
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='error text-center'>No products available.</div>" ;
                        }
                ?> 
                </div>
            </div> 

            <div class=" see-all text-center mb-5">
                <a href="<?php echo SITEURL ; ?>services.php">See all Services</a>
            </div>
        </section>
        <!-- Services section ends -->

        <!-- Categories section starts -->
        <section class="categories border-bottom">
            <h2 class="text-center">Categories</h2> 
            <div class="container">
            <div class="row">
                <div class="categories-flex">
                    
                    <?php
    
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 " ;

                            $res2 = mysqli_query($conn, $sql2) ;

                            $count2 = mysqli_num_rows($res2) ;

                            if($count2>0)
                            {
                                while($row2 = mysqli_fetch_assoc($res2))                        
                                {
                                    $id = $row2['id'] ;

                                    $title = $row2['title'] ;                       
                            
                                    $image_name = $row2['image_name'] ;

                                    ?>

                                    <div class="category-items float-container col-lg-4 col-md-6">
                                        <a href="<?php echo SITEURL ; ?>product-category.php?id=<?php echo $id; ?>"> 
                                            <?php
                                                    if($image_name != "")
                                                    {
                                                        ?>
                                                                <img src="img/product-category/<?php echo $image_name ; ?>">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        echo '<div class="error text-center">No image available</div>' ;
                                                    }
                                            ?>
                                            
                                            <!-- <h3 class="float-text text-bg"></h3> -->
                                            <div class="caption mt-2">
                                                <h3 class="text-center"><?php  echo $title ; ?></h3>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                }

                                
                            }
                            else
                            {
                                echo '<div class="error text-center">No product categories available</div>' ;
                            }
                        ?>
                    </div>
                </div>


            </div> 
            </div>
        </section>
        <!-- categories end -->

        <!-- Featured products start -->        
        <section class="featured-products mt-5">
            <h2 class="text-center"> Featured Products</h2>
            <div class="container">
                <div class="row m-5">

                <?php

                        $sql3 = "SELECT * FROM tbl_product WHERE active='Yes' AND featured = 'Yes' LIMIT 8 " ;

                        $res3 = mysqli_query($conn, $sql3) ;

                        $count3= mysqli_num_rows($res3);

                        if($count3>0)
                        {
                            while($row3 = mysqli_fetch_assoc($res3))
                            {
                                $id = $row3['id'] ;
                                $title = $row3['title'] ;                               
                                $price = $row3['price'] ;
                                $image_name = $row3['image_name'] ;
                                
                                ?>
                                    <div class="product-flex col-lg-4 col-md-6 col-sm-12">
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
                                                            <button type="submit" class="btn btn-success text-center addToCartBtn mt-1" data-bs-toggle="modal" data-bs-target="#b<?php echo $id ;?>">Add <i class="fa-solid fa-cart-plus"></i></button>                                                                 
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="b<?php echo $id ;?>" tabindex="-1" aria-labelledby="b<?php echo $id ;?>Label" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <?php echo $title; ?>
                                                                                </div>
                                                                                <div class="modal-body cartMessage">
                                                                                                                                                                       
                                                                                </div> 
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Ok</button>                                                                                    
                                                                                </div>                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                        </form> 
                                                                                               
                                                </div>                      
                                            </div>
                                        </div>                                              
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='error text-center'>No products available.</div>" ;
                        }
                ?> 
                </div>
            </div>
            <div class=" see-all text-center mb-5">
                <a href="<?php echo SITEURL ; ?>products.php">See all Products</a>
            </div>
        </section>            
        <!-- featured-products end -->

<?php include('partials-front/footer.php') ; ?>

       
    
       