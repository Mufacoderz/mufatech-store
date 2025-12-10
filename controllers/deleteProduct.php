<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

     // Ambil data produk
    $get = mysqli_query($conn, "SELECT image FROM products WHERE id='$id' LIMIT 1");
    $data = mysqli_fetch_assoc($get);

    if ($data) {

        $publicPath = $data['image'];

        // Hapus path projek-uas/ utk dapat path sebenarnya
        $relativePath = str_replace("/projek-uas", "..", $publicPath);

        $serverFile = $relativePath;

        //Hapus filenya
        if (file_exists($serverFile)) {
            unlink($serverFile);
        }
    }



    //hapus di db

    $query = "DELETE FROM products WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: ../pages/admin/manajemenProduct.php?");
        exit();
    } else {
        header("Location: ../pages/admin/manajemenProduct.php?status=error");
        exit();
    }

} else {
    header("Location: ../pages/admin/manajemenProduct.php?status=error");
    exit();
}
