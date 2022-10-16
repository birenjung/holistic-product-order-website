 <!-- Social links start -->

        <section class="social-links">
            <div class="text-center text-white">
                    <ul style="list-style:none;">                        
                        <li>
                            <a href="<?php echo SITEURL; ?>cart.php" style="text-decoration:none; color:white; text-spacing:1px; font-size:12px;">

                                <?php
                                        $product_num = 0 ;
                                        if(isset($_SESSION['cart']))
                                        {
                                            $product_num = count($_SESSION['cart']) ;
                                        }                                        
                                ?>
                                   My Cart <i class="fa-solid fa-cart-shopping"></i> <span id="pnum" class="bg-danger rounded p-1"><?php echo $product_num ;?></span>
                            </a>
                        </li>                       
                    </ul><br>    
                <h5>Our social links</h5>
                <ul>
                    <li>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
                    </li>                   
                </ul>
            </div>
        </section>
        <!-- social-limks end -->
        
        <section class="footer">
            <div class="text-center">
                <p>All rights reserved, 2022. AMP Holistic Enterprise Pvt. Ltd.</p>                
            </div>
        </section>
        <!-- footer ends -->
    <!-- </div> -->
        

<script src="js/script.js"></script>
<script src="js/jquery.js"></script>  
</body>
</html>