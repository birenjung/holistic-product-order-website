<?php
    
    include("../config/constants.php") ;

    if(isset($_GET['id']) && isset($_GET['image']))
    {
        $product_id = $_GET['id'] ;

        $image_name = $_GET['image'] ;

        if($image_name != "")
        {
            $r_path = "../img/products/".$image_name ;

            $remove = unlink($r_path) ;

            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='error'>!! Failed to Remove Image !!</div>" ;
                header("location:".SITEURL."admin/manage-products.php") ;
                die() ;
            }
        }

        

        $sql = "DELETE FROM tbl_product WHERE id = $product_id" ;

        $res = mysqli_query($conn, $sql) ;

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>!! Product Deleted Successfully !!</div>" ;
            header("location:".SITEURL."admin/manage-products.php") ;
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>!! Failed to Delete Product !!</div>" ;
            header("location:".SITEURL."admin/manage-products.php") ;
        }

        
    }
    else
    {
        $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
        header("location:".SITEURL."admin/manage-products.php") ;
    }
?>