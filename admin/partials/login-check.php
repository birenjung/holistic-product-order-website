<?php     

        if(!isset($_SESSION['username']))
        {
            $_SESSION['no-login-msg'] = "<div class='error'>Please log in to access admin panel.</div>" ;

            header("location:".SITEURL."admin/login.php") ;
        }

        

?>