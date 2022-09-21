<?php include('partials-front/menu.php') ; ?>


        

        <!-- Search section starts -->
        <section class="search text-center">
            <!-- <div class="container"> -->
                <form action="#" method="POST" class="form1">
                    <input type="search" name="search" placeholder="Search For Therapy and Products.." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">    
                </form>
            <!-- </div> -->

        </section>
        <!-- Search section ends -->        
        

        <!-- Services section starts -->
        <section class="services">
            <h2 class="text-center">
                Our Services
            </h2>

            <div class="services-flex">                
                

            <?php

                $sql = "SELECT * FROM tbl_service WHERE active ='Yes' AND featured = 'Yes' LIMIT 3 " ;

                $res = mysqli_query($conn, $sql) ;

                $count = mysqli_num_rows($res) ;

                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $title = $row['title'] ;
                        $price = $row['price'] ;
                        $description = $row['description'] ;
                        $image_name = $row['image_name'] ;

                        ?>
                            <div class="service-items">
                                <?php
                                        if($image_name != "")
                                        {
                                            ?>
                                                    <img src="img/services/<?php echo $image_name; ?>">
                                            <?php
                                        }
                                        else
                                        {
                                            echo '<div class="error text-center">Image not available</div>' ;
                                        }
                                ?>
                                    
                                    <div class="service-title text-center">
                                        <?php echo $title ; ?> 
                                    </div>
                                    <div class="price text-center">
                                        Rs. <?php echo $price ;?>
                                    </div>
                                    <div class="book-now">                       
                                        <a href="book-now" class="btn btn-secondary">Book Now</a>
                                    </div>
                            </div>    
                        <?php
                    }
                }
                else
                {
                    echo  "<div class='error text-center'>No Service Available</div>" ;
                }
            ?>
  
                        
            </div>

            <div class=" see-all text-center">
                <a href="<?php echo SITEURL ; ?>services.php">See all Services</a>
            </div>
            
        </section>
        <!-- Services section ends -->

        <!-- Categories section starts -->
        <section class="categories">
            <h2 class="text-center">Categories</h2> 
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

                            <div class="category-items float-container">
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
                                    
                                    <h3 class="float-text text-bg"><?php  echo $title ; ?></h3>                       
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
        </section>
        <!-- categories end -->

        <!-- Featured products start --> 
       
        <section class="featured-products">
            <h2 class="text-center"> Featured Products</h2>
            <div class="product-flex">

                <?php

                        $sql3 = "SELECT * FROM tbl_product WHERE active='Yes' AND featured = 'Yes' LIMIT 6 " ;

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
                                    <form action="" method="POST"  class="product-items"> 
                                    
                                        <a href="">
                                            <img src="img/products/<?php echo $image_name ; ?>">
                                        </a>
                                        <h3 class="product-name"><?php echo $title ; ?></h3>
                                        <h4 class="price">Rs. <?php echo $price ; ?></h4>

                                        
                            
                                    </form>                                               
                                               
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='error text-center'>No products available.</div>" ;
                        }
                ?> 
            </div>                        
           
            <div class=" see-all text-center">
                <a href="<?php echo SITEURL ; ?>products.php">See all Products</a>
            </div>
        </section>

                                               
                                    
                                          




       
        <!-- featured-products end -->

        

       <?php include('partials-front/footer.php') ; ?>

       
    
       