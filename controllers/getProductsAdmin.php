<?php


include __DIR__ . "/../config/koneksi.php";

$query = "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    ORDER BY products.id ASC
";

$result = mysqli_query($conn, $query);

$lists = [
    "Keyboard" => [],
    "Mouse" => [],
    "Monitor" => [],
    "Headphone" => [],
    "Desk" => [],
    "Chair" => [],
    "Other" => []
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
    "Other" => "other"
];



function renderItems($items, $id, $title, $folderMap)
{

    echo "<h2>$title</h2>";
    echo "<div id='$id' class='product-container'>";

    foreach ($items as $p) {

        $folder = $folderMap[$title];

        $filename = basename($p['image']);

        $imageFull = "../../uploads/$folder/$filename";

        // echo "<p style='color:red'>DEBUG PATH: $imageFull</p>";

        echo "
    <div class='admin-product-card'>
        <img src='" . $imageFull . "' alt='" . $p['name'] . "'>

        <div class='admin-product-info'>
            <h3>" . $p['name'] . "</h3>
            <p class='price'>Rp " . number_format($p['price'], 0, ',', '.') . "</p>
        </div>

        <div class='button'>
            <a class='edit'>
                <i class='fa-solid fa-pen'></i>
            </a>

            <a class='delete' href='../../controllers/deleteProduct.php?id={$p['id']}'
                onclick=\"return confirm('Hapus produk ini?')\">
                <i class='fa-solid fa-trash'></i>
            </a>


        </div>
    </div>
";
    }

    echo "</div>";
}

?>

<section class="list-product-section">

    <?php
    renderItems($lists["Keyboard"], "keyboard-list", "Keyboard", $folderMap);
    renderItems($lists["Mouse"], "mouse-list", "Mouse", $folderMap);
    renderItems($lists["Monitor"], "monitor-list", "Monitor", $folderMap);
    renderItems($lists["Headphone"], "headphone-list", "Headphone", $folderMap);
    renderItems($lists["Desk"], "desk-list", "Desk", $folderMap);
    renderItems($lists["Chair"], "chair-list", "Chair", $folderMap);
    renderItems($lists["Other"], "accessories-list", "Other", $folderMap);
    ?>

    <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
</section>