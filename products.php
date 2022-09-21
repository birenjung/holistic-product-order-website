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
        
         <!-- Featured products start -->

         <section class="featured-products">
            <h2 class="text-center">Products</h2>
            <div class="product-flex">

                <?php  
                        $sql = "SELECT * FROM tbl_product WHERE active='Yes' " ;

                        $res = mysqli_query($conn, $sql) ;

                        $count= mysqli_num_rows($res);

                        if($count>0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'] ;
                                $title = $row['title'] ;
                                $description = $row['description'] ;
                                $price = $row['price'] ;
                                $image_name = $row['image_name'] ;
                                
                                ?>
                                    <div class="product-items">
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
                                           
                                            <h3 class="product-name"><?php echo $title ; ?></h3>
                                            <h4 class="price">Rs. <?php echo $price ; ?></h4>
                                            <div class="cart">
                                            <form action="manage_cart.php" method="POST">
                                                <input type="hidden" name="id" value=<?php echo $id ;?>>
                                                <input type="hidden" name="title" value=<?php echo $title ;?>>
                                                <input type="hidden" name="price" value=<?php echo $price ;?>>
                                                <input type="hidden" name="image_name" value=<?php echo $image_name ;?>>
                                                <input type="submit" name="add_to_cart" value="Add to cart" class="btn btn-secondary">
                                            </form>
                                                
                                            </div>                        
                                        </a>
                                    </div>       

                                <?php                               
                                
                            }
                        }
                        else
                        {

                        }
                ?>
                         
        </section>       
        <!-- featured-products end -->

       
<?php include('partials-front/footer.php') ; ?>