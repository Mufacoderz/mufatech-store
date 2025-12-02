<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Akses ditolak!");
}

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$image = $_FILES['image'];

$folderMap = [
    "Keyboard" => "keyboards",
    "Mouse" => "mouses",
    "Monitor" => "monitors",
    "Headphone" => "headphones",
    "Desk" => "desks",
    "Chair" => "chairs",
    "Other" => "others"
];


// Validasi kategori
if (!isset($folderMap[$category])) {
    die("Kategori tidak valid!");
}

$targetFolder = "../assets/img/products/" . $folderMap[$category] . "/";

if (!is_dir($targetFolder)) {
    die("Folder untuk kategori ini tidak ditemukan! Upload dibatalkan.");
}

// Nama file baru
$filename = time() . "_" . basename($image["name"]);
$targetPath = $targetFolder . $filename;

// Upload gambar
if (!move_uploaded_file($image["tmp_name"], $targetPath)) {
    die("Upload gagal! Cek permission folder atau ukuran file.");
}

// Ambil category_id
$queryCat = "SELECT id FROM categories WHERE name = '$category' LIMIT 1";
$resultCat = mysqli_query($conn, $queryCat);

if (mysqli_num_rows($resultCat) === 0) {
    die("Kategori tidak ditemukan di database!");
}

$cat = mysqli_fetch_assoc($resultCat)['id'];

// Path yang disimpan ke db
$publicPath = "/projek-uas/assets/img/products/" . $folderMap[$category] . "/" . $filename;

// Insert ke db
$query = "
    INSERT INTO products (name, price, image, category_id)
    VALUES ('$name', '$price', '$publicPath', '$cat')
";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Produk berhasil ditambahkan!');
            window.location='../pages/admin/products.php';
            </script>";
} else {
    echo "Database Error: " . mysqli_error($conn);
}
?>
