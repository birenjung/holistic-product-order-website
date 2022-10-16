<?php include('../config/constants.php') ; ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log In</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
            <div class="container-fluid bg-dark d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
                    
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
                    
                <form method="POST">
                    <div class="table-responsive bg-info p-4 mb-4 rounded">   
                        <h3 class="text-center mb-3">Log In</h3>                     
                        <table class="table table-borderless" style="width:350px">
                            <tr>
                                <td>Username:</td>
                                <td>
                                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </td> 
                                            
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <input type="submit" name="submit" value="Log in" class=" form-control btn btn-primary">
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>                 
                    
                    <p class="text-center text-white">Created by <a href="" style="text-decoration:none; color:purple;">Birendra Jung Rai</a></p>
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
