<?php include('partials-front/menu.php') ; ?>

<?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'] ;

            $sql = "SELECT * FROM tbl_product WHERE id=$id" ;

            $res = mysqli_query($conn, $sql) ;

            $count = mysqli_num_rows($res) ;

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res) ;

                $title = $row['title'] ;
                $description = $row['description'] ;
                $price = $row['price'] ;
                $image_name = $row['image_name'] ;

            }
            else
            {
                header("location:".SITEURL) ;
            }
        }
        else
        {
            header("location:".SITEURL) ;
        }
?>

         <!-- Search section starts -->
         <section class="search text-center">
           <div class="container" >         
                <h2 style="color:#341f97;font-weight:bold;">Details on <i>"<?php echo $title ; ?>"</i></h2>   
           </div>
        </section>
        <!-- Search section ends -->  
<div class="container my-5 text-center">
    <a href="<?php echo SITEURL;?>products.php"><button class="btn btn-outline-primary">Go Back</button></a>
</div>
<div class="container">
<div class="description">
    <div class="left">
        <?php
                if($image_name != "")
                {
                    ?>
                             <img src="img/products/<?php echo $image_name ; ?>" alt="">
                    <?php
                }
                else
                {
                    echo "<div class='error text-center'>No image available</div>" ;
                }
        ?>
           
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
    <div class="right">
        <h2>Its benefits</h2>
        <p><?php echo $description ; ?></p>
    </div>
</div>
</div>
<?php include('partials-front/footer.php') ; ?>