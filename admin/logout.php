<?php
        include('../config/constants.php') ;

        // 1. Destroy the session

        session_destroy() ; //Unsets $_SESSION['username]

        header("location:".SITEURL."admin/login.php") ;

?>