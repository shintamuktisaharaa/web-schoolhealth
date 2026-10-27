<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kunjungan = (int) $_POST['id_kunjungan'];
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $id_obat_baru = empty($_POST['id_obat']) ? NULL : (int) $_POST['id_obat'];

    // **1. Ambil id_obat lama sebelum update**
    $query_old = "SELECT id_obat FROM kunjungan WHERE id_kunjungan = $id_kunjungan";
    $result_old = mysqli_query($koneksi, $query_old);
    $row_old = mysqli_fetch_assoc($result_old);
    $id_obat_lama = $row_old['id_obat'];

    // **2. Update data kunjungan**
    $query_update = "UPDATE kunjungan 
                     SET nama_siswa = '$nama_siswa', 
                         kelas = '$kelas', 
                         tanggal = '$tanggal', 
                         keluhan = '$keluhan', 
                         id_obat = " . ($id_obat_baru ? $id_obat_baru : "NULL") . " 
                     WHERE id_kunjungan = $id_kunjungan";
    
    if (mysqli_query($koneksi, $query_update)) {

        // **3. Perbarui stok obat**
        if ($id_obat_lama !== $id_obat_baru) {
            // a) Jika obat lama tidak NULL, tambahkan kembali stoknya
            if (!is_null($id_obat_lama)) {
                $query_tambah_stok = "UPDATE stok_obat SET jumlah = jumlah + 1 WHERE id_obat = $id_obat_lama";
                mysqli_query($koneksi, $query_tambah_stok);
            }
            
            // b) Jika obat baru tidak NULL, kurangi stoknya
            if (!is_null($id_obat_baru)) {
                $query_kurangi_stok = "UPDATE stok_obat SET jumlah = jumlah - 1 WHERE id_obat = $id_obat_baru AND jumlah > 0";
                mysqli_query($koneksi, $query_kurangi_stok);
            }
        }

        // Redirect setelah update berhasil
        header("Location: editkunjungan.php?message=success");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>
