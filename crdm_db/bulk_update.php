<?php
include 'config/database.php';

$data = [
    ["Belt", "Leather", 45],
    ["Tie", "Silk", 50],
    ["Handbag", "Leather", 25],
    ["Wallet", "Leather", 40],
    ["Watch", "Stainless steel", 60],
    ["Bracelet", "Gold-plated", 35],
    ["Necklace", "Silver", 50],
    ["Earrings", "Stainless steel", 55],
    ["Ring", "Platinum", 40],
    ["Hat", "Straw", 70],
    ["Sunscreen", "SPF 30", 90],
    ["Shampoo", "Moisturizing", 80],
    ["Conditioner", "Repairing", 75],
    ["Body wash", "Refreshing", 70],
    ["Lotion", "Hydrating", 65],
    ["Toothpaste", "Fluoride", 85],
    ["Toothbrush", "Soft bristles", 90],
    ["Razor", "Disposable", 80],
    ["Shaving cream", "Sensitive skin", 75],
    ["Deodorant", "Roll-on", 85],
    ["Perfume", "Eau de Perfume", 60],
    ["Candles", "Vanilla scented", 70],
    ["Matches", "Safety matches", 90],
    ["Batteries", "AA", 75],
    ["Flashlight", "LED", 55],
];

$product_prices = [
    [10],
    [24],
    [50],
    [15],
    [80],
    [12],
    [30],
    [18],
    [60],
    [42],
    [20],
    [14],
    [90],
    [28],
    [16],
    [70],
    [32],
    [22],
    [11],
    [35],
    [19],
    [25],
    [17],
    [13],
    [29]
];

$sql = "UPDATE product SET product_name = ?, product_details = ?, product_count = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

$sql1 = "UPDATE inventory SET product_price = ? WHERE order_id = ? ";
$stmt1 = $conn->prepare($sql1);

$conn->begin_transaction();
$i = 1;
foreach ($data as $row) {
    $stmt->bind_param("ssii", $row[0], $row[1], $row[2], $i);
    $stmt->execute();
    $i++;
}

$conn->begin_transaction();
$i = 1;
foreach ($product_prices as $row1) {
    $stmt1->bind_param("ii", $row1[0], $i);
    $stmt1->execute();
    $i++;
}

$conn->commit();