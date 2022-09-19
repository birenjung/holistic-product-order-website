if(isset($_POST['confirm-order']))
                        {
                            $product_name = $_POST['product-name'] ;
                            $price = $_POST['price'] ;
                            $qty = $_POST['qty'] ;
                            $sub_total = $_POST['sub-total'] ;

                            $customer_id = $_POST['customer_id'] ;

                            $fullname = $_POST['fullname'] ;
                            $phone = $_POST['phone'] ;
                            $email = $_POST['email'] ;
                            $address = $_POST['address'] ;

                            $grand_total = $_POST['grand-total'] ;
                            
                            $sql5 = "INSERT INTO tbl_ordered_products SET
                                        product_name = '$product_name',
                                        price = $price,
                                        quantity = $qty,
                                        sub_total = $price * $qty,
                                        customer_id = $customer_id
                            ";

                            $sql6 = "INSERT INTO tbl_customer SET
                                        c_name = '$fullname',
                                        c_phone = '$phone',
                                        c_email = '$email',
                                        c_address = '$address',
                                        grand_total = $grand_total
                            ";

                            if(mysqli_query($conn, $sql5) AND mysqli_query($conn, $sql6) == TRUE)
                            {
                                echo "<script>alert('Order Placed Successfully!!')</script>";
                               
                            }
                            else
                            {
                                echo "<script>alert('Error in order placement!!')</script>";
                               
                            }

                        }