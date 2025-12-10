<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
