<?php
include 'config/database.php';

$data = [
    ["T-shirt", "Cotton", 100],
    ["Jeans", "Denim", 75],
    ["Sneakers", "Canvas", 50],
    ["Backpack", "Polyester", 30],
    ["Hoodie", "Fleece", 80],
    ["Leggings", "Spandex", 60],
    ["Jacket", "Leather", 25],
    ["Dress", "Chiffon", 40],
    ["Shorts", "Cotton", 55],
    ["Sandals", "Leather", 45],
    ["Sweatpants", "Cotton", 70],
    ["Polo shirt", "Cotton", 90],
    ["Skirt", "Denim", 35],
    ["Blouse", "Silk", 55],
    ["Sweater", "Wool", 65],
    ["Trousers", "Polyester", 60],
    ["Coat", "Wool", 30],
    ["Vest", "Nylon", 20],
    ["Tank top", "Cotton", 75],
    ["Raincoat", "Polyester", 40],
    ["Swimsuit", "Spandex", 50],
    ["Socks", "Cotton", 100],
    ["Beanie", "Acrylic", 80],
    ["Gloves", "Leather", 60],
    ["Scarf", "Wool", 70],
];

$product_prices = [
    [10, 10],
    [24, 22],
    [5, 17],
    [15, 2],
    [8, 13],
    [12, 25],
    [30, 7],
    [18, 12],
    [6, 21],
    [42, 5],
    [20, 16],
    [14, 9],
    [9, 23],
    [28, 3],
    [16, 4],
    [7, 11],
    [32, 1],
    [22, 18],
    [11, 24],
    [35, 15],
    [19, 8],
    [25, 19],
    [17, 6],
    [13, 14],
    [29, 20]
];

$sql = "INSERT INTO product (product_name, product_details, product_count) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

$sql1 = "INSERT INTO inventory (product_price,item_id) VALUES (?, ?)";
$stmt1 = $conn->prepare($sql1);

$conn->begin_transaction();
foreach ($data as $row) {
    $stmt->bind_param("ssi", $row[0], $row[1], $row[2]);
    $stmt->execute();
}

$conn->begin_transaction();
foreach ($product_prices as $row1) {
    $stmt1->bind_param("ii", $row1[0], $row1[1]);
    $stmt1->execute();
}

$conn->commit();