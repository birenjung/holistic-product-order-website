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
                        <?php
                            if(isset($_SESSION['book']))
                            {
                                echo $_SESSION['book'];
                                unset($_SESSION['book']);
                            }
                        ?>
            </div>
            <div class="container">
                <div class="row">

                <?php
                        $sql = "SELECT * FROM tbl_service WHERE active ='Yes' ";

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
                            echo "<div class='error text-center'>No products available.</div>" ;
                        }
                ?> 
                </div>
            </div> 
        </section>
        <!-- Services section ends -->


<?php include('partials-front/footer.php') ; ?>