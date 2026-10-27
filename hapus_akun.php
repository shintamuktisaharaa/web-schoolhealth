<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Query untuk menghapus akun dari tabel login
    $query = "DELETE FROM login WHERE email = '$email'";

    if (mysqli_query($koneksi, $query)) {
        // Hapus sesi dan redirect ke halaman login
        session_unset();
        session_destroy();
        echo "<script>alert('Akun berhasil dihapus.'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "Gagal menghapus akun. Silakan coba lagi.";
    }
} else {
    // Jika sesi email tidak ditemukan, kembali ke index
    header("Location: index.php");
    exit();
}
?>
