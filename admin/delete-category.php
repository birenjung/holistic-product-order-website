<?php
    
    include('../config/constants.php') ;     

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $category_id = $_GET['id'] ;

        $image_name = $_GET['image_name'] ;

        if($image_name != "")
        {
            $remove_path = "../img/product-category/".$image_name ;

            $remove = unlink($remove_path) ;
    
            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='error'>!! Failed to Remove Image !!</div>" ;
                header("location:".SITEURL."admin/manage-category.php") ;
                die() ;
            }
        } 

        $sql = " DELETE FROM tbl_category WHERE id = $category_id " ;

        $res = mysqli_query($conn, $sql);
        

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>!! Category Deleted Successfully !!</div>" ;
            header("location:".SITEURL."admin/manage-category.php") ;
                                        
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>!! Failed to Delete Category !!</div>" ;
            header("location:".SITEURL."admin/manage-category.php") ;
        }  
    
    }
    else
    {
        $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
        header("location:".SITEURL."admin/manage-category.php") ;
    }

    
?>