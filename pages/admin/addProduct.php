<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

// Ambil semua kategori
$kategori = mysqli_query($conn, "SELECT * FROM categories");
?>

<?php include 'metaAdmin.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">

    <section class="cards">
        <div class="card form-container">

            <h2>Tambah Produk</h2>

            <form action="" method="POST" enctype="multipart/form-data" class="product-form">

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" placeholder="Masukkan nama produk" required>
                </div>

                <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="number" name="price" placeholder="Masukkan harga tanpa titik" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" required>
                        <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <button type="submit" name="simpan" class="btn-submit">Simpan</button>

            </form>
        </div>
    </section>

</div>

<?php

// ========== PROSES TAMBAH PRODUK ==========
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
        "Keyboard"  => "keyboard",
        "Mouse"     => "mouse",
        "Monitor"   => "monitor",
        "Headphone" => "headphone",
        "Desk"      => "desk",
        "Chair"     => "chair",
        "Other"     => "other"
    ];

    // Validasi kategori
    if (!isset($folderMap[$categoryName])) {
        die("Kategori tidak valid!");
    }

    // Folder tujuan upload
    $targetFolder = "../../uploads/" . $folderMap[$categoryName] . "/";

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
                window.location='manajemenProducts.php';
                </script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>

</body>
</html>
