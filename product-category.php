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
            <h2 class="text-center"> Featured Products</h2>
            <div class="product-flex">

                <?php
                        $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id AND active='Yes' " ;

                        $res2 = mysqli_query($conn, $sql2) ;

                        $count = mysqli_num_rows($res2) ;

                        if($count>0)
                        {
                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                $product_id = $row2['id'] ;
                                $title = $row2['title'] ;
                                $price = $row2['price'] ;
                                $description = $row2['description'] ;
                                $image_name = $row2['image_name'] ;

                                ?>
                                    <div class="product-items">
                                        <a href="">
                                            <?php
                                                
                                                if($image_name != "")
                                                {
                                                    ?>
                                                        <img src="img/products/<?php echo $image_name ; ?>">
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<div class='error text-center'>No image available</div>" ;
                                                }
                                            ?>
                                            
                                            <h3 class="product-name"><?php echo $title ; ?></h3>
                                            <h4 class="price">Rs. <?php echo $price ; ?></h4>
                                            <div class="cart btn btn-secondary">
                                                <a href="cart" >Add to Cart</a>
                                            </div>                        
                                        </a>
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