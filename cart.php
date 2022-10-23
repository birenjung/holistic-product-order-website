<?php include('partials-front/menu.php'); ?>
        
<div class="container my-5 px-4 py-3" style="background-color: #f7f7f5; border-radius:1px;"> 
    <div class="row justify-content-center">
        <div class="col-4">
            <h2 class="text-center mb-4 py-1 mt-2 rounded-bottom">My Cart <i class="fa-solid fa-cart-shopping"></i></h2>
        </div>
    </div>   
    
    <div class="row mb-5">
        <div class="col-lg-9">
            <div class="table-responsive-md">
            <table class="table text-white table-borderless text-center mb-2" style="background-color: white; border-radius:1px;">
                    <thead class="bg-success">
                        <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark" id="tbody">
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
                                        <td>
                                            <form action="manage_cart.php" method="POST">
                                                <input type="number" name="modQty" class="productQty" onchange="this.form.submit();" min="1" max="100" size="2" value="<?php echo $value['qty'];?>">
                                                <input type="hidden" name="product_title" value="<?php echo $value['product_title'] ; ?>">
                                            </form>
                                        </td>
                                        <td class="sub-total"></td>
                                        <td>
                                            <form action="manage_cart.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $key ;?>">
                                                <input type="hidden" name="product_title" value="<?php echo $value['product_title'] ; ?>">
                                                <span class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#a<?php echo $key; ?>"><i class="fa-solid fa-trash"></i></span>                                                                 
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="a<?php echo $key; ?>" tabindex="-1" aria-labelledby="a<?php echo $key; ?>Label" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    Confirmation
                                                                                </div>
                                                                                <div class="modal-header">
                                                                                    <span >
                                                                                        Are you sure to remove <?php echo $value['product_title'] ; ?> ?
                                                                                    </span>                                                                                    
                                                                                </div> 
                                                                                <div class="modal-footer">                                                                                
                                                                                    <button class="btn btn-sm btn-outline-danger" name="remove">Remove</button>
                                                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                </div>                                                                          
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                            </form>
                                        </td>                                       
                                    
                                <?php
                                                              

                            }
                           
                        }
                        if(empty($_SESSION['cart']))
                        {
                            echo "<td colspan='6' class='text-center text-danger'>Now Cart is Empty!</td>";
                        }
                        ?>
                        </tr>
                    
                    </tbody>
            </table>
            </div>
        
            
        </div>
        <div class="col-lg-3">
            <div class="p-2" style="background-color: white; border-radius:1px;">
                <h4 class="text-center">Grand Total (nrs)</h4>
                <h5 class="text-right" id="gtotal">
                    
                </h5> 
               
                <?php
                    if(!empty($_SESSION['cart'])) {
                ?>
                <div class="d-grid gap-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchase">
                    Purchase
                    </button>

                   
                        <!-- Modal -->
                    <div class="modal fade" id="purchase" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="purchaseLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content"> 
                            <div class="alert alert-success p-5 d-none" role="alert" id="purchase_success_msg"><h4 class="alert-heading"></h4></div>                           
                                <div class="modal-header">
                                    <h5 class="modal-title">Please fill your details.</h5>
                                    <button type="button" class="btn-close btn_close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="buy-form">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name *</label>
                                            <input type="text" class="form-control" id="c-name" placeholder="E.g. Manrani Rai" required>                                            
                                        </div>                                        
                                        <div class="mb-3">
                                            <label class="form-label">Address *</label>
                                            <textarea class="form-control" id="c-address" cols="30" rows="3" placeholder="E.g. Kharsala Tole, Itahari-20" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number *</label>
                                            <input type="text" class="form-control" id="c-phone" min="10" placeholder="E.g. 9827****49" required>                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="c-email" placeholder="E.g. holisticherbs2077@gmail.com">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>                                        
                                        <div class="form-text mb-1">Payment mode *</div>
                                            <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="pay-mode" value="cod" checked>
                                            <label class="form-check-label">
                                               Cash on delivery
                                            </label>                                            
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="pay-mode" value="esewa">
                                            <label class="form-check-label">
                                                Esewa
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="pay-mode" value="khalti">
                                            <label class="form-check-label">
                                                Khalti
                                            </label>
                                        </div> 
                                        <input type="hidden" name="grand_total" id="grandTotal" value="">                                          
                                        <button type="submit" class="btn btn-success">Place Order</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <small>* Fields are required.</small>     
                                    <button type="button" class="btn btn-outline-secondary btn_close"data-bs-dismiss="modal">Close</button>                                                              
                                </div>
                            </div>                            
                        </div>    
                    </div> 
                        <?php
                    }
                    ?>           
                </div>
            </div>
        </div>
    </div>
</div>  
</section>
                
<?php include('partials-front/footer.php');?>