<?php include("partials/menu.php"); ?>

<!-- content section starts -->
<section id="content">
    <h2>Dashboard</h2>
    <div class="container">
    <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
    ?>  
    </div>  
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Product Category</h4>
                <h4>
                <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        echo mysqli_num_rows($res);
                ?>
                </h4>
            </div>
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Service Category</h4>
                <h4>
                <?php
                        $sql = "SELECT * FROM tbl_s_category";
                        $res = mysqli_query($conn, $sql);
                        echo mysqli_num_rows($res);
                ?>
                </h4>
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Services</h4>
                <h4>
                <?php
                        $sql = "SELECT * FROM tbl_service";
                        $res = mysqli_query($conn, $sql);
                        echo mysqli_num_rows($res);
                ?>
                </h4>
            </div>
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Products</h4>
                <h4>
                <?php
                        $sql = "SELECT * FROM tbl_product";
                        $res = mysqli_query($conn, $sql);
                        echo mysqli_num_rows($res);
                ?>
                </h4>
            </div>           
        </div>
        <div class="row">
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Order</h4>
                    <h4>
                    <?php
                            $sql = "SELECT * FROM tbl_order_manager";
                            $res = mysqli_query($conn, $sql);
                            echo mysqli_num_rows($res);
                    ?>
                </h4>
            </div>
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Bookings</h4>
                <h4>
                <?php
                        $sql = "SELECT * FROM tbl_booking";
                        $res = mysqli_query($conn, $sql);
                        echo mysqli_num_rows($res);
                ?>
                </h4>
            </div>
            <div class="col-lg-3 p-3 me-4 mb-5 bg-info rounded text-center text-white">
                <h4>Revenue</h4>
                <?php                    
                    $sql3 = "SELECT SUM(grand_total) AS TOTAL FROM tbl_order_manager WHERE status = 'Delivered'";
                    $res3 = mysqli_query($conn, $sql3);
                    if($res==true)
                    {
                        $row3=mysqli_fetch_assoc($res3);                   
                        $revenue = $row3['TOTAL'];
                    }
                    if(!isset($revenue))
                    {
                        $revenue = 0;
                    }
                    $sql2 = "SELECT SUM(price) AS PRICE FROM tbl_booking WHERE status ='Complete'";
                    $res2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($res2);
                    $price = $row2['PRICE'];
                ?>
                    <h4>Rs. <?php echo $revenue + $price; ?></h4>
            </div>
        </div>
            
                
    </div>
</section>
<!-- content section ends -->

 <?php include("partials/footer.php"); ?> 

       