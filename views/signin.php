<?php
    include "signin_validate.php";
    //echo getcwd();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign In</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        <style>
            .property {
                margin: 0 auto;
                padding: 30px 0;
            }

            h4 {
                text-align: center;
                font-size: 22px;
                margin-bottom: 20px;
            }

            .avatar {
                color: #fff;
                margin: 0 auto 30px;
                text-align: center;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: #4aba60;
                padding: 15px;
            }

            .avatar i {
                font-size: 62px;
            }

            .forgot-link {
                float: right;
            }

            .postion {
                text-align: center;
                margin-left: 30%;
            }

            .wrong {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="container property">
            <div class="row">
                <div class="col-4 align-self-start"></div>
                    <div class="col-4 align-self-center">
                        <form method="POST" enctype="multipart/form-data" action="/signin">
                            <div class="avatar"><i class="fa fa-user"></i></div>
                            <h4>Signin to Your Account</h4>
                            <span class="wrong"><?php echo "$wrong"?></span>
                            <div class="form-group">
                                <input type="email" name="username"class="form-control" placeholder="Email" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" name ="password" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <a href="#" class="forgot-link">Forgot Password?</a>
                            </div> 
                            <div class="postion">
                                <button class="btn btn-success btn-xl" type="submit" name="submit" id="submit" value="submit"> Signin </button>
                            </div>
                        </form>			
                        <div class="text-center small">Don't have an account? <a href="signup">Sign up here!</a></div>
                    </div>
                <div class="col-4 align-self-end"></div>
            </div>    
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>