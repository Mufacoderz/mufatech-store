<?php
include 'config/koneksi.php';

$category = $_GET['category'];

$query = "
    SELECT 
        products.id,
        products.name AS product_name,
        products.price,
        products.image,
        categories.name AS category_name
    FROM products
    JOIN categories ON products.category_id = categories.id
    WHERE categories.name = '$category'
";


$result = mysqli_query($conn, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
