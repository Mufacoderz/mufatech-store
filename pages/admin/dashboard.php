<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include'metaAdmin.php';?>

<body>

    
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
            <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h1>
            <p>Anda sedang berada di halaman dashboard utama.</p>
        </header>

        <section class="cards">
            <div class="card">
                <h3>Total Pengguna</h3>
                <p>120</p>
            </div>
            <div class="card">
                <h3>Total Produk</h3>
                <p>45</p>
            </div>
            <div class="card">
                <h3>Total Galeri</h3>
                <p>82</p>
            </div>
        </section>
    </div>


    <script src="/projek-uas/assets/js/scriptAdmin.js"></script>

</body>
</html>
