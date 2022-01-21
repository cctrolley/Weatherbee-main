<?php
require "config/db.php"; 

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header('location: login.php');  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEATHERBEE</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

     <!-- JS-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="assets/js/bootbox.js"></script>
     
</head>
<body>

    <div class="navigation"> <!-- nav bar div -->
        <div class="logo">
            <a href="index.php"><img src="assets/images/logo-white.png" class="logo-edit" alt=""></a>
        </div>
    </div> <!-- nav bar div -->


