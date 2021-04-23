<?php
    include "signup_validate.php";
    // echo getcwd();
?>
<!DOCTYPE HTML>  
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signup Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/signup.css">
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background: url("assets/image/background.jpg") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .login-form {
            width: 50%;
            margin: 0 auto;
            padding: 100px 0 30px;
        }

        .error {
            color: #FF0000;
        }

        .box {
            /* background-color: #ececec; */
            padding: 2% 6% 6% 6%;
            color: #7a7a7a;
            font-weight: 10px;
            background-color: transparent !important;
            border: none !important;
            color: whitesmoke;
            display:flexbox;
        }

        .h {
            text-align: center;
            text-shadow: 5%;
            color: whitesmoke;
        }

        .postion {
            text-align: center;
        }

        .transparent-input {
            background-color: transparent !important;
            border: none !important;
        }
        .bottom-padding {
            padding-bottom: 1%;
        }
    </style>
    </head>
    <body>
        <div class="container-fluid">    
            <div class="login-form transparent-input">
                <h1 class="h"> SIGNUP HERE </h1>
                <form method="POST" enctype="multipart/form-data" action="/signup"> 
                    <div class="form-group box">
                        <label  class="col-sm-12 col-form-label">Name<span class="error">*</span></label>
                        <div class="col-sm-12 bottom-padding">
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            <span class = "error"><?php echo ' '.$nameErr;?></span>
                        </div>
                        <label class="col-sm-12 col-form-label">Email<span class="error">*</span></label>
                        <div class="col-sm-12 bottom-padding">
                            <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                            <span class = "error"><?php echo ' '.$emailErr;?></span>
                        </div>
                        <label  class="col-sm-12  col-form-label">Password<span class="error">*</span></label>
                        <div class="col-sm-12 bottom-padding">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                            <span class = "error"><?php echo ' '.$pwdErr;?></span>
                        </div>
                        <label  class="col-sm-12 col-form-label">Dob<span class="error">*</span></label>
                        <div class="col-sm-12 bottom-padding">
                            <input type="date" class="form-control" name="dob" required>
                            <span class = "error"><?php echo ' '.$dobErr;?>
                        </div>   
                        <div class="custom-control custom-radio">
                        <label  class="col-sm-12 col-form-label">Gender<span class="error">*</span></label>
                            <div class="col-sm-12 bottom-padding">
                                <input type="radio" class="custom-control-input" name="gender" value="female" required>Female
                                <input type="radio"  class="custom-control-input" name="gender" value="male" required>Male
                                <input type="radio" class="custom-control-input" name="gender" value="other" required>Other
                                <span class = "error"><?php echo ' '.$genderErr;?></span>
                            </div>
                        </div>
                        <div class="postion">
                            <button class="btn btn-success btn-lg" type="submit" name="submit" id="submit" value="submit"> SignUp </button>
                        </div>
                        <p class="text-center ">Already have an account? <a href="signin"><u>Sign in here!</a></u></p>  
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>