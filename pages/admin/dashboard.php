<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../../assets/css/adminStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

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
</body>
</html>
