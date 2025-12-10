<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../../config/koneksi.php';
$kategori = mysqli_query($conn, "SELECT * FROM categories");


?>

<?php include 'metaAdmin.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">

    <section class="cards">
        <div class="card form-container">

            <h2>Tambah Produk</h2>

            <form action="../../controllers/addProduct.php" method="POST" enctype="multipart/form-data" class="product-form">

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



</body>
</html>
