<?php

    include('../config/constants.php') ;

    if(isset($_GET['id']))
    {
        $admin_id = $_GET['id'] ;

        $sql = "DELETE FROM tbl_admin WHERE id = $admin_id" ;

        $res = mysqli_query($conn, $sql) ;

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>!! Admin Deleted Successfully !!</div>" ;
            header("location:".SITEURL."admin/manage-admin.php") ;
        }       
        
        else
        {
            $_SESSION['delete'] = "<div class='error'>!! Failed to Delete Admin !!</div>" ;
            header("location:".SITEURL."admin/manage-admin.php") ;
        }
        

       
    }
    else
        {
            $_SESSION['unautho'] = "<div class='error'>!! Unauthorized Access !!</div>" ;
            header("location:".SITEURL."admin/manage-admin.php") ;
        }
    
?>

