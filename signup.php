<?php 

require "assets/config/db.php";
include "assets/includes/form-handlers/register_handler.php";
include "assets/includes/form-handlers/login_handler.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>

    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container-1">
        <div class="rec-up2"></div>

        <div class="main-container">

        <div class="log-in-container">
           <div class="logo-container">
                <img src="assets/images/logo.png" alt="" class="logo">
            </div>

            <div class="log-in-title-container">
                <h1 class="log-in-title">SIGN UP</h1>
            </div>
            <form action="signup.php" method="POST">
            <div class="log-in-textbox">

                
                <input type="email" class="textbox" name="email" placeholder="email" 
                value = "<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" required>
                <?php if(in_array("email already in use <br>", $error_array)){
                    echo "<script> alert('email already in use') </script>";}
                else if(in_array("email invalid format <br>", $error_array)){
                    echo "<script> alert('email invalid format') </script>";} ?>
                
                <input type="text" class="textbox" name="username" placeholder="username" 
                value = "<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?>" required>
                <?php if(in_array("your username should be between 3-25 characters <br>", $error_array)){
                echo "<script> alert('your username should be between 3-25 characters') </script>";} ?>
                <?php if(in_array("username not unique", $error_array)){
                echo "<script> alert('this username was taken, please create a unique one.') </script>";} ?>


                <input type="password" class="textbox" name="password" placeholder="password" required>
                <input type="password" class="textbox" name="cpassword" placeholder="confirm password" required>
                <?php if(in_array("your passwords do not match <br>", $error_array)){
                echo "<script> alert('your passwords do not match') </script>";}
                else if(in_array("your password should not be less than 8 characters <br>", $error_array)){
                    echo "<script> alert('your password should not be less than 8 characters') </script>";} ?>  
            </div>

            <div class="log-in-button">
            <button type="submit" name="reg-btn" class="bg-button"> 
                    <img src="assets/images/arrow-right.png" alt="">
            </button>
            </div>

            <div class="lcontainer">
            <p class="linktotheother">Already have an account? <a href="login.php">Log in</a></p>
            </div>
            </form>


        </div>
        </div> 
        



        </div>

    </div>
</body>
</html>