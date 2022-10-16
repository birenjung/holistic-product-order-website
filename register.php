<?php
    include("config/constants.php");
    if(isset($_POST['register']))
    {
        $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
        $email = $_POST['email'];
        $pwd = md5($_POST['pwd']);

        $sql = "INSERT INTO tbl_user SET
                first_name = '$first_name',
                last_name = '$last_name',
                email = '$email',
                pwd = '$pwd'
            ";
        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
            header("location:".SITEURL);
        }       
    }

    if(isset($_POST['login']))
    {
        $email2 = $_POST['email'];
        $pwd2 = md5($_POST['pwd']);

        $sql2 = "SELECT * FROM tbl_user WHERE email = '$email2' AND pwd = '$pwd2' ";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if($count2==1)
        {
            echo "yes";
        }  
        else
        {   
            
            header("location.".SITEURL);
        }     
    }
?>