<?php include('config/constants.php'); ?>
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

                $sql = "SELECT * FROM tbl_service WHERE active ='Yes' AND featured = 'Yes' " ;

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
                                    <img src="img/services/<?php echo $image_name; ?>">
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
            
        </section>
        <!-- Services section ends -->
<?php include('partials-front/footer.php') ; ?>