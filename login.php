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
    <title>LOGIN</title>

    <link rel="stylesheet" href="assets/css/login.css">
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
                <h1 class="log-in-title">LOG IN</h1>
            </div>
            
            <form action="" method="POST">
            <div class="log-in-textbox">
                <input type="email" class="textbox" name="l-email" placeholder="email" required>

                <input type="password" class="textbox" name="l-pass" placeholder="password" required>
                <?php if(in_array("email or password was incorrect<br>", $error_array))
                 echo "<script> alert('email or password is incorrect') </script>" ?>
            </div>

            <div class="log-in-button">
            <button type="submit" name="log-btn" class="bg-button"> 
                <img src="assets/images/arrow-right.png" alt="">
            </button>
            </div>
            
            <div class="lcontainer">
            <p class="linktotheother">Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
            </form>

        </div>
        </div> 
        



        </div>

    </div>
</body>
</html>