<?php 

if(isset($_POST['log-btn'])){

    $email = filter_var($_POST['l-email'], FILTER_SANITIZE_EMAIL);

    $_SESSION['l-email'] = $email;
    $pass = md5($_POST['l-pass']);

    $check_database_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        header("location: index.php");
        exit();
    }
    else {
        array_push($error_array, "email or password was incorrect<br>");
    }

}


?>