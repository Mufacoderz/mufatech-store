<?php

$basePath = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? "../../" : "../";

include $basePath . "../config/koneksi.php";

$query = "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    ORDER BY products.id DESC
";

$result = mysqli_query($conn, $query);

// Kategori → Array
$lists = [
    "Keyboard" => [],
    "Mouse" => [],
    "Monitor" => [],
    "Headphone" => [],
    "Desk" => [],
    "Chair" => [],
    "Others" => []
];

// Masukkan produk ke kategori masing-masing
while ($row = mysqli_fetch_assoc($result)) {
    $cat = ucfirst($row['category_name']);

    if (!isset($lists[$cat])) {
        $lists[$cat] = [];
    }
    $lists[$cat][] = $row;
}

// Map kategori → nama folder
$folderMap = [
    "Keyboard" => "keyboards",
    "Mouse" => "mouses",
    "Monitor" => "monitors",
    "Headphone" => "headphones",
    "Desk" => "desks",
    "Chair" => "chairs",
    "Others" => "other"
];



function renderItems($items, $id, $title, $basePath, $folderMap)
{

    echo "<h2>$title</h2>";
    echo "<div id='$id' class='product-container'>";

    foreach ($items as $p) {

        $folder = $folderMap[$title];

        $filename = basename($p['image']);

        $imageFull = ROOT_URL . "uploads/$folder/$filename";

        // echo "<p style='color:red'>DEBUG PATH: $imageFull</p>";

        echo "
    <div class='product-card'>
        <img src='$imageFull' alt='{$p['name']}'>
        <h3>{$p['name']}</h3>
        <p>Rp " . number_format($p['price'], 0, ',', '.') . "</p>
        <button class='cart-btn'>Add to Cart</button>
    </div>
";
    }

    echo "</div>";
}

?>

<section class="list-product-section">

    <?php
    renderItems($lists["Keyboard"], "keyboard-list", "Keyboard", $basePath, $folderMap);
    renderItems($lists["Mouse"], "mouse-list", "Mouse", $basePath, $folderMap);
    renderItems($lists["Monitor"], "monitor-list", "Monitor", $basePath, $folderMap);
    renderItems($lists["Headphone"], "headphone-list", "Headphone", $basePath, $folderMap);
    renderItems($lists["Desk"], "desk-list", "Desk", $basePath, $folderMap);
    renderItems($lists["Chair"], "chair-list", "Chair", $basePath, $folderMap);
    renderItems($lists["Others"], "accessories-list", "Others", $basePath, $folderMap);
    ?>

    <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
</section>