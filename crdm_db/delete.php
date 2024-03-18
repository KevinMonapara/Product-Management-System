<?php

include 'config/database.php';

$name1 = $_GET['name'];
$sql4 = "DELETE FROM product WHERE product_name = '$name1'";
$data4 = mysqli_query($conn, $sql4);
if ($data4) {
    header("Location: data.php");
}