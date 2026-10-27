<?php
include "fungsi.php"; // Sertakan fungsi.php untuk koneksi dan fungsi lainnya

// Cek apakah ada parameter ID obat
if (isset($_GET['id_obat'])) {
    $id_obat = $_GET['id_obat'];

    // Panggil fungsi untuk menghapus obat
    if (hapusObat($id_obat) > 0) {
        echo "<script>alert('Data obat berhasil dihapus.'); window.location.href = 'lihatstokobat.php';</script>";
    } else {
        echo "<script>alert('Data obat gagal dihapus.'); window.location.href = 'lihatstokobat.php';</script>";
    }
} else {
    // Redirect jika ID tidak ada
    header("Location: lihatstokobat.php");
    exit;
}
?>
