<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

// Ambil semua kategori dari DB
$kategori = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../../assets/css/adminStyles.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">

    <section class="cards">
        <div class="card">
            <h2>Tambah Produk</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <label>Nama Produk</label>
                <input type="text" name="name" placeholder="Masukkan nama produk" required>
                <br><br>

                <label>Harga Produk</label>
                <input type="number" name="price" placeholder="Masukkan harga tanpa titik" required>
                <br><br>

                <label>Kategori</label>
                <select name="category_id" required>
                    <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php } ?>
                </select>
                <br><br>

                <label>Upload Gambar</label>
                <input type="file" name="image" accept="image/*" required>
                <br><br>

                <button type="submit" name="simpan">Simpan</button>

            </form>
        </div>
    </section>

</div>

<?php
// ========================
//  PROSES SIMPAN PRODUK
// ========================
if (isset($_POST['simpan'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Ambil nama kategori berdasarkan id
    $catQuery = mysqli_query($conn, "SELECT name FROM categories WHERE id='$category_id' LIMIT 1");
    $catData = mysqli_fetch_assoc($catQuery);
    $categoryName = $catData['name'];

    // Mapping nama folder upload
    $folderMap = [
        "Keyboard" => "keyboard",
        "Mouse" => "mouse",
        "Monitor" => "monitor",
        "Headphone" => "headphone",
        "Desk" => "desk",
        "Chair" => "chair",
        "Other" => "other"
    ];

    // Validasi kategori
    if (!isset($folderMap[$categoryName])) {
        die("Kategori tidak valid!");
    }

    // Folder upload baru
    $targetFolder = "../../uploads/" . $folderMap[$categoryName] . "/";

    // Jika folder belum ada → buat otomatis
    if (!is_dir($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }

    // Upload file
    $foto = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // Nama file unik
    $fotoBaru = uniqid() . "_" . $foto;

    // Proses upload
    if (!move_uploaded_file($tmp, $targetFolder . $fotoBaru)) {
        die("Upload gagal! Periksa permission folder.");
    }

    // Public path yang disimpan ke database
    $publicPath = "/projek-uas/uploads/" . $folderMap[$categoryName] . "/" . $fotoBaru;

    // Query insert
    $query = "
        INSERT INTO products (name, price, image, category_id)
        VALUES ('$name', '$price', '$publicPath', '$category_id')
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                window.location='products.php';
            </script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>

</body>
</html>
