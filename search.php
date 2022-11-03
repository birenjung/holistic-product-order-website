<?php include('partials-front/menu.php') ; ?> 
<!-- Search section starts -->
<section class="search text-center">
           <div class="container-fluid" >         
           <?php
                    if(isset($_GET['submit']))
                    {
                        $search = mysqli_escape_string( $conn, $_GET['search']);
                    }
                    else
                    {
                        header("location:".SITEURL);
                    }
            ?>  
             <h2 style="color:white">Products and services on Your Search <i>"<?php echo $search; ?>"</i></h2> 
           </div>

</section>
<!-- Search section ends -->    

<div class="container mt-5">
    <h2 class="text-center">Products</h2>
    <?php
            $sql = "SELECT * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";            
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
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
                echo "<div class='error text-center'><strong>Sorry!</strong> There are no any products with the type you searched.</div>";
            }
    ?>
</div>

<div class="container my-5">
    <h2 class="text-center">Services</h2>
    <?php
        $sql = "SELECT * FROM tbl_service WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($conn, $sql) ;
        $count = mysqli_num_rows($res) ;
        if($count>0)
        {
            while($row = mysqli_fetch_assoc($res))                            
            {
                $id = $row['id'] ;
                $title = $row['title'] ;
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
            echo "<div class='error text-center'><strong>Sorry!</strong> There are no any services with the type you searched.</div>";
        }
    ?>
</div>

<?php include('partials-front/footer.php') ; ?>