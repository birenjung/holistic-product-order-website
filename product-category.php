<?php include('partials-front/menu.php') ; ?>

        <?php
            if(isset($_GET['id']))
            {
                $category_id = $_GET['id'] ;

                $sql = "SELECT * FROM tbl_category WHERE id = $category_id" ;

                $res = mysqli_query($conn, $sql) ;

                $row = mysqli_fetch_assoc($res) ;

                $title = $row['title'] ;

                
            }
            else
            {
                header("location:".SITEURL) ;
            }

        ?>
        <!-- Search section starts -->
        <section class="search text-center">

                        <h2 style='color:white';>
                            Products on "<i><?php echo $title ; ?></i>"
                        </h2>

        </section>
        <!-- Search section ends -->    
        
         <!-- Featured products start -->

         <section class="featured-products">
            <h2 class="text-center"> Products on "<i><?php echo $title ; ?></i>"</h2>
            <div class="container">
                <div class="row mt-5">

                <?php
                        $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id AND active='Yes' " ;

                        $res2 = mysqli_query($conn, $sql2) ;

                        $count = mysqli_num_rows($res2) ;

                        if($count>0)
                        {
                            while($row2=mysqli_fetch_assoc($res2))
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
                                                    
                                                        <form action="manage_cart.php" method="POST">
                                                            <input type="hidden" name="id" value=<?php echo $id ;?>>
                                                            <input type="hidden" name="title" value=<?php echo $title ;?>>
                                                            <input type="hidden" name="price" value=<?php echo $price ;?>>
                                                            <input type="hidden" name="image_name" value=<?php echo $image_name ;?>>
                                                            <button type="submit" name="add_to_cart" class="btn btn-success text-center">Add <i class="fa-solid fa-cart-plus"></i></button>   
                                                        </form>                                                
                                                </div>                      
                                            </div>
                                        </div>       

                                    <?php                               
                                    
                            }
                        }
                        else
                        {
                            echo "<div class='error text-center'>No products available</div>" ;
                        }
                ?>                          
                
            
        </section>       
        <!-- featured-products end -->

<?php include('partials-front/footer.php') ; ?>