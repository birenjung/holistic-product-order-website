<?php include('../config/constants.php') ; ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log In</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
            <div class="content">
                <div class="login">

                    <h2 class="text-center">LOG IN</h2>  <br><br>

                    <?php
                           if(isset($_SESSION['login']))
                           {
                                echo $_SESSION['login'] ;
                                unset($_SESSION['login']) ;
                           }
                           if(isset($_SESSION['no-login-msg']))
                           {
                                echo $_SESSION['no-login-msg'] ;
                                unset($_SESSION['no-login-msg']) ;
                           }
                    ?>

                    <form action="" method="POST">
                        <table class="login-table">
                            <tr>
                                <td>Username:</td>
                                <td>
                                    <input type="text" name="username" placeholder="Enter your username">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="password" placeholder="Enter your password">
                                </td> 
                                            
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <input type="submit" name="submit" value="Log in" class="btn btn-primary">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br>
                    <br>
                    <p class="text-center">Created by <a href="">Birendra Jung Rai</a></p>
                </div>
            </div>

            <?php

                if(isset($_POST['submit']))
                {
                    $username = mysqli_real_escape_string($conn, $_POST['username']) ;

                    $password = mysqli_real_escape_string($conn, md5($_POST['password'])) ;

                    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' " ;

                    $res = mysqli_query($conn, $sql) ;

                    // Count rows to check whether the user exists or not

                    $count = mysqli_num_rows($res) ;

                    if($count==1)                   
                    {
                        $_SESSION['login'] = "<div class='success'>!! Logged In Successfully !! </div>" ;               
                        

                        header("location:".SITEURL."admin/") ;

                        $_SESSION['username'] = "$username" ;
                        header("location:".SITEURL."admin/") ;

                    }
                    else
                    {
                        $_SESSION['login'] = "<div class='error'>!! Username and password do not match !! </div>" ;
                        header("location:".SITEURL."admin/login.php") ;
                    }
                }
            ?>
    </body>
    </html>
