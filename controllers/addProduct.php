<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../config/koneksi.php';
//ambil katrgori
$kategori = mysqli_query($conn, "SELECT * FROM categories");

?>


<?php


if (isset($_POST['simpan'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    // Ambil nama kategori berdasarkan ID
    $catQuery = mysqli_query($conn, "SELECT name FROM categories WHERE id='$category_id' LIMIT 1");
    $catData = mysqli_fetch_assoc($catQuery);
    $categoryName = $catData['name'];

    // Pemetaan kategori -> folder
    $folderMap = [
        "Keyboard"  => "keyboards",
        "Mouse"     => "mouses",
        "Monitor"   => "monitors",
        "Headphone" => "headphones",
        "Desk"      => "desks",
        "Chair"     => "chairs",
        "Other"     => "other"
    ];

    // Validasi kategori
    if (!isset($folderMap[$categoryName])) {
        die("Kategori tidak valid!");
    }

    // Folder tujuan upload
    $targetFolder = "../uploads/" . $folderMap[$categoryName] . "/";

    // Jika folder belum ada -> buat
    if (!is_dir($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }

    // Upload gambar
    $foto = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // Buat nama file baru unik
    $fotoBaru = uniqid() . "_" . $foto;

    if (!move_uploaded_file($tmp, $targetFolder . $fotoBaru)) {
        die("Upload gagal! Periksa permission folder.");
    }

    // Path yang disimpan ke database
    $publicPath = "/projek-uas/uploads/" . $folderMap[$categoryName] . "/" . $fotoBaru;

    // Simpan ke database
    $query = "
        INSERT INTO products (name, price, image, category_id)
        VALUES ('$name', '$price', '$publicPath', '$category_id')
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                window.location='../pages/admin/manajemenProduct.php';
                </script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>