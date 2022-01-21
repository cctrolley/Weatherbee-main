<?php
$username = "";
$email = "";
$pass = "";
$cpass = "";

$error_array = array(); //will hold any error messages

if(isset($_POST['reg-btn'])){
    //username
    $username = strip_tags($_POST['username']);
    $username = str_replace('','', $username); //removes spaces
    $username = strtolower($username); //turns everything lower case
    $_SESSION['username'] = $username; //stores value

    //email
    $email = strip_tags($_POST['email']);
    $email = str_replace('','', $email); //removes spaces
    $email = strtolower($email); //turns everything lower case
    $_SESSION['email'] = $email; //stores value

    //password
    $pass = strip_tags($_POST['password']);
    $cpass = strip_tags($_POST['cpassword']);

    //email format checker
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $email_checker = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");

        $num_rows = mysqli_num_rows($email_checker);
        if($num_rows > 0) {
            array_push($error_array, "email already in use <br>");
        }
    }
    else{
        array_push($error_array,"email invalid format <br>");
    }
    
    //password confirmation
    if($pass == $cpass){
 
    }
    else{
        array_push($error_array,"your passwords do not match <br>");
    }
    if(strlen($pass) < 8) {
        array_push($error_array, "your password should not be less than 8 characters <br>");
    }

    //username length checker
    if(strlen($username) > 25 || strlen($username) < 3) {
        array_push($error_array, "your display username should be between 3-25 characters <br>");
    }

    $check_username_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");



     //checker in general
     if(empty($error_array)){
        $pass = md5($pass); //password encryption  
        $rand = rand(1,10); //Random number generator

        if ($rand == 1)
            $profile_pic = "assets/images/profile_pics/default_1.png";
        else if ($rand == 2)
            $profile_pic = "assets/images/profile_pics/default_2.png";
        else if ($rand == 3)
             $profile_pic = "assets/images/profile_pics/default_3.png";
        else if ($rand == 4)
            $profile_pic = "assets/images/profile_pics/default_4.png";
        else if ($rand == 5)
            $profile_pic = "assets/images/profile_pics/default_5.png";

        $bio = "this is an okay length bio";
        
        $check_username_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
            if(mysqli_num_rows($check_username_query) == 0) {
                $i=0;
                $i++;
          
            } else {
                $i=1;
                $i++;
                }

        $numgen = rand(100,900);
        $username = $username . "#" . $i . $numgen;

        $query = mysqli_query($conn, "INSERT INTO users 
        VALUES ('', '$email', '$username', '$pass', '$profile_pic','$bio')"); 

        echo "<script> alert('account created please log in :)') </script>";
       
        

        // clears previously written variables
        $_SESSION['username'] = "";
        $_SESSION['email'] = "";


    }
    else{
        echo "<script> alert('error creating account please check your details') </script>";
    }

}
?>