<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';



//totl produk

$totalProducts = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM products")
)['total'];


//total perkategori
$categoryCounts = [];
$catQuery = "
    SELECT categories.name AS category_name, COUNT(products.id) AS total
    FROM categories
    LEFT JOIN products ON products.category_id = categories.id
    GROUP BY categories.id
";
$catResult = mysqli_query($conn, $catQuery);

while ($row = mysqli_fetch_assoc($catResult)) {
    $categoryCounts[ucfirst($row['category_name'])] = $row['total'];
}
?>

<?php include 'metaAdmin.php'; ?>

<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">

    <header class="dashboard-header">
        <h1>Halaman Dashboard</h1>
        <p>Selamat datang kembali, <strong><?= $_SESSION['nama_lengkap']; ?></strong></p>
    </header>

    <section class="cards">
        <div class="card ">
            <h3>Stok Produk</h3>
            <p>120</p>
            <span class="card-desc">Total stok tersedia</span>
        </div>

        <div class="card">
            <h3>Total Produk</h3>
            <p><?= $totalProducts; ?></p>
            <span class="card-desc">Produk terdaftar</span>
        </div>

        <div class="card">
            <h3>Total Pelanggan</h3>
            <p>82</p>
            <span class="card-desc">Akun aktif</span>
        </div>
    </section>

    <section class="category-summary">
        <h3 class="section-title">Total Produk per Kategori</h3>

        <div class="category-cards">
            <?php
            $categories = ["Keyboard","Mouse","Monitor","Headphone","Desk","Chair","Other"];
            foreach ($categories as $cat):
            ?>
                <div class="category-card">
                    <span><?= $cat; ?></span>
                    <strong><?= $categoryCounts[$cat] ?? 0; ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="dashboard-row">

        <div class="dashboard-box">
            <h4>Aktivitas Terakhir</h4>
            <ul class="activity-list">
                <li>Produk <strong>Keyboard Keychron K6</strong> ditambahkan</li>
                <li>Pesanan <strong>#P-01</strong> dikirim</li>
                <li>Pelanggan baru mendaftar</li>
                <li>Stok produk diperbarui</li>
            </ul>
        </div>

        <div class="dashboard-box">
            <h4>Ringkasan Sistem</h4>
            <div class="system-info">
                <p>Status Sistem <span class="status-online">Online</span></p>
                <p>Pesanan Hari Ini <strong>14</strong></p>
                <p>Pesanan Dibatalkan <strong>0</strong></p>
            </div>
        </div>

    </section>

</div>

<script src="/projek-uas/assets/js/scriptAdmin.js"></script>
</body>
</html>
