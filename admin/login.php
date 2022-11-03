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
            <div class="container-fluid bg-light d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
                <div class="container text-center mb-2">    
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
                           if(isset($_SESSION['no_username']))
                           {
                                echo $_SESSION['no_username'] ;
                                unset($_SESSION['no_username']) ;
                           }
                        ?>
                    </div>
                    
                <form method="POST">
                    <div class="table-responsive bg-info p-4 mb-4 rounded" style="color:#222f3e">   
                        <h3 class="text-center mb-3">Log In</h3>                     
                        <table class="table table-borderless" style="width:350px; color:#222f3e;">
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
                            <tr>
                                <td colspan="2" class="text-center">
                                    <a href="<?php echo SITEURL; ?>admin/forgot-password.php" style="text-decoration:none; font-size:12px;" data-bs-toggle="modal" data-bs-target="#forgot_pwd">Forgot Password</a>
                                                                                               
                                    <!-- Modal -->
                                    <div class="modal fade" id="forgot_pwd" tabindex="-1" aria-labelledby="a<?php echo $id; ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                 Forgot Password
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="exampleInputPassword1">
                                                        </div>
                                                        <div class="mb-3 form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>                                                                            
                                                </div> 
                                                <div class="modal-footer">                                                                                
                                                    <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id; ?>"><button class="btn btn-sm btn-outline-danger">CONFIRM</i></button></a>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>                                                                          
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>                 
                    
                    <p class="text-center text-dark">Created by <a href="" style="text-decoration:none">Birendra Jung Rai</a></p>
                </div>
            </div>

            <?php

                if(isset($_POST['submit']))
                {
                    $username = mysqli_real_escape_string($conn, $_POST['username']) ;
                    $username = trim($username);

                    $password = mysqli_real_escape_string($conn, $_POST['password']) ;              
                

                    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'" ;

                    $res = mysqli_query($conn, $sql) ;

                    // Count rows to check whether the user exists or not

                    $count = mysqli_num_rows($res) ;

                    if($count==1)
                    {                                              
                            $row=mysqli_fetch_assoc($res);                     
                            $hash = $row['password'];
                            if(password_verify("$password", $hash))
                            {
                                $_SESSION['login'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Logged In Successfully</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button></div>'; 
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
                    else
                    {
                        $_SESSION['no_username'] = "<div class='error'>!! Username does not exist !! </div>" ;
                        header("location:".SITEURL."admin/login.php") ;
                    }                    
                }
            ?>
    </body>
    </html>
