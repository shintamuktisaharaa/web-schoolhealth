<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_obat = $_POST['id_obat'];
    $nama_obat = $_POST['nama_obat'];
    $stok_obat = $_POST['stok_obat'];
    $deskripsi_obat = $_POST['deskripsi_obat'];
    $tanggal_kadaluwarsa = $_POST['tanggal_kadaluwarsa'];

    // Query untuk memperbarui data
    $query = "UPDATE stok_obat SET
                nama_obat = '$nama_obat',
                stok_obat = '$stok_obat',
                deskripsi_obat = '$deskripsi_obat',
                tanggal_kadaluwarsa = '$tanggal_kadaluwarsa'
              WHERE id_obat = '$id_obat'";

    // Eksekusi query dan cek error
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil diperbarui!";
        header("Location: editstokobat.php"); // Redirect ke halaman lihat stok obat
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>
