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
            <h2>Details on <i>"<?php echo $title ; ?>"</i></h2>
</section>
        <!-- Search section ends --> 

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
           
            <h3 class="product-name"><?php echo $title ; ?></h3>
            <h4 class="price">Rs. <?php echo $price ; ?></h4>
            <div class="cart btn btn-secondary">
                <a href="cart" >Add to Cart</a>
            </div> 
    </div>
    <div class="right">
        <h2>Its benefits</h2>
        <p><?php echo $description ; ?></p>
    </div>
</div>

<?php include('partials-front/footer.php') ; ?>