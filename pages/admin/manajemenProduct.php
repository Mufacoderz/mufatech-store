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


    <div class="main-content" id="top">
        <div class="add-product">
            <h3>Tambah produk</h3>
            <a class="add-product-btn" href="addProduct.php">
                <p>+</p>
            </a>
        </div>
        <?php include __DIR__ . '/../../includes/listProducts.php'; ?>
    </div>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script src="/projek-uas/assets/js/data.js"></script>
    <script src="/projek-uas/assets/js/scriptAdmin.js"></script>

</body>

</html>