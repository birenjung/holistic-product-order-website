<?php include('partials-front/menu.php') ; ?>

<?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'] ;

            $sql = "SELECT * FROM tbl_service WHERE id=$id" ;

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
    <a href="<?php echo SITEURL;?>services.php"><button class="btn btn-outline-primary">Go Back</button></a>    
</div>
<div class="container">
<div class="description">
    <div class="left">
        <?php
                if($image_name != "")
                {
                    ?>
                             <img src="img/services/<?php echo $image_name ; ?>" alt="">
                    <?php
                }
                else
                {
                    echo "<div class='error text-center'>No image available</div>" ;
                }
        ?>
           
           <div class="caption text-center mt-2">
                <h5 class="product-name"><?php echo $title ; ?></h5>
                <div class="text-center">
                    Rs. <?php echo $price ;?>
                </div>                                                       

                <a href="<?php echo SITEURL; ?>booking.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-success text-center mt-1">Book</button></a>
                                
            </div>      
    </div>
    <div class="right">
        <h2>Its benefits</h2>
        <p><?php echo $description ; ?></p>
    </div>
</div>
</div>
<?php include('partials-front/footer.php') ; ?>