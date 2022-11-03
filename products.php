<?php include('partials-front/menu.php') ; ?>
<!-- Search section starts -->
<section class="search text-center">
           <div class="container-fluid" >         
                <form class="d-flex justify-content-center flex-wrap" action="<?php echo SITEURL; ?>search.php" method="GET">
                    <input class="form-control" type="search" name="search" placeholder="Search for services and products">
                    <input class="btn btn-primary responsive-search-btn" type="submit" name="submit" value="Search">                   
                </form>       
           </div>
</section>
<!-- Search section ends -->   
         
<!-- select categorry ends -->
         <section class="featured-products mt-5">
            <h2 class="text-center">Products</h2>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="p-2 col-lg-3 col-md-6 col-sm-12">
                            <select class="form-select" id='selectCategory'>
                                <?php
                    
                                    $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'" ;

                                    $res2 = mysqli_query($conn, $sql2) ;

                                    $count2 = mysqli_num_rows($res2) ;

                                    if($count2>0)
                                    {
                                        while($row2 = mysqli_fetch_assoc($res2))                        
                                        {
                                            $id = $row2['id'] ;

                                            $title = $row2['title'] ;  
                                            ?>                             
                               
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></a></option>
                                            

                                            
                                            
                                        <?php
                                        }                                        
                                    }
                                   
                                        ?>
                                    <option value="" selected>All</option>        
                            </select>                               
                                
                    </div>
                </div>
            </div>
<!-- select categorry ends -->

<!-- Featured products start -->
            <div class="container-fluid">
                <div class="row m-5" id="ans">
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
                                echo "<div class='error'>Sorry, no products are added yet.</div>";
                            }
                    ?>
                </div>
            </div>
                         
        </section>       
        <!-- featured-products end -->

       
<?php include('partials-front/footer.php') ; ?>