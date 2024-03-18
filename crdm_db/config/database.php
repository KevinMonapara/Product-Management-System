<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manage_prd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// $sql = "CREATE TABLE product (
//     id INT(10) AUTO_INCREMENT PRIMARY KEY,
//     product_name VARCHAR(30) NOT NULL,
//     product_details VARCHAR(200) NOT NULL,
//     product_count INT(20),
//     image VARCHAR(60) NOT NULL
//     )";

// $sql1 = "CREATE TABLE inventory (
//     order_id INT AUTO_INCREMENT PRIMARY KEY,
//     product_price VARCHAR(100) NOT NULL, 
//     item_id INT(10) 
//     )";

// $sql2 = "CREATE TABLE users (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     username VARCHAR(200),
//     email VARCHAR(200),
//     pswd VARCHAR(200)
//     )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// if ($conn->query($sql1) === TRUE) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// if ($conn->query($sql2) === TRUE) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }