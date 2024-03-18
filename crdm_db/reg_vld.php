<?php

include 'config/database.php';

if (isset($_POST['email'])) {
    // $email = $_POST['email'];
    // $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    // if (mysqli_num_rows($verify_query) >  0) {
    //     echo "Email is already exist.";
    // } 
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $sql = "SELECT * FROM users WHERE email='" . $email . "'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}

if (isset($_POST['username'])) {
    // $user = $_POST['username'];
    // $verify_query1 = mysqli_query($conn, "SELECT username FROM users WHERE username='$user'");
    // if (mysqli_num_rows($verify_query1) >  0) {
    //     echo "Username is already exist.";
    // } 
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}