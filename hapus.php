<?php
include 'koneksi.php';
include 'fungsi.php';

if (isset($_GET['id'])) {
    $id_kunjungan = $_GET['id'];
    deleteKunjungan($id_kunjungan);
    header("Location: editkunjungan.php");
    exit;
}
?>
