<?php
session_start();
include '../../config/koneksi.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include'metaAdmin.php';?>



<body>
<?php include 'sidebar.php'; ?>

<!-- buat popup berhasul dan gagal hpus produk -->

<?php if (isset($_GET['status'])): ?>

    <?php if ($_GET['status'] == 'error'): ?>
        <script>alert("Gagal menghapus produk!");</script>
    <?php endif; ?>

<?php endif; ?>



    <div class="main-content" id="top">
        <div class="add-product">
            <h3>Tambah produk</h3>
            <a class="add-product-btn" href="/projek-uas/pages/admin/tambahProduct.php">
                <p>+</p>
            </a>
        </div>
        <div class="list-product">
            <?php include __DIR__ . '/../../controllers/getProductsAdmin.php'; ?>
        </div>
    </div>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script src="/projek-uas/assets/js/data.js"></script>
    <script src="/projek-uas/assets/js/scriptAdmin.js"></script>

</body>

</html>