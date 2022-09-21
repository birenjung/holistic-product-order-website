<?php include('partials-front/menu.php'); ?>

<section class="search"> 
    
        
    
<div class="container mt-5 rounded">
    <h2 class="text-center">MY CART</h2>
    <div class="row">
        <div class="col-lg-9">
            <div class="table-responsive-sm">
            <table class="table text-white table-borderless">
                    <thead class="table-primary">
                        <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if(isset($_SESSION['cart']))
                        {
                        // print_r ($_SESSION['cart']) ;
                            $sn = 1;                            
                            foreach($_SESSION['cart'] as $key => $value)
                            {   
                                $sn = $key + 1;
                                ?>
                                    <tr>
                                        <td><?php echo $sn ; ?></td>
                                        <td><?php echo $value['product_title'];?></td>
                                        <td>
                                            <?php echo $value['product_price'];?>
                                            <input type="hidden" name="price" class="productPrice" value=<?php echo $value['product_price'] ?>>
                                        </td>
                                        <td><input type="number" name="qty" class="productQty" onchange=SUBTOTAL() min="1" max="100" size="2" value="<?php echo $value['qty'];?>"></td>
                                        <td class="sub-total"></td>
                                        <td>
                                            <form action="manage_cart.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $key ;?>">
                                                <input type="hidden" name="product_title" value="<?php echo $value['product_title'] ; ?>">
                                                <button class="btn btn-sm btn-danger" name="remove">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                                              

                            }
                           
                        }
                        ?>
                    
                    </tbody>
            </table>
            </div>
        
            
        </div>
        <div class="col-lg-3">
            <div class="border rounded p-2">
                <h4 class="text-center">Grand Total</h4> <br>
                <h5 class="text-right" id="gtotal">
                    
                </h5> <br>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button">Make Purchase</button>                    
                </div>
            </div>
        </div>
    </div>
</div>
            
        


    
</section>
                
<?php include('partials-front/footer.php');?>