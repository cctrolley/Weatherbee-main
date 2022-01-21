<?php
session_start();
ob_start(); //output buffer
$conn = mysqli_connect("localhost", "root", "", "weatherbee");

$timezone = date_default_timezone_set("Asia/Dubai"); //timezone setter

if (!$conn){
    die("Database connection failed");
}

?>